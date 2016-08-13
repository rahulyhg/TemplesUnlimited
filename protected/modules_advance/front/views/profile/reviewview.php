<?php 
            if($data->reviewowner->role == '2'){
                $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
				
				if(count($detailsmodel )){
					$city_fieldval =  $detailsmodel->city;
				    $state_fieldval = $detailsmodel->state;
				}
			
			
				
			}else if($data->reviewowner->role == '3'){
                $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
			
				$city_fieldval =  $detailsmodel->guidecity->name;
				$state_fieldval =  $detailsmodel->guidestate->state_name;
			}else if($data->reviewowner->role == '4'){
                $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));		
			
				$city_fieldval =  $detailsmodel->iyercity->name;
				$state_fieldval =  $detailsmodel->iyerstate->state_name;
			}	
		$review_rate = (int)$data->review_rate; 
		
		
$start_date = new DateTime($data->review_date);
$since_start =  $start_date->diff(new DateTime(date('Y-m-d H:i:s')));
//echo $since_start->days.' days total<br>';
//echo $since_start->y.' years<br>';
//echo $since_start->m.' months<br>';
//echo $since_start->d.' days<br>';
//echo $since_start->h.' hours<br>';
//echo $since_start->i.' minutes<br>';
//echo $since_start->s.' seconds<br>';

		?>
<div class="sc-page">
        <div class="">
               
                <div></div>
               
                <div class="image left"><a href="javascript:void(0);" class="greyscale"><?php echo helpers::view_userimage($data->reviewowner->user_image,'thumb',array('class'=>' reviewowerimage')); ?></a>
			<br/><a href="javascript:void(0);"><?php echo $since_start->days; ?>&nbsp;days ago</a>
				</div>
                <div class="text">
				<div class="item-stars clearfix">
				    <span class="star <?php if($review_rate>=1){  ?>active<?php } ?>"></span> 
				    <span class="star <?php if($review_rate>=2){  ?>active<?php } ?>"></span> 
					 <span class="star <?php if($review_rate>=3){  ?>active<?php } ?>"></span> 
					 <span class="star <?php if($review_rate>=4){  ?>active<?php } ?>"></span>
					 <span class="star <?php if($review_rate>=5){  ?>active<?php } ?> last"></span>
					  <span>
                    </span> </div><br>
        <div class="title"><h3><a href="javascript:void(0);"><?php echo $data->review_title; ?></a></h3></div>
         <p style="font-size:12px; ">Reviewed by <strong><?php echo $data->reviewowner->first_name.' '. $data->reviewowner->last_name; ?><?php if(count($detailsmodel )){
				  ?>&nbsp;from <?php echo $city_fieldval; ?>, <?php echo $state_fieldval; ?><?php } ?></strong>. </p>
             
       
       
       
       <div class="">
       


 
     <p> <?php echo $data->review_content; ?></p>
        

        
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