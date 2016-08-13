<?php 
if($data->reviewowner->role == '2'){
                $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
				if(count($detailsmodel )){
				
						if($detailsmodel->city!='0')
						$city_fieldval =     $detailsmodel->usercity->name; 
						else
						$city_fieldval =     "";
						
						
						if($detailsmodel->state!='0')
						$state_fieldval = $detailsmodel->userstate->state_name; 
						else
						$state_fieldval =     "";
				}
			
			
				
			}else if($data->reviewowner->role == '3'){
                $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
			
					if($detailsmodel->guide_city!='0')
					$city_fieldval =  $detailsmodel->guidecity->name;
					else
					$city_fieldval =  "";
				
					if($detailsmodel->guide_state!='0')
					$state_fieldval =  $detailsmodel->guidestate->state_name;
					else
					$state_fieldval =  "";
				
				
			}else if($data->reviewowner->role == '4'){
                $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));		
			
			    if($detailsmodel->iyer_city!='0')
				$city_fieldval =  $detailsmodel->iyercity->name;
				else
				$city_fieldval = "";
				
				
				if($detailsmodel->iyer_state!='0')
				$state_fieldval =  $detailsmodel->iyerstate->state_name;
				else
				$state_fieldval = "";
			}	
			$review_rate = (int)$data->review_rate;
			
			if($city_fieldval!='' || $state_fieldval)
			{
			$from =  "from " ;
			}
			else
			{
			$from ="";
			}
			  
			  
			 
			 $user_image = User::model()->getinfo($data->reviewowner->user_id);
			  



?>
<div class="reviewlistrow">
					<?php echo helpers::view_userimage($user_image->user_image,'thumb',array('class'=>'left reviewowerimage','style'=>'width:85px;height:85px;')); ?>
                    <p style="color:#000;"><strong><?php echo $data->review_title; ?></strong></p>
					<div class="item-stars clearfix">
				    <span class="star <?php if($review_rate>=1){  ?>active<?php } ?>"></span> 
				    <span class="star <?php if($review_rate>=2){  ?>active<?php } ?>"></span> 
					 <span class="star <?php if($review_rate>=3){  ?>active<?php } ?>"></span> 
					 <span class="star <?php if($review_rate>=4){  ?>active<?php } ?>"></span>
					 <span class="star <?php if($review_rate>=5){  ?>active<?php } ?> last"></span>
					  <span>
                    </span> </div><br>
                  <p style="font-size:12px; ">Reviewed by <strong><?php echo $data->reviewowner->first_name.' '. $data->reviewowner->last_name; ?>&nbsp;<?php if(count($detailsmodel )){
				  ?><?php echo $from; ?><?php echo (isset($city_fieldval) && $city_fieldval!='')?"&nbsp;".$city_fieldval.", ":""; ?><?php echo  (isset($state_fieldval) && $state_fieldval!='')?$state_fieldval.".":""; ?><?php } ?></strong></p>
				  
                   <div id="old_<?php echo $data->review_id; ?>"><?php echo  substr_replace($data->review_content,"...",100); ?><?php if(strlen($data->review_content)>100){ ?><a href="javascript:void(0);" onclick="shownewone('<?php echo $data->review_id; ?>','old');">More..</a> <?php } ?></div>
				   
				   <div style="display:none" id="new_<?php echo $data->review_id; ?>"><?php echo  $data->review_content; ?><a href="javascript:void(0);" onclick="shownewone('<?php echo $data->review_id; ?>','new');">  Less..</a></div>

				  <p><span class="right reviewlikeunlikewidget<?php echo $data->review_id; ?>">
				  <?php echo Reviews::model()->like_unlike_widget( $data->review_id); ?>
                    </span></p>
		  
		        <div class="rule"></div>
</div>



<script>
function shownewone(value,require)
{
  if(require=='old')
  {
    $('#old_'+value).css( "display", "none" );
	$('#new_'+value).css( "display", "block" );
  }
  else
  {
    $('#new_'+value).css( "display", "none" );
	$('#old_'+value).css( "display", "block" );
  }
}
</script>




