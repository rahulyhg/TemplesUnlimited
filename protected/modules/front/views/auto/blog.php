<div class="wrapper"  style="margin-top:30px;">
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/auto/blog'); ?>">&nbsp;Blog </a></h3>
</div>

<div class="wrapper">
   <h3 class="epooja">Blog</h3>
 </div>
		<div role="main" id="content">
			<div id="primary">

<article class="post-5019 page type-page status-publish hentry" id="post-5019">

	<?php
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'emptyText' => "We're sorry, no blog found.",
				'itemView'=>'_blogview',
				'template'=>'{items}{pager}',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
					
</article><!-- /#post -->	
</div> <!-- /#primary -->


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
<!--<h5 style="text-align: right; padding-right:10px;"><a class="" href="">View More &raquo;</a></h6>-->
</div>
</div>
<?php 
                   $criteria = new CDbCriteria();
				   
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

</div>
<style>
.list-view-loading {
    background-position: bottom left  !important;
}
</style>
