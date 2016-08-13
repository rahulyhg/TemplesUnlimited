<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/script.js'></script>
<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/auto/blog'); ?>">&nbsp;Blog </a><span style="color:#c1c1c1;">  &nbsp;>>&nbsp; </span><?php echo $model->blog_name; ?></h3>
</div>
</div>
<?php


				$dates = explode('-',$model->created);
				
				$month1 = date("F", mktime(0, 0, 0, $dates[1], 10));
				
				
				$fulldate =  $month1.'&nbsp;&nbsp;'.$dates[2].',&nbsp;&nbsp;'.$dates[0];
				
				
				
				$criteria = new CDbCriteria();
				
				$condition = 'review_itemtype="blog" and review_itemid="'.$model->id.'"';
				
				$criteria->condition =  $condition;
				
				$result = Reviews::model()->findAll($criteria);
		 
?>
<div class="wrapper">
   <h3 class="epooja">Blog</h3>
 </div>
 <div style="padding-bottom:5px; padding-top:35px;" class="wrapper">
<h3 style="font-size:30px; text-align:left; font-weight:bold;" class="left"><?php echo $model->blog_name;  ?></h3>
<!--<a style="background-color: #BFBFBF; color: #fff; font-size:13px; margin-left:5px; border-radius:3px;" class="sc-button light right" href="<?php echo CController::CreateUrl('/front/auto/blog'); ?>">Back</a>-->
</div>
		<div role="main" id="content" style="padding-top:0px;">
			<div id="primary">

				<article id="post-5019" class="post-5019 page type-page status-publish hentry">
			<div>		
  <div class="left"><?php echo  $fulldate; ?></div>
  <div class="right"><a ><?php echo count($result); ?> Comments</a></div>
  </div>
  <div style="padding-top:60px;">
		<?php if($model->file_type=='1') { ?>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/blogs/<?php echo $model->files;  ?>" style=" max-height:500px;" >
		<?php }else{   $url = explode('=', $model->video_url); ?>
	    <iframe width="600" height="400" src="//www.youtube.com/embed/<?php echo $url[1]; ?>" frameborder="0" allowfullscreen   ></iframe>
		<?php } ?> 

    <p style="margin-top:20px; text-indent:30px; text-align:justify">
     <?php echo $model->content;  ?>
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
</article><!---post---->


				
				
<?php $reviewscount = Reviews::model()->get_review_all('blog',$model->id);
if(isset($reviewscount) && $reviewscount!='')
{
   $count1 =  count($reviewscount);
}
else
{
  $count1 =  "0";
}


?>
				
				
<div class="closeable">
<h3>Reviews (<?php echo  $count1; ?>)</h3>
<div class="open-button comments-opened" style="display: block; top:-30px;">Hide Reviews</div>
<div id="comments">
<ol class="commentlist" style="display: block;">
<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">
<div class="reviewlistdiv"></div>
</li>
</ol>

<?php
			 $reviews = new Reviews;
			 $reviews->review_itemtype = 'blog';
			 $reviews->review_itemid = $model->id;
			 $this->renderPartial('reviews', array('reviews'=>$reviews)); 
?>	

</div>
</div>

			</div> <!-- /#primary -->
			
<script type="text/javascript">
jQuery(function(){
      jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/blog/id/'.$model->id); ?>');

  
});
</script>


<?php 


				   $result = Blogcategory::model()->findAll();
?>

<div role="complementary" id="secondary" style="border:1px solid #E8E8E8; margin-right:-2px; border-radius:5px 5px 0px 0px;">
<div class="" >
<h3 style="background-color:#F4F4F4; padding:10px; border-radius:5px 5px 0px 0px;">Categories</h3>
<ul class="style4 ul-style" style="margin-bottom:10px;">
<?php for($i=0;$i<count($result);$i++) { ?>
<li><a href="<?php echo CController::CreateUrl('/front/auto/blog',array('cat'=>$result[$i]->id)); ?>"><?php echo $result[$i]->categoryname; ?></a></li>
<?php } ?>
</ul>
<div>
<!--<h5 style="text-align: right; padding-right:10px;"><a class="" href="">View More &raquo;</a></h5>-->
</div>
</div>

<?php 
$criteria = new CDbCriteria();

$criteria->condition = 'id<>'.$model->id.'';

$criteria->order = 'id desc';

$criteria->limit = '5';

$result1 = Blogs::model()->findAll($criteria);
?>


<div class="" style="margin-bottom:10px;">
<h3 style="background-color:#F4F4F4; padding:10px; border-radius:5px 5px 0px 0px;">Recent Posts</h3>
<ul class="style4 ul-style1">
<?php for($i=0;$i<count($result1);$i++) { ?>
<li><a href="<?php echo CHtml::normalizeUrl(array("detail/blogdetails/id/".helpers::simple_encrypt($result1[$i]->id))); ?>"><?php echo $result1[$i]->blog_name; ?></a></li>
<?php } ?>
</ul>
</div>

<?php 
$sql = "SELECT DISTINCT CONCAT( MONTHNAME( `created` ) , ' ', YEAR( `created` ) ) AS `Month` , CONCAT( MONTH( `created` ) ,'-', YEAR( `created` ) ) AS `mon_no` FROM blogs ORDER BY `created` DESC ";
$command = Yii::app()->db->createCommand($sql);
$resultsdate = $command->queryAll();
?>


<div class="" style="margin-bottom:10px;">
<h3 style="background-color:#F4F4F4; padding:10px; border-radius:5px 5px 0px 0px;">Archives</h3>
<ul class="style4 ul-style">
<?php for($i=0;$i<count($resultsdate);$i++) { ?>
<li><a href="<?php echo CController::CreateUrl('/front/auto/blog',array('month'=>$resultsdate[$i]['mon_no'])); ?>"><?php echo $resultsdate[$i]['Month']; ?></a></li>
<?php } ?>
</ul>
</div>
</div>

</div> <!-- /#content -->

<style>
/*#commentform
{
 width:110%;
}*/

.review_hide
{
display:none !important;
}
</style>
