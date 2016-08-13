<?php 
$Profile=Profile::model()->findByPk($data->posted_by); 

$config=Config::model()->findByPk('1'); 

$date = explode(' ',$data->news_date);

$date_simple = explode('-',$date[0]);

$month = date("F", mktime(0, 0, 0, $date_simple[1], 10));

$simple_date =   $month.'&nbsp;'.$date_simple[2].',&nbsp;'.$date_simple[0];


?>
<!--<div class="sc-page" style="padding-top:0px;height:230px;"  >
<div class="item clearfix" >
<div style="float:left;margin:10px; background-color:#f4f4f4;" >
<div align="center"; style="color:#cb202d;"><?php echo $simple_date; ?></div>
<div style="width:230px; height:166px; vertical-align:middle;display:table-cell;text-align:center; ">
<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>">
<img  alt="" src="<?php echo Yii::app()->baseUrl ."". $data->news_image; ?>" style="border: 3px solid #bababa;"  ></a>
</div>
</div>
<div class="text">
<div class="title">
<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>"><?php echo $data->news_title;  ?></a></h3>
<p style="font-size:13px;"> by <?php echo $config->company_name; ?></p>
</div>
<p style="max-height:100px !important;" >
<?php echo substr_replace(strip_tags($data->news_content),'...',250);  // echo strip_tags(substr_replace(preg_replace('/&(\S)+;/','',$data->news_content),'...',250));  ?>
</p>

</div>
</div>
<a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>" class="right" style="color:#cb202d; margin-top:-50px; margin-right:20px;">Read More >></a>
</div>-->

<!--<style>
.sc-page .item .image img
{
 margin-left: auto;
 margin-right: auto;
}
.item:hover
{
border-radius: 10px;
border:0.5 thin #999999;
box-shadow: 0.5px 0.5px 0.5px 0.5px #999999 !important;
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
				<div align="center" style="color:#cb202d;"><?php echo $simple_date; ?></div>
				<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>" style="width:230px; height:166px; vertical-align:middle;display:table-cell;text-align:center; ">
				<img  alt=""  src="<?php echo Yii::app()->baseUrl ."". $data->news_image; ?>" style="border: 3px solid #bababa;"></a>
				</div>
				<div class="text">
				<div class="title">
				<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>"><?php echo $data->news_title;  ?></a></h3>
				<p style="font-size:13px;">by <?php echo $config->company_name; ?></p>
				</div>
				<p><?php echo substr_replace(strip_tags($data->news_content),'...',250); ?></p>
 <a href="<?php echo CHtml::normalizeUrl(array("detail/news/id/".helpers::simple_encrypt($data->news_id))); ?>"  style='color:#cb202d;margin-right:15px;' class="right">Read more &raquo;</a>

				</div><!-- /.text -->
				</div></div>


<style>
.sc-page .item .image img {
    border: 1px solid #eeeeee;
    display: block;
    height: auto;
    padding: 3px;
    width: auto;
}
</style>


