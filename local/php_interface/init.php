<?
AddEventHandler("main", "OnBuildGlobalMenu", function (&$aGlobalMenu, &$aModuleMenu) {
   $contentManager = array(2, 3, 4, 5);
   if($GLOBALS['USER']->GetUserGroupArray() == $contentManager){
      foreach ($aGlobalMenu as $key => $v) {
         if ($key != 'global_menu_content'){ 
            unset($aGlobalMenu[$key]);
         }
      }
   
      foreach ($aModuleMenu as $key => $menu) {
         if ($menu["items_id"] != 'menu_iblock_/news') {
            unset($aModuleMenu[$key]);
         }
      } 
   }
});
