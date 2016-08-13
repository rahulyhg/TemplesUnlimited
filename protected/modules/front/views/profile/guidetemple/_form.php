<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */

$guide_profile_dtails = Guide::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));	


$availability_dates = explode(',',$guide_profile_dtails->availability_dates);
$availability = array();


for($i=0;$i<count($availability_dates);$i++)
					{
					if($availability_dates[$i]>=date('Y-m-d'))
					  array_push($availability,$availability_dates[$i]);
					}
				    $dates = '';
					
					for($i=0;$i<count($availability);$i++)
					{
					 $date = explode('-',$availability[$i]);
					 $date[1] =(int)$date[1];
					 $date[2] =(int)$date[2];  
					 $dates .=  '"'.$date[2].'-'.$date[1].'-'.$date[0].'"'.',';
					}	
?>
<h1 style="margin-left:10px; margin-top:10px;" >Create Guide Activity</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iyerpoojas-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	 'htmlOptions' => array('style' => 'float:left; margin-left: 5%; width:90%'),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($guideactivities,'category_id'); ?>
	    <?php echo $form->dropDownList($guideactivities,'category_id',CHtml::listData(Guidecategories::model()->findAll(),'category_name','category_name'),array('prompt'=> 'Select category','class'=>'select_box'));	 ?>
		<?php echo $form->error($guideactivities,'category_id'); ?>
	</div>
	
<div style="clear:both; height:10px;" ></div>

	<div class="row">
		<?php echo $form->labelEx($guideactivities,'activity_title'); ?>
		<?php echo $form->textField($guideactivities,'activity_title',array('class'=>'input_box')); ?>
		<?php echo $form->error($guideactivities,'activity_title'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
		<?php echo $form->labelEx($guideactivities,'activity_description'); ?>
		 <?php  echo $form->textArea($guideactivities,'activity_description',array('maxlength'=>250,'class'=>'input_box','style'=>'max-width:50%;min-width:50%;'));  ?>
		<?php echo $form->error($guideactivities,'activity_description'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	

	
	<?php $guideactivities->activity_language = explode(',',$guideactivities->activity_language); 	 ?>
	

	
		<div class="row">
		<?php echo $form->labelEx($guideactivities,'activity_language',array('style'=>'vertical-align:top;')); ?>
		<?php  echo $form->dropDownList($guideactivities,'activity_language',CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array('multiple' =>'multiple','class'=>'select_box')); ?>
		<?php echo $form->error($guideactivities,'activity_language'); ?>
	</div>

	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
		<?php echo $form->labelEx($guideactivities,'activity_duration'); ?>
		<?php echo $form->textField($guideactivities,'activity_duration',array('class'=>'input_box','style'=>"width:30%;"))."  ".$form->dropDownList($guideactivities, 'duration_time_type',array('Mins'=>'Mins','Hours'=>'Hours','Days'=>'Days') , array('class'=>'select_box','style'=>"width:18%;")); ?>
		<?php echo $form->error($guideactivities,'activity_duration'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	<div class="row">
		<?php echo $form->labelEx($guideactivities,'amount'); ?>
		<?php echo $form->textField($guideactivities,'amount',array('class'=>'input_box')); ?>
		<?php echo $form->error($guideactivities,'amount'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>

	<div class="row">
		<?php echo $form->labelEx($guideactivities,'discount'); ?>
	<?php echo $form->dropDownList($guideactivities,'discount',array('Yes'=>'Yes','No'=>'No'),array('class'=>'select_box','prompt'=> 'Select Discount','onchange'=>'javascript:onChangediscount(this.value);')); ?>
		<?php echo $form->error($guideactivities,'discount'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	<div id="discount_details" style="display:none;">
	

	<div class="row">
		<?php echo $form->labelEx($guideactivities,'discount_percentage'); ?>
		<?php echo $form->dropDownList($guideactivities,'discount_percentage',array('10'=>'10%','20'=>'20%','30'=>'30%','40'=>'40%','50'=>'50%','60'=>'60%','70'=>'70%','80'=>'80%','90'=>'90%','100'=>'100%',),array('prompt'=> 'Select Percentage','class'=>'select_box')); ?>
		<div style="clear:both; height:10px; margin-left:32.5%; color:#ff0000;" id="discount_percentage_error" ></div>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	
		<div class="row">
		<?php echo $form->labelEx($guideactivities,'discount_dates_from'); ?>
		<?php echo $form->textField($guideactivities,'discount_dates_from',array('class'=>'input_box','style'=>"width:23%;",'placeholder'=>'Discount From','readonly'=>'readonly'))."&nbsp;&nbsp;to".$form->textField($guideactivities,'discount_dates_to', array('class'=>'input_box','style'=>"width:23%;",'placeholder'=>'Discount To')); ?>
		<div style="clear:both; height:10px; margin-left:32.5%; color:#ff0000;  " id="discount_dates_from_new" ></div>
	</div>
	
		
		
		
  </div>		
		
	<div style="clear:both; height:30px;" ></div>

	<div style="float:left; margin-left:32%;">
		<?php echo CHtml::submitButton($guideactivities->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-danger','onclick'=>'return submitformvalues();')); ?>
		<button class="btn  btn-large" onclick="window.location.href ='<?php echo CController::CreateUrl('profile/guidetemple'); ?>'" type="button"  style="margin-left:10px;">Cancel</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



<script>
function dsfdsfdsfdsf()
{
 $('#1234').show();
 $('#discount_dates_error').hide();
}
function onChangediscount(value)
{
  if(value=='Yes')
  {
  $('#discount_details').show();
  } 
  else
  {
    $('#discount_details').hide();
  }
}

var Guideactivities_discount =  $('#Guidetemple_discount').val();
if(Guideactivities_discount=='Yes')
$('#discount_details').show();
else
$('#discount_details').hide();
</script>
<script type="text/javascript">
function submitformvalues()
{
var Iyerpoojas_submit =  $('#Guidetemple_discount').val();

if(Iyerpoojas_submit=='Yes')
{
  var Guideactivities_discount_percentage = $('#Guidetemple_discount_percentage').val();
  var Guideactivities_discount_dates_from = $('#Guidetemple_discount_dates_from').val();
  var Guideactivities_discount_dates_to = $('#Guidetemple_discount_dates_to').val();

  if(Guideactivities_discount_percentage=='')
  {
  $('#discount_percentage_error').html('Select Discount Percentage');  
   return false;
  }
  
  if((Guideactivities_discount_dates_from=='') || (Guideactivities_discount_dates_to==''))
  {
   $('#discount_percentage_error').hide();
   $('#discount_dates_from_new').html('Select Discount Dates');  
   return false;
  }
  else
  {
    $('#discount_dates_from_new').html('');  
  }
}
else
{
return true;
}
}
 function onlyNumbers(event) {
        var charCode = (event.which) ? event.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
        return true;
}

$(function() {
jQuery("#Guidetemple_discount_dates_from").datepicker({
  beforeShowDay: available,
  changeMonth : true,
  changeYear : true,
  dateFormat: 'yy-mm-dd',	
  onSelect: function(selected) {
          $("#Guidetemple_discount_dates_to").datepicker("option","minDate", selected)
        }
 });

jQuery("#Guidetemple_discount_dates_to").datepicker({
  beforeShowDay: available,
  changeMonth : true,
  changeYear : true,
  dateFormat: 'yy-mm-dd',	
   onSelect: function(selected) {
           $("#Guidetemple_discount_dates_from").datepicker("option","maxDate", selected)
        }
  });   
});
  
  
</script>
<style>
.input_box
{
     margin: 10px 0;
    text-align: left;
    width: 50%;
	border: 2px solid #e8e8e8;
    color: #666666;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
	margin-left:10px;
}

.select_box
{
     margin: 10px 0;
    text-align: left;
    width: 50%;
    color: #666666;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
	margin-left:10px;
}
.row {
    margin-left: 0px;
    margin-right: 0px;
}
#iyerpoojas-form
{
    font-family: "ralewayregular" !important;
    font-size: 13px !important;
    padding: 17px;
}
#iyerpoojas-form label
{
width:30%;
}
.errorMessage
{
margin-left:32%;
}
#page .ui-icon {
    display: block;
}

</style>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">

<script>


var availableDates = [<?php echo $dates; ?>];

if(availableDates=='')
{
 $('#discount_dates_from_new').html("You don't have any available dates now. User can't book any of your activity until you select your available dates.");
}

function available(date) {
  dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
  console.log(dmy+' : '+($.inArray(dmy, availableDates)));
  if ($.inArray(dmy, availableDates) != -1) {
    return [true, "","Available"];
  } else {
    return [false,"","unAvailable"];
  }
}
</script>

<style>
.wpcf7 input {
    background: none repeat scroll 0 0 #ffffff;
    border: 2px solid #e8e8e8;
    color: #666666;
    display: block;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    padding: 10px 8px;
    height:40px;
}
</style>
