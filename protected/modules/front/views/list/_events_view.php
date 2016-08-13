<?php
$Profile=Profile::model()->findByPk($data->posted_by); 

if($data->event_updated =='0000-00-00 00:00:00')
{
$date = explode(' ',$data->event_created);
}
else
{
$date = explode(' ',$data->event_updated);
}

$config=Config::model()->findByPk('1'); 

$date_simple = explode('-',$date[0]);

$month = date('M', strtotime($date[0]));

$updated_time =  date("g:i a", strtotime($date[1]));

$simple_date =  $month.'&nbsp;&nbsp;'.$date_simple[2].',&nbsp;'.$date_simple[0]."&nbsp;".$updated_time."&nbsp;IST";

$events_date1 = explode('-',$data->event_start_date);

$events_date2 = $events_date1[2].'-'.$events_date1[1].'-'.$events_date1[0];  

$weekday = date('l', strtotime($data->event_start_date));

//$events_intimate =  $events_date2." ".$weekday.", ".$data->event_start_time; 


$event_date = explode('-',$data->event_start_date);

$day = date('l', strtotime($data->event_start_date)); 

$month = date("M", mktime(0, 0, 0, $event_date[1], 10));

$event_date1 = explode('-',$data->event_end_date);

$day1 = date('l', strtotime($data->event_end_date));

$month1 = date("M", mktime(0, 0, 0, $event_date1[1], 10));

$time = date("g:i a", strtotime($data->event_start_time));

$time1 = date("g:i a", strtotime($data->event_end_time));

if($day==$day1 && $month==$month1 && $event_date[2]==$event_date1[2])
$events_intimate = $day.",&nbsp;".$month."&nbsp;".$event_date[2].",&nbsp;".$event_date[0]."&nbsp;|&nbsp;".$time.'&nbsp; - &nbsp;'.$time1;  
else
$events_intimate =  $day.",&nbsp;".$month." ".$event_date[2].",&nbsp;".$event_date[0].'&nbsp; - &nbsp;'.$day1.",&nbsp;".$month1." ".$event_date1[2].",&nbsp;".$event_date[0]."&nbsp;|&nbsp;".$time.' &nbsp;-&nbsp; '.$time1; 
?>

	<!--<div class="sc-page"  style="padding-top:0px;height:230px;">
	<div class="item clearfix">
	<div style="float:left;margin:10px; background-color:#f4f4f4;" >
	<div style="width:230px; height:180px; vertical-align:middle;display:table-cell;text-align:center;">
	<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id)));  ?>">
	<img s alt=""  src="<?php echo Yii::app()->baseUrl ."". $data->event_image; ?>"  style="border: 3px solid #bababa;" ></a>
	</div>
	</div>
	<div class="text">
	<div class="title">
	<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>"><?php echo $data->event_name; ?></a></h3>
	<p style="font-size:13px;">
	 by <?php echo $config->company_name; ?> | Updated Date: <?php //echo $simple_date; ?>
	<br> 
	<?php  //echo $events_intimate; ?>
	</p>
	</div>
	<p><?php  echo substr_replace(strip_tags($data->event_content),'...',250);  //echo substr_replace(preg_replace('/&(\S)+;/','',$data->event_content),'...',250); ?></p>
	</div>
	</div>
     <a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>" class="right"   style='color:#cb202d;margin-top:-50px; margin-right:15px;'>Read More >></a>
	</div>-->
	
	<!--<style>
.sc-page .item .image img
{
margin-top:10px;
margin-left:10px;
}
.item:hover
{
border-radius: 10px;
border:0.5 thin #999999;
box-shadow: 0.5px 0.5px 0.5px 0.5px #999999 !important;
height:220px;
}
.item
{
height:230px;
}
.text
{
margin-top:10px;
}
</style>-->

<div class="sc-page" style="padding:10px;">
				<div class="item clearfix">
				<div class="image">
				<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>" style="width:230px; height:180px; vertical-align:middle;display:table-cell;text-align:center;  ">
				<img width="150" height="150" alt="" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->baseUrl ."". $data->event_image; ?>" style="border: 3px solid #bababa;" ></a>
				</div>
				
				<div class="text">
				<div class="title">
				<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>"><?php echo $data->event_name; ?></a></h3>
				<p style="font-size:12px;"> by <?php echo $config->company_name; ?> | Updated Date: <?php echo $simple_date; ?>
				<br> 
				<?php  echo $events_intimate; ?>
				</p>
				</div>
				
				<p class=""><?php  echo substr_replace(strip_tags($data->event_content),'...',250);  ?> <a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($data->event_id))); ?>" class="right"  style='color:#cb202d;margin-right:15px;'>Read More >></a></p>
				</div><!-- /.text -->
				<div class="rule"></div>
				</div>
				</div>


<style>
.sc-page .item .image img {
    border: 1px solid #eeeeee;
    display: block;
    height: auto;
    padding: 3px;
    width: auto;
}
</style>
