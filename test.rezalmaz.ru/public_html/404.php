<?
CHTTP::SetStatus('404 Not Found');
@define('ERROR_404', 'Y');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Ошибка 404");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Ошибка 404");
?> 

<div class="e404">
	<h1>Ошибка 404</h1>
	
	<p>Запрашиваемая страница не найдена или находится на стадии заполнения.</p>
	<p>Перейдите на <a href="/">главную</a> или <a href="mailto:info@rezalmaz.ru">напишите нам</a>.</p>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>