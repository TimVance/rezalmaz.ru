<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->AddHeadString('<style type="text/css">.answer p {padding-left: 25px;padding-right: 25px;}</style>')?>
<?//print_r($arResult);?>
<div class="grey_box_2">
	<div class="grey_header">
		<div class="decor_l"></div>
		<div class="decor_r"></div>
	</div>
	<div class="grey_content">
		<div class="grey_content_l">
			<div class="grey_content_r">
				<div class="text_style">
					<p class="padding_top"><?=$arResult['PREVIEW_TEXT']?></p>
				</div>				
			</div>							
		</div>
	</div>
	<div class="grey_footer">
		<div class="decor_l"></div>
		<div class="decor_r"></div>
	</div>
</div>

<div class="answer">
	<?=$arResult['DETAIL_TEXT']?>
</div>