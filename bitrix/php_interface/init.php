<?
addEventHandler("iblock", "OnBeforeIBlockElementUpdate", function (&$arFields) {
    if($arFields['ACTIVE'] == 'Y' ){
        return true;
    }

    $select = array(
        'ID',
        'IBLOCK_ID',
        'ACTIVE',
        'SHOW_COUNTER',
    );
    $filter = array(
        "IBLOCK_ID" => $arFields["IBLOCK_ID"],
        "ID" => $arFields["ID"]
    );

    $iterator = CIBlockElement::GetList(array(), $filter, false, array(), $select);
    if ($result = $iterator->GetNext()) {
        AddMessage2Log($result);
        if($result["ACTIVE"] == 'Y' and $result["SHOW_COUNTER"] > 2){
            $GLOBALS['APPLICATION']->throwException('«Товар невозможно деактивировать, у него ' . $result["SHOW_COUNTER"] . ' просмотров»'); 
            return false;
        }
    }
});