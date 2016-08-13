<?php 
if($data->type=='guide')
{
        $guidetemple = Guidetemple::model()->findByPK($data->activity_id);
		
		$guide =  Guide::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		
			
		
		$now = time(); // or your date as well
		$your_date = strtotime($data->created);
		$datediff = $now - $your_date;
		$dates=floor($datediff/(60*60*24));

	       if($guidetemple->discount=='Yes')
			{
			$temp = $guidetemple->amount *($guidetemple->discount_percentage / 100);
			
			$amount = $guidetemple->amount - $temp;
			}
			else
			{
			$amount =  $guidetemple->amount; 
			}
			
			$amount_option =  $guide->guide_amount_option;

}
else
{
		$iyerpoojas = Iyerpoojas::model()->findByPK($data->activity_id);
		
		$iyer =  Iyer::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		
		$now = time(); // or your date as well
		$your_date = strtotime($data->created);
		$datediff = $now - $your_date;
		$dates=floor($datediff/(60*60*24));
		 
		if($data->option=='1')
		{
		$options =  "Without Pooja Items";
		$amount  = $iyerpoojas->amount_without_items;
		}
		else
		{
		$options = "With Pooja Items";
		$amount  = $iyerpoojas->amount_with_items;
		}
		
		
		if($iyerpoojas->discount=='Yes')
		{
		$temp = $amount *($iyerpoojas->discount_percentage / 100);
		
		$amount = $amount - $temp;
		}
		else
		{
		$amount =  $amount; 
		}
		
		$amount_option =  $iyer->iyer_amount_option;
}

$user_details =  User::model()->findByPK($data->from_user);


$name = $user_details->first_name.' '.$user_details->last_name; 


if($dates=='0')
  $datessym = 'Today';
else if($dates=='1')
$datessym = $dates.' '.'day ago';
else    
$datessym = $dates.' '.'days ago';

?>



<div class="rule"></div>

<div class="sc-page shadow">
        <div class="item clearfix shadow">
		<!--<img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif">-->
		
		<?php if($user_details->user_image!=''){?>
		 <div class="image"><a  class="greyscale"><img src="<?php echo Yii::app()->request->baseUrl.'/'.$user_details->user_image; ?>" class="attachment-thumbnail wp-post-image"></a></div>
		 <?php }else{ ?> 
         <div class="image"><a  class="greyscale"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/user.png" class="attachment-thumbnail wp-post-image"></a></div>
		 <?php } ?>
		 
        <div class="text">
		<?php if($data->type=='guide') {?>
        <div class="title"><h3><?php echo $guidetemple->activity_title; ?></h3></div>
		<?php }else{ ?>
		<div class="title"><h3><?php echo $iyerpoojas->pooja_name; ?></h3></div>
		<?php } ?>
		
         Requested by  : <strong><?php echo $name; ?></strong>
		<br />
		Booked Date : <strong><?php echo $data->book_date; ?></strong>
		<br />
		
		<?php if($data->type=='guide') {?>
		<?php }else{ ?>
		Booked Option : <strong><?php echo $options; ?></strong
		  ><br />
		<?php } ?>
		Booked Amount : <strong><?php echo $amount_option.' '.$amount; ?></strong>
         <br />
          <a ><?php echo $datessym; ?> </a>
		<div>
		<?php  if($data->iyer_status=='yes'){ ?>
		 <a style="background-color: #67a031; color: #fff;  font-style:bold; font-size:13px; margin-left:5px; border-radius:3px"  class="sc-button light right" >Accepted</a>
		<?php }else  if($data->iyer_status=='no') { ?>
		<a style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button light right">Rejected</a>
		<?php } else { ?>
		<a style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:13px; margin-left:5px; border-radius:3px; cursor:pointer;" onclick="chooseoption('no','<?php echo $data->id; ?>');" class="sc-button light right" >Reject</a>
		<a style="background-color: #67a031; color: #fff;  font-style:bold; font-size:13px; margin-left:5px; border-radius:3px; cursor:pointer;" onclick="chooseoption('yes','<?php echo $data->id; ?>');" class="sc-button light right" >Accept</a>
		<?php }?>
		</div>
        </div>
        </div></div>
<div class="rule"></div>

<style>
.items .item {
    background: none repeat scroll 0 0 #ffffff;
    margin-bottom: 20px;
    padding: 0;
}
</style>

<script>
function chooseoption(option,id)
{
$.ajax({
	url :'<?php echo $this->createUrl('profile/iyerupdates'); ?>',
	type : "post",
	data : "option="+option+"&id="+id,
	success:function(data)
	{
	 window.location.reload();
	} 
});
}
</script>
