<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги алмазной резки от компании «РезАлмаз»");
$APPLICATION->SetPageProperty("description", "Компания «РезАлмаз» предоставляет больший выбор услуг по алмазной резке, бурению, штроблению. Высокое качество, низкие цены.");
?>

<?$APPLICATION->IncludeFile('/includes/service-bottom-blocks.php', array(), array('MODE'=>'html'))?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
