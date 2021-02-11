<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("Текущая дата"),
	"DESCRIPTION" => GetMessage("Выводим текущую дату"),
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