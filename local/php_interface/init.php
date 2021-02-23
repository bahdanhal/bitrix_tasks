<?
AddEventHandler("main", "OnProlog", function () {
    addMessage2Log('aaaaa');
    $GLOBALS['APPLICATION']->IncludeComponent(
        "ex2:metatags",
        "",
        Array(),
    );
});