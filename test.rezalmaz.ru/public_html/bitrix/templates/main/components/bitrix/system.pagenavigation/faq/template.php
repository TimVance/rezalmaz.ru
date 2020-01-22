<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>

<ul class="page_nav">
<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
$bFirst = true;
do
{
	if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
	
	<li><strong><?=$arResult["nStartPage"]?></strong></li>
	
	<? else: ?>
	
	<li><a href="/faq/<?=($arResult['nStartPage'] == 1)?null:'page_'.$arResult["nStartPage"].'/'?>"><?=$arResult["nStartPage"]?></a></li>
	
	<? endif;
	$arResult["nStartPage"]++;
	$bFirst = false;
} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
?>
</ul>