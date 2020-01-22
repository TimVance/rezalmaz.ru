<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<ul class="breadcrumb-navigation" itemscope itemtype="http://schema.org/BreadcrumbList">';
$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/" title="'.$title.'" itemprop="item">Главная</a></li><li><span>&nbsp;&gt;&nbsp;</span></li>';
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= '<li><span>&nbsp;&gt;&nbsp;</span></li>';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">'.$title.'</a></li>';
	else
		$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="item">'.$title.'</span></li>';
}

$strReturn .= '</ul>';
return $strReturn;
?>
