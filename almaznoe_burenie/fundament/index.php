<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сверление отверстий в фундаменте — алмазное бурение фундаментов в Москве");
$APPLICATION->SetPageProperty("description", "Сверление отверстий в фундаменте в Москве. Алмазное бурение фундаментов. Компания «РезАлмаз» — алмазная резка бетона, железобетона и кирпича. Сверление и бурение отверстий. Штробление стен. Работаем в Москве и Московской области. Выезд специалистов. Расчет цены работ на калькуляторе. Звоните: +7 (495) 792-93-92");

	?>

<div class="inner_two_column text_style" style="margin-top: -20px;">
	<div class="left_column">
		<h1>Сверление отверстий в фундаменте</h1>
		<p class="padding_top">Бурение отверстий в фундаменте с применением ударной и тяжелой техники – это вчерашний день. Компания «РезАлмаз» предлагает работы по бурению фундамента с использованием алмазной буровой установки в Москве и области. Такая технология имеет ряд преимуществ: отверстия располагаются строго в указанных местах, твердые включения и арматура не являются помехой, прочностные характеристики фундамента не нарушаются.</p>
		<p>Бурение отверстий в фундаменте может понадобиться для:</p>
		<ul>
			<li>дополнительных отдушин (продухов);</li>
			<li>прокладки дополнительных коммуникаций;</li>
			<li>установки дополнительного укрепления.</li>
		</ul>
		<p>Технология алмазного бурения производится практически без шума и вибрации. При этом минимум загрязнений обеспечивает подвод воды в рабочую зону.</p>
		<p>Просверлить фундамент, используя алмазное бурение, можно даже после проведения облицовочных работ, технология имеет ряд неоспоримых преимуществ:</p>
		<ul>
			<li>отсутствие сколов и растрескивания;</li>
			<li>высокая точность;</li>
			<li>ровный край;</li>
			<li>минимальный выброс пыли;</li>
			<li>работа в местах ограниченного доступа и под углом;</li>
			<li>безударная технология.</li>
		</ul>
		<p>Компания «РезАлмаз» имеет более 9 лет успешной работы на рынке и производит алмазное бурение в Москве и Московской области. Мы выполняем сверление отверстий в фундаменте любой толщины и беремся за работу любой сложности.</p>

		<h3 class="h3_bg">Дополнительная информация</h3>

		<ul>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/tehnologiya/">Технология алмазного бурения отверстий в бетоне: современные разработки</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/bez-vody/">Алмазное бурение без воды</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/asfalt/">Сверление отверстий в асфальте</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/podrozetnik/">Сверление подрозетников</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/perekrytiy/">Бурение отверстий в перекрытиях</a></li>
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
