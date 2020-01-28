<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Карта сайта");
$APPLICATION->SetPageProperty("description", "Карта сайта. Информация о контенте, ссылки на страницы сайта.");
$APPLICATION->SetTitle("Карта сайта");
?>

<div class="inner_two_column inner_two_column_2">
	<div class="left_column">
		<h1>Карта сайта</h1>
		<div class="sitemap">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.map",
			".default",
			Array(
				"LEVEL" => "3",
				"COL_NUM" => "1",
				"SHOW_DESCRIPTION" => "N",
				"SET_TITLE" => "Y",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"CACHE_NOTES" => ""
			),
		false
		);?>
		</div>
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
						<div class="text_style order-form-block">
							<h2 class="h2_bg">Форма заказа</h2>
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
