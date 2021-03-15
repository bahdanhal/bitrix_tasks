<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class ClassifiedProduction extends CBitrixComponent
{
    private function modulesCheck()
    {
        if (!Bitrix\Main\Loader::includeModule("iblock")) 
        {
            throw new \Exception('Modules error');
        }

        return true;
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
        $arElementFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 
            'ACTIVE' => 'Y', 
            'UF_FIRM' => $arFirmID,
            'CHECK_PERMISSIONS' => $this->arParams['CACHE_GROUPS']
        ];
        $arElementSelect = ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER', 'PROPERTY_UF_FIRM', 'DETAIL_PAGE_URL'];
        return CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
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
                $result['ELEMENTS_BY_FIRMS'][$catalogElement['PROPERTY_UF_FIRM_VALUE']][] =  $catalogElement;
            }
        }

        return $result;            
    }

    public function executeComponent()
    {
        $this->modulesCheck();
        if($this->startResultCache(false, array($GLOBALS['USER']->GetGroups()))){
            $this->arResult = $this->result();
            $this->SetResultCacheKeys(['ELEMENTS_COUNT']);
            $this->IncludeComponentTemplate();
        }
        $GLOBALS['APPLICATION']->SetTitle("Разделов: " . $this->arResult['ELEMENTS_COUNT']);
    }
}