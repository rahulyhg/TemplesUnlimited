<?php
$user_details  =  User::model()->findByAttributes(array('user_id'=>$data->user_id));


$name = $user_details->first_name.' '.$user_details->last_name; 

if($data->type=='guide')
{
$guidetemple = Guidetemple::model()->findByPK($data->activity_id);

$guide =  Guide::model()->findByAttributes(array('user_id'=>$data->user_id));

 $activity = $guidetemple->activity_title;
 $amount = $guidetemple->amount;
 
 $amount_option =  $guide->guide_amount_option;
}
else
{
  $iyerpoojas = Iyerpoojas::model()->findByPK($data->activity_id);
  
  $iyer =  Iyer::model()->findByAttributes(array('user_id'=>$data->user_id));
  
   $activity = $iyerpoojas->pooja_name;
   
   
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
						
				$amount_option =  $iyer->iyer_amount_option;		
}

		$now = time(); // or your date as well
		$your_date = strtotime($data->created);
		$datediff = $now - $your_date;
		$dates=floor($datediff/(60*60*24));
		
		if($data->iyer_status=='yes')
		$status = "Accepted";
		else if($data->iyer_status=='no')
		$status = "Rejected";
		else
		$status = "In-progress";
		
		
		$expire_date  = explode('-',$data->book_date);
		
		$pre_date = $expire_date[2].'-'.$expire_date['1'].'-'.$expire_date[0];

if($dates=='0')
$datessym = 'Today';
else if($dates==1)
$datessym = $dates.' '.'day ago';
else
$datessym = $dates.' '.'days ago';
?>

<div class="sc-page shadow">
<div class="item clearfix shadow">
<!--		<img src="image/close.gif" class="right">-->

<?php if($user_details->user_image!=''){?>
<div class="image"><a  class="greyscale"><?php  echo helpers::view_userimage($user_details->user_image,'thumb'); ?></a></div>
<?php }else{ ?> 
<div class="image"><a  class="greyscale"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/user.png" ></a></div>
<?php } ?>
		 
		 

<div class="text">
<div class="title"><h3><?php  echo  $activity ; ?></h3></div>

		Requested to  : <strong><?php echo $name; ?></strong><br />
		Booked Date : <strong><?php echo $pre_date; ?></strong><br />
		Booked Amount : <strong><?php echo $amount_option.' '.$amount; ?></strong></span><br />
	    <span style="margin-left:110px;"><strong><?php echo ucfirst($data->type)."&nbsp; Status"; ?> : <?php echo $status; ?></strong></span><br/>
            <a ><?php echo $datessym; ?> </a>
		  
		  

<a href="javascript:void(0);" class="sc-button light right"  onclick="chooseoption1('<?php echo $data->id; ?>');" style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:13px; margin-left:5px; border-radius:3px">Delete</a></p>

</div><!-- /.text -->
</div></div>
<div class="rule"></div>
<style>
.items .item {
    background: none repeat scroll 0 0 #ffffff;
    margin-bottom: 20px;
    padding: 0;
}

.sc-page .item .image img {
    border: 1px solid #eeeeee;
    display: block;
    height: auto;
    padding: 3px;
    width: auto ;
}
</style>

<script>
function chooseoption1(id)
{
var r = confirm("Are you sure, you want to delete this notification?");
if (r == true) {
$.ajax({
url :'<?php echo $this->createUrl('profile/deleteusernodify'); ?>',
type : "post",
data : "id="+id,
success:function(data)
{
window.location.reload();
} 
});
}
}
</script>
