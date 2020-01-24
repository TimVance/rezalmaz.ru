<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "алмазная резка и бурение, москва");
$APPLICATION->SetPageProperty("description", "«РезАлмаз» - профессиональная алмазная резка в Москве и Подмосковье. ✔ низкие цены, ✔ высокое качество, ✔ быстрое выполнения работ, ✔ есть допуск СРО. Звоните ☎ +7 (495) 792-93-92.");
$APPLICATION->SetTitle("Алмазная резка бетона в Москве и области - «РезАлмаз»");
?> 
<div class="intex_two_column"> 	 
  <div class="left_column text_style"> 		 
    <h1>Алмазная резка бетона в Москве</h1>
    <p class="padding_top">Алмазная резка - это технология безударного демонтажа строительных конструкций из прочного материала - железобетон, бетон, кирпич, камень. Для работы с твердыми материалами используется специальное оборудование с алмазным напылением. Услуга алмазной резки применяется при выполнении ремонтных работ или перепланировки в жилых зданиях и других сооружениях.</p>
  </div>
 	 
  <div class="right_column flash-block"> 		 		<?/*<div class="grey_box_2">
			<div class="grey_header">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style big_font">
							<p class="padding_top"> <span class="orange_number">1</span>Более 5 лет в сфере строительства;</p>
							<p class="padding_top"> <span class="orange_number">2</span>Большой опыт работы как с крупными предприятиями, так и с частными клиентами;</p>
							<p class="padding_top"> <span class="orange_number">3</span>Полный спектр услуг при строительстве или проведении ремонта.</p>
						</div>								
					</div>							
				</div>
			</div>
			<div class="grey_footer">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div> */?> 		 		<noindex><embed type="application/x-shockwave-flash" wmode="opaque" pluginspage="https://www.macromedia.com/go/getflashplayer" src="/flash.swf" width="398" height="252" style="border: 1px solid #999;" ></noindex>		 	</div>
 </div>
<div class="text_style">
	<table>
		<caption><h2>Цены на услуги алмазной резки</h2></caption>
		<tbody>
			<tr>
				<th>Толщина стены (мм)</th>
				<th>Кирпич<br>
					(стоимость 1-го погонного метра)<br>
					в рублях</th>
				<th>Железобетон, монолит<br>
					(стоимость 1-го погонного метра)<br>
					в рублях</th>
			</tr>
			<tr class="zebra">
				<td class="td-style">до 120</td>
				<td class="td-style">920</td>
				<td class="td-style">1280</td>
			</tr>
			<tr>
				<td class="td-style">130-180</td>
				<td class="td-style">1150</td>
				<td class="td-style">1940</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">200</td>
				<td class="td-style">1250</td>
				<td class="td-style">2150</td>
			</tr>
			<tr>
				<td class="td-style">220</td>
				<td class="td-style">1370</td>
				<td class="td-style">2350</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">250</td>
				<td class="td-style">1570</td>
				<td class="td-style">2700</td>
			</tr>
			<tr>
				<td class="td-style">300</td>
				<td class="td-style">1870</td>
				<td class="td-style">3250</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">400</td>
				<td class="td-style">2500</td>
				<td class="td-style">4500</td>
			</tr>
			<tr>
				<td class="td-style">500</td>
				<td class="td-style">3150</td>
				<td class="td-style">5650</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">600</td>
				<td class="td-style">от 3750</td>
				<td class="td-style">от 7300</td>
			</tr>
			<tr>
				<td class="td-style">650</td>
				<td class="td-style">от 4350</td>
				<td class="td-style">от 7600</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">700</td>
				<td class="td-style">от 4700</td>
				<td class="td-style">от 8250</td>
			</tr>
		</tbody>
	</table>
</div>
 <?/*
<ul class="page_menu"> 	 
	<li><a href="/almaznaja_rezka/" ><span class="ico_1"></span>Алмазная резка</a></li>
	<li><a href="/almaznoe_stroblenie/" ><span class="ico_2"></span>Штробление</a></li>
	<li><a href="/almaznoe_burenie/" ><span class="ico_3"></span>Алмазное бурение</a></li>
	<li><a href="/usilenie_projomov/" ><span class="ico_4"></span>Усиление проёмов</a></li>
	<li><a href="/kanatnaya_rezka/" ><span class="ico_6"></span>Канатная резка</a></li>
</ul>
*/?>

<div class="index_three_column text_style"> 	 
  <div class="left_column"> 		 
    <h2 class="h2_bg">Клиенты нашей компании</h2>
   		<hr /> 		 
   <p>Качество наших услуг оценили:</p>
   <?//$arrFilter = array("=ID" => array(10,4,6,7,8));?>
   <?$arrFilter = array("=ID" => array(8,2,4,5,6));?>

   		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"clients_index",
	Array(
		"IBLOCK_TYPE" => "clients",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "10",
		"SORT_BY" => "SORT",
		"SORT_ORDER" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
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
);?> 		 	</div>
 	 
	<div class="two_column">
		<h2 class="h2_bg">Для чего применяется алмазная резка?</h2>
		<hr />
		<p>Технология применяется для:</p>
		<ul>
			<li>резки и расширения дверных или оконных проемов</li>
			<li>создание в стенах ниш, штроб</li>
			<li>сверления отверстий под инженерные коммуникации</li>
			<li>исправление строительного брака</li>
			<li>проведения работ с фундаментом</li>
		</ul>
		<h2 class="h2_bg">Преимущества алмазной резки</h2>
		<hr />
		<p>Работы по резке и демонтажу с использованием специального инструмента, выполняются:</p>
		<ul>
			<li>Быстро. Алмазная резка и бурение отверстий производятся в кратчайшие сроки. Специальный инструмент (диски, канаты, коронки) легко режет железобетон, кирпич, камень, позволяя выполнять технологические отверстия и проемы любой формы в любых строительных конструкциях.</li>
			<li>Качественно. В отличие от отбойных молотков и перфораторов, наше оборудование работает без ударов и вибраций. Итоговые отверстия и проемы имеют ровные края и не нуждающиеся в обработке.</li>
			<li>Недорого. Сокращается время выполнения работ, что в свою очередь положительно сказывается на стоимости.</li>
		</ul>
   	</div>
 </div>

<div class="text_style">

    <div class="mp_calc">
        <?$APPLICATION->IncludeFile(
            SITE_DIR."includes/main_calc.php",
            array(),
            array(
                "MODE" => "html",
                "SHOW_BORDER" => "true",
                "NAME" => "Изменить",
                "TEMPLATE"  => ""
            )
        );?>
    </div>
	
	<div class="intex_one_column"> 
	<h2 class="h2_bg">Преимущества работы с компанией «РезАлмаз»</h2>
	<ul>
		<li>Выгодные условия сотрудничества. Индивидуальный подход к каждому клиенту, скидки при заказе большого объема работ.</li>
		<li>Универсальность. Наши специалисты всегда готовы найти эффективное и экономически выгодное решение для задач любой сложности.</li>
		<li>Современное оборудование. Мы располагаем широким арсеналом специального профессионального инструмента, которое позволяет работать со всеми прочными строительными материалами (бетон, железобетон, кирпич, камень, металл).</li>
		<li>Многолетний опыт. Предоставляем услуги алмазной резки более 10 лет.</li>
		<li>Гарантия качества. Компания имеет все необходимые разрешения, лицензии и допуски СРО для проведения демонтажа бетонных и железобетонных конструкций, выполнения буровых работ, устройства дверных и оконных проемов, иных операций, связанных с применением специального инструмента.</li>
	</ul>
	</div>
</div>

<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
