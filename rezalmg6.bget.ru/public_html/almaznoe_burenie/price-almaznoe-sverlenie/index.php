<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Цена сверления отверстий в бетоне — стоимость алмазного бурения и пробивки отверстий в кирпиче и бетоне в Москве, прайс-лист");
$APPLICATION->SetPageProperty("description", "Цена пробивки отверстий в бетоне в Москве. Алмазное сверление отверстий в кирпиче. Стоимость бурения в стенах и перекрытиях в прайс-листе. Компания «РезАлмаз» — алмазная резка бетона, железобетона и кирпича. Сверление и бурение отверстий. Штробление стен. Работаем в Москве и Московской области. Выезд специалистов. Расчет цены работ на калькуляторе. Звоните: +7 (495) 792-93-92");
?><div class="text_style price_page">
	<div class="price_hdr_line">
		<div class="col1"><h1>Цена сверления и бурения отверстий в кирпиче и бетоне</h1></div>
		<div class="col2"><a class="price_link" href="/price/price.pdf">Скачать прайс</a></div>
	</div>

<br />
<table>
	<caption>Алмазное бурение и пробивка отверстий</caption>
	<tbody>
		<tr>
			<th>Диаметр отверстия (мм)</th>
			<th>Бетон (монолит, неармированный бетон)<br>
				(стоимость 1-го см. глубины сверления)<br>
				в рублях</th>
			<th>Железобетон (армированный бетон)<br>
				(стоимость 1-го см. глубины сверления)<br>
				в рублях</th>
			<th>Кирпич<br>
				(стоимость 1-го см. глубины сверления)<br>
				в рублях</th>
		</tr>
		<tr>
			<td><52</td>
			<td>договорная</td>
			<td>договорная</td>
			<td>договорная</td>
		</tr>
		<tr>
			<td>52-102</td>
			<td>29</td>
			<td>29</td>
			<td>29</td>
		</tr>
		<tr>
			<td>112</td>
			<td>32</td>
			<td>32</td>
			<td>29</td>
		</tr>
		<tr>
			<td>122</td>
			<td>35</td>
			<td>35</td>
			<td>29</td>
		</tr>
		<tr>
			<td>132-152</td>
			<td>45</td>
			<td>45</td>
			<td>29</td>
		</tr>
		<tr>
			<td>162</td>
			<td>48</td>
			<td>48</td>
			<td>30</td>
		</tr>
		<tr>
			<td>172-182</td>
			<td>53</td>
			<td>53</td>
			<td>35</td>
		</tr>
		<tr>
			<td>202</td>
			<td>58</td>
			<td>58</td>
			<td>40</td>
		</tr>
		<tr>
			<td>225-252</td>
			<td>85</td>
			<td>85</td>
			<td>43</td>
		</tr>
		<tr>
			<td>272</td>
			<td>90</td>
			<td>90</td>
			<td>50</td>
		</tr>
		<tr>
			<td>300</td>
			<td>94</td>
			<td>94</td>
			<td>57</td>
		</tr>
		<tr>
			<td>350</td>
			<td>105</td>
			<td>105</td>
			<td>85</td>
		</tr>
		<tr>
			<td>400</td>
			<td>135</td>
			<td>135</td>
			<td>100</td>
		</tr>
		<tr>
			<td>450</td>
			<td>170</td>
			<td>170</td>
			<td>130</td>
		</tr>
		<tr>
			<td>500</td>
			<td>от 200</td>
			<td>от 200</td>
			<td>от 150</td>
		</tr>
		<tr>
			<td>600</td>
			<td>от 220</td>
			<td>от 220</td>
			<td>от 170</td>
		</tr>
	</tbody>
</table>

<table>
<caption>Коэффициенты сложности</caption>  
<tr>
	<td>К1 Отвод воды х 1,2</td>
	<td>К6 Высокая армированность Ø>16 x 1,5</td>
</tr>
<tr>
	<td>К2 Бурение на высоте 1,8-3,8 м х 1,2</td>
	<td>К7 Удаленный доступ к воде (более 50м) x 1,3</td>
</tr>
<tr>
	<td>К3 Бурение на высоте > 3,8 м х 1,5</td>
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
</tbody></table>
<br>
<p>Выезд за МКАД:</p>
<ul>
	<li>до 30км. &mdash; 1200 руб.</li>
	<li>свыше 30км. &mdash; 30 руб./км.</li>
</ul>

<p>Условия к заказчику:</p>
<ul>
	<li>Электроэнергия (220V-380V);</li>
	<li>Вода;</li>
	<li>Разметка отверстий;</li>
	<li>Доступ к месту проведения работ.</li>
</ul>


<p style="margin-top:20px;"><a class="price_link" href="/price/price.pdf">Скачать прайс на сверление, бурение и пробивку отверстий</a></p>
</div>

<?$APPLICATION->IncludeFile('/includes/calc_popup/calc_popup.php', array(), array('MODE'=>'html')); ?>
<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
