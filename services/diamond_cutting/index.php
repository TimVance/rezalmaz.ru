<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Алмазная резка");
?>
<div class="grey_box_1 inner_info_box">
	<div class="grey_header">
		<div class="decor_l"></div>
		<div class="decor_r"></div>
	</div>
	<div class="grey_content">
		<div class="grey_content_l">
			<div class="grey_content_r">
				<div class="inner_info_box_content text_style">
					<img src="/images/img_decor_1.png" alt="" class="inner_info_box_decor" />
					<h2><span>Алмазная резка бетона</span></h2>
					<p>Ремонт, расширение пространства комнат, декоративные арки, монтаж новых больших окон… В последние годы это очень популярные строительные работы. И все они легко исполнимы, если в ремонте используются инструменты с алмазным покрытием.</p>
					<p>«Резалмаз» специализируется на алмазной резке бетона в Москве и на уже пять лет оказывает клиентам высококвалифицированные услуги по работе с самыми сложными материалами.</p>
					<p>Современные технологии позволяют сделать прорезку отверстий быстро, практически бесшумно и очень точно.</p>

				</div>								
			</div>							
		</div>
	</div>
	<div class="grey_footer">
		<div class="decor_l"></div>
		<div class="decor_r"></div>
	</div>
</div>

<div class="inner_two_column text_style">
	<div class="left_column">
		<table cellspacing="0" cellpadding="0">  
			<caption>Стоимость услуг</caption>  
	        <tr>
	            <th>Толщина стены (мм)</th>
	            <th>Кирпич <br />(стоимость 1-го погонного метра)<br />в рублях</th>
	            <th>Слабоармированный бетон, ФБС, панель</th>
	            <th>Железобетон, монолит <br />(стоимость 1-го погонного метра)<br />в рублях</th>
	        </tr>
	        <tr class="zebra">
	            <td>до 170</td>
	            <td>900</td>
	            <td>900</td>
	            <td>1250</td>
	        </tr>
	        <tr>
	            <td>180</td>
	            <td>1100</td>
	            <td>1300</td>
	            <td>1900</td>
	        </tr>
	        <tr class="zebra">
	            <td>200</td>
	            <td>1220</td>
	            <td>1500</td>
	            <td>2050</td>
	        </tr>
	        <tr>
	            <td>220</td>
	            <td>1340</td>
	            <td>1800</td>
	            <td>2250</td>
	
	        </tr>
	        <tr class="zebra">
	            <td>250</td>
	            <td>1540</td>
	            <td>2300</td>
	            <td>2560</td>
	        </tr>
	        <tr>
	            <td>300</td>
	            <td>1830</td>
	            <td>3140</td>
	            <td>3140</td>
	        </tr>
	        <tr class="zebra">
	            <td>400</td>
	            <td>2450</td>
	            <td>4120</td>
	            <td>4120</td>
	        </tr>
	        <tr>
	            <td>500</td>
	            <td>3060</td>
	            <td>5180</td>
	            <td>5180</td>
	        </tr>
	        <tr class="zebra">
	            <td>600</td>
	            <td>3670</td>
	            <td>7140</td>
	            <td>7140</td>
	        </tr>
	        <tr>
	            <td>650</td>
	            <td>4230</td>
	            <td>7450</td>
	            <td>7450</td>
	        </tr>
	        <tr class="zebra">
	            <td>700</td>
	            <td>4590</td>
	            <td>8050</td>
	            <td>8050</td>
	        </tr>
		</table>
		<div class="photo_galery">
			<div class="big_photo"></div>
			<ul>
				<li><?=show_a_img('/images/2544-1600x900.jpg', 60, 0, 570)?></li>
				<li><?=show_a_img('/images/78826-1600x900.jpg', 60, 0, 570)?></li>
				<li><?=show_a_img('/images/93624-1600x900.jpg', 60, 0, 570)?></li>
				<li><?=show_a_img('/images/93656-1600x900.jpg', 60, 0, 570)?></li>
				<li><?=show_a_img('/images/123418-1600x900.jpg', 60, 0, 570)?></li>
			</ul>
		</div>
	</div>
	<div class="right_column">
		<div class="grey_box_2">
			<div class="grey_header">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style">
							<h2 class="arrow_bg"><span>Возможны скидки до 20%!</span></h2>
							<p class="clear_left">Выезд опытного консультанта поможет на месте обсудить все детали и тонкости планируемых работ, а также определить окончательную стоимость проекта.</p>
						</div>								
					</div>							
				</div>
			</div>
			<div class="grey_footer">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>
		
		<div class="grey_box_2">
			<div class="grey_header">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style">
							<?$APPLICATION->IncludeFile('/form_order.php', array(), array('MODE'=>'html'))?>
						</div>								
					</div>							
				</div>
			</div>
			<div class="grey_footer">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>
		
		<div class="text_box">
			<h3><span>Наша компания предлагает вам следующие виды работ:</span></h3>
			<ul>
				<li>исправление строительного брака;</li>
				<li>резка проемов в стенах и перекрытиях любой сложности;</li>
				<li>резка фасадов;</li>
				<li>резка монолитных конструкций;</li>
				<li>прорезка ниш под сейфы, встроенную мебель и т.д.;</li>
				<li>резка под углом;</li>
				<li>резка вплотную к полу, к потолку, к стене на любой высоте.</li>
			</ul>
			<h3><span>Алмазная резка стен и дверных проемов</span></h3>
			<p>Алмазная резка стен подразумевает под собой несколько этапов. Первым делом проводится разметка стены, где четко и точно устанавливаются границы будущего проема. После этого бетон разрезается по намеченным линиям. Далее в углах будущего проема с помощью алмазного бурения просверливаются отверстия. Затем прорезь делается с обратной стороны стенки. Вырезанный материал аккуратно укладывается на подготовленную поверхность и разрезается на блоки (так отработанный железобетон легче убрать). Последняя стадия расширения проема в стене – укрепление его специальными металлоконструкциями.</p>

			<p>Самые главные преимущества работы алмазным оборудованием по расширению дверного проема: монолит разрезается в кратчайшие сроки, практически бесшумно и с максимальной точностью. Качество будет одинаково высокое вне зависимости от сложности работы. Любое, даже самое безумное дизайнерское решение можно воплотить в жизнь.</p>

			<p>Современная техника позволяет проводить алмазную резку проемов на глубину до 700 мм. Насыщенность материала арматурой практически не влияет на время выполнения заказа.</p>


		</div>
	</div>				
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>