<form id="form_reviews" method="post"> 	
<div class="order_form_2"> 		
    <div class="toggleSlide">
		<label><span>*</span> Введите свои имя и фамилию: </label> 			
		<div class="input_text_l"> 				
			<div class="input_text_r">
				<input type="text" name="name" data-default="" />
			</div>
       	</div>
     	<label><span>*</span> Контактный e-mail: </label> 			
		<div class="input_text_l"> 				
			<div class="input_text_r">
				<input type="text" name="email" data-default="" />
			</div>
       	</div>
		<input type="text" class="phone_fax" name="phone_fax" value=""/>

        <div id="g-recaptcha-form_reviews"></div>
        <div class="text-danger" id="recaptchaError"></div><br />

     	<label><span>*</span> Текст сообщения: </label>
	</div>
   		
    <div class="textarea_big"> 			
		<div class="textarea_r">
			<textarea cols="5" rows="5" name="message" class="show_form" data-default="Введите Ваше сообщение"></textarea>
		</div>
    </div>
   		
    <div class="toggleSlide"> 			
		<ul> 				
			<li><input type="reset" class="clear" value="Очистить" /></li>			
			<li><input type="submit" class="button hide_form" value="Отправить" /></li>
       	</ul>
    </div>
</div>
 </form>