<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Алмазная резка деформационных швов в Москве");
$APPLICATION->SetPageProperty("description", "Компания РезАлмаз предлагает услуги по алмазной резке деформационных швов. Мы работаем не только на объектах в Москве но и в пределах Центрального Федерального округа.");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;"> 	
	<div class="left_column">
		<h1>Алмазная резка деформационных швов</h1>
		<p>Деформационные швы применяются во многих жилых и промышленных объектах для снятия нагрузки с отдельных частей конструкций в местах их предполагаемой деформации. Она может образоваться в результате колебания температуры, неравномерной усадки грунта, сейсмической активности и прочих воздействиях.</p>
		<h2 class="h2_bg">Особенности резки швов</h2>
		<p>Для резки деформационных швов могут применяться:</p>
		<ul>
			<li>штроборез;</li>
			<li>дисковая пила;</li>
			<li>канатная установка.</li>
		</ul>
		<p>Перед резкой проводится расчет глубины, ширины и частоты швов. Показатели зависят от температурного режима эксплуатации здания. Если в помещение нет отопления, то прорези должны быть сделаны через каждые 40 метров. В отапливаемом – через каждые 60 метров. Глубина швов как правило составляет четверть от толщины бетонного покрытия.</p>
		<p>Алмазная резка имеет следующие преимущества:</p>
		<ul>
			<li>подача воды сводит к минимуму количество пыли образовываемой в процессе работы;</li>
			<li>швы получаются ровными и равномерной глубины;</li>
			<li>высокая скорость работ.</li>
		</ul>
		<p>После резки каналов происходит их очищение от остатков бетона. Затем швы заполняются герметиком. Это нужно для предотвращения попадания в них влаги и различного мусора.</p>
		<h2 class="h2_bg">Стоимость работ</h2>
		<p>Конечная цена зависит от:</p>
		<ul>
			<li>глубины и длины швов;</li>
			<li>степени армированности материала;</li>
			<li>наличия воды поблизости и т.д.</li>
		</ul>
		<p>Компания «РезАлмаз» имеет большой опыт в проведении работ при помощи <a href="/">алмазной резки</a>. Наши специалисты выезжают на объекты не только в Москве, но и в пределах Центрального Федерального округа.</p>
		<p>Обращайтесь – нарезаем швы аккуратно и быстро.</p>
			
		<h3 class="h3_bg">Дополнительная информация</h3>
		
		<ul> 
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/sten-bez-pyli/">Алмазная резка стен без пыли</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/pereplanirovka-kvartir/">Перепланировка квартир</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/kamnya/">Алмазная резка камня</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/perekrytiy/">Резка перекрытий</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/shvov-betone/">Нарезка швов в бетоне</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/betonnogo-pola/">Алмазная резка бетонных полов</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/kirpicha/">Алмазная резка кирпичной стены</a></li>
			<li><a href="/almaznaja_rezka/sten/">Алмазная резка стен</a></li>
			<li><a href="/almaznaja_rezka/asfalta/">Алмазная резка асфальта</a></li>
			<li><a href="/almaznaja_rezka/nish/">Алмазная резка ниш</a></li>
			<li><a href="/almaznaja_rezka/fundamenta/">Алмазная резка фундамента</a></li>
		</ul>
	</div>
 	
	<div class="right_column" style="margin-top: -15px !important;"> 		
	
		<?$APPLICATION->IncludeFile('/block_calc_right.php', array(), array('MODE'=>'html'))?>
        <?$APPLICATION->IncludeFile('/block_order_right.php', array(), array('MODE'=>'html'))?>
     		
		<div class="grey_box_2" style="margin: -15px 0px 0px !important;"> 			
			<div class="grey_header"> 				
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			
			<div class="grey_content"> 				
				<div class="grey_content_l"> 					
					<div class="grey_content_r"> 						
						<div class="text_style">              
							<?$APPLICATION->IncludeFile('/form_order1.php', array(), array('MODE'=>'html'))?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="grey_footer"> 				
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>
   		 		
		<div class="text_box" style="padding: 0px;"> 		
			<?$APPLICATION->IncludeFile('/includes/service_prices.php', array(), array('MODE'=>'html'))?>
		</div>
   	</div>
</div>

<?$APPLICATION->IncludeFile('/includes/calc_popup/calc_popup.php', array(), array('MODE'=>'html')); ?>
<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
