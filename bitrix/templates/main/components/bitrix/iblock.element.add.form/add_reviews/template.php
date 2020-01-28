

<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>

<?if (count($arResult["ERRORS"])):?>
	<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?=ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
<?=bitrix_sessid_post()?> 	
<div class="order_form_2"> 		
    <div class="toggleSlide">
		<label><span>*</span> Ваше имя: </label> 			
		<div class="input_text_l"> 				
			<div class="input_text_r">
				<input type="text" name="PROPERTY[NAME][0]" value="" />
			</div>
       	</div>
     	<label><span>*</span> Ваш e-mail: </label> 			
		<div class="input_text_l"> 				
			<div class="input_text_r">
				<input type="text" name="PROPERTY[2][0]" value="" />
			</div>
       	</div>
		
     	<label><span>*</span> Текст сообщения: </label>
	</div>
   		
    <div class="textarea_big"> 			
		<div class="textarea_r">
			<textarea cols="5" rows="5" name="PROPERTY[PREVIEW_TEXT][0]" class="show_form"></textarea>
		</div>
    </div>
   		
    <div class="toggleSlide"> 			
		<ul> 				
			<li><input type="reset" class="clear" value="Очистить" /></li>			
			<li><input type="submit" name="iblock_submit" class="button hide_form"  value="Отправить" /></li>
       	</ul>
    </div>
</div>
 </form>