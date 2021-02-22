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
    private function result()
    {
        $arFirmFilter = ['IBLOCK_ID' => $this->arParams['FIRM_IBLOCK_ID']];
        $arFirmSelect = ['IBLOCK_ID', 'ID', 'NAME'];
        $firmList = CIBlockElement::GetList([], $arFirmFilter, false, false, $arFirmSelect);
        while ($firm = $firmList->Fetch()){
	        $arFirmID[] = $firm['ID'];
            $result[$firm['ID']] = [
                'FIRM_NAME' => $firm['NAME'], 
                'ELEMENTS' => []
            ];
        }
        $result['ELEMENTS_COUNT'] = $firmList->SelectedRowsCount();

        $arElementFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 'ACTIVE' => 'Y', 'UF_FIRM' => $arFirmID];
        $arElementSelect = ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER', 'PROPERTY_UF_FIRM'];
        $elementsResult = CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
        while ($catalogElement = $elementsResult->Fetch()){
            if(CIBlockElementRights::UserHasRightTo($catalogElement['IBLOCK_ID'], $catalogElement['ELEMENT_ID'], 'R')){;
                if($catalogElement['PROPERTY_UF_FIRM_VALUE']){
                    $result[$catalogElement['PROPERTY_UF_FIRM_VALUE']]['ELEMENTS'][] =  $catalogElement;
                }
                $result[$catalogElement['PROPERTY_UF_FIRM_VALUE']]['iii'][] = CIBlockElementRights::UserHasRightTo($catalogElement['IBLOCK_ID'], $catalogElement['ELEMENT_ID'], 'element_read', 4);
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