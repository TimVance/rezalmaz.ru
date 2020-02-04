				
				<div class="footer">
					<?$APPLICATION->IncludeFile('include_areas/footer_copyright.php', array(), array('MODE'=>'html'))?>
					<?$APPLICATION->IncludeFile('include_areas/footer_counters.php', array(), array('MODE'=>'html'))?>
				</div>	

			</div>
		</div>
	</div>
	<div id="subscribe-modal" class="reveal-modal" data-reveal="">
		    <div class="grey_box_2">
						<div class="grey_content">
							<div class="grey_content_l">
								<div class="grey_content_r">
									<div class="text_style">
									<div class="close-callback"></div>
										<h3 style="padding:20px">Есть вопросы? Давайте обсудим!</h3>
										<br>
										<form id="form_callback_modal" method="post" onsubmit="yaCounter7139977.reachGoal('CALLBACK_FORM'); return true;">
											<div class="order_form_2">
													<label>Ваше имя: </label>
													<div class="input_text_l">
														<div class="input_text_r">
															<input type="text" name="user_name" data-default="" style="color: rgb(153, 153, 153);">
														</div>
													</div>
													<label><span>*</span>Ваш телефон: </label>
													<div class="input_text_l">
														<div class="input_text_r">
															<input type="text" name="phone_number" data-default="" style="color: rgb(153, 153, 153);">
														</div>
													</div>
													<ul>
														<li><input type="submit" class="button hide_form" value="Отправить"></li>
														<li><input type="button" class="button close-reveal-modal" value="Закрыть"></li>
													</ul>
												
											</div>
										</form>
									
								</div>
							</div>
						</div>
					</div>
					</div>
		            <br style="clear: left;">
		        	<a style="display:block;width: 12px;height: 12px;position: absolute;right: 12px;top: 12px;background: url(/images/close-callback.png) no-repeat;cursor: pointer;" class="close-reveal-modal"></a>
				</div>
</div>
	<div class="bg-splash"></div>

<script type="text/javascript">
    var make_redirect = false;
    var redirect_url  = "thanks.php";
    var tracker_code  = "12b8f5b6ee0493f7f3e64c076f1da585";
  </script>
  
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!-- 	<script type="text/javascript" src="/bitrix/templates/.default/js/jquery-1.7.1.min.js"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/bitrix/templates/.default/js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="/bitrix/templates/.default/js/reveal.js"></script>
	<?/*<script type="text/javascript" src="/bitrix/templates/.default/js/script.js"></script>*/?>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/../.default/js/jquery.url.min.js"></script> 
	<script type="text/javascript">
    $(document).ready(function() {
         $(':input').blur(function () {
             if($(this).val().length > 0){
                 pageTracker._trackEvent("Form: " + window.location.pathname + window.location.search, "input_exit", $(this).attr('name'));
             }
         });
     });
	</script>

<!-- BEGIN JIVOSITE CODE {literal} --><script type='text/javascript'>
(function(){ var widget_id = 'JaugVNHa5Z';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->	
	
</body>
</html>
