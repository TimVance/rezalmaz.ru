<div class="footer_row">
	<div class="col-2"> 
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"bottom",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "N"
	)
);?>
	</div>
	
	<div class="col-1" itemscope="" itemtype="https://schema.org/Organization">
		<div style="display:none">
			<span itemprop="name">РезАлмаз</span>
			<div itemprop="address" itemscope="" itemtype="https://schema.org/PostalAddress">Адрес: <span itemprop="postalCode">125130</span>, <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">Головинское шоссе, 10</span></div>
		</div>
		
		<p>Электронная почта: <a href="mailto:info@rezalmaz.ru"><span itemprop="email">info@rezalmaz.ru</span></a></p>

		<p><?=set_seo_link('/about/contacts/', '125438, Москва, Лихоборская набережная, д.14');?>
			<br><span class="ya-phone" itemprop="telephone">+7 (495) 792-93-92</span></p>

		<p style="margin-bottom:5px;">©2007-<?php echo date('Y'); ?> «РезАлмаз» | Все права защищены. 
		<br>
		Копирование информации запрещено.
		<br>Все цены на сайте не являются публичной офертой.</p>
		
		<p><a href="/sitemap/">Карта сайта</a></p>
		<p><a style="margin-right:5px;" href="https://www.youtube.com/channel/UC1LI9cqjWuMtKgtsyG-hqwA"><img alt="youtube" src="/images/youtube-brands-svg.png"></a>
		<a href="https://www.instagram.com/_rezalmaz_/"><img alt="instagram" src="/images/instagram-brands-svg.png"></a></p>
		
		<p> 	<?php
			global $sape;
				echo $sape->return_links(1);
			?> </p>
	</div>
</div><br>