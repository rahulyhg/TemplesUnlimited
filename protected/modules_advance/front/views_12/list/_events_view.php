<?php
$Profile=Profile::model()->findByPk($data->posted_by); 

$date = explode(' ',$data->event_created);

$date_simple = explode('-',$date[0]);

$month = date('M', strtotime($date[0]));

$simple_date =  $month.'&nbsp;&nbsp;'.$date_simple[2].','.$date_simple[0];

$events_date1 = explode('-',$data->event_start_date);

$events_date2 = $events_date1[2].'-'.$events_date1[1].'-'.$events_date1[0];  

$weekday = date('l', strtotime($data->event_start_date));

$events_intimate =  $events_date2." ".$weekday.", ".$data->event_start_time; 

?>

	<div class="sc-page">
	<div class="item clearfix">
	<div class="image" style="height: 205px;">
	<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id)));  ?>">
	<img s alt="" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->baseUrl ."". $data->event_image; ?>"></a>
	</div>
	<div class="text">
	<div class="title">
	<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>"><?php echo $data->event_name; ?></a></h3>
	<p style="font-size:12px;">
	All India | Posted by <?php echo $Profile->first_name.'&nbsp;'.$Profile->last_name; ?> | Updated: <?php echo $simple_date; ?> <?php echo $date[1]; ?> IST
	<br> 
	<?php  echo $events_intimate; ?>
	</p>
	</div>
	<p><?php echo substr_replace($data->event_content ,'....' ,250); ?></p>
	<a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>" class="right"   style='color:#cb202d;'>Read More >></a>
	
	</div><!-- /.text -->
	</div>
	</div>
