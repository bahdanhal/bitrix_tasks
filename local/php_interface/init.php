<?
AddEventHandler("main", "OnBeforeEventAdd", function (&$event, &$lid, &$arFields) {
    $user = $GLOBALS['USER'];
    if ($event !== "FEEDBACK_FORM") {
        return true;
    }
    if (!$user->IsAuthorized()) {
        $arFields["AUTHOR"] = "Пользователь не авторизован, данные из формы: " . $arFields["AUTHOR"];
    } else {
        $arFields["AUTHOR"] = "Пользователь авторизован: ". $user->GetID() . ' (' . $user->GetLogin() . ') ' . $user->GetFullName() .
         ", данные из формы: " . $arFields["AUTHOR"];
    }
    
    CEventLog::Add([
        "SEVERITY" => "INFO",
        "AUDIT_TYPE_ID" => "MAIL_DATA_REPLACED",
        "MODULE_ID" => "main",
        "ITEM_ID" => $user->GetID(),
        "DESCRIPTION" => "Замена данных в отсылаемом письме – " . $arFields["AUTHOR"],
    ]);
});