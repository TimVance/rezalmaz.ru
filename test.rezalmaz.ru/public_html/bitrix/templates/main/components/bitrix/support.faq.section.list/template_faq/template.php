<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//display sections?>
		<?foreach ($arResult['SECTIONS'] as $val):?>
		<?if($arParams["SECTION_ID"]==$val["ID"]) $SELECTED_ITEM = $val?>
				<?='<h3>'.$val['NAME'].'</h3>'?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"faq",
					Array(
						"AJAX_MODE" => "N",
						"IBLOCK_TYPE" => "FAQ",
						"IBLOCK_ID" => "1",
						"NEWS_COUNT" => "10",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_ORDER1" => "DESC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(),
						"PROPERTY_CODE" => array(),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
						"ADD_SECTIONS_CHAIN" => "Y",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => $val["ID"],
						"PARENT_SECTION_CODE" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "Новости",
						"PAGER_SHOW_ALWAYS" => "Y",
						"PAGER_TEMPLATE" => "faq",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "Y",
						"AJAX_OPTION_SHADOW" => "Y",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N"
					)
				);?>
		<?endforeach;?>