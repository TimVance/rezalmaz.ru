<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Усиление проемов в кирпичной стене после алмазной резки. Цены на усиление дверных проемов.");
$APPLICATION->SetPageProperty("keywords", "усиление проемов, усиление дверного проема");
$APPLICATION->SetPageProperty("title", "Усиление дверного проема в несущей стене, усиление швеллерами и уголками – Резалмаз");
$APPLICATION->SetTitle("Усиление проемов");
?><?/*<div class="grey_box_1 inner_info_box">
	<div class="grey_header">
		<div class="decor_l"></div>
		<div class="decor_r"></div>
	</div>
	<div class="grey_content">
		<div class="grey_content_l">
			<div class="grey_content_r">
				<div class="inner_info_box_content text_style">
					<img src="/images/img_decor_4.png" alt="" class="inner_info_box_decor" />
					<h1>Усиление дверного проема в кирпичной стене</h1>
					<p>В вашем доме наконец-то случился капитальный ремонт, и вы расширили дверной проем с помощью алмазной резки железобетона. Казалось бы, вставляй дверь и живи спокойно. Однако вся работа может оказаться насмарку, если вовремя не усилить дверной проем.</p>
					<p>Это необходимая и естественная мера, ведь, вырезав часть стены, вы значительно ее ослабили. Компенсировать снижение прочности можно довольно легко, установив для этого специальные металлоконструкции.</p>

<p>Усиление проема в несущей стене производится с помощью швеллеров и уголков. </p>
				</div>								
			</div>							
		</div>
	</div>
	<div class="grey_footer">
		<div class="decor_l"></div>
		<div class="decor_r"></div>
	</div>
</div>*/?>

<div class="grey_box_1 inner_info_box bg_4">
	<div class="inner_info_box_content text_style">
		<h1>Усиление дверного проема в кирпичной стене</h1>
		<p class="padding_top">Проводя ремонт, в ходе которого предстоит перепланировка помещений, очень часто проводится расширение старого или вырезка нового дверного проема в кирпичной стене. Прежде чем в вырезанный проем будет установлен дверной блок, его необходимо усилить.</p><p> Усиление проемов в кирпичной стене проводится при помощи различных материалов: швеллеров, уголков и пр. Для упрощения этого процесса необходимо выполнить вырезание проема, края которого будут идеально ровными. Для этого чаще всего используется <a href="/">алмазная резка</a>. Но если вами произведена резка проемов другим способом, то края проемов нуждаются в дополнительной обработке.</p>
	</div>
</div>


<div class="inner_two_column text_style">
	<div class="left_column">

		<?$APPLICATION->IncludeFile('/includes/service_prices.php', array(), array('MODE'=>'html'))?>

		<p class="more_prize"><a href="/price/">Полный прайс услуг</a></p>

<?php
$fopen = file("names.txt")
?>
 		
    <div class="photo_galery"> 			
      <div class="big_photo"></div>
	
      <div id="in"></div>   

      <ul>
	        <li><?=show_a_img('/images/shtrob1.jpg', 60, 0, 570)?><div id="/images/shtrob1.jpg" class="pic"><? echo $fopen[0]; ?></div></li>
		<li><?=show_a_img('/images/shtrob2.jpg', 60, 0, 570)?><div id="/images/shtrob2.jpg" class="pic"><? echo $fopen[1]; ?></div></li>
		<li><?=show_a_img('/images/shtrob3.jpg', 60, 0, 570)?><div id="/images/shtrob3.jpg" class="pic"><? echo $fopen[2]; ?></div></li>
		<li><?=show_a_img('/images/shtrob4.jpg', 60, 0, 570)?><div id="/images/shtrob4.jpg" class="pic"><? echo $fopen[3]; ?></div></li>
		<li><?=show_a_img('/images/shtrob5.jpg', 60, 0, 570)?><div id="/images/shtrob5.jpg" class="pic"><? echo $fopen[4]; ?></div></li>
                <li><?=show_a_img('/images/usilenie/proem1.jpg', 60, 0, 570)?><div id="/images/usilenie/proem1.jpg" class="pic"><? echo $fopen[5]; ?></div></li>
                <li><?=show_a_img('/images/usilenie/proem2.jpg', 60, 0, 570)?><div id="/images/usilenie/proem2.jpg" class="pic"><? echo $fopen[6]; ?></div></li>
      </ul>
      </div>
    </div>
	<div class="right_column">
		<div class="grey_box_2"> 			
      <div class="grey_header"> 				
        <div class="decor_l"></div>
       				
        <div class="decor_r"></div>
       			</div>
     			
      <div class="grey_content"> 				
        <div class="grey_content_l"> 					
          <div class="grey_content_r"> 						
            <div class="text_style"> 							
              <p class="arrow_bg skidka"><span>Возможны скидки до 20%!</span></p>
             							
              <p class="clear_left">Выезд опытного консультанта поможет на месте обсудить все детали и тонкости планируемых работ, а также определить окончательную стоимость проекта.</p>
             						</div>
          								 					</div>
        							 				</div>
       			</div>
     			
      <div class="grey_footer"> 				
        <div class="decor_l"></div>
       				
        <div class="decor_r"></div>
       			</div>
     		</div>
		
		<div class="grey_box_2">
			<div class="grey_header">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
			<div class="grey_content">
				<div class="grey_content_l">
					<div class="grey_content_r">
						<div class="text_style">							
							<?$APPLICATION->IncludeFile('/form_order.php', array(), array('MODE'=>'html'))?>
						</div>								
					</div>							
				</div>
			</div>
			<div class="grey_footer">
				<div class="decor_l"></div>
				<div class="decor_r"></div>
			</div>
		</div>
		
		<div class="text_box">
			<h2><span>Усиление швеллерами и уголками</span></h2>
			<p><i>Если толщина стены, в которой проводится усиление проемов, не более 18 см, то применяется 18 или 20-сантиметровый швеллер.</i> Если же стена имеет толщину более 40 см, то кроме усиления швеллерами или усиления уголками понадобится еще и дополнительное усиление ригельной балки, под которой непосредственно находится проем.</p>

<p>Для проведения двух- и однорядного, уголкового или коробкового усиления проемов, швеллеры и уголки крепятся к стене при помощи закладных деталей или анкеров. Рама, сваренная из швеллера и уголка, монтируется внутрь, после чего приваривается к закладным, чем обеспечивает надежное усиление проемов. Если стена имеет старую штукатурку или отделана другим способом, чтобы скрыть уголок, которым усилен проем, стоит провести <a href="http://www.rezalmaz.ru/almaznoe_stroblenie/">штробление</a> краев отверстия ровно на толщину и ширину уголка.</p>

<p>Безусловно, перепланировка и вырезание отверстий в несущих стенах обязательно должно быть согласовано в установленном порядке с компетентными органами. Компания «Резалмаз» возьмет на себя все ваши заботы о проведении ремонта, усилении стен и проемов, что поможет вам избежать ненужных проблем.</p>
		</div>
	</div>				
</div>

<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
