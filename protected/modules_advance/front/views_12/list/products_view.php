<?php
/* @var $this TemplesController */
/* @var $data Temples */
?>
  <?php 

  
  
  $productimage = Storeproducts::model()->get_image($data->product_id);
  $productdesc = strip_tags($data->product_overview);
  
  if($data->product_have_variations=='1'){ 
           $options = $data->variations;
		
		   $option_price = '';
		    $option_shipping_price = '';
		   if(count($options)){
		     $option = $options[0];
			 $option_price = helpers::to_currency($option->product_price);
		   }
}else{
      $option_price = helpers::to_currency($data->product_price);
}

  
 ?>
 	<div class="sc-column one-fourth">
		
		<?php echo helpers::view_thumb($productimage,array('alt'=>'Item thumbnail')); ?>
	
	<h5 align="center" class="producttitle"><?php echo  helpers::show_minimize($data->product_name,45); ?></h5>
	<h5 align="center"><strong><?php echo $option_price; ?></strong></h5>
	<p  class="productdesc"><?php echo helpers::show_desc($productdesc ); ?></p>
	<a style="background-color: #CB202D; border-radius:10px;" class="sc-button aligncenter left store-cart" href="<?php echo CHtml::normalizeUrl(array("detail/product/id/".helpers::simple_encrypt($data->product_id))); ?>"><span class="border"><span class="wrap"><span style="color: #ffffff;" class="title">View Details</span></span></span></a>&nbsp;<a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/addcarts.gif" class="before-cart-button"/></a>&nbsp;<span class="favouritewidget<?php echo $data->product_id; ?>"><?php echo Profile::model()->favourite_widget($data->product_id); ?></span>
	</div>
 

		