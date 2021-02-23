<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class Metatags extends CBitrixComponent
{
    public function executeComponent()
    {   
        if (!\Bitrix\Main\Loader::IncludeModule("iblock")){
            return false;
        }
        if($this->StartResultCache(3600000, $GLOBALS['APPLICATION']->GetCurPage())){
            $select = array(
                'ID',
                'IBLOCK_ID',
                'NAME',
                'TITLE',
                'DESCRIPTION',
            );
            $filter = array(
                "NAME" => $GLOBALS['APPLICATION']->GetCurPage(),
            );
            $element = CIBlockElement::GetList(array(), $filter, false, array(), $select)->GetNext();
            if(!isset($element)){
                $this->AbortResultCache();
            }
            $db_props = CIBlockElement::GetProperty($element['IBLOCK_ID'], $element['ID'],"sort", "asc", array());
            $PROPS = array();
            while($ar_props = $db_props->GetNext()){
                $PROPS[$ar_props['NAME']] = $ar_props['VALUE'];
            }
            $this->arResult = Array("TITLE" => $PROPS['TITLE'], "DESCRIPTION" => $PROPS['DESCRIPTION']);
            $this->SetResultCacheKeys(Array("ELEMENT", "DESCRIPTION"));
            $this->EndResultCache();
        }

        if (isset($this->arResult)) {
            $GLOBALS['APPLICATION']->SetPageProperty("title", $this->arResult['TITLE']); 
            $GLOBALS['APPLICATION']->SetPageProperty("description", $this->arResult['DESCRIPTION']); 
        }
    }
}