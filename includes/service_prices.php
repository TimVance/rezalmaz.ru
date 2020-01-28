<?if (
		(strstr($_SERVER['REQUEST_URI'], '/almaznaja_rezka/')) ||
		(strstr($_SERVER['REQUEST_URI'], '/kanatnaya_rezka/')) ||
		(strstr($_SERVER['REQUEST_URI'], '/rezka_proyomov/')) ||
		(strstr($_SERVER['REQUEST_URI'], '/stenoreznie_mashini/'))) { ?>
	<table cellpadding="0" cellspacing="0">
		<caption>Цены</caption>
		<tbody>
			<tr>
				<th>Толщина стены (мм)</th>
				<th>Кирпич<br>
					(стоимость 1-го погонного метра)<br>
					в рублях</th>
				<th>Железобетон, монолит<br>
					(стоимость 1-го погонного метра)<br>
					в рублях</th>
			</tr>
			<tr class="zebra">
				<td class="td-style">до 120</td>
				<td class="td-style">920</td>
				<td class="td-style">1280</td>
			</tr>
			<tr>
				<td class="td-style">130-180</td>
				<td class="td-style">1150</td>
				<td class="td-style">1940</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">200</td>
				<td class="td-style">1250</td>
				<td class="td-style">2150</td>
			</tr>
			<tr>
				<td class="td-style">220</td>
				<td class="td-style">1370</td>
				<td class="td-style">2350</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">250</td>
				<td class="td-style">1570</td>
				<td class="td-style">2700</td>
			</tr>
			<tr>
				<td class="td-style">300</td>
				<td class="td-style">1870</td>
				<td class="td-style">3250</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">400</td>
				<td class="td-style">2500</td>
				<td class="td-style">4500</td>
			</tr>
			<tr>
				<td class="td-style">500</td>
				<td class="td-style">3150</td>
				<td class="td-style">5650</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">600</td>
				<td class="td-style">от 3750</td>
				<td class="td-style">от 7300</td>
			</tr>
			<tr>
				<td class="td-style">650</td>
				<td class="td-style">от 4350</td>
				<td class="td-style">от 7600</td>
			</tr>
			<tr class="zebra">
				<td class="td-style">700</td>
				<td class="td-style">от 4700</td>
				<td class="td-style">от 8250</td>
			</tr>
		</tbody>
	</table>
<?} else if (strstr($_SERVER['REQUEST_URI'], '/almaznoe_burenie/')) { ?>
	<table>
		<caption>Цены</caption>
		<tbody>
			<tr>
				<th>Диаметр отверстия (мм)</th>
				<th>Бетон<br>
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
			</tr>
			<tr>
				<td>52-102</td>
				<td>30</td>
				<td>30</td>
			</tr>
			<tr>
				<td>112</td>
				<td>33</td>
				<td>30</td>
			</tr>
			<tr>
				<td>122</td>
				<td>36</td>
				<td>30</td>
			</tr>
			<tr>
				<td>132-152</td>
				<td>46</td>
				<td>30</td>
			</tr>
			<tr>
				<td>162</td>
				<td>49</td>
				<td>31</td>
			</tr>
			<tr>
				<td>172-182</td>
				<td>54</td>
				<td>36</td>
			</tr>
			<tr>
				<td>202</td>
				<td>60</td>
				<td>41</td>
			</tr>
			<tr>
				<td>225-252</td>
				<td>87</td>
				<td>44</td>
			</tr>
			<tr>
				<td>272</td>
				<td>92</td>
				<td>51</td>
			</tr>
			<tr>
				<td>300</td>
				<td>96</td>
				<td>58</td>
			</tr>
			<tr>
				<td>350</td>
				<td>107</td>
				<td>87</td>
			</tr>
			<tr>
				<td>400</td>
				<td>138</td>
				<td>102</td>
			</tr>
			<tr>
				<td>450</td>
				<td>141</td>
				<td>133</td>
			</tr>
			<tr>
				<td>500</td>
				<td>от 204</td>
				<td>от 155</td>
			</tr>
			<tr>
				<td>600</td>
				<td>от 225</td>
				<td>от 175</td>
			</tr>
			<tr>
				<td colspan="3" style="background-color:#DEDEDE;"><span style="font-size:18px;font-weight:bold;color:#000;">При бурении на глубину более 1 м, цена договорная!</span></td>
			</tr>
		</tbody>
	</table>
<?} else if (strstr($_SERVER['REQUEST_URI'], '/almaznoe_stroblenie/')) { ?>
	<table>
		<caption>Цены</caption>  
		<tbody><tr>
			<th>Наименование работ</th>
			<th>Кирпич<br>(стоимость 1-го погонного метра)<br>в рублях</th>
			<th>Бетон<br>(стоимость 1-го погонного метра)<br>в рублях</th>
		</tr>
		<tr>
			<td>Штроба 2х2 см. штроборезом<br>с пылесосом по стене</td>
			<td>200</td>
			<td>300</td>
		</tr>
		<tr>
			<td>Штроба 2х2 см. штроборезом<br>с пылесосом по потолку</td>
			<td> </td>
			<td>400</td>
		</tr>
		<tr>
			<td>Гнездо-подрозетник</td>
			<td>200</td>
			<td>300</td>
		</tr>
		<tr>
			<td>Штроба под кондиционер</td>
			<td>1000</td>
			<td>1500</td>
		</tr>
		</tbody>
	</table>
<?} else if (strstr($_SERVER['REQUEST_URI'], '/usilenie_projomov/')) { ?>
	<table>
		<caption>Цены</caption>  
		<tbody><tr>
			<th>Тип усиления</th>
			<th width="200">Область применения</th>
			<th>Цена<br>(стоимость 1-го погонного метра)<br>в рублях</th>
		</tr>
		<tr>
			<td>Однорядное, двурядное, уголковое</td>
			<td>Кирпич, бетон, железобетон, ФБС</td>
			<td>от 3000</td>
		</tr>
		</tbody>
	</table>
<? } ?>
