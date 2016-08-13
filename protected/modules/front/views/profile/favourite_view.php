<div class="sc-page favourtitediv<?php echo $data->product_id; ?>" style="margin-bottom:0px;"><div class="item clearfix "><div class="image"><a href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>" class="greyscale">
 <?php $productimage = Storeproducts::model()->getinfo($data->product_id); 

   $productdesc = strip_tags($data->product_overview);?>
   
   <img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/'.$productimage->product_image; ?>"  alt="Product image" class="attachment-thumbnail wp-post-image" width="150" height="150" />
 <?php //echo helpers::view_thumb($productimage,array('class'=>'"attachment-thumbnail wp-post-image',"width"=>"150px","height"=>"150px")); ?>
 </a></div><div class="text"><div class="title"><h3>
 <a href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>"><?php echo  $data->product_name; ?></a>
 <a href="<?php echo CHtml::normalizeUrl(array("profile/removefavourite/id/".helpers::simple_encrypt($data->product_id))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a>
 </h3></div><p style="height:10px;"><?php echo helpers::show_desc($productdesc); ?></p><a  style="float:right; margin-right:10px;" href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($data->product_id))); ?>">View More</a></div></div></div>
<div class="rule"></div>
