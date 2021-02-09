<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(CModule::IncludeModule("iblock")){
    /*if (is_set($arParams["CANONICAL_ID"]) && intval($arParams["CANONICAL_ID"]) > 0) {
        $select = array(
            'ID',
            'IBLOCK_ID',
            //'NAME',
            'PROPERTY_NEWS',
        );
        $filter = array(
            //"IBLOCK_ID" => 5,//$arParams["CANONICAL_ID"],
            // ."PROPERTY_NEWS" => $arResult["ID"]
        );
        print_r(GetIBlock($arParams["CANONICAL_ID"]));
        $iterator = CIBlockElement::GetList(array(), $filter, false, array(), $select);
//        if ($result = $iterator->GetNext()) {
//            $this->getComponent()->setResultCacheKeys(["CANONICAL"]);
//        }
        //$arResult['CANONICAL'] = 'test.ru/test';
        $this->getComponent()->setResultCacheKeys(["CANONICAL"]);

    }*/
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
          $arResult["CANONICAL"] = $result["NAME"];
          $this->getComponent()->setResultCacheKeys(["CANONICAL"]);
       }
    }
    
}
