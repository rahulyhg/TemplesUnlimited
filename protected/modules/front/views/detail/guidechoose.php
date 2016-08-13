<?php    //echo $poojas->user_id;//  echo "<pre>";print_r($poojas); 
$criteria1 = new CDbCriteria();
		$condition1 ='';
		$condition1 .= ' `user_id` ="'.$guidetemple->user_id.'" ' ;
		$criteria1->condition =  $condition1;
$guide_details = Guide::model()->find($criteria1);


$date1 = explode('-',Yii::app()->session['choose_date']);
$month = date('F', strtotime(Yii::app()->session['choose_date']));
?>

<div style="position:relative; width:580px; height:auto;background: #FBF2D3;padding: 8px 10px 10px;border-top: 1px solid #ECD37F;border-bottom: 1px solid #ECD37F;margin-top: 10px;">
<h3 style="text-align: center;">Guide Booking Details<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cross.png" style="float:right; cursor:pointer;"  onclick="show('<?php echo $ivalues; ?>');"/></h3>
<div class="formated-date" style="vertical-align:middle; height:30px; padding-top:12px; border-bottom:1px solid #ECD37F; border-top:1px solid #ECD37F;"><strong >Date:</strong><?php echo  $month;?> <?php echo $date1[2].'th'; ?>, <?php echo $date1[0]; ?><span style="float:right;"></span></div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl('front/detail/booked_details'), 
)); ?>

<?php
	        if($guidetemple->discount=='Yes')
			{
			$temp = $guidetemple->amount *($guidetemple->discount_percentage / 100);
			
			$cuttent_amount = $guidetemple->amount - $temp;
			}
			else
			{
			$cuttent_amount =  $guidetemple->amount; 
			}

?>

<div style="width:100%; font-size:14px;">
                 <div style="height:20px;"></div>
					
					<div>
					<div style="float:left; width:30%;">
					<span>Amount</span>
					</div>
					
					<div>
					<span style="width:70%;"><span id="temp_amount_<?php echo $ivalues; ?>"><?php echo $cuttent_amount; ?></span>&nbsp;<?php echo $guide_details->guide_amount_option; ?></span>
					</div>
					
					</div>
					
					<div style="height:20px; width:100%; float:left;"></div>
					
					
					<div>
					<div style="float:left; width:30%;">
					<span>Working Hours</span>
					</div>
					
					<div >
					<span ><?php echo $guidetemple->activity_duration.' '.$guidetemple->duration_time_type; ?></span>
					</div>
					
					</div>
					
					<div style="height:20px;"></div>
					
					<input type="hidden" name="activity_id" value="<?php echo $guidetemple->activity_id; ?>" />
					<input type="hidden" name="booked_date" value="<?php echo Yii::app()->session['choose_date']; ?>" />
					<input type="hidden" name="user_id" value="<?php echo $guidetemple->user_id; ?>" />
					<input type="hidden" name="type" value="guide" />
					
						<?php $model=Profile::model()->findByPk(Yii::app()->user->id); ?>
					<div style="height:auto;">
					
					<?php	if(isset(Yii::app()->user->id) && Yii::app()->user->id!='' ) {?>
					
					<?php if($model->role!='3' && $model->role!='4') { ?>
					
				<input type="submit"   value="Book Now"  style=" border:2px solid #67a031;background-color: #67a031;border-radius: 3px;color: #fff;font-size: 13px;margin: 10px;width: 110px;padding:6px 6px; margin-left:75%;">	<?php } ?>
				<?php }else { ?>
				
				
		<a class="sc-button light"title="Please login to Booking Guide." href="<?php echo CController::CreateUrl('/login'); ?>"  style="border:2px solid #CB202D;background-color: #CB202D;border-radius: 3px;color: #fff;font-size: 13px;margin: 10px;width: 110px;padding:6px 6px; margin-left:75%; cursor:pointer;">Login</a>	
					<?php } ?>	
					
					
			
					</div>				
					
                  </div>			  
<?php $this->endWidget(); ?>
</div>

</div>

<script>
function show(values)
{
$('#select_option_values_'+values).css({"display":"none"}); 
$('#editfiledlink_'+values).css({"display":"block"}); 
}
</script>
