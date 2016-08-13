<?php 

               if($data->reviewowner->role == '2'){
                $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
  
				if(count($detailsmodel )){
					$city_fieldval =    $detailsmodel->usercity->name; 
				        $state_fieldval = $detailsmodel->userstate->state_name;
					$owner_name = $data->reviewowner->first_name.' '. $data->reviewowner->last_name;
					$conjection = '&nbsp;for&nbsp;';
               }    }     
		else if($data->reviewowner->role == '3'){
                $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
			
				$city_fieldval =  $detailsmodel->guidecity->name;
				$state_fieldval =  $detailsmodel->guidestate->state_name;
				$owner_name = $data->reviewowner->first_name.' '. $data->reviewowner->last_name;
				$conjection = '&nbsp;by&nbsp;';
			}else if($data->reviewowner->role == '4'){
                $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));		
				$city_fieldval =  $detailsmodel->iyercity->name;
				$state_fieldval =  $detailsmodel->iyerstate->state_name;
				$owner_name = $data->reviewowner->first_name.' '. $data->reviewowner->last_name;
				$conjection = '&nbsp;by&nbsp;';
			}	
		$review_rate = (int)$data->review_rate; 

if($city_fieldval!='0' || $state_fieldval!='0')
$from =  "&nbsp;from " ;
else
$from ="";

		
$start_date = new DateTime($data->review_date);
$since_start =  $start_date->diff(new DateTime(date('Y-m-d H:i:s')));


if($since_start->days=='0')
$days_to = "Today";
else if($since_start->days=='1') 
$days_to = $since_start->days .""."&nbsp;day ago";
else
$days_to = $since_start->days .""."&nbsp;days ago";

?>
<div class="sc-page">
        <div class="">
               
                <div></div>
               
                <div class="image left"><a  class="greyscale"><?php echo helpers::view_userimage($data->reviewowner->user_image,'thumb',array('class'=>' reviewowerimage','style'=>'width:84px;height:84px;')); ?></a>
			<br/><a href="javascript:void(0);"><?php echo $days_to; ?></a>
				</div>
				
				 <div class="title"><h3><a ><?php echo $data->review_title; ?></a></h3></div>
                <div class="text">
				<div class="item-stars clearfix">
				    <span class="star <?php if($review_rate>=1){  ?>active<?php } ?>"></span> 
				    <span class="star <?php if($review_rate>=2){  ?>active<?php } ?>"></span> 
					 <span class="star <?php if($review_rate>=3){  ?>active<?php } ?>"></span> 
					 <span class="star <?php if($review_rate>=4){  ?>active<?php } ?>"></span>
					 <span class="star <?php if($review_rate>=5){  ?>active<?php } ?> last"></span>
					  <span>
                    </span> </div><br>
       
                    <p style="font-size:12px; ">Reviewed by  <strong><?php echo $owner_name;  ?></strong>
		 
			 <?php if(count($detailsmodel )){  ?><?php echo $from; ?><strong><?php echo (isset($city_fieldval) && $city_fieldval!='0')?"&nbsp;".$city_fieldval.", ":""; ?><?php echo  (isset($state_fieldval) && $state_fieldval!='0')?$state_fieldval.".":""; ?></strong><?php } ?>

				  </p>
             
       
       
       
       <div class="">
       


 
     <p> <div class="comment more"><?php echo $data->review_content; ?></div></p>
        

        
<div class="clearing"></div>
<p><span class="right reviewlikeunlikewidget<?php echo $data->review_id; ?>">
				  <?php echo Reviews::model()->like_unlike_widget( $data->review_id); ?>
 </span></p>
  </div>
 
  
     
        </div><!-- /.text -->
        </div></div>
  <!-- <hr style="border:1px solid #f2f2f2;">     -->
<!-------->
<div class="rule"></div>


