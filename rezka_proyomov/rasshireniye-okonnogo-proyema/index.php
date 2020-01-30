<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Расширение оконного проема в кирпичной стене в Москве. Цена расширения проемов по вертикали в панельном доме. Компания «РезАлмаз» — алмазная резка бетона, железобетона и кирпича. Сверление и бурение отверстий. Штробление стен. Работаем в Москве и Московской области. Выезд специалистов. Расчет цены работ на калькуляторе. Звоните: +7 (495) 792-93-92");
$APPLICATION->SetTitle("Расширение оконного проема — цена расширения оконного проема в кирпичной стене панельного дома в Москве");
?>
<div class="inner_two_column text_style" style="margin-top: -20px;"> 	
	<div class="left_column">
		<h1>Расширение оконного проема</h1>
		<p class="padding_top">Расширение оконных проемов — востребованная строительная услуга. В зависимости от потребностей владельца помещения и конструктивных особенностей здания производится <a href="http://www.rezalmaz.ru/rezka_proyomov/">расширение проема</a> по вертикали, по горизонтали или в двух направлениях одновременно.</p>
		<p>Компания РезАлмаз предлагает комплексные услуги. Наши сотрудники составят проект перепланировки в соответствии со СНиП и качественно проведут строительные работы. </p>
		<h3 class="h3_bg">Технология работы</h3>
		<p>Увеличение окон осуществляется при помощи <a href="/">технологии алмазной резки</a>. На сегодня этот метод является наиболее надежным и безопасным, он имеет следующие плюсы:</p>
		<ul>
			<li>высокая точность и гладкость срезов;</li>
			<li>минимальное количество пыли;</li>
			<li>бесшумность;</li>
			<li>универсальность (подходит для расширения оконного проема в кирпичной стене, бетоне, мраморе и любых других материалах.)</li>
		</ul>
		<h3 class="h3_bg">Расширение оконного проема в панельном доме</h3>
		<p>Расширение оконного проема в панельном доме имеет некоторые особенности. По периметрам окон и дверей заложена арматура, которую можно повредить даже при незначительном увеличении. Поэтому при проведении работ необходимо обязательно использовать укрепляющие конструкции. </p> 
		<h3 class="h3_bg">Последствия расширения оконного проема без согласования </h3>
		<p>Расширение оконного проема — разновидность перепланировки помещения, поэтому прежде чем его провести, необходимо получить соответствующие разрешения в ряде организаций. Последствия несанкционированного расширения оконных проемов могут быть серьезными:</p>
		<ul>
			<li>создание аварийной ситуации, судебное разбирательство;</li>
			<li>наложение штрафных санкций;</li>
			<li>принуждение к восстановлению проема или продаже недвижимости с торгов.</li>
		</ul>
		<p>Получение разрешений — достаточно сложный процесс, который имеет множество нюансов. Например, чтобы согласовать расширение оконного проема в деревянном доме старой постройки, может потребоваться проведение дополнительных экспертиз. </p>
		<h3 class="h3_bg">Цены и сроки </h3>
		<p>Цены на алмазную резку оконных проемов и сроки выполнения работ определяются индивидуально. Они зависят от материала стены — бетон, кирпич, камень, сложности оформления разрешений, необходимости укрепления и др. Подробности вы можете узнать у наших специалистов.</p>
		<h3 class="h3_bg">Дополнительная информация</h3>
		<ul>
			<li><a href="/rezka_proyomov/dvernoi-proem/">Расширение дверного проема и его усиление</a></li>
			<li><a href="/rezka_proyomov/v-nesuschih-stenax/">Резка проемов в несущих стенах — важная часть перепланировки</a></li>
			<li><a href="/rezka_proyomov/dvernyh/">Алмазная резка дверных проемов</a></li>
			<li><a href="/rezka_proyomov/okonnyh/">Алмазная резка оконных проемов</a></li>
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

<?$APPLICATION->IncludeFile('/includes/calc_popup/calc_popup.php', array(), array('MODE'=>'html'));?>
<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>