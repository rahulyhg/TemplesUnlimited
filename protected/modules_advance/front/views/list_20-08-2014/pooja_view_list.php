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

	   
	   
	   <div class="sc-page">
				<div class="item clearfix">
				<div class="image">
				<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("front/detail/pooja/id/".helpers::simple_encrypt($data->pooja_id))); ?>">
				<img width="150" height="150" alt="dharshan" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $poojaimage; ?>"></a>
				</div>
				<div class="text">
				<div class="title">

				<h3><a href="<?php echo CHtml::normalizeUrl(array("front/detail/pooja/id/".helpers::simple_encrypt($data->pooja_id))); ?>"><?php echo  helpers::show_minimize($data->pooja_name,45); ?></a></h3>
				<h5 class="item-title right">Charges:   <?php  if($data->pooja_have_options=='1'){ ?><i>from</i>&nbsp;<?php } ?><?php echo $option_price; ?></h5>
				
				</div>
				<p> <?php echo $productdesc ; ?></p>
				</div><!-- /.text -->
				<div class="item-rating rating-grey right" style="padding-right:10px;">
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div>
              </div>
				<div class="rule"></div>
				</div></div>
	   
	
		