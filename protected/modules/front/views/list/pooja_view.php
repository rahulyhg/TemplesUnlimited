<?php
/* @var $this TemplesController */
/* @var $data Temples */
?>
<?php 
  $poojaimage = Images::model()->get_image('pooja',$data->pooja_id);
   $poojaimage = ( $poojaimage && count( $poojaimage))?$poojaimage->image_path:'images/index.jpeg';
  $productdesc = $data->pooja_description; 
  
  if($data->pooja_have_options=='1'){
           $options = $data->poojaoptions;
		   $option_price = '';
		    $option_shipping_price = '';
		   if(count($options)){
		   $option = $options[0];
			 $option_price = helpers::to_currency($option->option_price).'<br/>';
		   }
}else{
 $option_price = helpers::to_currency($data->pooja_price);
} 
 ?>
 
  <li class="item clearfix sc-column one-fourth administrator">
              <div class="item-thumbnail"> <a href="<?php echo CHtml::normalizeUrl(array("detail/pooja/id/".helpers::simple_encrypt($data->pooja_id))); ?>">
			  <?php echo helpers::view_thumb($poojaimage,array('alt'=>'Item thumbnail')); ?>
			  </a> </div>
              <h3 class="item-title producttitle"><a href="<?php echo CHtml::normalizeUrl(array("detail/pooja/id/".helpers::simple_encrypt($data->pooja_id))); ?>"><?php echo  helpers::show_minimize($data->pooja_name,45); ?></a></h3>
              <div class="item-address-wrapper">
                <!--<div class="item-address-pin"></div>-->
                <p class="productdesc"> <?php echo helpers::show_desc($productdesc ); ?></p>
                
                <h5 class="item-title">Charges: <?php  if($data->pooja_have_options=='1'){ ?><i>from</i>&nbsp;<?php } ?><?php echo $option_price; ?></h5>
              </div>
              
              <div class="item-rating rating-grey">
				  
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div>
              </div>
       </li>
	   
	
		
