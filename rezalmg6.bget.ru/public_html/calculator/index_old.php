<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");

if(!CModule::IncludeModule("iblock"))
 return;

$calc_groups = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 5, "ACTIVE" => "Y"));
while($calc_group = $calc_groups->GetNextElement()){
	$arr_group = $calc_group->GetFields();
	$group_id = $arr_group['ID'];
	$arr_groups[$group_id] = $arr_group['NAME'];
	$arr_group = $calc_group->GetProperties();
	foreach($arr_group['SERVICES']['VALUE'] as $value){
		$arr_types_list[] = $value;
		$arr_types_ids[$group_id][] = $value;
	}
}

$calc_types = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 4, "ID" => $arr_types_list, "ACTIVE" => "Y"));
while($calc_type = $calc_types->GetNextElement()){
	$arr_type = $calc_type->GetFields();
	$type_id = $arr_type['ID'];
	$arr_type = $calc_type->GetProperties();
	$arr_types[$type_id] = $arr_type['SHORT_NAME']['VALUE'];
	$i = 0;
	foreach($arr_type['PRICE']['VALUE'] as $key => $value){
		$kkk = preg_replace('/[^\d\<\-]/', '', $arr_type['PRICE']['DESCRIPTION'][$key]).'*';
		$arr_type_param[$type_id][$kkk] = $value;
		$i++;
	}
}

print_r($arr_type_param);
?>

<link href="calc.css" type="text/css" rel="stylesheet" />
<div class="text_style" style="padding:50px 50px 50px 50px;">
	<h1>Калькулятор:</h1>
	<div class="calc">
		<noindex>
			<div class="stage stage_1">
				<div class="column_short">
					<div class="text_head"><div class="step_index">1</div>Тип работ:</div>
				</div>
				<div class="column">
					<div class="sel_param_col">
						<?php foreach ($arr_groups as $firstId => $firstName):?>
							<label class="label_param"><input type="radio" name="work" class="radio-input" value="<?=$firstId?>"><span><?=$firstName?></span></label>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<?php foreach ($arr_types_ids as $group_id => $stageVal):?>
				<div name="<?=$group_id?>" class="stage_2">
					<div class="stage">
						<div class="column_short">
							<?switch($group_id){
								case 5374:
									$sTempStr = 'резать';
									break;
								case 5375:
									$sTempStr = 'сверлить';
									break;
								case 5376:
									$sTempStr = 'штробить';
									break;
							}?>
							<div class="text_head"><div class="step_index">2</div>Что будем <?=$sTempStr?> ?</div>
						</div>
						<div class="column">
							<div class="sel_param_col">
								<?php foreach ($stageVal as $type_id):?>
									<?if(isset($type_id, $arr_types) && $arr_types[$type_id] != ''):?>
										<label class="label_param"><input type="radio" name="material" class="radio-input" value="<?=$type_id?>"><span><?=$arr_types[$type_id]?></span></label>
									<?endif?>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
			<div work="5374" name="param" class="stage_3">
				<div class="stage">
					<div class="column_short">
						<div class="text_head"><div class="step_index">3</div>Укажите параметры:</div>
					</div>
					<div class="column">
						<div class="sel_param_row">
							<label class="label_param">Толщина материала (мм.)</label>
<!-- 							<input type="text" class="changed_param" id="5374_thick" value="0"> -->
							<div>
								<select class="changed_param" id="5374_thick">
									<? //foreach($arr_type_param[5371] as $key=>$item) { ?>
<!-- 									<option value="<?=$item?>"><?=$key?></option> -->
									<? //} ?>
								</select>
							</div>
								<? //print_r($arr_type_param); ?>
						</div>
						<div class="sel_param_row">
							<label class="label_param">Длина реза (м.)</label>
							<input type="text" class="changed_param" id="5374_length" value="0">
						</div>
					</div>
				</div>
			</div>
			<div work="5375" name="param" class="stage_3">
				<div class="stage">
					<div class="column_short">
						<div class="text_head"><div class="step_index">3</div>Укажите параметры:</div>
					</div>
					<div class="column">
						<div class="sel_param_row">
							<label class="label_param">Диаметр отверстия (мм.)</label>
							<input type="text" class="changed_param" id="5375_diameter" value="0">
						</div>
						<div class="sel_param_row">
							<label class="label_param">Глубина сверления (см.)</label>
							<input type="text" class="changed_param" id="5375_depth" value="0">
						</div>
						<div class="sel_param_row">
							<label class="label_param">Колличество отверстий</label>
							<input type="text" class="changed_param" id="5375_count" value="0">
						</div>
					</div>
				</div>
			</div>
			<div work="5376" name="param" class="stage_3">
				<div class="stage">
					<div class="column_short">
						<div class="text_head"><div class="step_index">3</div>Укажите параметры:</div>
					</div>
					<div class="column">
						<div class="sel_param_row sel_padding">
							<div class="label_param_betwin"><label class="label_param">Штроба 2х2 см. штроборезом<br>с пылесосом по стене:</label></div>
							<div><input type="text" class="changed_param" id="5376_wall" value="0"></div>
							<span class="span_mark">&nbsp;в&nbsp;метрах</span>
						</div>
						<div class="sel_param_row sel_padding" id="ceiling_display" style="display: none;">
							<div class="label_param_betwin"><label class="label_param">Штроба 2х2 см. штроборезом<br>с пылесосом по потолку:</label></div>
							<div><input type="text" class="changed_param" id="5376_ceiling" value="0"></div>
							<span class="span_mark">&nbsp;в&nbsp;метрах</span>
						</div>
						<div class="sel_param_row sel_padding">
							<div class="label_param_betwin"><label class="label_param">Гнездо-подрозетника:</label></div>
							<div><input type="text" class="changed_param" id="5376_socket" value="0"></div>
							<span class="span_mark">&nbsp;штук</span>
						</div>
						<div class="sel_param_row sel_padding">
							<div class="label_param_betwin"><label class="label_param">Штроба под кондиционер:</label></div>
							<div><input type="text" class="changed_param" id="5376_cond" value="0"></div>
							<span class="span_mark">&nbsp;в метрах</span>
						</div>
					</div>
				</div>
			</div>
		</noindex>
		<div class="stage_4">
			<div class="stage">
				<div class="column_short">
					<button id="calc_summ">Рассчитать</button>
					<div id="result_callback"><button class="callback_link_calc" href="#callback">Оставить заявку</button></div>
				</div>
				<div class="column_result">
			    	<div id="result_calc" class="column text_result"></div>
					<table class="koefs-dificults">
						<caption>Коэффициенты сложности</caption>  
						<tbody>
							<tr>
								<td>К1 Отвод воды х 1,2</td>
								<td>К6 Высокая армированность Ø&gt;16 x 1,5</td>
							</tr>
							<tr>
								<td>К2 Бурение на выс 1,8-3,8 м х 1,2</td>
								<td>К7 Удаленный доступ к воде (более 50м) x 1,3</td>
							</tr>
							<tr>
								<td>К3 Бурение на выс &gt; 3,8 м х 1,5</td>
								<td>К8 Бурение в труднодоступных местах x 2</td>
							</tr>
							<tr>
								<td>К4 Применение хим анкера х 1,2</td>
								<td>К9 Работы в ночное время с 22.00 до 7.00 x 1,4</td>
							</tr>
							<tr>
								<td>К5 Бурение снизу вверх х 2</td>
								<td>К10 Работы в выходные и праздничные дни x 1,5</td>
							</tr>
						</tbody>
					</table>
					<?$APPLICATION->IncludeFile('/form_callback.php', array('MORE_NAME' => '_calc'), array('MODE'=>'html'))?>
			    </div>
			</div>
		</div>
	</div>
</div>
<script>
// 	var tmp = <?=json_encode($arr_type_param);?>;
// 	var oTypeParam = new Object();
// 	for (var root in tmp){
// 		for (var sub in tmp[root]){ 
// 			if (!oTypeParam.hasOwnProperty(sub)){
// 				oTypeParam[sub] = new Object();
// 				console.log('new');
// 			}
// 			var arr_last = new Object();
// 			for (var last in tmp[root][sub]){ 
// 				arr_last[last] = new Object();
// 				arr_last[last] = tmp[root][sub][last];
// // 				console.log(sub, last, oTypeParam[sub][last]);
// // 				console.log(last, tmp[root][sub]);
// 			}
// 			oTypeParam[sub] = arr_last;
// // 			console.log(root, sub, arr_last);
// // 			break;
// 		}
// 		console.log(root, sub, oTypeParam);
// 		if (root > 9) break;
// 	}
// 	
// 	console.log(tmp);
// 	console.log(oTypeParam);
	
 	var oTypeParam = <?=json_encode($arr_type_param);?>;
 		console.log(oTypeParam[5371]);
 	var ttt = oTypeParam[5371];
 	var listNew = [];
 	
	for (var i in ttt) {
		aaa = [];
		aaa[i] = ttt[i];
		listNew.push(aaa);
	}
 	
// 	for (var i = 0; i < listNew.length; i++) {
// 		alert(listNew[i].name);
// 	}
 	
 	
 	var keys = Object.keys(oTypeParam).sort();
 	
 	
//  	listNew.sort(compareObjects);
 	
 	function compareObjects (a, b) {
// 		if (String(a) < String(b)) return -1;
// 		if (String(a) > String(b)) return 1;
// 		return 0;
		console.log(a, b);
		return a-b;
	};
	
	
	
	
	
	var obj = [];
	for (i in oTypeParam){
		var keys = Object.keys(oTypeParam[i]).sort();
		obj[i] = [];
		for (j in keys){
// 			console.log(i, keys[j]);
// 			aaa = [];
// 			aaa[keys[j]] = oTypeParam[i][keys[j]];
			obj[i][keys[j]] = [];
			obj[i][keys[j]] = oTypeParam[i][keys[j]];
//  			obj[i].push(aaa);
		}
		break;
// 		console.log(keys);
	}
 	
// 	console.log(obj);
	oTypeParam = obj;
	
	;(function ($, location) {
		$(function () {
			$(document).ready(function() {
				$('#phone_number-callback_calc').mask("+7(999) 999-99-99");
			});
			$('[name="work"]').on('change', function(event){
				$('.stage_2').hide();
				$('[name="param"]').hide();
				$('[name="'+$(event.currentTarget).val()+'"]').show();
				$('#result_calc').html('');
				$('#result_callback').hide();
				$('.koefs-dificults').hide();
				$('[name="material"]').removeAttr("checked");
				$('.stage_4').hide();
			});
			$('[name="material"]').on('change', function(event){
				$('[name="param"]').hide();
				$('[name="param"][work="'+$('[name="work"]:checked').val()+'"]').show();
				if(parseInt($('[name="material"]:checked').val()) == 5380){
					$('#ceiling_display').show();
				}else{
					$('#ceiling_display').hide();
				}
				$('#result_calc').html('');
				$('#result_callback').hide();
				$('.koefs-dificults').hide();
				$('.stage_4').show();
			});
			
			$('input[name="material"]').click(function(){
				switch($(this).val()){
					case '5371':
						$('#5374_thick').empty();
						var obj = oTypeParam[5371];
						for (var key in obj){
							$('#5374_thick').append('<option value="'+ obj[key] + '">' + key + '</option>');
// 							arr[key] = obj[key];
// 							console.log(key + ' : ' + obj[key]);
						}
// 						<option value=""></option>
						break;
					case '5373':
						alert('бетон');
						break;
					default:
				}
			});
			
// 			$('select').change(function(){
// 				alert($(this).find('option:selected').val());
// 			});
			
			$('#calc_summ').on('click', function(event){
				var res = 0;
				switch($('[name="work"]:checked').val()){
					case '5374':
						var thick = (parseFloat($('#5374_thick').find('option:selected').text()) > 0) ? parseFloat($('#5374_thick').find('option:selected').text()) : 0;
						var price = (parseFloat($('#5374_thick').find('option:selected').val()) > 0) ? parseFloat($('#5374_thick').find('option:selected').val()) : 0;
						var length = (parseFloat($('#5374_length').val()) > 0) ? parseFloat($('#5374_length').val()) : 0;

						summ = length * price;
						
						var from = '';
						if (thick >= 600) from = 'от ';
						
						res = '<p>Стоимость работы: ' + from + summ + ' руб.</p>';
						if(summ < 20000){
							res += '<p>Минимальная стоимость выезда: 20 000 руб.</p>';
						}
						
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
						res = diameter * depth;
						res = res * count;
						
						if(res < 600){
							res = 600;
						}
						
						if(res >= 10000){
							res = '<p>Стоимость работы: '+res+' руб.</p>';
						}else if(res >= 600){
							res = '<p>Стоимость работы: '+res+' руб.</p><p>Минимальная стоимость выезда: 10 000 руб.</p>';
						}else{
							res = '<p>Минимальная стоимость 1 отверстия: 600 руб.</p><p>Минимальная стоимость выезда: 10 000 руб.</p>';
						}
					break;
					case '5376':	// ШТРОБЛЕНИЕ
						var wall = (parseFloat($('#5376_wall').val()) > 0) ? $('#5376_wall').val() : 0;
						var socket = (parseInt($('#5376_socket').val()) > 0) ? $('#5376_socket').val() : 0;
						var cond = (parseInt($('#5376_cond').val()) > 0) ? $('#5376_cond').val() : 0;
						if(parseInt($('[name="material"]:checked').val()) == 5380){
							var ceiling = (parseFloat($('#5376_ceiling').val()) > 0) ? $('#5376_ceiling').val() : 0;
							res = (
									(wall * oTypeParam[$('[name="material"]:checked').val()]['1']) + 
									(ceiling * oTypeParam[$('[name="material"]:checked').val()]['2']) +
									(socket * oTypeParam[$('[name="material"]:checked').val()]['3']) +
									(cond * oTypeParam[$('[name="material"]:checked').val()]['4'])
								);
						}else{
// 							res = cond * wall * socket * oTypeParam[$('[name="material"]:checked').val()]['1'];
							res = (
									(wall * oTypeParam[$('[name="material"]:checked').val()]['1']) + 
									(socket * oTypeParam[$('[name="material"]:checked').val()]['3']) +
									(cond * oTypeParam[$('[name="material"]:checked').val()]['4'])
								);
						}
						res = '<p>Стоимость работы: '+res+' руб.</p>';
					break;
				}
				$('#result_calc').html(res);
				$('#result_callback').show();
				$('.koefs-dificults').show();
			});
			$('.callback_link_calc').click(function(){
				$('.bg-splash').show();
				$('.callback_form_calc').toggle();
				$('.callback_form_calc .close-callback, .callback_form_calc #close-callback_calc').click(function(){
					$('.callback_form_calc').hide();
					$('.bg-splash').hide();
				});
				return false;
			});
			$('#exec-callback_calc').click(function() {
				var oPhoneNumber = $('#phone_number-callback_calc');
				if (oPhoneNumber.val() !== ''){
					$.ajax({
						url: '/send_callback.php',
						type: 'post',
						dataType: 'json',
						data: {
							'phone_number': oPhoneNumber.val(),
							'client_name': $('#name-callback_calc').val(),
						},
						success: function(data) {
							if (data.success == true){
								$('#form_callback_calc').html('<p style="text-align:center;">Спасибо, мы перезвоним в<br>течении 15 минут</p>');
								$('.callback_form_calc').delay(2000).fadeOut();
								$('.koefs-dificults').hide();
								$('.bg-splash').hide();
								window.location.reload();
							}
							else
								alert(data.errors.join("\n"));
						}
					});
				}
				else {
					$('.order_form_2 label').eq(1).css('color', 'red');
				}
				oPhoneNumber.val('');
				return false;
			});
		});
	})(jQuery, location);
</script>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
