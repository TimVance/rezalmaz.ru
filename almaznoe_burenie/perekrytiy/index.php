<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Алмазное бурение перекрытий — сверление отверстий в плитах перекрытия в Москве");
$APPLICATION->SetPageProperty("description", "Алмазное бурение перекрытий в Москве. Алмазное сверление отверстий в плитах перекрытия. Компания «РезАлмаз» — алмазная резка бетона, железобетона и кирпича. Сверление и бурение отверстий. Штробление стен. Работаем в Москве и Московской области. Выезд специалистов. Расчет цены работ на калькуляторе. Звоните: +7 (495) 792-93-92");

	?>
<div class="inner_two_column text_style" style="margin-top: -20px;">
	<div class="left_column">
		<h1>Бурение отверстий в перекрытиях</h1>
		<p class="padding_top">Алмазное бурение отверстий в перекрытиях зданий и инженерных конструкций – процесс трудоемкий, так как плиты перекрытий имеют высокую плотность и обычно качественно армируются железом. Получить ровное, гладкое отверстие в толстой плите обычным перфоратором и штроборезом будет сложно, а количество рабочего шума и пыли всегда затрудняет работу в жилых домах. Проблему поможет решить <a href="/almaznoe_burenie/">алмазное бурение отверстий</a> в перекрытиях, которое выполняется специальным буровым инструментом с удлиненными алмазными насадками на бурах.</p>
		
		<h3 class="h3_bg">Технология алмазного сверления перекрытий</h3>
		<p>Отверстия в перекрытиях обычно необходимы при строительстве или капитальном ремонте для прокладки инженерных коммуникаций (электропроводки, вентиляционных воздухопроводов, труб отопления, водоснабжения и канализации). Алмазные буры способны справиться с этой задачей идеально, так как:</p>
		<ul>
			<li>работа выполняется быстро и экономично;</li>
			<li>качество, точность размеров и требуемый угол можно постоянно контролировать;</li>
			<li>операция производится с минимальным шумом и пылью;</li>
			<li>есть возможность сделать отверстие в перекрытии при затрудненном доступе или в ограниченном рабочем пространстве.</li>
		</ul>
		<p>Специалисты компании «Резалмаз» предлагают в Москве и Московской области алмазное сверление отверстий в плитах перекрытия с помощью современных алмазных буров, использующих удлиненные алмазные насадки, которые позволяют получать отверстия требуемого диаметра в плитах перекрытий любой толщины, плотности и твердости. Бур легко преодолевает также арматурное укрепление, не создавая ударных и вибрационных нагрузок на поверхности, что исключает появление трещин и сколов, пыли и рабочего мусора.</p>
		<p>Услуги алмазного бурения перекрытий от «Резалмаз» в Москве имеют минимальную стоимость и выполняются нашими опытными специалистами с использованием профессионального инструмента. Для вызова на дом нашего консультанта, который оценит объемы, сложность и стоимость работ, позвоните нам или закажите обратный звонок на сайте!</p>

		<h3 class="h3_bg">Дополнительная информация</h3>

		<ul>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/tehnologiya/">Технология алмазного бурения отверстий в бетоне: современные разработки</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/bez-vody/">Алмазное бурение без воды</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/asfalt/">Сверление отверстий в асфальте</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/podrozetnik/">Сверление подрозетников</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/fundament/">Сверление отверстий в фундаменте</a></li>
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
