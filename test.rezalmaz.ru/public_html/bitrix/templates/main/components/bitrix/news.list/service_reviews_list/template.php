<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="service-reviews-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="item">
		<div class="text"><?=$arItem["PREVIEW_TEXT"]?></div>
		<div class="name"><?=$arItem["NAME"]?></div>
	</div>
<?endforeach;?>

	<div class="more-items"><a href="/reviews/">Посмотреть все...</a></div>
</div>
