<?/*<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">*/?>
<!DOCTYPE html>
<html lang="ru" xmlns="https://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
	<?$APPLICATION->ShowHead()?> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?$APPLICATION->ShowTitle()?></title>

	<meta name="yandex-verification" content="e220077cc35e015c" />
	<meta property="og:title" content="Алмазная резка, бурение и штробление в Москве и Подмосковье – Резалмаз" />
	<meta property="og:url" content="https://www.rezalmaz.ru/" />
	<meta property="og:image" content="https://www.rezalmaz.ru/images/logo.png" />
	<meta property="og:description" content="Услуги строительно-ремонтных работ с использованием технологии алмазной резки, бурения и штробления." />
	<meta property="og:locale" content="ru_RU" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render=explicit" async defer></script>
	<!--[if IE]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/../.default/ie.css" type="text/css" /><![endif]-->
	<!--[if IE 6]>
		<script src="<?=SITE_DIR?>js/DD_belatedPNG.js"></script>
		<script>
			DD_belatedPNG.fix('img, div, span');
		</script>
		<style type="text/css">
			.page_position {width:expression(document.documentElement.clientWidth > 1091 ? "1091px" : "auto");}
			body {width:expression(document.documentElement.clientWidth < 985 ? "985px" : "auto");}
	   </style>
	<![endif]-->
	<?/*<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />*/?>
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta name='yandex-verification' content='47538c605b353b1b' />
<?if($_SERVER['REQUEST_URI']=='/services/'){?>
<meta name="robots" content="noindex, nofollow">
<?}else{?>
<meta name="robots" content="noyaca"/>
<?}?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125633195-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125633195-1');
</script>
<script charset="UTF-8" src="//cdn.sendpulse.com/js/push/03918e2409f54566aed463b324e77260_1.js" async></script>
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<div class="page_decor">
	<div class="page_position">
		<div class="page_inner_decor_l">
			<div class="page_inner_decor_r">
				<div class="header<? if ($APPLICATION->GetCurDir() != '/'): ?> inner<?endif?>"<? if (defined("ERROR_404")) { echo ' style="min-height:150px;"'; } ?>>
					<?$APPLICATION->IncludeFile('/form_callback.php', array(), array('MODE'=>'html'))?> 
					<? if (!defined("ERROR_404")) { ?>
						<?if ($APPLICATION->GetCurDir() == '/' && false) {?>
						<div class="column_1">
							<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include_areas/header_logo_and_phones.php', array(), array('MODE'=>'php'))?>
						</div>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "2",
							"CHILD_MENU_TYPE" => "top_sub",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
							false
						);?>
						<? }else{?>
						
						
						
						<div class="column_1">
							<? if ($APPLICATION->GetCurDir() == '/'): ?>	<img src="/images/logo.png" alt="Алмазное сверление и резка" /><? else: ?><a href="/"><img src="/images/logo.png" alt="Алмазное сверление и резка" /></a><? endif ?>
							<span class="slogan">Успешно работаем с 2005 г.</span>
						</div>
						<div class="column_2">
							<div class="callback"><a class="callback_link" href="#callback">Заказать звонок</a></div>
						</div>
						<div class="column_3">
							<div class="phones"> <a class="a-phone" href="tel:+74957929392"><span class="ya-phone">+7 (495) 792-93-92</span></a></div>
							<div class="worktime">Ежедневно с 09:00 до 22:00<br /> Москва, Головинское шоссе, д. 10</div>
                            <div class="header-social">
                                <a style="margin-right:5px;" href="https://www.youtube.com/channel/UC1LI9cqjWuMtKgtsyG-hqwA"><img src="/images/youtube-brands-svg.png" alt="youtube"/></a>
                                <a href="https://www.instagram.com/_rezalmaz_/"><img src="/images/instagram-brands-svg.png" alt="instagram"/></a>
                            </div>
                        </div>
						<div class="clear"></div>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "top_2", array(
							"ROOT_MENU_TYPE" => "top_2",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "top_sub_2",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
							false
						);?>
						<div class="clear"></div>
						
						
						<? } ?>
					<? }else{ ?>
						<div class="column_1">
							<a href="/"><img src="/images/logo.png" alt="Алмазное сверление и резка"></a>
							<span class="slogan">Успешно работаем с 2005 г.</span>
						</div>
					<? } ?>
				</div>
				
<div class="breadcrumbs">
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
		"START_FROM" => "1",
		"PATH" => "", 
		"SITE_ID" => "s1"
		)
	);?>
</div>
