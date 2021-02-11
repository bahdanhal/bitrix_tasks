<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

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
		"NEWS_PROPERTY_ELEMENT_ID" => Array(
			"PARENT" => "IBLOCKS_SETTINGS",
			"NAME" => GetMessage("NEWS_PROPERTY_ELEMENT_ID"),
			"TYPE" => "STRING",
		),
		"TEMPLATE" => Array(
			"PARENT" => "COMPONENT_SETTINGS",
			"NAME" => GetMessage("TEMPLATE"),
			"TYPE" => "STRING",
		),
		"CACHE_TYPE" => Array(
			"PARENT" => "COMPONENT_SETTINGS",
			"NAME" => GetMessage("CACHE_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => array('AUTO_MANAGED' => GetMessage("AUTO_MANAGED"), 'AUTO' => GetMessage("AUTO"), 'NONE' => GetMessage("NONE")),
	   ),
		"CACHE_TIME"  => Array(
			"PARENT" => "COMPONENT_SETTINGS",
			"NAME" => GetMessage("CACHE_TIME"),
			"TYPE" => "STRING",
			"DEFAULT" => 36000000,
		),
	),
);

