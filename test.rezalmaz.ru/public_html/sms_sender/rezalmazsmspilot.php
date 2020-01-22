<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
include($_SERVER['DOCUMENT_ROOT'].'/sms_sender/smspilot.class.php');


class RezalmazSMSPilot extends SMSPilot
// Использование:
// $sms = new RezalmazSMSPilot();
// echo $sms->send('+7 111 222 33');

// придёт смска "На Rezalmaz.ru оставлена заявка на обратный звонок. Номер +7 111 222 33.""

{
	public function __construct() 
    { 
        $r_key='K97LT54J76YN781G654VW73Z6UJ1A087OZ12EG0QV3UJMZSUWINANF532P1WJ9NJ';
		$r_charset='UTF-8';
		$r_from='rezalmaz';

        parent::__construct($r_key, $r_charset, $r_from); 

        $this->to='+7 903 778 08 80';
        $this->email_for_errors='opter@bk.ru';

        $this->sms_template='На Rezalmaz.ru оставлена заявка на обратный звонок. Номер %s.';
        
    }

    public function send( $client_number ) {
    	
    	$text=sprintf($this->sms_template,$client_number);

    	if (parent::send($this->to,$text)){
			if ((int) $this->balance < 100) {
				bxmail($this->email_for_errors,'Низкий баланс smspilot для rezalmaz.ru', 'Осталось отправок: '.$this->balance);
			}
		} else {
			bxmail($this->email_for_errors,'Смска не отправилась', 'Не удалось отправить смс на номер "'.$this->to.'" с текстом "'.$this->from.'"\nОшибка: '.$this->error);
		}
  	}
}




?>