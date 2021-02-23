<?
AddEventHandler("main", "OnEpilog", function () {
    $GLOBALS['APPLICATION']->IncludeComponent(
        "ex2:metatags",
        "",
        Array(),
    );
});