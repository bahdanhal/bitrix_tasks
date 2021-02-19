<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock")){
	return;
}
AddMessage2Log(GetMessage("COMPONENT_SETTINGS"));
$arComponentParameters = array(
	"GROUPS" => array(
		"IBLOCKS_SETTINGS" => array(
			"SORT" => 110,
			"NAME" => GetMessage("IBLOCKS_SETTINGS"),
		),
		"COMPONENT_SETTINGS" => array(
			"SORT" => 120,
			"NAME" => GetMessage("COMPONENT_SETTINGS"),
		),
	),
	"PARAMETERS" => array(

		"CATALOG_IBLOCK_ID" => array(
			"PARENT" => "IBLOCKS_SETTINGS",
			"NAME" => GetMessage("CATALOG_IBLOCK_ID"),
			"TYPE" => "STRING",

		),
		"NEWS_IBLOCK_ID" => array(
			"PARENT" => "IBLOCKS_SETTINGS",
			"NAME" => GetMessage("NEWS_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"UF_NEWS_LINK_ID" => Array(
			"PARENT" => "IBLOCKS_SETTINGS",
			"NAME" => GetMessage("UF_NEWS_LINK_ID"),
			"TYPE" => "STRING",
		),
		"CACHE_TIME"  => Array(
			"DEFAULT" => 36000000,
		),
	),
);

