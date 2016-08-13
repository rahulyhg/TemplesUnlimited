<?php
/* @var $this TemplesController */
/* @var $data Temples */
?>
  <?php 
    $data->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
    $iyer_image=  $data->user_image;
 ?>
<li class="item clearfix administrator" id="right-border">
			<div class="item-content-wrapper clearfix left">
				<div class="item-description left">
					<h3 class="item-title "><a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>"><?php echo $data->gender.'. '.$data->first_name.' '.$data->last_name; ?></a></h3>
					<div class="item-stars clearfix left">
					 <?php echo Reviews::model()->show_average_stars('iyer',$data->user_id); ?>
				</div>
				<?php  $reviewdetail = Reviews::model()->get_reviews_count('iyer',$data->user_id); ?>
				<p>&nbsp;&nbsp;&nbsp;<strong><?php echo $reviewdetail['count']; ?></strong> Customer Reviews</p>
				<div class="left">
					<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>" style="margin-right: 19px;" class="left"><?php echo helpers::view_thumb($iyer_image); ?></a>
				</div>
				
				
					<p class="item-excerpt"><?php   echo substr_replace(strip_tags( helpers::show_desc($data->iyermoredetails->iyer_description)),' ',50);   ?></p>
					<div class="item-meta">
						<div class="item-meta-information item-address left"><strong >Experience : </strong> <?php echo $data->iyermoredetails->iyer_experience; ?>,<?php echo  $data->iyermoredetails->	iyer_experience_type; ?></div><br/>

						<div class="item-meta-information item-website left"><strong>Working Hours : </strong> <?php echo  abs($data->iyermoredetails->iyer_wh)." Hours"; ?></div><br/>

						<div class="item-meta-information item-meta-information-last item-email left"><strong>Languages  : </strong><?php echo  $data->languagename->language_name; ?></div>
					</div>
				</div>
			</div>

			<div class="item-rating rating-grey right">
						<span class="dir-searchsubmit" id="directory-search">
				<p><strong><i>from&nbsp;</i></strong><?php echo  $data->iyermoredetails->iyer_amount_option."  ".$data->iyermoredetails->iyer_amount; ?></h3></p>
				<a style="background-color: #CB202D; color: #fff;  font-style:bold;border-radius:3px" class="sc-button light" href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>"><strong>View Details</strong></a>
						<!--<input type="submit" value="View details" class="dir-searchsubmit" style="margin-left:5px; width:50%; font-size:14px;">-->
						
						</span>
			</div>

		</li>		
