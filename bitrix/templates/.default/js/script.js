function setCookie(c_name,value,expiredays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}


function setCookieWithPath(c_name,value,expiredays, path) {
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toUTCString())+';path='+path;
}

function getCookie(c_name) {
	if (document.cookie.length>0) {
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1) {
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) {
				c_end=document.cookie.length;
			}
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return false;
}

function closePopOwer(id_name,speed) {

	animation = false;
	
	if(!speed) speed = 300;
	$(id_name).animate({'top': '-' + $(id_name).eq(0).outerHeight() + 'px'},speed, function() { $(id_name).addClass('none'); });

}

function close_All_PopOwer() {

		if($('.popOwer').length > 0)
			{
				$(".popOwer").each(function(){
					if(!$(this).hasClass('none')) 
						{
							closePopOwer("#" + $(this).attr("id"),250);
							if($("#searchButton").hasClass('none')) $("#searchButton").removeClass('none');
						}
				});
			}
}

$(document).ready(function(){	
	/** subscription start **/
    var siteNamePrefix = "MadRobots_Main_",
        subscriptionCookieNames = {
            page_visited: 'swp',
            hide_modal: 'swh'
        };

    var showSubscriptionModal = function() {
		if (getCookie(subscriptionCookieNames.hide_modal) != 1)
		{ $("#subscribe-modal").foundation('reveal', 'open'); setCookieWithPath(subscriptionCookieNames.hide_modal, 1, null, '/'); }
    };

    var modalPageVisited = getCookie(subscriptionCookieNames.page_visited) || 1,
        subscriptionModalHidden = getCookie(subscriptionCookieNames.hide_modal) || 0;

    if (subscriptionModalHidden != 1) {
        setTimeout(function() {
            showSubscriptionModal();
        }, 20 * 1000);
        setCookieWithPath(subscriptionCookieNames.page_visited, ++modalPageVisited, null, '/');

    }
    $('#subscribe-modal').find('.close-reveal-modal').live('click', function() {
        $('#subscribe-modal').foundation('reveal', 'close');
        return false;
    });

    $('#form_callback_modal').submit(function() {
		if ($('input[name=phone_number]', this).val() !== ''){
			$.ajax({
				url: '/send_callback_modal.php',
				type: 'post',
				dataType: 'json',
				data: {
					'user_name': $('input[name=user_name]', this).val(),
					'phone_number': $('input[name=phone_number]', this).val(),
				},
				success: function(data) {
					if (data.success == true){
						$('#form_callback_modal').html('<p>Ожидайте, Вам перезвонят на указанный номер.</p>');
						$('#subscribe-modal').delay(2000).foundation('reveal', 'close');
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

});