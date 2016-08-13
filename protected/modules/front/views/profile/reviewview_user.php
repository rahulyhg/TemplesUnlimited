<?php 
$detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$data->reviewowner->user_id));
				
if(count($detailsmodel)){
        $city_fieldval =    $detailsmodel->usercity->name; 
    $state_fieldval = $detailsmodel->userstate->state_name;
        $owner_name = $data->review_itemtype;
        $conjection = '&nbsp;for&nbsp;';
}
$review_rate = (int)$data->review_rate; 
		
		
$start_date = new DateTime($data->review_date);
$since_start =  $start_date->diff(new DateTime(date('Y-m-d H:i:s')));


if($city_fieldval!='0' || $state_fieldval!='0')
$from =  "&nbsp;from " ;
else
$from ="";


if($since_start->days=='0')
$days_to = "Today";
else if($since_start->days=='1') 
$days_to = $since_start->days .""."&nbsp;day ago";
else
$days_to = $since_start->days .""."&nbsp;days ago";

$image_url1 =  $image_url ='';

if($data->review_itemtype=='temple')
{
  $detailsmodel =  Temples::model()->findByPK($data->review_itemid);
  $name = $detailsmodel->temple_name;
  $image_url = Yii::app()->request->baseUrl.'/temple_images/review/'.$detailsmodel->main_image;
}
else if($data->review_itemtype=='pooja')
{
  $detailsmodel =  Pooja::model()->findByPK($data->review_itemid);
  $name = $detailsmodel->pooja_name;
  $image_url = Yii::app()->request->baseUrl.'/uploads/pooja/listpage/'.$detailsmodel->pooja_image;
}
else if($data->review_itemtype=='product')
{
  $detailsmodel =  Storeproducts::model()->findByPK($data->review_itemid);
  $name = $detailsmodel->product_name;
  $image_url = Yii::app()->request->baseUrl.'/uploads/store/listpage/'.$detailsmodel->product_image;    
}
else if($data->review_itemtype=='blog')
{
   $detailsmodel =  Blogs::model()->findByPK($data->review_itemid);
   $name = $detailsmodel->blog_name;

     if($detailsmodel->file_type=='1') 
     {
     $image_url = Yii::app()->request->baseUrl.'/uploads/blogs/listpage/'.$detailsmodel->files;
     }else{
     $image_url = helpers::view_userimage($detailsmodel->files,'thumb');
     }                                    
}
else if($data->review_itemtype=='iyer')
{ 
   $detailsmodel =  User::model()->findByPK($data->review_itemid);
   $name = $detailsmodel->first_name.' '.$detailsmodel->last_name;
   $image_url1 =  helpers::view_userimage($detailsmodel->user_image,'thumb',array('class'=>'reviewowerimage','style'=>'width:84px;height:84px;'));
}
else if($data->review_itemtype=='guide')
{
   $detailsmodel =  User::model()->findByPK($data->review_itemid);
   $name = $detailsmodel->first_name.' '.$detailsmodel->last_name;
   $image_url1 =  helpers::view_userimage($detailsmodel->user_image,'thumb',array('class'=>'reviewowerimage','style'=>'width:84px;height:84px;'));   
}
else 
{
    
}

?>
<div class="sc-page">
        <div class="">
               
                <div></div>
               
                <?php if(isset($image_url1) && $image_url1!='') { ?>
                <div class="image left"><a  class="greyscale"><?php echo $image_url1; ?></a>
                <?php }else{ ?>
                <div class="image left"><a  class="greyscale"><img  src="<?php echo $image_url; ?>" class="reviewowerimage" style="width:84px; height: 84px;" ></a>  
                <?php }?>
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
       
                    <p style="font-size:12px; "> Reviewed for <strong><?php echo $name;  ?></strong></p>

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


