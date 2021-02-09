<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult['CANONICAL']){
    $APPLICATION->SetPageProperty("canonical", $arResult['CANONICAL']);
}