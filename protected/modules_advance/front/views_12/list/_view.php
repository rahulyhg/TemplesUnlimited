<?php
/* @var $this TemplesController */
/* @var $data Temples */
?>

<li class="item clearfix administrator" id="right-border">
  <div class="item-content-wrapper clearfix left">
    <div class="item-description left">
      <h3 class="item-title "><a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>"><?php echo $data->temple_name; ?></a></h3>
      <div class="item-stars clearfix left"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div>
      <p>&nbsp;&nbsp;&nbsp;<strong>3</strong> Customer Reviews</p>
      <div class="left"> <a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>" style="margin-right: 19px;" class="left"><img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/<?php echo CHtml::encode($data->main_image); ?>" height="150px" width="150px"></a> </div>
      <p class="item-excerpt"><?php echo (strlen($data->temple_description)>250)?substr($data->temple_description,0,250).'...':$data->temple_description; ?></p>
      <div class="item-meta">
        <div class="item-meta-information item-address "><strong>Location:</strong> <?php echo $data->city->name; ?></div>
        <div class="item-meta-information item-website "><strong>Deity:</strong> <?php echo $data->temple_deity; ?></div>
        <div class="item-meta-information item-meta-information-last item-email "><strong>Timings: </strong><?php echo $data->temple_timings; ?></div>
       <!-- <div class="alignleft">4:00 PM - 9:30 PM</div>-->
      </div>
    </div>
  </div>
  <div class="item-rating rating-grey right"> <span class="dir-searchsubmit" id="directory-search"> <a style="background-color: #CB202D; color: #fff;  font-style:bold;border-radius:3px" class="sc-button light" href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>"><strong>View Details</strong></a>
    <!--<input type="submit" value="View details" class="dir-searchsubmit" style="margin-left:5px; width:50%; font-size:14px;">-->
    </span> </div>
</li>
