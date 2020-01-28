<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать");
?>
	
<script type="text/javascript">
	$(document).ready(function() {
		$('.toggleSlide').show();
	});
</script>

<div class="grey_box_1 inner_info_box height_auto"> 	 
  <div class="grey_header"> 		 
    <div class="decor_l"></div>
   		 
    <div class="decor_r"></div>
   	</div>
 	 
  <div class="grey_content"> 		 
    <div class="grey_content_l"> 			 
      <div class="grey_content_r"> 				 
        <div class="inner_info_box_content_2 text_style"> 					 
          <h2 class="h2_bg" style="width:160px">Сделать заказ</h2>
<br />
<div style="width:500px">
<?$APPLICATION->IncludeFile('/form_order.php', array(), array('MODE'=>'html'))?>
</div>

       				</div>
      								 			</div>
    							 		</div>
  	</div>
	 
 <div class="grey_footer"> 		 
   <div class="decor_l"></div>
  		 
   <div class="decor_r"></div>
  	</div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>