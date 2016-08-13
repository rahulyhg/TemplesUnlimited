<?php 
    $data->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
  //$guideimage = Images::model()->get_image('guide',$data->user_id);
    $guideimage = $data->user_image;
	
 ?>
<li class="item clearfix administrator" id="right-border">
			<div class="item-content-wrapper clearfix left">
				
				<div class="item-description left">
					<h3 class="item-title "><a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>"><?php   echo $data->gender.'. '.$data->first_name.' '.$data->last_name;// echo $data->guidemoredetails->guide_title; ?></a>
					<?php if($data->guidemoredetails->guide_have_certificate == '1' && trim($data->guidemoredetails->guide_license) != ''){ ?>
					&nbsp;<img width="6%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/Certificate.png" alt="Certified Guide" title="Certified Guide">
					<?php } ?>
					</h3>
                                    <div class="item-stars clearfix left">
					 <?php echo Reviews::model()->show_average_stars('guide',$data->user_id); ?>
                                    </div>
  <?php  $reviewdetail = Reviews::model()->get_reviews_count('guide',$data->user_id); ?>
					
				
				<p>&nbsp;&nbsp;&nbsp;<strong><?php echo $reviewdetail['count']; ?></strong> Customer Reviews</p>
				
				
				
							
			
				<div class="left">
					<a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>" style="margin-right: 19px;" class="left"><?php echo helpers::view_thumb150($guideimage,array('height'=>'150px','width'=>'150px')); ?></a>
				</div>
				
				
					<p class="item-excerpt"><?php echo helpers::show_desc($data->guidemoredetails->guide_description); ?></p>
					<div class="item-meta">
						<div class="item-meta-information item-address left"><strong>Location:</strong> <?php echo  $data->guidemoredetails->guidecity->name; ?>,<?php echo  $data->guidemoredetails->guidestate->state_name; ?></div><br/>

						<div class="item-meta-information item-website left"><strong>Phone:</strong> <?php echo  $data->guidemoredetails->guide_phone; ?></div><br/>
						<!-- <b>Categories : </b><?php echo  implode(',',CHtml::listData(Temples::model()->getall_byids(explode(',',$data->guidemoredetails->guide_categories)),'id','temple_name')); ?>-->

						<div class="item-meta-information item-meta-information-last item-email left"><strong>Languages:</strong><?php echo  $data->languagename->language_name; ?></div>
					</div>
				</div>
			</div>

			<div class="item-rating rating-grey right">
						<span class="dir-searchsubmit" id="directory-search">
				<p><!--<strong>Price: </strong>--><i>From</i>&nbsp;<?php echo  helpers::to_currency($data->guidemoredetails->guide_amount); ?></h3></p>
				<a style="background-color: #CB202D; color: #fff;  font-style:bold;border-radius:3px" class="sc-button light" href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>"><strong>View Details</strong></a>
				<br/><!--<b>(<?php echo  $data->guidemoredetails->guide_amount_option; ?>)</b>-->
						<!--<input type="submit" value="View details" class="dir-searchsubmit" style="margin-left:5px; width:50%; font-size:14px;">-->
						
						</span>
			</div>

		</li>
		
