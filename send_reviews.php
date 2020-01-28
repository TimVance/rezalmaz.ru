<?php

header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$success = false;
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' 
	&& !empty($_POST['name'])
	&& !empty($_POST['email'])
	&& !empty($_POST['message'])) {
	
	if (CEvent::Send("REVIEWS", "s1", array(
		'ORDER_NAME' => trim($_POST['name']), 
		'ORDER_EMAIL' => trim($_POST['email']), 
		'ORDER_MASSAGE' => trim(@$_POST['message'])
	)) > 0) {
		$success = true;
	} else 
		$errors[] = 'Не удалось отправить сообщение';
} else {
	if (empty($_POST['name'])) $errors[] = 'Не заполнено поле "Ваше имя"';
	if (empty($_POST['email'])) $errors[] = 'Не заполнено поле "E-mail"';
	if (empty($_POST['site'])) $errors[] = 'Не заполнено поле "Текст сообщения"';
}

print json_encode(array('success'=>$success, 'errors'=>$errors));

?>