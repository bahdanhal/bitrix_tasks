<?
AddEventHandler('main',   'OnEpilog',  function(){
    if (defined('ERROR_404') and ERROR_404 == 'Y' or CHTTP::GetLastStatus() == "404 Not Found"){
        CEventLog::Add(array(
            "SEVERITY" => "INFO",
            "AUDIT_TYPE_ID" => "ERROR_404",
            "MODULE_ID" => "main",
            "DESCRIPTION" => $GLOBALS['APPLICATION']->GetCurUri(),
         ));
    }
});