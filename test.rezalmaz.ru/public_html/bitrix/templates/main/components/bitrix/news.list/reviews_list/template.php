<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="answer">
			<p><strong>Отзыв оставил(а) <?=$arItem["NAME"]?></strong></p>
		</div>
		<div class="grey_box_2">
			<div class="grey_header">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style">
							<p class="padding_top"><?=$arItem["PREVIEW_TEXT"]?></p>
							<?if($arItem["DETAIL_TEXT"] !== ""):?>
							<hr class="hr_reviews" />
							<p style="float:right; text-align:right; padding: 10px !important; font-style:italic;"><strong>Ответ Резалмаз:</strong> <?=$arItem["DETAIL_TEXT"];?></p>
							<div style="clear:both;"></div>
							<?endif;?>
						</div>				
					</div>							
				</div>
			</div>
			<div class="grey_footer">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>	
<?endforeach;?>
</div>