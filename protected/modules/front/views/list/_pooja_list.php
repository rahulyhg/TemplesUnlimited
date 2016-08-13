<?php
$criteria = new CDbCriteria;
$criteria->condition='pooja_id=:pooja_id';
$criteria->params=array(':pooja_id'=>$data->pooja_id);
$Poojaoptions = Poojaoptions::model()->findAll($criteria);




		     $reviews = new Reviews;
			 $type = 'pooja';
			 $id= $data->pooja_id;
			 
			 $reviews = Reviews::model()->get_review_all($type,$id);
			 
			
			$avg_reviews =array();
			for($i=0;$i<count($reviews);$i++)
			{
			array_push($avg_reviews,$reviews[$i]['review_rate']);
			}
			
			 $avg = array_sum($avg_reviews)/count($reviews);
			 
			 
			 if($data->pooja_price!='')
{
$amount = $data->pooja_price;
}
else
{
$amount = (isset($Poojaoptions[0]->option_price)?$Poojaoptions[0]->option_price:'');
}



?>

			<div class="sc-page">
				<div class="item clearfix" style="background: none repeat scroll 0 0 #ffffff; height:auto; padding:10px;">
				<div class="image">
				<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/poojaold/id/".helpers::simple_encrypt($data->pooja_id))); ?>">
				<img alt="dharshan" class="attachment-thumbnail" src="<?php echo Yii::app()->request->baseUrl.'/uploads/pooja/listpage/'.$data->pooja_image; ?>"></a>
				</div>
				<div class="text">
				<div class="title">
				<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/poojaold/id/".helpers::simple_encrypt($data->pooja_id))); ?>"><b><?php  echo $data->pooja_name;?></b></a></h3>
				<h5 class="item-title right"><b>Charges: Rs.&nbsp;<?php  echo $amount; ?></b></h5>
				</div>
				<p><?php  echo substr_replace(strip_tags($data->pooja_overview),'...',200); ?></p>

				</div><!-- /.text -->
				
				<div style="clear:both"></div>
				
				<div class="item-rating rating-grey right" style="padding-right:10px;">				
					<div class="item-stars clearfix"> 
					<span class="star <?php if($avg>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($avg>=5){  ?>active<?php } ?> last"></span>
					<span>
					</span>
					
					</div>
              </div>
				<div class="rule"></div>
				</div>
				</div>

<style>
.sc-page .item .image img {
    border: 1px solid #eeeeee;
    display: block;

}
</style>
			
		  
			
			
