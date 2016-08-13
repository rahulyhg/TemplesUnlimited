<?php 
    $iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
	
	 $user_basic = User::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));

     $iyer_image=  $user_basic['user_image'];
	
	
		$iyerpoojas = Iyerpoojas::model()->findAll('user_id=:user_id',array(':user_id'=>$data->user_id));
		$secondarylanguages ='';
		$lowest_price = array();
		for($i=0;$i<count($iyerpoojas);$i++)
		{
		$iyerpoojas[$i]->mantra_language = explode(',',$iyerpoojas[$i]->mantra_language); 
		$secondarylanguages .= implode(',',CHtml::listData(Languages::model()->getall_byids($iyerpoojas[$i]->mantra_language),'language_id','language_name'));
		$secondarylanguages .=',';
		array_push($lowest_price,$iyerpoojas[$i]->amount_without_items);
		}
		$mother = implode(',',CHtml::listData(Languages::model()->getall_byids($data->language),'language_id','language_name'));
		$iyer_languages = explode(',',$secondarylanguages);
		array_push($iyer_languages,$mother);
		$iyer_languages2 = array_unique($iyer_languages);
		$iyer_languages3  = array_filter($iyer_languages2);	
		$iyer_languages3 = array_reverse($iyer_languages3);
		$iyer_languages4 = implode(', ',$iyer_languages3); 
		
		$stringlang = strlen($iyer_languages4);
		
		if($stringlang>35)
		$languages = substr_replace($iyer_languages4,'...',35);
		else
		$languages = $iyer_languages4;
		

			if(count($lowest_price)>0)
			$lowest = min($lowest_price); 
			else
			$lowest = $iyermoredetails->iyer_amount;
			
			
			
			if($iyermoredetails->iyer_amount>$lowest)
			$amount =  $lowest;
			else
			$amount =  $iyermoredetails->iyer_amount;

 ?>
 
<li class="item clearfix administrator" id="right-border" >
			<div class="item-content-wrapper clearfix left">
				<div class="item-description left">
					<h3 class="item-title "><a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>"><?php echo $user_basic['gender'].'. '.$user_basic['first_name'].' '.$user_basic['last_name']; ?></a></h3>
					<div class="item-stars clearfix left">
					 <?php echo Reviews::model()->show_average_stars('iyer',$data->user_id); ?>
				</div>
				<?php  $reviewdetail = Reviews::model()->get_reviews_count('iyer',$data->user_id); ?>
				<p>&nbsp;&nbsp;&nbsp;<strong><?php echo $reviewdetail['count']; ?></strong> Customer Reviews</p>
				<div class="left">
					<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>" style="margin-right: 19px;" class="left"><?php  echo helpers::view_thumb($iyer_image); ?></a>
				</div>
				
				<?php 
				
				$overview_lentgh = strlen($iyermoredetails->iyer_overview);
				
				if($overview_lentgh<=20)
				{
				 $overview =  strip_tags($iyermoredetails->iyer_overview); 
				}
				else
				{
				$overview =   substr_replace(strip_tags($iyermoredetails->iyer_overview),'....',50); 
				}
				?>
						<p class="item-excerpt"><?php   echo $overview;  ?></p>
						<div class="item-meta">
		<div class="item-meta-information item-address left"><strong >Experience : </strong><?php echo $iyermoredetails->iyer_experience; ?>,<?php echo  $iyermoredetails->iyer_experience_type; ?></div><br/>
						
						<div class="item-meta-information item-website left"><strong>Working Hours : </strong> <?php echo  abs($iyermoredetails->iyer_wh)." Hours"; ?></div><br/>
						
						<div class="item-meta-information item-meta-information-last item-email left"><strong>Languages  : </strong><?php echo  $languages;   ?></div>
						</div>
						</div>
						</div>

			<div class="item-rating rating-grey right">
						<span class="dir-searchsubmit" id="directory-search">
				<p><strong><i>from&nbsp;</i></strong><?php  echo  $iyermoredetails->iyer_amount_option."  ".$amount; ?></h3></p>
				<a style="background-color: #CB202D; color: #fff;  font-style:bold;border-radius:3px" class="sc-button light" href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>"><strong>View Details</strong></a>
						
						</span>
			</div>

		</li>
