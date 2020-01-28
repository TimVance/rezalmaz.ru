<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//print_r($arResult);?>

<? if (!empty($arResult['ITEMS'])): ?>
<?/*
<ul class="link_black">
	<? foreach ($arResult['ITEMS'] as $arItem): ?>
		<li><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['PREVIEW_TEXT']?></a></li>
	<? endforeach ?>
</ul>
*/?>

	<? foreach ($arResult['ITEMS'] as $arItem): ?>
		<div class="answer">
			<p><?=$arItem['PREVIEW_TEXT']?></p>
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
							<p class="padding_top"><?=$arItem['DETAIL_TEXT']?></p>
						</div>				
					</div>							
				</div>
			</div>
			<div class="grey_footer">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>
	<? endforeach ?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<? endif ?>
