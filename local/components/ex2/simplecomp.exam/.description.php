<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SIMPLECOMP"),
	"DESCRIPTION" => GetMessage("SIMPLECOMP_DESC"),
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "simplecomp.exam",
			"NAME" => GetMessage("T_IBLOCK_DESC_CATALOG"),
			"SORT" => 30,
		)
	),
);
?>