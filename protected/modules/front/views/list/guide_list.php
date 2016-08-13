<?php 
				$guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
				
				$user_basic = User::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
				
				$guide_image=  $data->user_image;
				
				$guideactivities = Guidetemple::model()->findAll('user_id=:user_id',array(':user_id'=>$data->user_id));
				$secondarylanguages ='';
				$lowest_amount = array(); 
				for($i=0;$i<count($guideactivities);$i++)
				{
				$guideactivities[$i]->activity_language = explode(',',$guideactivities[$i]->activity_language); 
				$secondarylanguages .= implode(',',CHtml::listData(Languages::model()->getall_byids($guideactivities[$i]->activity_language),'language_id','language_name'));
				$secondarylanguages .=',';
				array_push($lowest_amount,$guideactivities[$i]->amount);
				}
				$mother = implode(',',CHtml::listData(Languages::model()->getall_byids($data->language),'language_id','language_name'));
				$guide_languages = explode(',',$secondarylanguages);
				array_push($guide_languages,$mother);
				$guide_languages2 = array_unique($guide_languages);
				$guide_languages3  = array_filter($guide_languages2);	
				$guide_languages3 = array_reverse($guide_languages3);
				$guide_languages4 = implode(', ',$guide_languages3); 
				
				$stringlang = strlen($guide_languages4);
				
				if($stringlang>18)
				$languages = substr_replace($guide_languages4,'...',18);
				else
				$languages = $guide_languages4;
				
				
				$overview_lentgh = strlen($guidemoredetails->guide_overview);
				
				if($overview_lentgh<=20)
				$overview =  strip_tags($guidemoredetails->guide_overview); 
				else
				$overview =   substr_replace(strip_tags($guidemoredetails->guide_overview),'....',50); 
				
				
				$reviews = new Reviews;
				$type = 'guide';
				$id= $data->user_id;
				$reviews = Reviews::model()->get_average($type,$id);
				$reviewscount = Reviews::model()->get_review_all($type,$id);
				if(isset($reviewscount) && $reviewscount!='')
				$count1 =  count($reviewscount);
				else
				$count1 =  "0";

                if(count($lowest_amount)>0)
				$lowest = min($lowest_amount); 
				else
				$lowest = $guidemoredetails->guide_amount;
				
				
				
				if($guidemoredetails->guide_amount>$lowest)
				$amount =  $lowest;
				else
				$amount =  $guidemoredetails->guide_amount;
		?>
		
		<li class="item clearfix administrator" id="right-border">
		<div class="item-content-wrapper clearfix left">
		
		<div class="item-description left">
		<h3 class="item-title "><a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>"><?php echo $user_basic['gender'].'. '.$user_basic['first_name'].' '.$user_basic['last_name']; ?> </a> <?php if($guidemoredetails->guide_have_certificate=='Yes') { ?><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/Certificate.png" width="6%"> <?php } ?></h3>
		
		<div class="item-stars clearfix left"> 
					<span class="star <?php if($reviews>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($reviews>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($reviews>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($reviews>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($reviews>=5){  ?>active<?php } ?> last"></span>
					<span>
					</span>
					</div>
		
		<p>&nbsp;&nbsp;&nbsp;<strong><?php echo $count1; ?></strong> Customer Reviews</p>
		
		<div class="left">
		
		<a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>" style="margin-right: 19px;" class="left"><?php  echo helpers::view_thumb150($guide_image); ?></a>
		</div>
		
		
		<p class="item-excerpt"><?php   echo $overview;  ?>.</p>
		<div class="item-meta">
		<div class="item-meta-information item-address left"><strong>Experience:</strong><?php echo $guidemoredetails->guide_experience; ?>,<?php echo  $guidemoredetails->guide_experiencetype; ?></div>
		
		<div class="item-meta-information item-website left"><strong>Working Hours:</strong><?php echo  abs($guidemoredetails->guide_wh)." Hours"; ?></div>
		
		<div class="item-meta-information item-meta-information-last item-email left"><strong>Languages:</strong><?php echo  $languages;   ?></div>
		</div>
		</div>
		</div>
		
		<div class="item-rating rating-grey right">
		<span class="dir-searchsubmit" id="directory-search">
		<p><strong>Price: </strong><?php  echo  $guidemoredetails->guide_amount_option."   ".$amount; ?></p>
		<a style="background-color: #CB202D; color: #fff;  font-style:bold;border-radius:3px" class="sc-button light" href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>"><strong>View Details</strong></a>
		
		
		</span>
		</div>
		
		</li>
