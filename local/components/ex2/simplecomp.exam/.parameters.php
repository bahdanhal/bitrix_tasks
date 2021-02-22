<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock")){
	return;
}
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
		"FIRM_IBLOCK_ID" => array(
			"PARENT" => "IBLOCKS_SETTINGS",
			"NAME" => GetMessage("FIRM_IBLOCK_ID"),
			"TYPE" => "STRING",
		),

		"CACHE_TIME"  => Array(
			"DEFAULT" => 36000000,
		),
	),
);