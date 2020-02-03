<?php

header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$success = false;
$errors = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['phone'])) {
    if (CEvent::Send("ORDER_SERVICE", "s1", array(
            'ORDER_NAME' => trim($_POST['name']),
            'ORDER_PHONE' => trim($_POST['phone']),
            'ORDER_EMAIL' => trim($_POST['email']),
            'ORDER_SERVICE' => trim($_POST['service']),
            'ORDER_MESSAGE' => trim($_POST['message'])
        )) > 0) {
        $success = true;
    } else
        $errors[] = 'Не удалось отправить сообщение';
} else {
    if (empty($_POST['name'])) $errors[] = 'Не заполнено поле "Ваше имя"';
    if (empty($_POST['phone'])) $errors[] = 'Не заполнено поле "Телефон"';
}

print json_encode(array('success'=>$success, 'errors'=>$errors));

?>
