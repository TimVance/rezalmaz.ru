<?php

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
        $kkk = preg_replace('![^\d\-\sдот]!si', '', $arr_type['PRICE']['DESCRIPTION'][$key]).'*';   // Добавлена * - Чтобы json не сортировал как нам не надо
        $arr_type_param[$type_id][$kkk] = $value;
        $i++;
    }
}

// print_r($arr_type_param);
?>

<link href="calculator/calc.css" type="text/css" rel="stylesheet" />

<table>
    <caption><h2>Расчет стоимости алмазной резки</h2></caption>
</table>

<div class="text_style calc-block">
    <div class="calc">
        <noindex>
            <div class="stage stage_1">
                <div class="column_short">
                    <div class="text_head"><div class="step_index">1.</div>Тип работ:</div>
                </div>
                <div class="column">
                    <div class="sel_param_col">
                        <?php foreach ($arr_groups as $firstId => $firstName):?>
                            <span class="label_param"><input type="radio" name="work" class="radio-input" value="<?=$firstId?>"><label><?=$firstName?></label></span>
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
                            <div class="text_head"><div class="step_index">2.</div>Что будем <?=$sTempStr?> ?</div>
                        </div>
                        <div class="column">
                            <div class="sel_param_col">
                                <?php foreach ($stageVal as $type_id):?>
                                    <?if(isset($type_id, $arr_types) && $arr_types[$type_id] != ''):?>
                                        <span class="label_param"><input type="radio" name="material" class="radio-input" value="<?=$type_id?>"><label><?=$arr_types[$type_id]?></label></span>
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
                        <div class="text_head"><div class="step_index">3.</div>Укажите параметры:</div>
                    </div>
                    <div class="column">
                        <div class="sel_param_row">
                            <span class="label_param">Толщина материала (мм.)</span>
<!--                            <input type="text" class="changed_param" id="5374_thick" value="0"> -->
                            <select class="changed_param" id="5374_thick"></select>
                        </div>
                        <div class="sel_param_row">
                            <span class="label_param">Длина реза (м.)</span>
                            <input type="text" class="changed_param" id="5374_length" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div work="5375" name="param" class="stage_3">
                <div class="stage">
                    <div class="column_short">
                        <div class="text_head"><div class="step_index">3.</div>Укажите параметры:</div>
                    </div>
                    <div class="column">
                        <div class="sel_param_row">
                            <span class="label_param">Диаметр отверстия (мм.)</span>
<!--                            <input type="text" class="changed_param" id="5375_diameter" value="0"> -->
                            <select class="changed_param" id="5375_diameter"></select>
                        </div>
                        <div class="sel_param_row">
                            <span class="label_param">Глубина сверления (см.)</span>
                            <input type="text" class="changed_param" id="5375_depth" value="0">
                        </div>
                        <div class="sel_param_row">
                            <span class="label_param">Колличество отверстий</span>
                            <input type="text" class="changed_param" id="5375_count" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div work="5376" name="param" class="stage_3">
                <div class="stage">
                    <div class="column_short">
                        <div class="text_head"><div class="step_index">3.</div>Укажите параметры:</div>
                    </div>
                    <div class="column">
                        <div class="sel_param_row sel_padding">
                            <div class="label_param_betwin"><span class="label_param">Штроба 2х2 см. штроборезом<br>с пылесосом по стене:</span></div>
                            <div><input type="text" class="changed_param" id="5376_wall" value="0"></div>
                            <span class="span_mark">&nbsp;в&nbsp;метрах</span>
                        </div>
                        <div class="sel_param_row sel_padding" id="ceiling_display" style="display: none;">
                            <div class="label_param_betwin"><span class="label_param">Штроба 2х2 см. штроборезом<br>с пылесосом по потолку:</span></div>
                            <div><input type="text" class="changed_param" id="5376_ceiling" value="0"></div>
                            <span class="span_mark">&nbsp;в&nbsp;метрах</span>
                        </div>
                        <div class="sel_param_row sel_padding">
                            <div class="label_param_betwin"><span class="label_param">Гнездо-подрозетника:</span></div>
                            <div><input type="text" class="changed_param" id="5376_socket" value="0"></div>
                            <span class="span_mark">&nbsp;штук</span>
                        </div>
                        <div class="sel_param_row sel_padding">
                            <div class="label_param_betwin"><span class="label_param">Штроба под кондиционер:</span></div>
                            <div><input type="text" class="changed_param" id="5376_cond" value="0"></div>
                            <span class="span_mark">&nbsp;в метрах</span>
                        </div>
                    </div>
                </div>
            </div>
        </noindex>
        <div class="stage_4">





            <div class="stage db">
                <div class="text_head cst">Коэффициенты сложности</div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" name="kf" value="1.2">
                                Отвод воды
                            </td>
                            <td>
                                <input type="checkbox" name="kf" value="1.5">
                                Высокая армированность Ø&gt;16
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="kf" value="1.2">
                                Бурение на выс 1,8-3,8 м
                            </td>
                            <td>
                                <input type="checkbox" name="kf" value="1.3">
                                Удаленный доступ к воде (более 50м)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="kf" value="1.5">
                                Бурение на выс &gt; 3,8 м
                            </td>
                            <td>
                                <input type="checkbox" name="kf" value="2">
                                Бурение в труднодоступных местах
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="kf" value="1.2">
                                Применение хим анкера
                            </td>
                            <td>
                                <input type="checkbox" name="kf" value="1.4">
                                Работы в ночное время с 22.00 до 7.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="kf" value="2">
                                Бурение снизу вверх
                            </td>
                            <td>
                                <input type="checkbox" name="kf" value="1.5">
                                Работы в выходные и праздничные дни
                            </td>
                        </tr>
                    </tbody>
                </table>                
            </div>






            <div class="stage fin">
                <div class="column_short">
                    <button id="calc_summ" onclick="yaCounter7139977.reachGoal('rasschital-na-kalkulyatore-s-glavnoy'); return true;">Рассчитать</button>
                    <div id="result_callback"><button class="callback_link_calc" href="#callback">Оставить заявку</button></div>
                </div>
                <div class="column_result">
                    <div id="result_calc" class="column text_result"></div>
                    <?/*table class="koefs-dificults">
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
                    </table*/?>
                    <?$APPLICATION->IncludeFile('/form_callback.php', array('MORE_NAME' => '_calc'), array('MODE'=>'html'))?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var oTypeParam = <?=json_encode($arr_type_param);?>;
//  var str = '1245*';
//  console.log(str);
//  str = str.replace(/\*/g, '');
//  console.log(str);
//  
//  console.log(oTypeParam);
//  
//  for (i in oTypeParam){
//      for (j in oTypeParam[i]){
//          console.log(oTypeParam[i][j]);
//      }
//  }
    
    ;(function ($, location) {
        $(function () {
            $(document).ready(function() {
                $('#phone_number-callback_calc').mask("+7(999) 999-99-99");
                //$('.mp_calc select').styler();
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
            
            $('.label_param label').click(function(){
                $(this).parent().find('.radio-input').click();
            });
            
            $('input[name="material"]').click(function(){
                switch($(this).val()){
                    case '5371':
                        $('#5374_thick').empty();
                        var obj = oTypeParam[$(this).val()];
                        for (var key in obj){
                            var key_z = key.replace(/\*/g, '');
                            $('#5374_thick').append('<option value="'+ obj[key] + '">' + key_z + '</option>');
                        }
                        break;
                    case '5373':
                        $('#5374_thick').empty();
                        var obj = oTypeParam[$(this).val()];
                        for (var key in obj){
                            var key_z = key.replace(/\*/g, '');
                            $('#5374_thick').append('<option value="'+ obj[key] + '">' + key_z + '</option>');
                        }
                        break;
                    case '5377':
                        $('#5375_diameter').empty();
                        var obj = oTypeParam[$(this).val()];
                        for (var key in obj){
                            var key_z = key.replace(/\*/g, '');
                            $('#5375_diameter').append('<option value="'+ obj[key] + '">' + key_z + '</option>');
                        }
                        break;
                    case '5378':
                        $('#5375_diameter').empty();
                        var obj = oTypeParam[$(this).val()];
                        for (var key in obj){
                            var key_z = key.replace(/\*/g, '');
                            $('#5375_diameter').append('<option value="'+ obj[key] + '">' + key_z + '</option>');
                        }
                        break;
                    case '5379':
                    case '5380':
                    default:
                }
            });
            
//          $('select').change(function(){
//              alert($(this).find('option:selected').val());
//          });
            
            $('#calc_summ').on('click', function(event){
                var res = 0;
                var msg_01 = '<p class="min-notice">Для расчета точной стоимости вашей задачи свяжитесь с нашим менеджером.</p>';
                var msg_02 = '';//'<p class="min-notice">Минимальная стоимость выезда: 10000 руб.</p>';

                var kf_cnt = $('input[name="kf"]:checked');
                //var kf_result = 0;
                //$('input[name="kf"]:checked').each(function(index, el) {
                //    kf_result += parseFloat($(this).val());
                //});
                //kf_result = Math.round(kf_result* 100)/100;
                //console.log('Суммарный коэффициент - ' + kf_result);

                switch($('[name="work"]:checked').val()){
                    case '5374':
                        var thick = (parseFloat($('#5374_thick').find('option:selected').text()) > 0) ? parseFloat($('#5374_thick').find('option:selected').text()) : 0;
                        var price = (parseFloat($('#5374_thick').find('option:selected').val()) > 0) ? parseFloat($('#5374_thick').find('option:selected').val()) : 0;
                        var length = (parseFloat($('#5374_length').val()) > 0) ? parseFloat($('#5374_length').val()) : 0;

                        summ = length * price;
                        
                        var from = '';
                        if (thick >= 600) from = 'от ';

                        if (kf_cnt.length>0) {
                            var orig_sum = from+summ;
                            kf_cnt.each(function(index, el) {
                                orig_sum *= parseFloat($(this).val());
                            });
                            console.log('Стоимость без КФ - '+(from+summ));
                            res = '<p>Стоимость работы: ' + Math.round(orig_sum) + ' руб.</p>' + msg_01;                            
                        } else {
                            res = '<p>Стоимость работы: ' + from + summ + ' руб.</p>' + msg_01;
                        }

                        if(summ < 10000){
                            res += msg_02;  //'<p class="min-notice">Минимальная стоимость выезда: 20000 руб.</p>';
                        }
                        
                        break;
                    case '5375':
                        var diameter = (parseFloat($('#5375_diameter').find('option:selected').text()) > 0) ? parseFloat($('#5375_diameter').find('option:selected').text()) : 0;
                        var price = (parseFloat($('#5375_diameter').find('option:selected').val()) > 0) ? parseFloat($('#5375_diameter').find('option:selected').val()) : 0;
                        var depth = (parseFloat($('#5375_depth').val()) > 0) ? $('#5375_depth').val() : 0;
                        var count = (parseInt($('#5375_count').val()) > 0) ? $('#5375_count').val() : 0;
                        
                        if (price > 0){
                            summ = depth * count * price;
                            
                            if(summ < 600){
                                summ = 600;
                            }
                            
                            if(summ >= 10000){

                                if (kf_cnt.length>0) {
                                    var orig_sum = summ;
                                    kf_cnt.each(function(index, el) {
                                        orig_sum *= parseFloat($(this).val());
                                    });
                                    console.log('Стоимость без КФ - '+(summ));
                                    res = '<p>Стоимость работы: ' + Math.round(orig_sum) + ' руб.</p>' + msg_01;                          
                                } else {
                                    res = '<p>Стоимость работы: ' + summ + ' руб.</p>' + msg_01;
                                }
                               
                            }else if(summ >= 600){

                                if (kf_cnt.length>0) {
                                    var orig_sum = summ;
                                    kf_cnt.each(function(index, el) {
                                        orig_sum *= parseFloat($(this).val());
                                    });
                                    console.log('Стоимость без КФ - '+(summ));
                                    res = '<p>Стоимость работы: ' + Math.round(orig_sum) + ' руб.</p>' + msg_01 + msg_02;                          
                                } else {
                                    res = '<p>Стоимость работы: ' + summ + ' руб.</p>' + msg_01 + msg_02;
                                }

                            }else{
                                res = '<p>Минимальная стоимость 1 отверстия: 600 руб.</p>' + msg_01 + msg_02;
                            }

                        }else{
                            summ = price;
                            res = '<p>Стоимость работы: договорная.</p>' + msg_01 + msg_02;
                        }
                        
                        break;
                    case '5376':    // ШТРОБЛЕНИЕ
                        var wall = (parseFloat($('#5376_wall').val()) > 0) ? $('#5376_wall').val() : 0;
                        var socket = (parseInt($('#5376_socket').val()) > 0) ? $('#5376_socket').val() : 0;
                        var cond = (parseInt($('#5376_cond').val()) > 0) ? $('#5376_cond').val() : 0;
                        
                        if(parseInt($('[name="material"]:checked').val()) == 5380){
                            var ceiling = (parseFloat($('#5376_ceiling').val()) > 0) ? $('#5376_ceiling').val() : 0;
                            summ = (
                                    (wall * oTypeParam[$('[name="material"]:checked').val()]['1*']) + 
                                    (ceiling * oTypeParam[$('[name="material"]:checked').val()]['2*']) +
                                    (socket * oTypeParam[$('[name="material"]:checked').val()]['3*']) +
                                    (cond * oTypeParam[$('[name="material"]:checked').val()]['4*'])
                                );
                        }else{
//                          res = cond * wall * socket * oTypeParam[$('[name="material"]:checked').val()]['1'];
                            summ = (
                                    (wall * oTypeParam[$('[name="material"]:checked').val()]['1*']) + 
                                    (socket * oTypeParam[$('[name="material"]:checked').val()]['3*']) +
                                    (cond * oTypeParam[$('[name="material"]:checked').val()]['4*'])
                                );
                        }

                        if (kf_cnt.length>0) {
                            var orig_sum = summ;
                            kf_cnt.each(function(index, el) {
                                orig_sum *= parseFloat($(this).val());
                            });
                            console.log('Стоимость без КФ - '+(summ));
                            res = '<p>Стоимость работы: ' + Math.round(orig_sum) + ' руб.</p>' + msg_01 + msg_02;                          
                        } else {
                            res = '<p>Стоимость работы: ' + summ + ' руб.</p>' + msg_01 + msg_02;
                        }

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
            $('#form_callback_calc').submit(function(event) {
                var oPhoneNumber = $('#phone_number-callback_calc');
                if ($('input[name=phone_fax]', this).val() != '')return false;
                
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
                                $('#form_callback_calc').html('<p class="thanks">Спасибо, мы перезвоним в<br>течение 15 минут</p><p class="understand"><a href="#">Понятно</a></p>');
                                oPhoneNumber.val('');
                                $('.callback_form_calc .hdr3').hide();
                                $('.callback_form_calc .understand a').click(function(){
                                    $('.callback_form_calc .close-callback').click();
                                    return false;
                                });
                                $('.callback_form_calc').show();
//                              $('.koefs-dificults').hide();
                            }else{
                                alert(data.errors.join("\n"));
                            }
                        }
                    });
                }
                else {
                    $('.order_form_2 label').eq(1).css('color', 'red');
                }
                event.stopPropagation();
                return false;
            });
        });
    })(jQuery, location);
</script>