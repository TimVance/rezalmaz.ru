<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Клиенты и отзывы по алмазному бурению и резке – Резалмаз");
$APPLICATION->SetPageProperty("description", "Клиенты компании РезАлмаз. Мы предлагаем услуги по алмазной резке проемов в Москве и Московской области. Звоните по телефону +7 (495) 792-93-92.");
$APPLICATION->SetTitle("Клиенты и отзывы");
?> 
<div class="grey_box_1 inner_info_box height_auto"> 	
  <div class="grey_header"> 		
    <div class="decor_l"></div>
   		
    <div class="decor_r"></div>
   	</div>
 	
  <div class="grey_content"> 		
    <div class="grey_content_l"> 			
      <div class="grey_content_r"> 				
        <div class="inner_info_box_content_2 text_style"> 					
          <h1>Клиенты</h1>
         					
          <p>Нашими услугами по проведению ремонтно-строительных работ с применением технологии алмазной резки и алмазного сверления (бурения) воспользовались и оценили их уровень государственные и муниципальные учреждения, крупные предприятия и организации, фирмы - представители малого и среднего бизнеса, а также несколько сотен рядовых граждан (владельцы квартир, гаражей, загородных домов), многие из которых стали постоянными клиентами компании &quot;РезАлмаз&quot;.</p>
         				</div>
      								 			</div>
    							 		</div>
   	</div>
 	
  <div class="grey_footer"> 		
    <div class="decor_l"></div>
   		
    <div class="decor_r"></div>
   	</div>
 </div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"clients",
	Array(
		"IBLOCK_TYPE" => "clients",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"",),
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
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
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
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>