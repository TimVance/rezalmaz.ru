<?
$arUrlRewrite = array(
	array(
		"CONDITION"	=>	"#/faq/page_([0-9]+)/(\\?.*)?#",
		"RULE"	=>	"PAGEN_1=$1",
		"ID"	=>	"",
		"PATH"	=>	"/faq/index.php",
	),
	array(
		"CONDITION"	=>	"#/faq/(.*)/(\\?.*)?#",
		"RULE"	=>	"CODE=$1",
		"ID"	=>	"",
		"PATH"	=>	"/faq/detail.php",
	),
	array(
		"CONDITION"	=>	"#^/portfolio/#",
		"RULE"	=>	"",
		"ID"	=>	"bitrix:news",
		"PATH"	=>	"/portfolio/index.php",
	),
	array(
		"CONDITION"	=>	"#^/regions/#",
		"RULE"	=>	"",
		"ID"	=>	"bitrix:news",
		"PATH"	=>	"/regions/index.php",
	),
);

?>