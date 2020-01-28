<?php if(empty($MORE_NAME)){
	$sDopParam = '';
}else{
	$sDopParam = $MORE_NAME;
}?>
<div class="callback_form<?=$sDopParam?> calc-form">
	<div class="text_style">
		<div class="close-callback"></div>
		<div class="hdr3"><span>Мы перезвоним</span><p class="tm">в течение 15 минут</p></div>
		<form id="form_callback<?=$sDopParam?>" method="post" onsubmit="yaCounter7139977.reachGoal('CALLBACK'); return true;">
			<div class="order_form_2">
				<label>Ваше имя:</label>
				<input type="text" id="name-callback<?=$sDopParam?>" name="name" data-default="" />
				
				<label>Ваш телефон: <span>*</span></label>
				<input type="text" id="phone_number-callback<?=$sDopParam?>" name="phone_number" data-default="" placeholder="+7(___) ___-__-__" />
				<input type="text" class="phone_fax" name="phone_fax" value=""/>
				
				<?/*<label>Ваш email: <span>*</span></label>
				<input type="text" id="email-callback<?=$sDopParam?>" name="email" data-default="" /> */?>
			
				<ul>
					<li><input type="submit" id="exec-callback<?=$sDopParam?>" class="button hide_form" value="Отправить"/></li>
					<?/*<li><input type="button" id="close-callback<?=$sDopParam?>" class="button hide_form no-back" value="Закрыть"/></li>*/?>
				</ul>
				
			</div>
		</form>
	</div>
</div>
