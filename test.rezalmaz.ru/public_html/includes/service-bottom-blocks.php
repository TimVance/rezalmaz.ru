<?if($_SERVER['REQUEST_URI']!='/services/'){?>
	<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
	<script src="//yastatic.net/share2/share.js"></script>
	<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter" data-counter=""></div>
<?}?>

<div class="service-bottom-block">
	<h2 class="h2_bg">Услуги</h2>
	<ul class="page_menu"> 	 
		<li><?=set_seo_link('/almaznaja_rezka/', '<span class="sm_ico ico_1"></span>Алмазная резка')?><p class="price"><a href="/almaznaja_rezka/price-almaznaya-rezka/">Цены</a></p></li>
		<li><?=set_seo_link('/almaznoe_stroblenie/', '<span class="sm_ico ico_2"></span>Штробление')?><p class="price"><a href="/price/">Цены</a></p></li>
		<li><?=set_seo_link('/almaznoe_burenie/', '<span class="sm_ico ico_3"></span>Алмазное бурение')?><p class="price"><a href="/almaznoe_burenie/price-almaznoe-sverlenie/">Цены</a></p></li>
		<li><?=set_seo_link('/usilenie_projomov/', '<span class="sm_ico ico_4"></span>Усиление проёмов')?><p class="price"><a href="/price/">Цены</a></p></li>
		<li><?=set_seo_link('/kanatnaya_rezka/', '<span class="sm_ico ico_6"></span>Канатная резка')?><p class="price"><a href="/price/">Цены</a></p></li>
	</ul>
</div>

<div class="service-bottom-block">
	<h2 class="h2_bg">Отзывы</h2>
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "service_reviews_list", array(
		"IBLOCK_TYPE" => "FAQ",
		"IBLOCK_ID" => "3",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"ACTIVE" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "DETAIL_TEXT",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
		),
		false
	);?>
</div>

<div class="service-bottom-block">
	<h2 class="h2_bg">Допуск СРО</h2>
	
	<table class="tb-sro">
	<tbody>
		<tr>
			<td>
				<img src="/about/sro/sro_izyskaniya.jpg" alt="Свидетельство о допуске к работам, которые оказывают влияние на безопасность объектов капитального строительства" />
				<p><a href="/about/sro/sro-izyskaniya-rezalmazstroi.pdf" title="Свидетельство о допуске к работам, которые оказывают влияние на безопасность объектов капитального строительства">Посмотреть свидетельство о допуске к работам (pdf)</a></p>
			</td>
			<td>
				<img src="/about/sro/sro_proekt.jpg" alt="Свидетельство о допуске к работам по подготовке проектной документации, которые оказывают влияние на безопасность объектов капитального строительства" />
				<p><a href="/about/sro/sro-projekt-rezalmazstroi.pdf" title="Свидетельство о допуске к работам по подготовке проектной документации, которые оказывают влияние на безопасность объектов капитального строительства">Посмотреть свидетельство о допуске к работам по подготовке проектной документации (pdf)</a></p>
			</td> 
			<td>
				<img src="/about/sro/sro_stroit.jpg" alt="Свидетельство о допуске к определенному виду или видам работ, которые оказывают влияние на безопасность объектов капитального строительства" />
				<p><a href="/about/sro/sro_stroit_2015.pdf" title="Свидетельство о допуске к определенному виду или видам работ, которые оказывают влияние на безопасность объектов капитального строительства">Посмотреть свидетельство о допуске к работам на объектах (pdf)</a></p>
			</td>
		</tr>           
	</tbody>
	</table>
</div> 

<div class="service-bottom-block">
	<h2 class="h2_bg">Наши работы</h2>
	
	<?
	global $arrFilter;
	$arrFilter = array("=ID" => array(5410,5408,5407));
	?>
	
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "service_portfolio", array(
		"IBLOCK_TYPE" => "PORTFOLIO",
		"IBLOCK_ID" => "8",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"ACTIVE" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "DETAIL_TEXT",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
		),
		false
	);?>
</div>
