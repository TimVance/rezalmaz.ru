<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сухое алмазное бурение без воды в Москве");
$APPLICATION->SetPageProperty("description", "Сухое алмазное бурение бетона без воды в Москве. Компания «РезАлмаз» — алмазная резка бетона, железобетона и кирпича. Сверление и бурение отверстий. Штробление стен. Работаем в Москве и Московской области. Выезд специалистов. Расчет цены работ на калькуляторе. Звоните: +7 (495) 792-93-92");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;">
	<div class="left_column">
		<h1>Сухое алмазное бурение без воды</h1>
		<p class="padding_top">В случаях, когда нет возможности подключить водяное охлаждение, для проделывания отверстий в фундаментах или стенах оптимально использовать алмазное бурение без воды, где охлаждение рабочей поверхности достигается за счет воздушной вентиляции.</p>
		
		<p>Коронки, используемые для <a href="/almaznoe_burenie/">алмазного бурения</a> без воды, изготавливаются по специальной технологии. Алмазные сегменты приваривают к коронке лазером, что обеспечивает надежную фиксацию при трении и воздействии высоких температур. Для лучшей сохранности оборудования «сухое» сверление требует больше времени.</p>
		
		<p>При выборе технологии, рекомендуем обратиться к специалистам, мы работаем в Москве и области ежедневно.</p>

		<p>Использование сухого бурения подходит для более мягких материалов:</p>
		<ul>
		<li>кирпича;</li>
		<li>бетона;</li>
		<li>газобетона.</li>
		</ul>

		<p>Коронка нагревается значительно меньше, отпадает необходимость водяного охлаждения. Данная технология актуальна при работе в помещениях с готовой отделкой, позволяет не прерывать рабочий ритм, так как:</p>
		<ul>
		<li>практически бесшумна;</li>
		<li>отсутствует вибрация;</li>
		<li>блокируется пылевой выброс.</li>
		</ul>

		<p>Благодаря уникальным особенностям сухое алмазное бурение может производиться в жилых и офисных помещениях, не нарушая привычный распорядок. После окончания работ не остается следов от крепежа буровой установки, внешний вид помещения изменяется только в одном: в указанных местах под нужными углами появляются отверстия необходимой глубины с ровными краями.</p>

		<p>Если вы хотите воспользоваться сухим алмазным бурением, но не уверены, подходит ли данная технология – позвоните нам. Мы работаем в Москве и области больше 9 лет, определим подходящий тип сверления и произведем работы любой сложности в любых труднодоступных местах.</p>

		<h3 class="h3_bg">Дополнительная информация</h3>

		<ul>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/tehnologiya/">Технология алмазного бурения отверстий в бетоне: современные разработки</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/asfalt/">Сверление отверстий в асфальте</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/podrozetnik/">Сверление подрозетников</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/perekrytiy/">Бурение отверстий в перекрытиях</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/fundament/">Сверление отверстий в фундаменте</a></li>
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
