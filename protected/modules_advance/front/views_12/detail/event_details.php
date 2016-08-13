<?php
$event_date = explode('-',$model->event_start_date);
$month = date("F", mktime(0, 0, 0, $event_date[1], 10));

$event_date1 = explode('-',$model->event_end_date);

 $month1 = date("F", mktime(0, 0, 0, $event_date1[1], 10));


$simple_date =  $month." ".$event_date[2].",".$event_date[0].' - '.$month1." ".$event_date1[2]." ".$event_date[0];

?>
<div class="wrapper">
   <h3 class="epooja">Events</h3>
 </div>
 <div style="padding-bottom:5px; padding-top:35px;" class="wrapper">
<h3 style="font-size:30px; text-align:left; font-weight:bold;" class="left"><?php echo $model->event_name; ?></h3>
<a style="background-color: #BFBFBF; color: #fff; font-size:13px; margin-left:5px; border-radius:3px;" class="sc-button light right" href="<?php echo CHtml::normalizeUrl(array("list/newsevents")); ?>">Back</a>
</div>
		<div role="main" id="content" style="padding-top:0px;">
			<div id="primary" style="float:left; width:65%;">

				<article id="post-5019" class="post-5019 page type-page status-publish hentry">
			<div>		
  <div class="left"><strong>Date : </strong><?php  echo  $simple_date; ?></div>
  </div>
  <div> 
    <img src="<?php echo Yii::app()->baseUrl."".$model->image_name; ?>"  style="margin-top:20px; margin-left:">
    <p style="margin-top:20px; text-indent:30px; text-align:justify">
       <?php echo $model->event_content; ?>
    </p>
  </div>
  
  <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-523c184172cc4d8d"></script>
<!-- AddThis Button END -->
	
				</article>
				
			</div>




<div role="complementary" id="secondary" style="border:1px solid #E8E8E8; margin-right:-2px; border-radius:5px 5px 0px 0px;">

<div class="" style="margin-bottom:10px;">
<h3 style="background-color:#F4F4F4; padding:10px; border-radius:5px 5px 0px 0px;">Event Details</h3>



		<div id="RightSectionInfo">
		<p class="CalenderIcon">
		<?php  echo $simple_date; ?>               
		</p>
		</div>
		
		<div id="RightSectionInfo">
		<p class="TimeIcon"> <?php echo $model->event_start_time.' - '.$model->event_end_time; ?> </p>
		</div>
		
		
		<div id="RightSectionInfo">
		<p class="AddressIcon">
		<?php echo $model->event_address; ?>
		</p>
		</div>
		
		<div id="RightSectionInfo">
		<p class="AddressIcon">
		Get Directions
		</p>
		</div>
		
		
		<div id="RightSectionInfo">
		<p class="ContactNoIcon"><?php echo $model->phone_no; ?></p>
		</div>
		
		
		<div id="RightSectionInfo">
		<p class="HostIcon">
		<?php echo $model->email_id; ?>               
		</p>
		</div>
		
		<div id="RightSectionInfo">
		<p class="" style="padding: 0 0 10px 0;border-bottom: 1px solid #cecece;margin-top: -25px; margin-left:20px;">
		<b style="color:#df3c19;">Views:</b>&nbsp;<?php echo $model->views; ?>
		</p>
		</div>

		</div>
		</div>
		
		
<?php  $id = Yii::app()->session['event_id'];  	
$criteria = new CDbCriteria();
$criteria->addCondition("event_id!=$id");
$criteria->limit = 5;
$events = Events::model()->findAll($criteria);
 ?>

<div role="complementary" id="secondary" style="border:1px solid #E8E8E8; margin-right:-2px; border-radius:5px 5px 0px 0px; margin-top:20px;">

<div class="" style="margin-bottom:10px;">
<h3 style="background-color:#F4F4F4; padding:10px; border-radius:5px 5px 0px 0px;">Other Events</h3>
<ul class="style4 ul-style1">

<?php for($i=0;$i<count($events);$i++) {?>
<li><a href="<?php echo CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($events[$i]->event_id))); ?>"><?php  echo $events[$i]->event_name; ?></a></li>
<?php } ?>

</ul>
</div>

</div>

</div> 

<style>

#RightSectionInfo {
    margin-bottom: 5px;
    padding: 5px 0;
    width: 93%;
}
.CalenderIcon {
    background: url("<?php echo Yii::app()->baseUrl ?>/images/calender-icon.png") no-repeat scroll left top rgba(0, 0, 0, 0);
    padding: 0 0 10px 30px;
	border-bottom: 1px solid #cecece;
	margin-left:20px;
	
}
.TimeIcon {
    background: url("<?php echo Yii::app()->baseUrl ?>/images/time-icon.png") no-repeat scroll left top rgba(0, 0, 0, 0);
    padding: 0 0 10px 30px;
	border-bottom: 1px solid #cecece;
	margin-left:20px;
	margin-top: -25px;
}
.AddressIcon {
    background: url("<?php echo Yii::app()->baseUrl ?>/images/address-icon.png") no-repeat scroll left top rgba(0, 0, 0, 0);
    padding: 0 0 10px 30px;
	border-bottom: 1px solid #cecece;
	margin-left:20px;
	margin-top: -25px;
}
.ContactNoIcon {
    background: url("<?php echo Yii::app()->baseUrl ?>/images/telephone-icon.png") no-repeat scroll left top rgba(0, 0, 0, 0);
    padding: 0 0 10px 30px;
	border-bottom: 1px solid #cecece;
	margin-left:20px;
	margin-top: -25px;
}
.HostIcon {
    background: url("<?php echo Yii::app()->baseUrl ?>/images/contact-icon.png") no-repeat scroll left top rgba(0, 0, 0, 0);
    padding: 0 0 10px 30px;
	border-bottom: 1px solid #cecece;
	margin-left:20px;
	margin-top: -25px;
}

</style>