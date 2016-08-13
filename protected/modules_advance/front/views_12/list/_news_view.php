<?php 
$Profile=Profile::model()->findByPk($data->posted_by); 

$date = explode(' ',$data->news_created);

$date_simple = explode('-',$date[0]);

$month = date("F", mktime(0, 0, 0, $date_simple[1], 10));

$simple_date =  $month.'&nbsp;&nbsp;'.$date_simple[2].','.$date_simple[0];

?>
<div class="sc-page">
<div class="item clearfix">
<div class="image">
<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>">
<img  alt="" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->baseUrl ."". $data->news_image; ?>"></a>
</div>
<div class="text">
<div class="title">
<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>"><?php echo $data->news_title;  ?></a></h3>
<p style="font-size:12px;"> All India | Posted by <?php echo $Profile->first_name.'&nbsp;'.$Profile->last_name; ?> | Updated: <?php echo $simple_date; ?> <?php echo $date[1]; ?> IST</p>
</div>
<p><?php echo $data->news_content;  ?></p>
<a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>" class="right" style="color:#cb202d">Read more &raquo;</a>
</div><!-- /.text -->
</div>
</div>
