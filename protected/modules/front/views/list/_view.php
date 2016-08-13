<?php
/* @var $this TemplesController */
/* @var $data Temples */
?>

<?php 
		$count_desc = strlen($data->temple_description);
		if($count_desc<60)
		$desc=$data->temple_description;
		else
		$desc = substr_replace(strip_tags($data->temple_description),'...',60);
		
		$count_diety = strlen($data->temple_deity);
		
		if($count_diety<18)
		$diety=$data->temple_deity;
		else
		$diety = substr_replace(strip_tags($data->temple_deity),'...',18);
		
		$count_timing = strlen($data->temple_timings);
		
		if($count_timing<18)
		$timing=$data->temple_timings;
		else
		$timing = substr_replace(strip_tags($data->temple_timings),'...',18);
		
		
		$type = 'temple';
        $id= $data->id;
 


        $reviewscount = Reviews::model()->get_average($type,$id);
?>

<li class="item clearfix administrator" id="right-border">
  <div class="item-content-wrapper clearfix left">
    <div class="item-description left">
      <h3 class="item-title "><a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>"><?php echo $data->temple_name; ?></a></h3>
      <div class="item-stars clearfix left">
		
		<span class="star <?php if($reviewscount>=1){  ?>active<?php } ?>"></span> 
		<span class="star <?php if($reviewscount>=2){  ?>active<?php } ?>"></span> 
		<span class="star <?php if($reviewscount>=3){  ?>active<?php } ?>"></span> 
		<span class="star <?php if($reviewscount>=4){  ?>active<?php } ?>"></span>
		<span class="star <?php if($reviewscount>=5){  ?>active<?php } ?> last"></span>
		<span>
 </div>
      <p>&nbsp;&nbsp;&nbsp;<strong><?php echo $data->count_review; ?></strong> Customer Reviews</p>
      <div class="left"> <a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>" style="margin-right: 19px;" class="left"><img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/main_image/<?php echo CHtml::encode($data->main_image); ?>" ></a> </div>
      <p class="item-excerpt"><?php   echo $desc;  ?></p>
      <div class="item-meta">
        <div class="item-meta-information item-address "><strong style="color: #444444;font-size: 14px;line-height: 24px;">Location:</strong> <?php echo ($data->city_id!='0')?$data->city->name:'Nil'; ?></div>
        <div class="item-meta-information item-website "><strong style="color: #444444;font-size: 14px;line-height: 24px;">Deity:</strong> <?php echo  $diety; ?></div>
        <div class="item-meta-information item-meta-information-last item-email "><strong style="color: #444444;font-size: 14px;line-height: 24px;">Timings: </strong><?php echo $timing;  ?></div>
      </div>
    </div>
  </div>
  <div class="item-rating rating-grey right"> <span class="dir-searchsubmit" id="directory-search"> <a style="background-color: #CB202D; color: #fff;  font-style:bold;border-radius:3px" class="sc-button light" href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>"><strong style="font-family: arial;font-size: 14px;line-height: 24px;">View Details</strong></a>
    </span> </div>
</li>
