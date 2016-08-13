<?php
$Profile=Profile::model()->findByPk($data->posted_by); 

$date = explode(' ',$data->event_created);



$date_simple = explode('-',$date[0]);

$month = date('M', strtotime($date[0]));

$updated_time =  date("g:i a", strtotime($date[1]));

$simple_date =  $month.'&nbsp;&nbsp;'.$date_simple[2].','.$date_simple[0]."&nbsp;".$updated_time."&nbsp;IST";

$events_date1 = explode('-',$data->event_start_date);

$events_date2 = $events_date1[2].'-'.$events_date1[1].'-'.$events_date1[0];  

$weekday = date('l', strtotime($data->event_start_date));

//$events_intimate =  $events_date2." ".$weekday.", ".$data->event_start_time; 


$event_date = explode('-',$data->event_start_date);

$day = date('D', strtotime($data->event_start_date)); 

$month = date("M", mktime(0, 0, 0, $event_date[1], 10));

$event_date1 = explode('-',$data->event_end_date);

$day1 = date('D', strtotime($data->event_end_date));

$month1 = date("M", mktime(0, 0, 0, $event_date1[1], 10));

$time = date("g:i a", strtotime($data->event_start_time));

$time1 = date("g:i a", strtotime($data->event_end_time));

if($day==$day1 && $month==$month1 && $event_date[2]==$event_date1[2])
$events_intimate = $day.",".$month." ".$event_date[2].",".$event_date[0]."&nbsp;|&nbsp;".$time.' - '.$time1;  
else
$events_intimate = $day.",".$month." ".$event_date[2].",".$event_date[0].' - '.$day1.",".$month1." ".$event_date1[2].",".$event_date[0]."&nbsp;|&nbsp;".$time.' - '.$time1; 
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
	All India | Posted by <?php echo $Profile->first_name.'&nbsp;'.$Profile->last_name; ?> | Updated Date: <?php echo $simple_date; ?>
	<br> 
	<?php  echo $events_intimate; ?>
	</p>
	</div>
	<p><?php echo substr_replace(preg_replace('/&(\S)+;/','',$data->event_content),'...',250); ?></p>
	<a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>" class="right"   style='color:#cb202d;margin-top:-30px;'>Read More >></a>
	
	</div><!-- /.text -->
	</div>
	</div>
	
	<style>
.sc-page .item .image img
{
margin-top:10px;
margin-left:10px;
}
.item:hover {
    border-radius: 10px;
    box-shadow: 2px 2px 2px 2px #888888 !important;
}
.item
{
height:200px;
}
.text
{
margin-top:10px;
}

</style>
