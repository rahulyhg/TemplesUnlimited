<?php 
if($index%3==0){
 echo "<div style='clear:both'></div> </div><div class='row' style='margin-top:10px;'>";
}
?>
<?php 
    $data->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
    $iyer_image=  $data->user_image;
	
	
		$iyerpoojas = Iyerpoojas::model()->findAll('user_id=:user_id',array(':user_id'=>$data->user_id));
		$secondarylanguages ='';
		$lowest_price1 = array();
		for($i=0;$i<count($iyerpoojas);$i++)
		{
		$iyerpoojas[$i]->mantra_language = explode(',',$iyerpoojas[$i]->mantra_language); 
		$secondarylanguages .= implode(',',CHtml::listData(Languages::model()->getall_byids($iyerpoojas[$i]->mantra_language),'language_id','language_name'));
		$secondarylanguages .=',';
		array_push($lowest_price1,$iyerpoojas[$i]->amount_without_items);
		}
		$mother = implode(',',CHtml::listData(Languages::model()->getall_byids($data->language),'language_id','language_name'));
		$iyer_languages = explode(',',$secondarylanguages);
		array_push($iyer_languages,$mother);
		$iyer_languages2 = array_unique($iyer_languages);
		$iyer_languages3  = array_filter($iyer_languages2);	
		$iyer_languages3 = array_reverse($iyer_languages3);
		$iyer_languages4 = implode(', ',$iyer_languages3); 
		
		$stringlang = strlen($iyer_languages4);
		
		if($stringlang>18)
		$languages = substr_replace($iyer_languages4,'...',18);
		else
		$languages = $iyer_languages4;

	$dates = explode('/',$iyer_image);
	
			if(count($lowest_price1)>0)
			$lowest2 = min($lowest_price1); 
			else
			$lowest2 =  $data->iyermoredetails ->iyer_amount;
			
			
			
			if( $data->iyermoredetails ->iyer_amount>$lowest2)
			$amount3 =  $lowest2;
			else
			$amount3 =   $data->iyermoredetails ->iyer_amount;
			
?>
 <div class="col-md-4" style="padding:0">

 <div class="sc-column one-fourth newpage" >
 
 <?php if($iyer_image==''){ ?>
 
 <img src="<?php echo Yii::app()->request->baseUrl.'/image/user.png' ?>"  alt="Iyer image"  style="border-radius:2px;"  class="image" width="210" height="160" align="middle";/>
 <?php }else{ ?>
 
		<img src="<?php echo Yii::app()->request->baseUrl.'/uploads/users/useriyer/'.$dates[2]; ?>"  alt="Iyer image"  style="border-radius:2px;"  class="image" />
	<?php } ?>
	
	<h5 align="center" class="title1"><?php echo $data->gender.'. '.$data->first_name.' '.$data->last_name; ?></h5>
	
	<h5 align="center" class="price"> <strong>Rs. <?php echo $data->iyermoredetails->iyer_amount_option."  ".$amount3; ?></strong></h5>
	
	<p><strong>Experience : </strong><?php echo $data->iyermoredetails->iyer_experience; ?>,<?php echo  $data->iyermoredetails->iyer_experience_type; ?><br /><strong>Working Hours : </strong><?php echo  abs($data->iyermoredetails->iyer_wh)." Hours"; ?><br /><strong>Languages : </strong><?php echo  $languages; ?></p>
	
	<div class="center">

	<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>" class="sc-button aligncenter store-cart" style="background-color: #CB202D; border-radius:10px;" > <span class="border"><span class="wrap"><span class="title" style="color: #ffffff; text-align:center" >View Details</span></span></span></a>
	</div>
</div>
</div>


<style>
.newpage:hover
{
box-shadow:2px 2px 2px 2px #888888 !important;
}
.image
{
 margin-top:-10px;
}

.center {
    margin-left: auto;
    margin-right: auto;
	width:80%;
	font-size:15px;
	font-weight:bold;
}



@media only screen and (min-width: 768px) and (max-width: 1600px) 
{
.title1
{
height:50px;
padding-top:10px;
}

.image
{
/*height:160px;
width:220px;*/
}
}

</style>




