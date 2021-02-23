<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class Metatags extends CBitrixComponent
{
    public function executeComponent()
    {   
        if (!\Bitrix\Main\Loader::IncludeModule("iblock")){
            return false;
        }
        if($this->StartResultCache(3600000)){
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
            $this->arResult = Array("ELEMENT" => CIBlockElement::GetList(array(), $filter, false, array(), $select)->GetNext(), 'a' => 1);
            $this->SetResultCacheKeys(Array("ELEMENT", "a"));
            $this->EndResultCache();
        }
        $result = $this->arResult['ELEMENT'];
        if (isset($result)) {
            $db_props = CIBlockElement::GetProperty($result['IBLOCK_ID'], $result['ID'],"sort", "asc", array());
            $PROPS = array();
            while($ar_props = $db_props->GetNext()){
                $PROPS[$ar_props['NAME']] = $ar_props['VALUE'];
            }
            $GLOBALS['APPLICATION']->SetPageProperty("title", $PROPS['TITLE']); 
            $GLOBALS['APPLICATION']->SetPageProperty("description", $PROPS['DESCRIPTION']); 
        }
    }
}