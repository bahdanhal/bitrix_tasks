<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(CModule::IncludeModule("iblock")){
    if (is_set($arParams["CANONICAL_ID"]) and $arParams["CANONICAL_ID"] > 0) {
        $select = array(
            'ID',
            'IBLOCK_ID',
            'NAME',
            'PROPERTY_NEWS',
        );
       $filter = array(
          "IBLOCK_ID" => $arParams["CANONICAL_ID"],
          "PROPERTY_NEWS" => $arResult["ID"]
       );
    
       $iterator = CIBlockElement::GetList(array(), $filter, false, array(), $select);
       if ($result = $iterator->GetNext()) {
           if($result["NAME"]){
                $APPLICATION->SetPageProperty("canonical", $result["NAME"]);
           }
       }
    }
    
}
