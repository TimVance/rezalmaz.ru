<?php if(empty($MORE_NAME)){
	$sDopParam = '';
}else{
	$sDopParam = $MORE_NAME;
}?>
<div class="callback_form<?=$sDopParam?>">
<div class="grey_box_2">
	<div class="grey_header">
		<div class="decor_l">
		</div>
		<div class="decor_r">
		</div>
	</div>
	<div class="grey_content">
		<div class="grey_content_l">
			<div class="grey_content_r">
				<div class="text_style">
				<div class="close-callback"></div>
					<div class="hdr3"><span>Контактные данные</span><p class="tm">Мы перезвоним в течение 15 минут</p></div>
					<br />
					<form id="form_callback<?=$sDopParam?>" method="post" onsubmit="yaCounter7139977.reachGoal('CALLBACK'); return true;">
						<div class="order_form_2">
								<label>Ваш телефон: <span>*</span></label>
								<input type="text" id="phone_number-callback<?=$sDopParam?>" name="phone_number" data-default="" placeholder="+7(___) ___-__-__"/>

								<label>Ваше имя:</label>
								<input type="text" id="name-callback<?=$sDopParam?>" name="name" data-default=""/>
								<input type="text" class="phone_fax" name="phone_fax" value=""/>
                                <div id="g-recaptcha-form-callback<?=$sDopParam?>"></div>
                                <div class="text-danger" id="recaptchaError"></div>
                                <ul>
									<li><input type="submit" id="exec-callback<?=$sDopParam?>" class="button hide_form" value="Отправить"/></li>
									<?/*<li><input type="button" id="close-callback<?=$sDopParam?>" class="button hide_form no-back" value="Закрыть"/></li>*/?>
								</ul>
							
						</div>
					</form>
				
			</div>
		</div>
	</div>
	<div class="grey_footer">
		<div class="decor_l">
		</div>
		<div class="decor_r">
		</div>
	</div>
</div>
</div>
</div>
