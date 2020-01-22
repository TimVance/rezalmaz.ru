<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вопросы технологии алмазного бурения отверстий в бетоне – Резалмаз");
$APPLICATION->SetPageProperty("description", "Технологии и оборудование используемое при алмазном бурение отверстий в бетоне. Компания РезАлмаз предлагает услуги по алмазной резке проемов в Москве и Московской области бетонных и железобетонных конструкций.");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;">
	<div class="left_column"> 
		<h1>Технология алмазного бурения отверстий в бетоне: современные разработки</h1>
		<p class="padding_top">Технология <a href="http://www.rezalmaz.ru/almaznoe_burenie/">алмазного бурения отверстий в бетоне</a> является наиболее оперативным, точным и малозатратным методом. С ее внедрением в производство такая операция, как сверление больших отверстий в бетоне, стала проходить намного проще и быстрее.</p>
		
		<h3 class="h3_bg">Когда используют алмазное бурение?</h3>
		
		<p>Это ключевой этап прокладки коммуникаций. Он необходим при создании отверстий для электрического оборудования, вентиляции, кондиционеров, канализации и водопровода. Метод применяют для любых материалов: бетона, железобетона, кирпича.</p>
		
		<h3 class="h3_bg">Алмазное сверление отверстий в бетоне: оборудование, которое мы используем</h3>
		
		<p>Алмазное сверление отверстий в бетоне, инструмент для которого выбирается с особым профессиональным вниманием и тщательностью, предполагает использование бурильной установки с алмазными коронками. Данное оборудование гарантирует точность и чистоту работ, так как надежно закрепляется у стены, не двигается, не отклоняется.</p>
		
		<p>В конструкцию подается водопроводная вода, которая охлаждает коронку и собирает пыль. Растекаться жидкости не дает водяной коллектор. Для отверстий под розетки воду можно не использовать. Бурение на небольшую глубину само по себе не дает много пыли, кроме того, работы занимают мало времени — скорость сверления составляет 1–6 см/мин и зависит от прочности материала.</p>
		
		<p>Алмазное сверление отверстий в бетоне с помощью современного оборудования не повреждает строительные конструкции, так как исключает сильные удары и вредную вибрацию.</p>

		<h3 class="h3_bg">Дополнительная информация</h3>

		<ul>
			<li><a href="http://www.rezalmaz.ru/almaznoe_burenie/bez-vody/">Алмазное бурение без воды</a></li>
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
