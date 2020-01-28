<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Алмазная резка полов — цена алмазной резки бетонного пола в Москве");
$APPLICATION->SetPageProperty("description", "Алмазная резка бетонного пола в Москве. Доступная цена. Компания «РезАлмаз» — алмазная резка бетона, железобетона и кирпича. Сверление и бурение отверстий. Штробление стен. Работаем в Москве и Московской области. Выезд специалистов. Расчет цены работ на калькуляторе. Звоните: +7 (495) 792-93-92");

?>
<div class="inner_two_column text_style" style="margin-top: -20px;"> 	
	<div class="left_column">
		<h1>Алмазная резка бетонных полов</h1>
		<p class="padding_top">При проведении демонтажа фундамента, бетонных оснований, конструкций и стяжек, нарезки просветов, штроб и канавок под системы вентиляции и инженерные коммуникации, устройстве температурных швов в полах и устранении строительного брака, оптимальной будет алмазная резка бетонного пола по низкой цене, которую предлагает компания «Резалмаз»!</p>
		
		<h3 class="h3_bg">Преимущества алмазной резки бетонного пола</h3>
		<p>Алмазная резка полов - сложный технологический процесс, который выполняется в компании «Резалмаз» специализированным инструментом: шоврезчиками, бензорезами, штроборезами и дисковыми пилами с использованием режущих дисков с алмазным напылением, а работы в труднодоступных местах (углы) требуют использования алмазных сверел.</p>
		<p>Использование алмазного инструмента позволяет:</p>
		<ul> 
			<li>быстро резать бетонные основания любой прочности и плотности с минимальной динамической нагрузкой на конструкции;</li>
			<li>получать очень ровную поверхность отверстия и контролировать его угол;</li>
			<li>выполнять работы с минимальным шумом, вибрацией и пылью.</li>
		</ul>
		
		<h3 class="h3_bg">Услуги резки бетонных напольных оснований от «Резалмаз»</h3>
		<p>Технология <a href="/">алмазной резки</a> бетона оптимальна для работы в помещениях небольшой площади с ограниченным рабочим пространством, где необходимо резать пол быстро и качественно, с минимумом разрушений и строительного мусора.</p>
		<p>Специалисты компании «Резалмаз» - подготовленные мастера ремонта с допусками и опытом проведения подобных работ в любых условиях. Мы выполним задачу с использованием профессионального инструмента быстро и качественно.</p>
		<p>При заказе услуг наших специалистов в Москве, к вам на дом прибудет наш консультант, который на месте оценит фронт работ, их технические особенности и стоимость проекта. Если вам необходима резка полов из бетона и других плотных стройматериалов – позвоните нам или закажите обратный звонок на сайте!</p>
		
		<h3 class="h3_bg">Дополнительная информация</h3>
		
		<ul> 
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/sten-bez-pyli/">Алмазная резка стен без пыли</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/pereplanirovka-kvartir/">Перепланировка квартир</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/kamnya/">Алмазная резка камня</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/perekrytiy/">Резка перекрытий</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/shvov-betone/">Нарезка швов в бетоне</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/kirpicha/">Алмазная резка кирпичной стены</a></li>
			<li><a href="/almaznaja_rezka/sten/">Алмазная резка стен</a></li>
			<li><a href="/almaznaja_rezka/asfalta/">Алмазная резка асфальта</a></li>
			<li><a href="/almaznaja_rezka/nish/">Алмазная резка ниш</a></li>
			<li><a href="/almaznaja_rezka/shvov/">Алмазная резка деформационных швов</a></li>
			<li><a href="/almaznaja_rezka/fundamenta/">Алмазная резка фундамента</a></li>
		</ul>
	</div>
 	
	<div class="right_column" style="margin-top: -15px !important;"> 		
	
		<?$APPLICATION->IncludeFile('/block_calc_right.php', array(), array('MODE'=>'html'))?>
     		
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
