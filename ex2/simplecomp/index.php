<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("simplecomp");
?>/////////////////////////////////////////////////////<?$APPLICATION->IncludeComponent(
	"ex2:simplecomp", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"NEWS_IBLOCK_ID" => "1",
		"AUTHOR_CODE" => "AUTHOR",
		"AUTHOR_TYPE_CODE" => "UF_USER_GROUP"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>