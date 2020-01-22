<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сверление отверстий в асфальте, расценки в Москве – Резалмаз");
$APPLICATION->SetPageProperty("description", "Алмазное бурение отверстий в асфальте в Москве по доступным ценам. Заказать сверление отверстий в компании РезАлмаз.");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;">
	<div class="left_column">
		<h1>Сверление отверстий в асфальте</h1>
		<p class="padding_top">Оптимальная технология для сверления отверстий в асфальте любой толщины и твердости – алмазное бурение. Сверхпрочные технические алмазные элементы на высоких скоростях проделывают ровные отверстия необходимой глубины.</p>
		
		<p>Пыль, неизбежная при бурении асфальта, адсорбируется водой, подведенной в рабочую зону. Обеспечивается высокий коэффициент экологичности работ в местах большого скопления людей. Вода служит для охлаждения рабочих поверхностей, благодаря чему возможна безостановочная работа без перегрева.</p>
		
		<p>Сверление отверстий в асфальте при помощи алмазных коронок обеспечивает:</p>
		<ul>
		<li>высокую скорость работ;</li>
		<li>точность;</li>
		<li>ровные срезы;</li>
		<li>отсутствие шума и вибрации.</li>
		</ul>
		<p>Расценки на <a href="/almaznoe_burenie/">сверление отверстий</a> в асфальте зависят от множества факторов: от объема работ, характеристик асфальтового покрытия, глубины и диаметра отверстий. Звоните, мы работаем в Москве и области без выходных.</p>

		<h3 class="h3_bg">Дополнительная информация</h3>

		<ul>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/tehnologiya/">Технология алмазного бурения отверстий в бетоне: современные разработки</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/bez-vody/">Алмазное бурение без воды</a></li>
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
