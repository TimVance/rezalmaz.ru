<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="bm-menu">
		<ul class="bottom-menu">
		
		<? $last_depth_level = 1 ?>
		<? foreach($arResult as $k=>$arItem): ?>
			<? if ($arItem['DEPTH_LEVEL'] > $last_depth_level):  ?>
				<ul>
			<? elseif($arItem['DEPTH_LEVEL'] < $last_depth_level): ?>
				</ul>
			<? endif ?>
			
			<? if ($arItem['DEPTH_LEVEL'] == 1): ?>
				<? if ($k > 0): ?></li><? endif ?>
				<? if ($arItem['IS_PARENT']): $arItem['TEXT'] .= ':' ?>
					<li class="parent column_<?=$arItem['ITEM_INDEX']+1?>"><span><?=$arItem["TEXT"]?></span>
				<? else: ?>
					<?if ($_SERVER['REQUEST_URI'] != $arItem['LINK']):?>
					<?/*<li class="item_<?=$arItem['ITEM_INDEX']+1?>"><?if(strpos($arItem["LINK"], 'almaznaja_rezka/')) echo '<noindex>';?><a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a><?if(strpos($arItem["LINK"], 'almaznaja_rezka/')) echo '</noindex>';?> */?>
					<li class="item_<?=$arItem['ITEM_INDEX']+1?>"><a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
					<?else:?>
					<li class="item_<?=$arItem['ITEM_INDEX']+1?>"><?=$arItem["TEXT"]?>
					<?endif?>
				<?endif?>
			<? elseif($arItem['DEPTH_LEVEL'] == 2): ?>
					<?
						$add_class = '';
						if (!empty($arItem['PARAMS']['item_class'])) $add_class = ' class="'.$arItem['PARAMS']['item_class'].'"';
					?>
					<?if($arItem["SELECTED"]):?>
						 <? //class="current" ?>
						<li<?=$add_class?>><span><?=$arItem["TEXT"]?></span><strong><?= isset($arItem["PARAMS"]["ALT"]) ? $arItem["PARAMS"]["ALT"] : null ?></strong></li>
					<?else:?>
						<li<?=$add_class?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><strong><?= isset($arItem["PARAMS"]["ALT"]) ? $arItem["PARAMS"]["ALT"] : null ?></strong></li>
					<?endif?>
			<? endif ?>
			
			<? if ($k == count($arResult)-1): ?>
				</li>
			<? endif ?>
			
			<? $last_depth_level = $arItem['DEPTH_LEVEL'] ?>
		<?endforeach?>

		</ul>
	</div>
<?endif?>
