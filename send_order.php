<?php

header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


$success = false;
$errors = array();


// captcha
$recaptcha = $_POST['captcha'];
$secret='6LdcodcUAAAAAP2JHeFBUGWFxuVsQ96m0a1eu5Qh';

$url = 'https://www.google.com/recaptcha/api/siteverify';
$params = [
	'secret' => $secret,
	'response' => $recaptcha,
	'remoteip' => $_SERVER['REMOTE_ADDR']
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
if(!empty($response)) $decoded_response = json_decode($response);
$result = false;
if ($decoded_response && $decoded_response->success)
{
	$result = $decoded_response->success;
}
// captcha


$errors = $result;
if ($_SERVER['REQUEST_METHOD'] == 'POST'
	&& !empty($_POST['name'])
	&& $result
	&& !empty($_POST['email'])
	&& !empty($_POST['message'])) {
	
	if (empty($_POST['phone_fax'])){	//Проверка на заполнение антиспам поля
		if (CEvent::Send("ORDER", "s1", array(
			'ORDER_NAME' => trim($_POST['name']), 
			'ORDER_EMAIL' => trim($_POST['email']), 
			'ORDER_MASSAGE' => trim(@$_POST['message'])
		)) > 0) {
			$success = true;
		} else 
			$errors[] = 'Не удалось отправить сообщение';
	}else{
		$success = true;
	}
} else {
	if (empty($_POST['name'])) $errors[] = 'Не заполнено поле "Ваше имя"';
	if (empty($_POST['email'])) $errors[] = 'Не заполнено поле "Телефон"';
	if (empty($_POST['message'])) $errors[] = 'Не заполнено поле "Текст сообщения"';
	if (empty($_POST["captcha"]) || $result) $errors[] = 'Потвердите, что вы не робот';
}

print json_encode(array('success'=>$success, 'errors'=>$errors));

?>
