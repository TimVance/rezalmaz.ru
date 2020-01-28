<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");

if(!CModule::IncludeModule("iblock"))
 return;

$calcGroups = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 5, "ACTIVE" => "Y"));
while($calcGroup = $calcGroups->GetNextElement()){
	$arGroupTemp = $calcGroup->GetFields();
	$stageGroupId = $arGroupTemp['ID'];
	$firstStage[$stageGroupId] = $arGroupTemp['NAME'];
	$arGroupTemp = $calcGroup->GetProperties();
	foreach($arGroupTemp['SERVICES']['VALUE'] as $value){
		$arTypeList[] = $value;
		$arTypeID[$stageGroupId][] = $value;
	}
}
$calcTypes = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 4, "ID" => $arTypeList, "ACTIVE" => "Y"));
while($calcType = $calcTypes->GetNextElement()){
	$arTypeTemp = $calcType->GetFields();
	$stageTypeId = $arTypeTemp['ID'];
	$arTypeTemp = $calcType->GetProperties();
	$secondStage[$stageTypeId] = $arTypeTemp['SHORT_NAME']['VALUE'];
	foreach($arTypeTemp['PRICE']['VALUE'] as $key => $value){
		$arTypeParam[$stageTypeId][preg_replace('/[^\d]/', '', $arTypeTemp['PRICE']['DESCRIPTION'][$key])] = $value;
	}
}
?>
<div class="text_style" style="padding:0 50px 50px 50px;">
	<div class="calc-block">
		<noindex>
			<div>
				<div><div>1</div>Калькулятор:</div>
			</div>
			<div>
				<?php foreach ($firstStage as $firstId => $firstName):?>
					<label><input type="radio" name="work" value="<?=$firstId?>"><?=$firstName?></label>
				<?php endforeach;?>
			</div>
			<?php foreach ($arTypeID as $stageGroupId => $stageVal):?>
				<div name="<?=$stageGroupId?>" class="second_stage" style="display:none;">
					<div><div>2</div>Что будем сверлить?</div>
				</div>
				<div name="<?=$stageGroupId?>" class="second_stage" style="display:none;">
					<?php foreach ($stageVal as $stageTypeId):?>
						<label><input type="radio" name="material" value="<?=$stageTypeId?>"><?=$secondStage[$stageTypeId]?></label>
					<?php endforeach;?>
				</div>
			<?php endforeach;?>
			<div work="5374" name="param" style="display: none;">
				<div>
					<div><div>3</div>Укажите параметры</div>
				</div>
				<div class="params">
					<div>
						<label>Толщина материала (см.)</label>
						<input type="text" id="5374_thick" value="0">
					</div>
					<div>
						<label class="label">Длина реза (м.)</label>
						<input type="text" id="5374_length" value="0">
					</div>
				</div>
			</div>
			<div work="5375" name="param" style="display: none;">
				<div>
					<div><div>3</div>Укажите параметры:</div>
				</div>
				<div class="params">
					<div>
						<label>Диаметр отверстия (мм.)</label>
						<input type="text" id="5375_diameter" value="0">
					</div>
					<div>
						<label class="label">Глубина сверления (см.)</label>
						<input type="text" id="5375_depth" value="0">
					</div>
					<div>
						<label class="label">Колличество отверстий</label>
						<input type="text" id="5375_count" value="0">
					</div>
				</div>
			</div>
			<div work="5376" name="param" style="display: none;">
				<div>
					<div><div>3</div>Укажите параметры:</div>
				</div>
				<div class="params">
					<div>
						<label>Длина (м.)</label>
						<input type="text" id="5376_wall" value="0">
					</div>
					<div id="ceiling_display" style="display: none;">
						<label class="label">Длина (м.)</label>
						<input type="text" id="5376_ceiling" value="0">
					</div>
					<div>
						<label class="label">Колличество отверстий</label>
						<input type="text" id="5376_socket" value="0">
					</div>
				</div>
			</div>
		</noindex>
		<button id="calc_summ">Рассчитать!</button>
		<div>
            <div>
                Стоимость работы : <span id="result_calc"></span>
            </div>
        </div>
	</div>
</div>
<script>
	var oTypeParam = <?=json_encode($arTypeParam);?>;
	;(function ($, location) {
		$(function () {
			$('[name="work"]').on('change', function(event){
				$('.second_stage').hide();
				$('[name="param"]').hide();
				$('[name="'+$(event.currentTarget).val()+'"]').show();
			});
			$('[name="material"]').on('change', function(event){
				$('[name="param"]').hide();
				$('[name="param"][work="'+$('[name="work"]:checked').val()+'"]').show();
				if(parseInt($('[name="material"]:checked').val()) == 5380){
					$('#ceiling_display').show();
				}else{
					$('#ceiling_display').hide();
				}
			});
			$('#calc_summ').on('click', function(event){
				var res = 0;

				switch($('[name="work"]:checked').val()){
					case '5374':
						var thick = 0;
						var length = (parseFloat($('#5374_length').val()) > 0) ? $('#5374_length').val() : 0;
						for(var i in oTypeParam[$('[name="material"]:checked').val()]){
							if(i >= parseFloat($('#5374_thick').val())){
								thick = parseFloat(oTypeParam[$('[name="material"]:checked').val()][i]);
								break;
							}
						}
						res = thick * length;
					break;
					case '5375':
						var diameter = 0;
						var depth = (parseFloat($('#5375_depth').val()) > 0) ? $('#5375_depth').val() : 0;
						var count = (parseInt($('#5375_count').val()) > 0) ? $('#5375_count').val() : 0;
						for(var i in oTypeParam[$('[name="material"]:checked').val()]){
							if(i >= parseFloat($('#5375_diameter').val())){
								diameter = parseFloat(oTypeParam[$('[name="material"]:checked').val()][i]);
								break;
							}
						}
						res = diameter * depth * count;
					break;
					case '5376':
						var wall = (parseFloat($('#5376_wall').val()) > 0) ? $('#5376_wall').val() : 0;
						if(parseInt($('[name="material"]:checked').val()) == 5380){
							var ceiling = (parseFloat($('#5376_ceiling').val()) > 0) ? $('#5376_ceiling').val() : 0;
						}else{
							var ceiling = 0;
						}
						var socket = (parseInt($('#5376_socket').val()) > 0) ? $('#5376_socket').val() : 0;
						res = (wall * oTypeParam[$('[name="material"]:checked').val()]['1']) + (ceiling * oTypeParam[$('[name="material"]:checked').val()]['2']) + (socket * oTypeParam[$('[name="material"]:checked').val()]['3']);
					break;
				}
				$('#result_calc').html(res+' руб.');
			});
		});

	})(jQuery, location);
</script>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
