function show_default_value(el) {
	if ($(el).val() == '' || $(el).val() == $(el).data('default')) {
		$(el).val($(el).data('default'));
		$(el).css('color', '#999');
	}
}
function hide_default_value(el) {
	if ($(el).val() == $(el).data('default')) {
		$(el).val('');
		$(el).css('color', '#555');
	}
}
function init_default_values() {
	$('input[type=text], textarea').each(function() {
		if ($(this).data('default') !== undefined) {
			show_default_value(this);
			$(this).bind({
				focus: function() {hide_default_value(this)},
				blur: function() {show_default_value(this)}
			});
		}
	});
}

$(document).ready(function() {
	$('.btn-menu-mobile').click(function(){
		if ($('.top_menu, .top_menu_2').is(':hidden')){
			$(this).addClass('active');
			$('.top_menu, .top_menu_2').show();
		}else{
			$('.top_menu, .top_menu_2').hide();
			$(this).removeClass('active');
		}
	});
	
	$('.tm-menu .top_menu_2 .btn-wrap').click(function(){
		$(this).parent().children('ul').toggle();
		if (!$(this).hasClass('wrapped')){
			$(this).addClass('wrapped');
		}else{
			$(this).removeClass('wrapped');
		}
	});
	
	$('#phone_number-callback').mask("+7(999) 999-99-99");
	$('.modal-phone').mask("+7(999) 999-99-99");

	if ($('.fancy').length){
		$('.fancy').fancybox();
		console.log('FANCY');
	}
	
	var i_am_bot = true;
	
	$('.show_form').click(function() {$('.toggleSlide').slideDown()})
	
// 	$('.photo_galery .big_photo').html('<img src="'+ $('.photo_galery ul li a').attr('href') +'" alt="">');
// 	if($(".photo_galery #in").length > 0){
// 		if(document.getElementById($('.photo_galery ul li a').attr('href')) != null)
// 			document.getElementById('in').innerHTML = document.getElementById($('.photo_galery ul li a').attr('href')).innerHTML;
// 	}
// 	
// 	$('.photo_galery ul li a').click(function() {
// 		$('.photo_galery .big_photo').html('<img src="'+ $(this).attr('href') +'" alt="">');
// 		if($(".photo_galery #in").length > 0){
// 			if(document.getElementById($(this).attr('href')) != null)
// 				document.getElementById('in').innerHTML = document.getElementById($(this).attr('href')).innerHTML;
// 		}
// 
// 		return false;
// 	});
	
	$('.photo_galery li a').each(function(){
		$(this).attr('rel', 'gallery-group');
	});
	
	$('.photo_galery li a').fancybox();
	
	init_default_values();
	$('input[type=reset]').click(function() {
		$('input[type=text], textarea').each(function() {
			$(this).val('');
		});
		init_default_values();
		$('.toggleSlide').slideUp()
		return false;
	});
	
	$('#form_order input, #form_order textarea, #form_question input, #form_question textarea, #form_reviews input, #form_reviews textarea, #form_callback input, #form_callback textarea').bind({
		click: function() {i_am_bot = false},
		focus: function() {i_am_bot = false}
	});
	
	$('#form_order').submit(function() {
	
		if ($('input[name=phone_fax]', this).val() != ''){
			i_am_bot = true;
		}
	
		if (i_am_bot) return false;
		
		if ($('input[name=name]', this).val() == ''){
				$('input[name=name]', this).addClass('wrong');
			}
			else $('input[name=name]', this).removeClass('wrong');
			
		if ($('input[name=email]', this).val() == ''){
				$('input[name=email]', this).addClass('wrong');
			}
			else $('input[name=email]', this).removeClass('wrong');
			
		if ($('textarea[name=message]', this).val() == '' || $('textarea[name=message]', this).val() == $('textarea[name=message]', this).data('default')){
				$('textarea[name=message]', this).addClass('wrong');
			}
			else $('textarea[name=message]', this).removeClass('wrong');
		if ($('input[name=name]', this).val() !== '' && $('input[name=email]', this).val() !== '' && $('textarea[name=message]', this).val() !== '')
			$.ajax({
				url: '/send_order.php',
				type: 'post',
				dataType: 'json',
				data: {
					'name': $('input[name=name]', this).val(),
					'email': $('input[name=email]', this).val(),
					'message': $('textarea[name=message]', this).val()
				},
				success: function(data) {
					if (data.success == true)
						$('#form_order').html('<div style="width:90%;text-align:center;margin:0 auto;padding:10px 0;font-size:14px;">Ваша заявка принята! В ближайшее время мы свяжемся с вами для уточнения деталей.</div>')
					else
						alert(data.errors.join("\n"));
				}
			});
		
		return false;
	});

	$('#exec-callback').submit(function() {
		var oPhoneNumber = $('#phone_number-callback');
		if (oPhoneNumber.val() !== ''){
			$.ajax({
				url: '/send_callback.php',
				type: 'post',
				dataType: 'json',
				data: {
					'phone_number': oPhoneNumber.val(),
					'client_name': $('#name-callback').val(),
				},
				success: function(data) {
					if (data.success == true){
						oPhoneNumber.val('');
						$('#name-callback').val('');
						$('#form_callback').html('<p style="text-align:center;">Спасибо, мы перезвоним в<br>течении 15 минут</p>');
						$('.callback_form').delay(2000).fadeOut();
					}
					else
						alert(data.errors.join("\n"));
				}
			});
		}
		else {
			$('.order_form_2 label').eq(1).css('color', 'red');
		}
		return false;
	});
	
	$('#form_callback').submit(function() {
		if ($('input[name=phone_fax]', this).val() != ''){
			i_am_bot = true;
		}
	
		if (i_am_bot) return false;
		
		var oPhoneNumber = $('#phone_number-callback');
		if (oPhoneNumber.val() !== ''){
			$.ajax({
				url: '/send_callback.php',
				type: 'post',
				dataType: 'json',
				data: {
					'phone_number': oPhoneNumber.val(),
					'client_name': $('#name-callback').val(),
				},
				success: function(data) {
					if (data.success == true){
						oPhoneNumber.val('');
						$('#name-callback').val('');
						$('#form_callback').html('<p style="text-align:center;">Спасибо, мы перезвоним в<br>течении 15 минут</p>');
						$('.callback_form').delay(2000).fadeOut();
					}
					else
						alert(data.errors.join("\n"));
				}
			});
		}
		else {
			$('.order_form_2 label').eq(0).css('color', 'red');
		}
		return false;
	});
	
	$('#form_question').submit(function() {
		if ($('input[name=phone_fax]', this).val() != ''){
			i_am_bot = true;
		}
	
		if (i_am_bot) return false;
		
		if ($('input[name=name]', this).val() !== '' && $('input[name=email]', this).val() !== '' && $('textarea[name=message]', this).val() !== '')
			$.ajax({
				url: '/send_question.php',
				type: 'post',
				dataType: 'json',
				data: {
					'name': $('input[name=name]', this).val(),
					'email': $('input[name=email]', this).val(),
					'message': $('textarea[name=message]', this).val()
				},
				success: function(data) {
					if (data.success == true)
						$('#form_question').html('<div style="width:90%;text-align:center;margin:0 auto;padding:10px 0;font-size:14px;">Ваше сообщение успешно отправлено.</div>')
					else
						alert(data.errors.join("\n"));
				}
			});
		
		return false;
	});
	
	$('#form_reviews').submit(function() {
		if ($('input[name=phone_fax]', this).val() != ''){
			i_am_bot = true;
		}

		if (i_am_bot) return false;

		if ($('input[name=name]', this).val() !== '' && $('input[name=email]', this).val() !== '' && $('textarea[name=message]', this).val() !== '')
			$.ajax({
				url: '/send_reviews.php',
				type: 'post',
				dataType: 'json',
				data: {
					'name': $('input[name=name]', this).val(),
					'email': $('input[name=email]', this).val(),
					'message': $('textarea[name=message]', this).val()
				},
				success: function(data) {
					if (data.success == true)
						$('#form_reviews').html('<div style="width:90%;text-align:center;margin:0 auto;padding:10px 0;font-size:14px;">Ваше отзыв отправлен.</div>')
					else
						alert(data.errors.join("\n"));
				}
			});

		return false;
	});

	$('#form_order_service').submit(function() {
		if ($('input[name=name]', this).val() !== '' && $('input[name=phone]', this).val() !== '')
			$.ajax({
				url: '/send_order_modal.php',
				type: 'post',
				dataType: 'json',
				data: {
					'name': $('input[name=name]', this).val(),
					'phone': $('input[name=phone]', this).val(),
					'email': $('input[name=email]', this).val(),
					'service': $('input[name=service]', this).val(),
					'message': $('textarea[name=message]', this).val()
				},
				success: function(data) {
					if (data.success == true)
						$('#form_order_service').html('<div style="width:90%;text-align:center;margin:0 auto;padding:10px 0;font-size:14px;">Ваше отзыв отправлен.</div>')
					else
						alert(data.errors.join("\n"));
				}
			});
		return false;
	});
	
	$('.close-callback').click(function (){
		$('.callback_form').hide();
	});
	
	$('#close-callback').click(function (){
		$('.callback_form').hide();
		return false;
	});

	$('.callback_link').click(function(){
		$('.callback_form').toggle();
		return false;
	})
});
