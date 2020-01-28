<?php

header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/sms_sender/rezalmazsmspilot.php');

$success = false;
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' 
	&& !empty($_POST['phone_number'])) {
	
	if (CEvent::Send("CALLBACK_MODAL", "s1", array('PHONE_NUMBER' => trim($_POST['phone_number']), 'USER_NAME' => trim($_POST['user_name']))) > 0) {
		$success = true;
		$sms = new RezalmazSMSPilot();
		$sms->send($_POST['user_name'].": ".$_POST['phone_number']);
	} else 
		$errors[] = 'Не удалось отправить сообщение';
} else {
	if (empty($_POST['phone_number'])) $errors[] = 'Вы не ввели номер';
}

print json_encode(array('success'=>$success, 'errors'=>$errors));

?>