<?php

header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/sms_sender/rezalmazsmspilot.php');

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



if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['phone_number'])) {
	
		if (CEvent::Send("CALLBACK", "s1", array(
			'PHONE_NUMBER' => trim($_POST['phone_number']), 'CLIENT_NAME' => trim($_POST['client_name']), 
	)) > 0) {
		$success = true;
		$sms = new RezalmazSMSPilot();
		$sms->send($_POST['phone_number']);
	} else 
		$errors[] = 'Не удалось отправить сообщение';
} else {
	if (empty($_POST['phone_number'])) $errors[] = 'Вы не ввели номер';
    if (empty($_POST["captcha"]) || $result) $errors[] = 'Потвердите, что вы не робот';
}

print json_encode(array('success'=>$success, 'errors'=>$errors));

?>