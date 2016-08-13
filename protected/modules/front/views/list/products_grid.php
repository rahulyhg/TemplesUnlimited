<?php
	if($data->product_have_variations=='1'){ 
	$options = $data->variations;
	
	$option_price = '';
	$option_shipping_price = '';
	
	if(count($options)){
	$option = $options[0];
	$option_price = helpers::to_currency($option->product_price);
	
	$pure_amount =  floor($option->product_price);
	$pure_shipping_amount =  floor($option->product_shipping_price);
					
	}
	}else{
	$option_price = helpers::to_currency($data->product_price);
	
	
	$pure_amount =  floor($data->product_price);
	$pure_shipping_amount =  floor($data->product_shipping_price);
					
					
	}
	
	
	$model1 = User::model()->findByPK(Yii::app()->user->id);
	
	if($index%4==0){
	echo "<div style='clear:both'></div> </div><div class='row' style='margin:0; margin-top:40px;'>";
	}
?>

 <div class="col-md-3 " style="padding:0">
	<div class="sc-column one-fourth newpage">
	
	<div class="item-thumbnail" style="width:220px; height:160px;vertical-align:middle;display:table-cell;text-align:center; background:#FFFFFF;"> 
	
	
	<img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/main_image/'.$data->product_image; ?>"  alt="Product image" class="image1" />
	</div>
	
	<h5 align="center" class="title1"><?php   echo $data->product_name;   ?> </h5>
	<h5 align="center"><strong><?php echo $option_price; ?></strong></h5>
	<p class="product_overview" style="padding:6px;"><?php echo substr_replace(strip_tags($data->product_overview),'...',40);   ?>  </p>

<?php  if( ($model1['role']=='2') || (Yii::app()->user->isGuest)){ ?>	
<a style="background-color: #CB202D; border-radius:10px; margin-left:6px;" class="sc-button aligncenter left store-cart" href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>"><span class="border"><span class="wrap"><span style="color: #ffffff;" class="title">View Details</span></span></span></a>&nbsp;

<?php } else { ?> 

<a style="background-color: #CB202D; border-radius:10px; width:80%; margin-left:10%;" class="sc-button aligncenter left store-cart" href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>"><span class="border"><span class="wrap"><span style="color: #ffffff;" class="title">View Details</span></span></span></a>&nbsp;
<?php } ?>

<?php  if(($model1['role']=='2') || (Yii::app()->user->isGuest)){ ?>

<a href="javascript:void(0);" >&nbsp;<img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/addtocart.png" onclick="addtocart('<?php echo $data->product_id; ?>','<?php echo $pure_amount ; ?>','<?php echo $pure_shipping_amount ; ?>');" class="before-cart-button" style="margin-top:-10px;" title="Add to Cart"/></a>&nbsp;<span class="favouritewidget<?php echo $data->product_id; ?>"><?php echo Profile::model()->favourite_widget($data->product_id); ?></span> <?php }   ?>
	</div>

</div>

	
	
<script>
function addtocart(product_id,amount,shipping_amount)
{

    $.ajax({
              url :'<?php echo Yii::app()->request->baseUrl; ?>'+'/index.php/front/profile/addcart',
              type : "post",
              data : 'product_id='+product_id+'&amount='+amount+'&shipping_amount='+shipping_amount+'&variations='+<?php echo $data->product_id.'-'."1"  ?>,
              success:function(data)
              {
			     data  = data.split('##');
			     if(data[0]=='1')
				 {
				 $('#flashmessage1').hide();
				 $('#flashmessage').show();
				  $('#login').hide();
				 setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 
				 $('html, body').animate({scrollTop:$('#menu-main-menu').position().top}, 'slow'); 
				 }
				 else
				 {
				  $('#flashmessage').hide();
				  $('#flashmessage1').show();
				   $('#login').hide();
				  setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				  $('html, body').animate({scrollTop:$('#menu-main-menu').position().top}, 'slow'); 
				 }
				 $('#cart_count').html("Cart ("+data[1]+")");
				 
			  } 
         });
}

   

</script>

<style>

@media only screen and (min-width: 768px) and (max-width: 1600px) {
.image1
{
/*width:220px;
height:160px;*/
margin-top:-10px;
}

.title1
{
height:60px;
padding-top:10px;
}
.maintest
{
padding-left:20px;
}
.product_overview
{
height:50px;
}
}

.newpage:hover
{
box-shadow:2px 2px 2px 2px #888888 !important;
}

.sc-button, a.button {
    display: inline-block;
    padding: 5px 13px 7px;
}

@media only screen  and (min-width: 720px)  and (max-width: 720px) {


.image1
{
width:220px;
height:160px;
margin-top:-10px;
}


.onecolumn .sc-column.one-fourth, .onecolumn .sc-column.one-fourth-last {
    width: 135px;
}

.title1
{
height:60px;
padding-top:10px;
}
.maintest
{
padding-left:20px;
}
.mainpage h5, .entry-content h5, .page-footer h5 {
    font-size: 13px;
    line-height: 1.3;
    margin: 0 0 8px;
}
}

@media only screen  and (max-width: 480px) {
table, th, td {
	width:250px;
}
</style>		  


