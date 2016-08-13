<?php
			$count_content = strlen($data->content);
			if($count_content<200)
			$content=strip_tags($data->content);
			else
			$content = substr_replace(strip_tags($data->content),'...',200);
			
			
			
			 $dates = explode('-',$data->created);
			 
			 $month1 = date("F", mktime(0, 0, 0, $dates[1], 10));
			 
			 
			 $fulldate =  $month1.'&nbsp;&nbsp;'.$dates[2].',&nbsp;&nbsp;'.$dates[0];

			 
			  $category = Blogcategory::model()->findByPk($data->category);
			  
			  
			   
			   
			   
			     $criteria = new CDbCriteria();
				
				 $condition = 'review_itemtype="blog" and review_itemid="'.$data->id.'"';
				 
				 $criteria->condition =  $condition;
				 
				 $result = Reviews::model()->findAll($criteria);
?>
			
			<article id="post-7639" class="post-7639 post type-post status-publish format-standard hentry category-dress category-flowers-2 category-happiness tag-wedding-2 clearfix">		
			
			<div class="entry clearfix">
			
			<h2 class="entry-title"><a href="<?php echo CHtml::normalizeUrl(array("detail/blogdetails/id/".helpers::simple_encrypt($data->id))); ?>" title="Shiva Sahasra Linga Puja Mahotsavam" rel="bookmark"><?php echo $data->blog_name;  ?></a></h2>
			
			<div class="entry-container clearfix">
			
			<div class="right sc-column one-half" style="margin-right:0px; float:right;">
				<?php if($data->file_type=='1') { ?>
				<a href="<?php echo CHtml::normalizeUrl(array("detail/blogdetails/id/".helpers::simple_encrypt($data->id))); ?>" class="block"><img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/blogs/listpage/<?php echo $data->files;  ?>" class="block" alt="" ></a>
				<?php }else{   $url = explode('=', $data->video_url); ?>
				<a href="<?php echo CHtml::normalizeUrl(array("detail/blogdetails/id/".helpers::simple_encrypt($data->id))); ?>" class="block"><iframe width="" height="" src="//www.youtube.com/embed/<?php echo $url[1]; ?>" frameborder="0" allowfullscreen></iframe></a>
				<?php } ?> 
			</div>
			
			<div class="left entry-content loop-content sc-column sc-column-last one-half-last"><p><?php echo $content; ?></p>
			</div>
			
			</div>


<?php $name = Config::model()->findByPk('1'); ?>
			
			<div class="entry-meta clearfix left">
			<a rel="bookmark" title="<?php echo $fulldate; ?>" class="date meta-info" style="margin-left:0"><?php echo $fulldate; ?></a>
			<a rel="author" title="View all posts by admin"  class="url fn n ln author meta-info"><?php echo $name->company_name ?></a>
			<span class="categories meta-info"><a rel="category tag" title="View all posts in <?php echo $category->categoryname ?>" href="<?php echo CController::CreateUrl('/front/auto/blog',array('cat'=>$data->category)); ?>"><?php echo $category->categoryname ?></a></span>
			<span class="comments meta-info"><?php echo count($result); ?></span>
			</div>
			<div class="right" style="margin-top:10px">
			<a href="<?php echo CHtml::normalizeUrl(array("detail/blogdetails/id/".helpers::simple_encrypt($data->id))); ?>">Read More..</a>
			</div>
			</div>
			</article>
			
<style>
@media only screen and (min-width: 768px) and (max-width: 1600px) {
.block
{
/*width:310px;
height:190px;
}*/
}
</style>
