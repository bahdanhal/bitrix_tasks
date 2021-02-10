<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("feedback");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"EMAIL_TO" => "aaaaaaa@test.ru",
		"EVENT_MESSAGE_ID" => array(),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(),
		"USE_CAPTCHA" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>