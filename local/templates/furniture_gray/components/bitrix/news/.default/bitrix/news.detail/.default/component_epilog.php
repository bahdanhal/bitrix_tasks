<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(isset($_GET['REPORT'])){

    if($GLOBALS['USER']->IsAuthorized()){
        $user = $USER->GetID() . " (" . $USER->GetLogin() . ") " . $USER->GetFullName();
    } else {
        $user = "Не авторизован";
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
    $reportId = $element->Add($arFields);
    if($arParams['USE_AJAX'] === 'Y'){
        $answer['ID'] = $reportId;
        $GLOBALS['APPLICATION']->RestartBuffer();
        echo json_encode($answer);
        exit();
    } else {
        if(isset($reportId)){
            $text = 'Жалоба принята, №' . $reportId;
        } else {
            $text = 'Ошибка';
        }
        $component = ob_get_contents();
        ob_clean();
        echo $text . $component;
    }
}