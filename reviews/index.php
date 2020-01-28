<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оставить отзыв – алмазное бурение и резка Резалмаз");
$APPLICATION->SetPageProperty("description", "Отзывы о работе компании РезАлмаз. Мы предлагаем услуги по алмазной резке проемов в Москве и Московской области. Звоните по телефону +7 (495) 792-93-92.");
$APPLICATION->SetTitle("Оставить отзыв");
?> 
<div class="inner_two_column inner_two_column_2 text_style"> 					 
	<div class="left_column"> 						 
		<h1>Отзывы</h1>
		<br />
		<div class="faq">
		
		<?$APPLICATION->IncludeComponent("bitrix:news.list", "reviews_list", array(
	"IBLOCK_TYPE" => "FAQ",
	"IBLOCK_ID" => "4",
	"NEWS_COUNT" => "20",
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
	"SET_TITLE" => "Y",
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
	</div>
		 
	<div class="right_column padding_top_57"> 						 
		<div class="grey_box_2"> 							 
			<div class="grey_header"> 								 
				<div class="decor_l"></div>
				<div class="decor_r"></div>
       		</div>
     							 
			<div class="grey_content"> 								 
				<div class="grey_content_l"> 									 
					<div class="grey_content_r"> 										 
						<div class="text_style"> 											 
							<h3 class="h3_bg">Оставить отзыв</h3>
							<?$APPLICATION->IncludeFile('/form_reviews.php', array(), array('MODE'=>'html'))?>
							<?
								/*AddEventHandler("iblock", "OnAfterIBlockElementAdd", "switch_activity");
								function switch_activity(&$arFields){
									$el = new CIBlockElement;
									$elem_id = $arFields["ID"];
									$change_property = Array("ACTIVE" => "Y");
									$res = $el->Update($elem_id, $change_property);
								}*/
		
							?>	
	<? /*$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "add_reviews", array(
	"IBLOCK_TYPE" => "faq",
	"IBLOCK_ID" => "3",
	"STATUS_NEW" => "ANY",
	"LIST_URL" => "",
	"USE_CAPTCHA" => "Y",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "Ваш отзыв добавлен.",
	"DEFAULT_INPUT_SIZE" => "30",
	"RESIZE_IMAGES" => "N",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "2",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "2",
	),
	"GROUPS" => array(
		0 => "2",
	),
	"STATUS" => "ANY",
	"ELEMENT_ASSOC" => "PROPERTY_ID",
	"ELEMENT_ASSOC_PROPERTY" => "",
	"MAX_USER_ENTRIES" => "100000",
	"MAX_LEVELS" => "100000",
	"LEVEL_LAST" => "Y",
	"MAX_FILE_SIZE" => "0",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/",
	"CUSTOM_TITLE_NAME" => "Фамилия и имя",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "Текст сообщения",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "",
	"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
); */?>
						</div>
           			</div>
         		</div>
       		</div>
     							 
			<div class="grey_footer"> 								 
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
     	</div>
   	</div>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>