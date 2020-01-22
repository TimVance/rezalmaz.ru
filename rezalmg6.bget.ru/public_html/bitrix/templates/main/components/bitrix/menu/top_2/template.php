<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="tm-menu">
		<span class="btn-menu-mobile">МЕНЮ</span>
		<ul class="top_menu_2">

		<?
		$previousLevel = 0;
		foreach($arResult as $arItem):?>

			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<?if ($_SERVER['REQUEST_URI'] != $arItem['LINK']):?>
						<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
					<?else:?>
						<li><span class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></span>
					<?endif?>
						<div class="btn-wrap"></div>
						<ul>
							<li class="link-back">Назад</li>
				<?else:?>
					<?if ($_SERVER['REQUEST_URI'] != $arItem['LINK']):?>
						<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
					<?else:?>
						<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><span class="parent"><?=$arItem["TEXT"]?></span>
					<?endif?>
						<div class="btn-wrap"></div>
						<ul>
							<li class="link-back">Назад</li>
				<?endif?>

			<?else:?>

				<?if ($arItem["PERMISSION"] > "D"):?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<?if ($_SERVER['REQUEST_URI'] != $arItem['LINK']):?>
							<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
						<?else:?>
							<li><span class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></span>
						<?endif?>
					<?else:?>
						<?if ($_SERVER['REQUEST_URI'] != $arItem['LINK']):?>
							<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
						<?else:?>
							<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><span><?=$arItem["TEXT"]?></span></li>
						<?endif?>
					<?endif?>

				<?else:?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>

				<?endif?>

			<?endif?>

			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

		<?endforeach?>

		<?if ($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>

		</ul>
<?endif?>


