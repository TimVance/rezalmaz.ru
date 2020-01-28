<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult['ITEMS'])): ?>
<ul class="link_black">
	<? foreach ($arResult['ITEMS'] as $arItem): ?>
		<li><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['PREVIEW_TEXT']?></a></li>
	<? endforeach ?>
	<li class="last"><a href="/faq/">Все вопросы</a></li>
</ul>

<? endif ?>