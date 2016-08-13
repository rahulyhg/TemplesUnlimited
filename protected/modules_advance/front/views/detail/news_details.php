<?php
$date = explode('-',$model->news_date);

$month = date("F", mktime(0, 0, 0, $date[1], 10));

$news_date = $month." ".$date[2].",".$date[0];
?>

<div class="wrapper">
   <h3 class="epooja">News</h3>
 </div>
 <div style="padding-bottom:5px; padding-top:35px;" class="wrapper">
<h3 style="font-size:30px; text-align:left; font-weight:bold;" class="left"><?php echo $model->news_title; ?></h3>
<a style="background-color: #BFBFBF; color: #fff; font-size:13px; margin-left:5px; border-radius:3px;" class="sc-button light right" href="<?php echo CHtml::normalizeUrl(array("list/newsevents")); ?>">Back</a>
</div>
		<div role="main" id="content" style="padding-top:0px;">
			<div id="primary" style="float:left; width:65%;">

				<article id="post-5019" class="post-5019 page type-page status-publish hentry">
			<div>		
  <div class="left"><strong>Date : </strong><?php echo $news_date; ?></div>
  </div>
  <div> 
    <img src="<?php echo Yii::app()->baseUrl ."/".$model->image_name; ?>"  style="margin-top:50px; margin-left:">
    <p style="margin-top:20px; text-indent:30px; text-align:justify">
       <?php echo $model->news_content; ?>
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
			
<?php  $id = Yii::app()->session['news_id'];  	
$criteria = new CDbCriteria();
$criteria->addCondition("news_id!=$id");
$criteria->limit = 5;
$news = News::model()->findAll($criteria);
 ?>



<div role="complementary" id="secondary" style="border:1px solid #E8E8E8; margin-right:-2px; border-radius:5px 5px 0px 0px;">

<div class="" style="margin-bottom:10px;">
<h3 style="background-color:#F4F4F4; padding:10px; border-radius:5px 5px 0px 0px;">Other News</h3>
<ul class="style4 ul-style1">
<?php for($i=0;$i<count($news);$i++) {?>
<li><a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($news[$i]->news_id))); ?>"><?php  echo $news[$i]->news_title; ?></a></li>
<?php } ?>

</ul>
</div>

</div>

</div> 
