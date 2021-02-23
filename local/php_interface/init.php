<?
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnEpilog', 'metatags');
function metatags() {
    $GLOBALS['APPLICATION']->IncludeComponent(
        "ex2:metatags",
        "",
        Array(),
    );
}