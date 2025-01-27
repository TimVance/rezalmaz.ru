<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Портфолио");
?>

<div class="grey_box_1 inner_info_box height_auto portfolio">
<?if($_SERVER['REQUEST_URI']=='/portfolio/'){
$APPLICATION->SetPageProperty("description", "Здесь вы можете ознакомиться с примерами наших выполненных работ по алмазной резке, алмазному бурению и демонтажу. Компания РезАлмаз высокое качество предоставляемых услуг по низким ценам.");
?>
<h1>Галерея наших работ</h1>
<h2 class="h2_bg">Фотогалерея</h2>
<?}?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"portfolio",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "Content",
		"IBLOCK_ID" => "5",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(),
		"LIST_PROPERTY_CODE" => array(),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(),
		"DETAIL_PROPERTY_CODE" => array('PF_PHOTOS', 'NAME', 'DESCRIPTION'),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"SEF_FOLDER" => "/portfolio/",
		"SEF_URL_TEMPLATES" => Array(
			"detail" => "#ELEMENT_CODE#/"
		),
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"VARIABLE_ALIASES" => Array(
			"detail" => Array(),
		)
	)
);?>
<?if($_SERVER['REQUEST_URI']=='/portfolio/'){?>
<h2 class="h2_bg">Видео наших работ</h2>
</div>
<div class="service-bottom-block text_style video" style="margin-top: -50px;">
	<div>
		<iframe style="float:left; margin-right: 10px;" width="500" height="285" src="https://www.youtube.com/embed/7W9vyh8gCNM?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<iframe width="500" height="285" src="https://www.youtube.com/embed/mDHLY1LlrhQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	</div>
</div>
<?}?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
