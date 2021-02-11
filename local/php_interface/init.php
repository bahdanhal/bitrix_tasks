<?
AddEventHandler("main", "OnProlog", function () {
    $select = array(
        'ID',
        'IBLOCK_ID',
        'NAME',
        'TITLE',
        'DESCRIPTION',
    );
    $filter = array(
        "NAME" => $GLOBALS['APPLICATION']->getCurDir(),
    );

    if (CModule::IncludeModule("iblock")){
        $iterator = CIBlockElement::GetList(array(), $filter, false, array(), $select);
        if ($result = $iterator->GetNext()) {
            //CIBlockElement::GetProperty($result['IBLOCK_ID'], $result['ID'], array(), array(), array());//"TITLE"));
            $db_props = CIBlockElement::GetProperty($result['IBLOCK_ID'], $result['ID'],"sort", "asc", array());
            $PROPS = array();
            while($ar_props = $db_props->GetNext()){
            	$PROPS[$ar_props['NAME']] = $ar_props['VALUE'];
            }
            $GLOBALS['APPLICATION']->SetPageProperty("title", $PROPS['TITLE']); 
            $GLOBALS['APPLICATION']->SetPageProperty("title", $PROPS['DESCRIPTION']); 
            //$sectionProps = CIBlockElement::GetProperty($result['IBLOCK_ID'], $result['ID'], array(), array("DESCRIPTION"));
            //$GLOBALS['APPLICATION']->SetPageProperty("title", $sectionProps->getNext()['VALUE']);
        }
    }
    
});