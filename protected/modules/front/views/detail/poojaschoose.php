<?php    //echo $poojas->user_id;//  echo "<pre>";print_r($poojas); 
$criteria1 = new CDbCriteria();
		$condition1 ='';
		$condition1 .= ' `user_id` ="'.$poojas->user_id.'" ' ;
		$criteria1->condition =  $condition1;
$iyer_details = Iyer::model()->find($criteria1);


$date1 =explode('-',Yii::app()->session['choose_date']);
$month = date('F', strtotime(Yii::app()->session['choose_date']));
?>

<div style="position:relative; width:580px; height:auto;background: #FBF2D3;padding: 8px 10px 10px;border-top: 1px solid #ECD37F;border-bottom: 1px solid #ECD37F;margin-top: 10px;">
<h3 style="text-align: center;">Iyer Booking Details<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cross.png" style="float:right; cursor:pointer;"  onclick="show('<?php echo $ivalues; ?>');"/></h3>
<div class="formated-date" style="vertical-align:middle; height:30px; padding-top:12px; border-bottom:1px solid #ECD37F; border-top:1px solid #ECD37F;"><strong >Date:</strong><?php echo  $month;?> <?php echo $date1[2].'th'; ?>, <?php echo $date1[0]; ?><span style="float:right;"></span></div>


<?php $form=$this->beginWidget('CActiveForm', array(
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl('front/detail/booked_details'), 
)); ?>



<div style="width:100%; font-size:14px;">
                 <div style="height:20px;"></div>
					
					<div>
					<div style="float:left; width:30%;">
					<span>Amount</span>
					</div>
					
					<div>
					<span style="width:70%;"><span id="temp_amount_<?php echo $ivalues; ?>"><?php echo $poojas->amount_without_items; ?></span>&nbsp;<?php echo $iyer_details->iyer_amount_option; ?></span>
					</div>
					
					</div>
					
					<div style="height:20px; width:100%; float:left;"></div>
					
					
					<div>
					<div style="float:left; width:30%;">
					<span>Working Hours</span>
					</div>
					
					<div >
					<span ><?php echo $poojas->duration.' '.$poojas->duration_time_type; ?></span>
					</div>
					
					</div>
					
					<div style="height:20px;"></div>
					
					<div>
					<div style="float:left; width:30%;">
					<span>Choose your Option</span>
					</div>
					
					<div>
					<span style="width:70%;"><select name="pooja_option" id="pooja_option" style="padding:5px 5px 5px 5px;" onchange="selectpoojaoptions(this.value);"><option value="1">Without Pooja Items</option><option value="2">With Pooja Items</option></select></span>
					</div>

					</div>
					
					<div style="height:10px;"></div>
					
					<input type="hidden" name="activity_id" value="<?php echo $poojas->id; ?>" />
					<input type="hidden" name="booked_date" value="<?php echo Yii::app()->session['choose_date']; ?>" />
					<input type="hidden" name="user_id" value="<?php echo $poojas->user_id; ?>" />
					
					<?php $model=Profile::model()->findByPk(Yii::app()->user->id); ?>
					<div style="height:auto;">
					
					
					
					
					
					
					
				<?php	if(isset(Yii::app()->user->id) && Yii::app()->user->id!='') {?>
				
				<?php if($model->role!='3' && $model->role!='4') { ?>
				<input type="submit"   value="Book Now"  style=" border:2px solid #67a031;background-color: #67a031;border-radius: 3px;color: #fff;font-size: 13px;margin: 10px;width: 110px;padding:6px 6px; margin-left:75%;">
				
				<?php  } }else { ?>
				
				
		<a class="sc-button light"title="Please login to Booking Guide." href="<?php echo CController::CreateUrl('/login'); ?>"  style="border:2px solid #CB202D;background-color: #CB202D;border-radius: 3px;color: #fff;font-size: 13px;margin: 10px;width: 110px;padding:6px 6px; margin-left:75%; cursor:pointer;">Login</a>	
					<?php } ?>	
					</div>				
					
                  </div>			  
<?php $this->endWidget(); ?>
</div>

</div>
<script>

function selectpoojaoptions(value)
{
if(value=='2')
{
var with_amount ='<?php echo $poojas->amount_with_items; ?>';
$('#temp_amount_'+<?php echo $ivalues; ?>).html(with_amount);
}
else
{
var without_amount ='<?php echo $poojas->amount_without_items; ?>';
 $('#temp_amount_'+<?php echo $ivalues; ?>).html(without_amount);
 }
}

function show(ivalues)
{
$('#select_option_values_'+ivalues).css({"display":"none"}); 
$('#editfiledlink_'+ivalues).css({"display":"block"}); 
}
</script>
