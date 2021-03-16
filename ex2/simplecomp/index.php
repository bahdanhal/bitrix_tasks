<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("simplecomp");
?><?$APPLICATION->IncludeComponent(
	"ex2:simplecomp.exam", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CATALOG_IBLOCK_ID" => "2",
		"FIRM_IBLOCK_ID" => "5",
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"LINK_TEMPLATE" => "#SITE_DIR#/products/detail.php?ID=#ELEMENT_ID#",
		"PAGE_COUNT" => "2",
		"CACHE_DEPENDENCY_IBLOCK_ID" => "3"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>