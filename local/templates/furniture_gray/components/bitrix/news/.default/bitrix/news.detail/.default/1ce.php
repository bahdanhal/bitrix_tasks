<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($_GET['REPORT'] == 'Y'){
    //отправка
    if(isset($_GET['SEND'])){
        return;
    }
    if($GLOBALS['USER']->IsAuthorized()){
        
    }
    $element = new CIBlockElement;

    $properties = array(
        "USER_INFO" => $user,
        "NEWS" => $arResult['ID'],
    );
    $arFields = Array(
        "IBLOCK_ID"      => 5,
        "PROPERTY_VALUES"=> $properties,
        'ACTIVE_FROM'     => ConvertTimeStamp(time(), "FULL"),
        "NAME"           => "Жалоба на новость №".$arResult['ID'],
    );

    $arResult['REPORT_ID'] = $element->Add($arFields);
    
    if($arParams['USE_AJAX'] === 'Y'){
        $GLOBALS['APPLICATION']->RestartBuffer();
        exit();
    } else {
        LocalRedirect($GLOBALS['APPLICATION']->GetCurUri("SEND=Y&REPORT_ID=" . $arResult['REPORT_ID']));
    }
}
