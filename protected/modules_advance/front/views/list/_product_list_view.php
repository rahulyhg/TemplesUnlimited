<?php
$criteria = new CDbCriteria;
$criteria->condition='product_id=:product_id';
$criteria->params=array(':product_id'=>$data->product_id);
$Productvariations = Productvariations::model()->findAll($criteria);



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

		     $reviews = new Reviews;
			 $type = 'product';
			 $id= $data->product_id;
			 
			 $reviews = Reviews::model()->get_review_all($type,$id);
			 
			
			$avg_reviews =array();
			for($i=0;$i<count($reviews);$i++)
			{
			array_push($avg_reviews,$reviews[$i]['review_rate']);
			}
			
			 $avg = array_sum($avg_reviews)/count($reviews);
			 
			 $model1 = User::model()->findByPK(Yii::app()->user->id);
?>
<div class="sc-page">
				<div class="item clearfix" style="background-color:#fff; height:auto;padding:10px;">
				<div class="image">
				<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>">
				<img  alt="dharshan" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/listpage/'.$data->product_image; ?>"></a>
				</div>
				<div class="text">
				<div class="title">

				<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>"><?php echo $data->product_name; ?></a></h3>
				<h5 class="item-title right">Charges: Rs. <?php  echo ($data->product_price!='')?helpers::to_currency($data->product_price): helpers::to_currency($Productvariations[0]->product_price); ?></h5>
				
				</div>
				<div class="titleparagraph" >
				<p><?php  echo substr_replace(strip_tags($data->product_overview),'...',150);  ?></p>
				</div>
				</div><!-- /.text -->
				<div class="item-rating rating-grey right" style="padding-right:10px;">
				
				
				
                <div class="item-stars clearfix"> 
					<span class="star <?php if($avg>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($avg>=5){  ?>active<?php } ?> last"></span>
					<span>
					</span>
					
					</div>
					
					
	<?php  if(($model1['role']=='2') || (Yii::app()->user->isGuest)){ ?>
	<a href="javascript:void(0);" >&nbsp;<img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/addtocart.png" onclick="addtocart('<?php echo $data->product_id; ?>','<?php echo $pure_amount ; ?>','<?php echo $pure_shipping_amount ; ?>');" class="before-cart-button" style="margin-top:-10px;"/></a>&nbsp;<span class="favouritewidget<?php echo $data->product_id; ?>"><?php echo Profile::model()->favourite_widget($data->product_id); ?></span> <?php }   ?>

              </div>
				<div class="rule"></div>
				

		
				</div></div>

<style>

@media only screen and (min-width: 768px) and (max-width: 1600px) {

.titleparagraph
{
height:50px;
}
}

@media only screen  and (max-width: 480px) {

.titleparagraph
{
height:150px !important;
}
}

@media only screen  and (max-width: 720px) {

}

</style>	

<style>
.sc-page .item .image img {
    border: 1px solid #eeeeee;
    display: block;
/*    height: 130px;
    padding: 3px;
    width: 130px;*/
}
</style>

<script>
function addtocart(product_id,amount,shipping_amount)
{

    $.ajax({
              url :'<?php echo Yii::app()->request->baseUrl; ?>'+'/index.php/front/profile/addcart',
              type : "post",
              data : 'product_id='+product_id+'&amount='+amount+'&shipping_amount='+shipping_amount,
              success:function(data)
              {
			     data  = data.split('##');
			     if(data[0]=='1')
				 {
				 $('#flashmessage1').hide();
				 $('#flashmessage').show();
				  $('#login').hide();
				 setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 }
				 else
				 {
				  $('#flashmessage').hide();
				  $('#flashmessage1').show();
				   $('#login').hide();
				  setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 }
				 $('#cart_count').html("Cart ("+data[1]+")");
				 
			  } 
         });
}

   

</script>			
				
