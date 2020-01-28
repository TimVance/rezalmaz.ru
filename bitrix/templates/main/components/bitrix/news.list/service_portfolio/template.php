<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="servise-portfolio-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="item">
		<div class="img"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a></div>
		<div class="name"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
	</div>
<?endforeach;?>

	<div class="more-items"><a href="/portfolio/">Посмотреть все...</a></div>
</div>
