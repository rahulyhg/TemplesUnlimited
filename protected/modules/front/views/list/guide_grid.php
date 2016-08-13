<?php 
if($index%3==0){
 echo "<div style='clear:both'></div> </div><div class='row' style='margin-top:10px;'>";
}

$guidermoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));

$guide_image=  $data->user_image;

$guideactivities = Guidetemple::model()->findAll('user_id=:user_id',array(':user_id'=>$data->user_id));
$secondarylanguages ='';
$lowest_amount1 = array(); 
for($i=0;$i<count($guideactivities);$i++)
{
$guideactivities[$i]->activity_language = explode(',',$guideactivities[$i]->activity_language); 
$secondarylanguages .= implode(',',CHtml::listData(Languages::model()->getall_byids($guideactivities[$i]->activity_language),'language_id','language_name'));
$secondarylanguages .=',';
array_push($lowest_amount1,$guideactivities[$i]->amount);
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
$languages = substr_replace($guide_languages4,'...',15);
else
$languages = $guide_languages4;

$dates = explode('/',$guide_image);




if(count($lowest_amount1)>0)
$lowest1 = min($lowest_amount1); 
else
$lowest1 = $guidermoredetails->guide_amount;




if($guidermoredetails->guide_amount>$lowest1)
$amount2 =  $lowest1;
else
$amount2 =  $guidermoredetails->guide_amount;


?>
 <div class="col-md-4" style="padding:0">

 <div class="sc-column one-fourth newpage" >
 
 <?php if($guide_image==''){ ?>
 
 <img src="<?php echo Yii::app()->request->baseUrl.'/image/user.png' ?>"  alt="Guide image"  style="border-radius:2px;"  class="image" width="210" height="160" align="middle";/>
 <?php }else{ ?>
	<img src="<?php echo Yii::app()->request->baseUrl.'/uploads/users/userdispaly/'.$dates[2]; ?>"  alt="Guide image"  style="border-radius:2px;"  class="image" />
	<?php } ?>
	
	<h5 align="center" class="title1"><?php echo $data->gender.'. '.$data->first_name.' '.$data->last_name; ?></h5>
	
	<h5 align="center" class="price"> <strong><?php  echo $guidermoredetails->guide_amount_option."  ".$amount2; ?></strong></h5>
	
	<p><strong>Experience : </strong><?php echo $guidermoredetails->guide_experience; ?>,<?php echo  $guidermoredetails->guide_experiencetype; ?><br /><strong>Working Hours : </strong><?php echo  abs($guidermoredetails->guide_wh)." Hours"; ?><br /><strong>Languages : </strong><?php echo  $languages; ?></p>
	
	<div class="center">

	<a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($data->user_id))); ?>" class="sc-button aligncenter store-cart" style="background-color: #CB202D; border-radius:10px;" > <span class="border"><span class="wrap"><span class="title" style="color: #ffffff; text-align:center" >View Details</span></span></span></a>
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
height:160px;
width:220px;
}
}

</style>




