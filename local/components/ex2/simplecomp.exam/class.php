<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class ClassifiedProduction extends CBitrixComponent
{
    private $filter;
    private function modulesCheck()
    {
        if (!Bitrix\Main\Loader::includeModule("iblock")) 
        {
            throw new \Exception('Modules error');
        }

        return true;
    }

    private function getButtonLinks(&$element) {

        $buttons = CIBlock::GetPanelButtons(
            $element["IBLOCK_ID"],
            $element["ID"]
        );
        $element["ADD_LINK"] = $buttons["edit"]["add_element"]["ACTION_URL"];
        $element["EDIT_LINK"] = $buttons["edit"]["edit_element"]["ACTION_URL"];
        $element["DELETE_LINK"] = $buttons["edit"]["delete_element"]["ACTION_URL"];

    }

    private function getFirms()
    {
        $arFirmFilter = ['IBLOCK_ID' => $this->arParams['FIRM_IBLOCK_ID'], 
            'CHECK_PERMISSIONS' => $this->arParams['CACHE_GROUPS']
        ];
        $arFirmSelect = ['IBLOCK_ID', 'ID', 'NAME'];
        return CIBlockElement::GetList([], $arFirmFilter, false, false, $arFirmSelect);;
    }

    private function getElements()
    {
        $arElementFilter = [];
        if(isset($this->filter)){
            $arElementFilter = [
                'IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 
                'ACTIVE' => 'Y', 
                'UF_FIRM' => $arFirmID,
                'CHECK_PERMISSIONS' => $this->arParams['CACHE_GROUPS'],
                array(
                    "LOGIC" => "OR",
                    array(
                        "<=PROPERTY_PRICE" => 1700, 
                        "=PROPERTY_MATERIAL" => "Дерево, ткань"
                    ), 
                    array(
                        "<PROPERTY_PRICE" => "1500",
                        "PROPERTY_MATERIAL" => "Металл, пластик"
                    ),
                ),
            ]; 
        } else {
            $arElementFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 
                'ACTIVE' => 'Y', 
                'UF_FIRM' => $arFirmID,
                'CHECK_PERMISSIONS' => $this->arParams['CACHE_GROUPS']
            ];
        }
        $arElementSelect = ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER', 'PROPERTY_UF_FIRM', 'DETAIL_PAGE_URL'];
        return CIBlockElement::GetList(['NAME' => 'ASC', 'SORT' => 'ASC'], $arElementFilter, false, false, $arElementSelect);
    }
    private function result()
    {
        $firmList = $this->getFirms();
        while ($firm = $firmList->GetNext()){
	        $arFirmID[] = $firm['ID'];
            $result['FIRMS'][$firm['ID']] = [
                'FIRM_NAME' => $firm['NAME'], 
            ];
        }
        $result['ELEMENTS_COUNT'] = $firmList->SelectedRowsCount();

        $elementsResult = $this->getElements();
        $elementsResult->SetUrlTemplates($arParams['LINK_TEMPLATE']);
        while ($catalogElement = $elementsResult->GetNext()){
            if(in_array($catalogElement['PROPERTY_UF_FIRM_VALUE'], $arFirmID)){
                $this->getButtonLinks($catalogElement);
                $result['ELEMENTS_BY_FIRMS'][$catalogElement['PROPERTY_UF_FIRM_VALUE']][] =  $catalogElement;
            }
        }

        $result['LINK'] = $GLOBALS['APPLICATION']->GetCurUri('F=Y');
        return $result;
    }

    public function executeComponent()
    {
        $this->modulesCheck();
        $this->filter = \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->get('F');
        if(isset($this->filter)){
            $this->arResult = $this->result();    
            $this->IncludeComponentTemplate();
        } else {
            if($this->startResultCache(false, array($GLOBALS['USER']->GetGroups()))){
                $this->arResult = $this->result();
                $this->SetResultCacheKeys(['ELEMENTS_COUNT', 'LINK']);
                $this->IncludeComponentTemplate();
            }
        }
        $GLOBALS['APPLICATION']->SetTitle("Разделов: " . $this->arResult['ELEMENTS_COUNT']);
    }
}
