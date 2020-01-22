<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? /*
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><?=$arResult["NAME"]?></h1>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>
*/?>

<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" />
<script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>

<div class="inner_two_column inner_two_column_2 text_style">
	<div class="left_column">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
			<h1><?=$arResult["NAME"]?></h1>
		<?endif;?>
		<?echo $arResult["DETAIL_TEXT"];?>
	</div>
	
	<div class="right_column">
		<div class="grey_box_2"> 			
			<div class="grey_header"> 				
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style">
							<?$APPLICATION->IncludeFile('/form_order.php', array(), array('MODE'=>'html'))?> 						
						</div>
					</div>
				</div>
			</div>
			
			<div class="grey_footer"> 				
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>
		
		<!--<div class="grey_box_2"> 			
			<div class="grey_header"> 				
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style price_block">
							<p class="bold">Минимальная стоимость выезда:</p>
							<p>Алмазная резка — 20 000 руб.</p>
							<p>Резка канатом — 30 000 руб.</p>
							<p>Алмазное сверление — 12 000 руб.</p>
							<p>Штробление — 10 000 руб.</p>
							<p style="margin-top:20px;"><a class="price_link" href="/price/">Смотреть полный прайс</a></p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="grey_footer"> 				
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>-->
	</div>
</div>

<div class="region-gallery-list">
	<a href="/images/almaznaya_rezka/almaznaya_rezka22.570x0.jpg" class="fancy" title="Алмазная резка" rel="group"><img src="/images/almaznaya_rezka/almaznaya_rezka22.570x0.jpg" alt="Алмазная резка" title="Алмазная резка" /></a>
	<a href="/images/almaznaya_rezka/almaznaya_rezka23.570x0.jpg" class="fancy" title="Алмазная резка" rel="group"><img src="/images/almaznaya_rezka/almaznaya_rezka23.570x0.jpg" alt="Алмазная резка" title="Алмазная резка" /></a>
	<a href="/images/burenie3start.jpg" class="fancy" title="Алмазное бурение" rel="group"><img src="/images/burenie3start.jpg" alt="Алмазное бурение" title="Алмазное бурение" /></a>
	<a href="/images/burenie5.jpg" class="fancy" title="Алмазное бурение" rel="group"><img src="/images/burenie5.jpg" alt="Алмазное бурение" title="Алмазное бурение" /></a>
	<a href="/images/burenie/burenie17.570x0.jpg" class="fancy" title="Алмазное бурение" rel="group"><img src="/images/burenie/burenie17.570x0.jpg" alt="Алмазное бурение" title="Алмазное бурение" /></a>
</div>

<div class="block-hdr">Наши услуги</div>
<div class="region-service-list">
	<ul class="page_menu"> 	 
		<li><a href="/almaznaja_rezka/"><span class="ico_1"></span>Алмазная резка</a></li>
		<li><a href="/almaznoe_stroblenie/"><span class="ico_2"></span>Штробление</a></li>
		<li><a href="/almaznoe_burenie/"><span class="ico_3"></span>Алмазное бурение</a></li>
		<li><a href="/usilenie_projomov/"><span class="ico_4"></span>Усиление проёмов</a></li>
		<li><a href="/kanatnaya_rezka/"><span class="ico_6"></span>Канатная резка</a></li>
	</ul>
</div>

<div class="block-hdr">Наши клиенты</div>
<div class="region-clients-list">
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"clients_region",
		Array(
			"IBLOCK_TYPE" => "clients",
			"IBLOCK_ID" => "2",
			"NEWS_COUNT" => "7",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "ACTIVE_FROM",
			"SORT_ORDER2" => "DESC",
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
	);?>
</div>

<div class="block-hdr">Контакты</div>
<div class="region-contacts">
	<div class="rc">
		<div itemscope="" itemtype="http://schema.org/LocalBusiness"> 
			<p class="nm"><span itemprop="name">Компания «РезАлмаз»</span></p>
		
			<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"> 
				<p><span class="bold">Адрес:</span> <span itemprop="postalCode">125130</span>, <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">Головинское шоссе, 10</span></p>
			</div>
		
			<p class="bold">Телефоны:</p>
			<p>
				<span itemprop="telephone">+7 (495) 792-93-92</span><br />
				<span itemprop="telephone">+7 (926) 339-36-53</span><br />
				<span itemprop="telephone">+7 (966) 178-56-56</span></p>

			<p><span class="bold">Электронная почта:</span> <a href="mailto:info@rezalmaz.ru" ><span itemprop="email">info@rezalmaz.ru</span></a></p>
			<p><span class="bold">Режим работы:</span> <time itemprop="openingHours" datetime="Mo-Su, 09:00−22:00">с 9 утра до 10 вечера, без выходных</time></p>
			
			<p>При необходимости возможен выезд специалиста к заказчику для предварительного составления сметы и консультации.</p>
			<p>Общество с ограниченной ответственностью «РезАлмазСтрой»;</p>
			<p><span class="bold">ИНН:</span> 7743872879 </p>
			<p><span class="bold">Юридический адрес:</span> 125502, Москва, ул. Петрозаводская д.9 корп.2</p>
		</div>
	</div>
	<div class="region-map">
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=McQqzydDuzHqsQhlqQ9rEz_MACieawYI&width=100%&height=379&lang=ru_RU&sourceType=constructor"></script>
	</div>
</div>

<div class="block-hdr">Выезд в регионы</div>
<div class="region-vyezd">
</div>

<div class="close-nav">
	<?if(is_array($arResult["TOLEFT"])):?> 
	<a href="<?=$arResult["TOLEFT"]["URL"]?>"> 
		< <?=$arResult["TOLEFT"]["NAME"]?> 
	</a> 
	<?endif?>
	<?if(is_array($arResult["TORIGHT"])):?> 
	<a href="<?=$arResult["TORIGHT"]["URL"]?>"> 
		<?=$arResult["TORIGHT"]["NAME"]?> > 
	</a> 
	<?endif?>
</div>