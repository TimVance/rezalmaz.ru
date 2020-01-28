<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Вопрос-Ответ – алмазное бурение и резка Резалмаз");
$APPLICATION->SetPageProperty("description", "Вопросы и ответы. Мы предлагаем услуги по алмазной резке проемов в Москве и Московской области. Звоните по телефону +7 (495) 792-93-92.");
$APPLICATION->SetTitle("Вопрос-Ответ");
?> 
<div class="inner_two_column inner_two_column_2 text_style"> 					 
  <div class="left_column"> 						 
    <h1>Вопрос-ответ</h1>
   						 
    <br />
   <?/*$APPLICATION->IncludeComponent("bitrix:news.list", "faq", array(
	"IBLOCK_TYPE" => "FAQ",
	"IBLOCK_ID" => "1",
	"NEWS_COUNT" => "10",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "ID",
		1 => "",
		2 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
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
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "1",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "faq",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);*/?>
<div class="faq">
<?$APPLICATION->IncludeComponent("bitrix:support.faq.section.list", "template_faq", Array(
	"IBLOCK_TYPE" => "FAQ",	// Типы инфоблоков
	"IBLOCK_ID" => "6",	// Список инфоблоков
	"SECTION" => "",	// Список секций (по умолчанию - из корневой секции)
	"EXPAND_LIST" => "Y",	// Показывать вложенные секции
	"SECTION_URL" => "faq_detail.php?SECTION_ID=#SECTION_ID#",	// URL страницы секции (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?></div> 					</div>
 					 
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
              <h3 class="h3_bg">Задайте вопрос тут</h3>
             											<?$APPLICATION->IncludeFile('/form_question.php', array(), array('MODE'=>'html'))?> 										</div>
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