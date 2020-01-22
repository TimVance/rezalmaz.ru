<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Перепланировка квартир, разрешение на перепланировку – Резалмаз");
$APPLICATION->SetPageProperty("description", "Компания РезАлмаз предлагает услуги по перепланировке квартир. Мы проводим все необходимые работы по резке и усилению проемов. Звоните по телефону +7 (495) 792-93-92.");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;"> 	
	<div class="left_column">
		<h1>Перепланировка квартир</h1>
		
		<p class="padding_top">Перепланировка квартир подразумевает выполнение самых разнообразных работ, начиная от перестройки межкомнатных перегородок и заканчивая частичным сносом несущих стен. </p>
		
		<h3 class="h3_bg">Виды перепланировки</h3>
		
		<p>В зависимости от специфики выделяется два вида реконструкции квартир:</p>
		
		<ul> 
			<li>Простая. Предполагает незначительные изменения: перенос, демонтаж и сборку перегородок, дополнительные проемы в некапитальных стенах, заделка проемов. Она выполняется на основании эскиза, который отражает запланированные изменения в существующем плане квартиры. </li>
		
			<li>Сложная. Включает в себя более трудоемкие работы: частичный снос капитальных стен и обустройство в них проемов, увеличение площади помещений, перенос санузла и кухни, переоборудование коммуникаций. Перепланировка этого вида осуществляется на основании архитектурного проекта.</li>
		</ul>
		
		<h3 class="h3_bg">Разрешение на перепланировку</h3>
		
		<p>Перед началом ремонтных работ необходимо согласовать перепланировку в Мосжилинспекции, отделе архитектуры и градостроительства, СЭС и пожарной инспекции. Эти организации проводят экспертизу эскизов и проектов в целях обеспечения безопасности при проведении реконструкции и дальнейшей эксплуатации помещения. </p>
		
		<h3 class="h3_bg">Последствия отсутствия разрешения на перепланировку</h3>
		
		<p>Если разрешение на перепланировку отсутствует, это приведет к серьезным негативным последствиям:</p>
		
		<ul> 
			<li>собственник не сможет распоряжаться реконструированной недвижимостью;</li>
		
			<li>при получении наследства у правопреемников возникнут значительные сложности с оформлением документов;</li>
		
			<li>органы власти могут наложить крупный штраф, обязать восстановить первоначальную конфигурацию жилья, обратиться в суд с иском о принудительной продаже квартиры.</li>
		</ul>
		
		<h3 class="h3_bg">Услуги нашей компании</h3>
		
		<p>Если вы хотите сделать перепланировку своей квартиры, обратитесь в компанию РезАлмаз. Наш парк оборудования позволяет проводить все необходимые работы по <a href="/" >резке</a> и усилению проемов, алмазному бурению, штроблению. </p>
		
		<h3 class="h3_bg">Дополнительная информация</h3>
		
		<ul> 
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/sten-bez-pyli/">Алмазная резка стен без пыли</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/kamnya/">Алмазная резка камня</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/perekrytiy/">Резка перекрытий</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/shvov-betone/">Нарезка швов в бетоне</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznaja_rezka/betonnogo-pola/">Алмазная резка бетонных полов</a></li>
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
