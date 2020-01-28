<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вопрос детально");
?>
<div class="inner_two_column text_style">
	<div class="left_column">
		<h2><span>Вопрос-ответ</span></h2>
<?$APPLICATION->IncludeComponent("bitrix:news.detail", "faq", Array(
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "N",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить детальное изображение
	"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
	"USE_SHARE" => "N",	// Отображать панель соц. закладок
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"IBLOCK_TYPE" => "FAQ",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "1",	// Код информационного блока
	"ELEMENT_ID" => "",	// ID новости
	"ELEMENT_CODE" => $_REQUEST["CODE"],	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => "",	// Поля
	"PROPERTY_CODE" => "",	// Свойства
	"IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
	"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
	"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Страница",	// Название категорий
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	),
	false
);?>

<br />
<h3><span>Другие вопросы</span></h3>
<br />
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"faq_other_questions",
	Array(
		"IBLOCK_TYPE" => "FAQ",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "3",
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
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
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

</div>
<div class="right_column padding_top_43">
	<div class="grey_box_2">
		<div class="grey_header">
			<div class="decor_l"></div>
			<div class="decor_r"></div>
		</div>
		<div class="grey_content">
			<div class="grey_content_l">
				<div class="grey_content_r">
					<div class="text_style">
						<h3><span>Задайте вопрос тут</span></h3>
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
</div>				
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>