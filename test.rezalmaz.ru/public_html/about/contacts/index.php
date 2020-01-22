<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты Резалмаз – алмазное бурение и резка бетона в Москве и Московской области");
$APPLICATION->SetPageProperty("description", "Контакты компании РезАлмаз. Мы предлагаем услуги по алмазной резке проемов в Москве и Московской области. Звоните по телефону +7 (495) 792-93-92.");
$APPLICATION->SetTitle("Контакты");
?> 
<link rel="stylesheet" type="text/css" href="/bitrix/templates/main/contact_print.css">
<div class="grey_box_1 inner_info_box height_auto"> 	 
  <div class="grey_header"> 		 
    <div class="decor_l"></div>
   		 
    <div class="decor_r"></div>
   	</div>
 	 
  <div class="grey_content"> 		 
    <div class="grey_content_l"> 			 
      <div class="grey_content_r"> 				 
        <div class="inner_info_box_content_2 text_style"> 					 
          <h1>Наши контакты</h1>
         <input id="prbutton" onclick="window.print();" type="button" value="Печать">
          <br />
         
          <br />
         
          <div itemscope="" itemtype="http://schema.org/LocalBusiness"> 
            <p><span itemprop="name">Компания «РезАлмаз»</span></p>
           
            <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"> 
              <p>Адрес: <span itemprop="postalCode">125130</span>, <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">Головинское шоссе, 10</span> </p>
             </div>
           
            <p>Телефон:</p>

            <p><span class="ya-phone" itemprop="telephone">+7 (495) 792-93-92</span></p>
            
           
            <p style="font-size: 18px;">Электронная почта: <a href="mailto:info@rezalmaz.ru" ><span itemprop="email">info@rezalmaz.ru</span></a></p>

           
            <p>Режим работы: <time itemprop="openingHours" datetime="Mo-Su, 09:00−22:00">с 9 утра до 10 вечера, без выходных</time></p>
           </div>
         
          <p>При необходимости возможен выезд специалиста к заказчику для предварительного составления сметы и консультации.</p>
         
          <br />
         
          <p>Общество с ограниченной ответственностью «РезАлмазСтрой»; </p>
         
          <p> ИНН 7743872879 </p>
         
          <p> Юридический адрес: 125502, Москва, ул. Петрозаводская д.9 корп.2</p>
<br />
<br />
<h2 class="h2_bg">Схема проезда</h2>
<br />
<!--<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=McQqzydDuzHqsQhlqQ9rEz_MACieawYI&width=100%&height=379&lang=ru_RU&sourceType=constructor"></script>-->
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aa0ad67499088e22f72f1a84c8983162cce8fb73c60b597110154227e353f203e&amp;width=990&amp;height=379&amp;lang=ru_RU&amp;scroll=true"></script>
<br />
<br />
<div id="feedback">
<h2 class="h2_bg">Обратная связь</h2>
<br />
<?$APPLICATION->IncludeComponent("dev:main.feedback","",Array(
        "USE_CAPTCHA" => "N",
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "EMAIL_TO" => "info@rezalmaz.ru",
        "REQUIRED_FIELDS" => Array("NAME","EMAIL","MESSAGE"),
        "EVENT_MESSAGE_ID" => Array("7"),
        "SPAM_FIELD" => "phone_fax"
    )
);?></div>

         				</div>
       								 			</div>
     							 		</div>
   	</div>
 	 
  <div class="grey_footer"> 		 
    <div class="decor_l"></div>
   		 
    <div class="decor_r"></div>
   	</div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
