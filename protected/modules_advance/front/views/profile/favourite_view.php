" class="greyscale">
 <?php $productimage = Storeproducts::model()->get_image($data->product_id); 
   $productdesc = strip_tags($data->product_overview);?>
 <?php echo helpers::view_thumb($productimage,array('class'=>'"attachment-thumbnail wp-post-image',"width"=>"150px","height"=>"150px")); ?>
 </a></div><div class="text"><div class="title"><h3>
 <a href="<?php echo CHtml::normalizeUrl(array("detail/product/id/".helpers::simple_encrypt($data->product_id)."/test/1")); ?>"><?php echo  $data->product_name; ?></a>
 <a href="<?php echo CHtml::normalizeUrl(array("profile/removefavourite/id/".helpers::simple_encrypt($data->product_id))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a>
 </h3></div><p><?php echo helpers::show_desc($productdesc); ?><a href="<?php echo CHtml::normalizeUrl(array("detail/product/id/".helpers::simple_encrypt($data->product_id))); ?>">View More</a></p></div><!-- /.text --></div></div>
<div class="rule"></div>
