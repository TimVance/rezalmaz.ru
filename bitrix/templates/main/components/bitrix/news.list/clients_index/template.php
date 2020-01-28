<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult['ITEMS'])): ?>
<ul class="partner_list">
	<? foreach ($arResult['ITEMS'] as $arItem): ?>
		<?/*<li><?=CFile::ShowImage($arItem['PREVIEW_PICTURE']['ID'])?></li>*/?>
		<li><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" width="200" height="200" /></li>
	<? endforeach ?>
		<li class="last"><a href="/about/clients/">Все клиенты</a></li>
</ul>

<? endif ?>
