<?if(!defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED!==true) die();
if($arResult['CANONICAL']){
    $APPLICATION->SetPageProperty("canonical", $arResult['CANONICAL']);
}