<?php

header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/sms_sender/rezalmazsmspilot.php');

$success = false;
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['phone_number'])) {
	
	if (empty($_POST['phone_fax'])){	//Проверка на заполнение антиспам поля
		if (CEvent::Send("CALLBACK", "s1", array('PHONE_NUMBER' => trim($_POST['phone_number']), 'CLIENT_NAME' => trim($_POST['client_name']), /*'CLIENT_EMAIL' => trim($_POST['client_email']),*/)) > 0) {
			$success = true;
			$sms = new RezalmazSMSPilot();
			$sms->send($_POST['phone_number']);
		} else {
			$errors[] = 'Не удалось отправить сообщение';
		}
	}else{
		$success = true;
	}
} else {
	if (empty($_POST['phone_number'])) $errors[] = 'Вы не ввели номер';
}

print json_encode(array('success'=>$success, 'errors'=>$errors));

?>
