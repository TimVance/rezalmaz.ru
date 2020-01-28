<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult['ITEMS'])): ?>
<ul class="partner_list_2">
	<? foreach ($arResult['ITEMS'] as $arItem): ?>
		<li>
			<div class="logo_box">
				<?=CFile::ShowImage($arItem['PREVIEW_PICTURE']['ID'])?>
			</div>
			<?=$arItem['NAME']?>
		</li>
	<? endforeach ?>
</ul>

<? endif ?>