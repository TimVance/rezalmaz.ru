<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Штробление стен без пыли по низкой цене в Москве – Резалмаз");
$APPLICATION->SetPageProperty("description", "Заказать услуги по штроблению стен без пыли по телефону +7 (495) 792-93-92 в Москве. Профессиональная алмазная резка и штробление стен по низкой цене от компании «Резалмаз».");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;">
	<div class="left_column">
		<h1>Штробление стен без шума и пыли</h1>
		<p class="padding_top">Копания РезАлмаз выполняет <a href="/almaznoe_stroblenie/">штробление стен без пыли в Москве по низкой цене</a>, выезжаем также за пределы МКАД. Наши мастера сталкиваются с самыми cложными запросами и решают любые проблемы, связанные с техническими ограничениями на штробление. Мы учитываем все существующие нормативы и следим за любыми изменениями технического регламента в Москве.</p>
		<p>Штробление стен под проводку, розетки или трубы может производиться без пыли и шума, штроба может быть проделана в стене, имеющей твердые вкрапления и арматуру без снижения прочности конструкции. Резка штробы без пыли возможна благодаря подключению к штроборезу промышленного пылесоса. Эта технология абсолютно безопасна для здоровья, а отсутствие пыли и крошки избавляет от необходимости генеральной уборки после окончания работ. Благодаря забору пылесосом мелких частиц из штробы, получают ровные срезы и одинаково точную ширину и глубину по всей длине.</p>
		<p>Наши мастера используют современные штроборезы с алмазным наконечником. Использование такого инструмента увеличивает стоимость штробления, но оправдывает себя, так как обеспечивает:</p>
		<ul>
			<li>высокую точность;</li>
			<li>скорость работы;</li>
			<li>сохранность несущих конструкций;</li>
			<li>безопасность.</li>
		</ul>
		<p>Для достижения лучшего результата по привлекательной цене обращайтесь к специалистам компании «РезАлмаз». Мы работаем в Москве и за МКАД, заявки принимаем по телефону с 9 утра до 10 вечера ежедневно и по электронной почте. Для решения сложных вопросов, когда обстоятельства требуют принимать во внимание особенности рабочей площадки или конструкции стены – на место выезжает специалист для составления плана работ и предварительной оценки итоговой стоимости штробления.</p>
		<h3 class="h3_bg">Дополнительная информация</h3>
		<ul>
			<li><a href="http://www.rezalmaz.ru/almaznoe_stroblenie/gorizontalnoe/">Горизонтальное штробление несущих стен</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_stroblenie/instrument/">Инструмент для штробления стен</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_stroblenie/pod-kondicioner/">Штробление несущих стен под кондиционер</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_stroblenie/potolka-v-panelnom-dome/">Штробление потолка в панельном доме</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_stroblenie/snip/">Штробление стен, СНиП</a></li>
			<li><a href="http://www.rezalmaz.ru/almaznoe_stroblenie/pazogrebnevyh-plit/">Пазогребневые плиты</a></li>
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

<?$APPLICATION->IncludeFile('/includes/calc_popup/calc_popup.php', array(), array('MODE'=>'html'));?>
<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
