<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */

$iyer_profile_dtails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));	


$availability_dates = explode(',',$iyer_profile_dtails->availability_dates);
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
<h1 style="margin-left:10px; margin-top:10px;" >Create Pooja</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iyerpoojas-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	 'htmlOptions' => array('style' => 'float:left; margin-left: 5%; width:90%'),
)); ?>



	<p class="note">* All Fields are required.</p>
	
	
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'category_id',array('id'=>'check')); ?>
	    <?php echo $form->dropDownList($iyerpoojas,'category_id',CHtml::listData(Iyercategories::model()->findAll(),'id','category_name'),array('prompt'=> 'Select category','class'=>'select_box'));	 ?>
		<?php echo $form->error($iyerpoojas,'category_id'); ?>
	</div>
	
<div style="clear:both; height:10px;" ></div>

	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'pooja_name',array('id'=>'check')); ?>
		<?php echo $form->textField($iyerpoojas,'pooja_name',array('class'=>'input_box')); ?>
		<?php echo $form->error($iyerpoojas,'pooja_name'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'description',array('id'=>'check')); ?>
		 <?php  echo $form->textArea($iyerpoojas,'description',array('maxlength'=>250,'class'=>'input_box','style'=>'max-width:50%;min-width:50%;'));  ?>
		<?php echo $form->error($iyerpoojas,'description'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
<?php $iyerpoojas->mantra_language = explode(',',$iyerpoojas->mantra_language); 	 ?>
	
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'mantra_language',array('style'=>'vertical-align:top;','id'=>'check')); ?>
		<?php  echo $form->dropDownList($iyerpoojas,'mantra_language',CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array('multiple' =>'multiple','class'=>'select_box')); ?>
		<?php echo $form->error($iyerpoojas,'mantra_language'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'duration',array('id'=>'check')); ?>
		<?php echo $form->textField($iyerpoojas,'duration',array('class'=>'input_box','style'=>"width:30%;"))."  ".$form->dropDownList($iyerpoojas, 'duration_time_type',array('Mins'=>'Mins','Hours'=>'Hours','Days'=>'Days') , array('class'=>'select_box','style'=>"width:18%;")); ?>
		<?php echo $form->error($iyerpoojas,'duration'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'amount_with_items',array('id'=>'check')); ?>
		<?php echo $form->textField($iyerpoojas,'amount_with_items',array('class'=>'input_box')); ?>
		<?php echo $form->error($iyerpoojas,'amount_with_items'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'amount_without_items',array('id'=>'check')); ?>
		<?php echo $form->textField($iyerpoojas,'amount_without_items',array('class'=>'input_box')); ?>
		<?php echo $form->error($iyerpoojas,'amount_without_items'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'discount',array('id'=>'check')); ?>
		<?php echo $form->dropDownList($iyerpoojas,'discount',array('Yes'=>'Yes','No'=>'No'),array('class'=>'select_box','prompt'=> 'Select Discount','onchange'=>'javascript:onChangediscount(this.value);')); ?>
		<?php echo $form->error($iyerpoojas,'discount'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	<div id="discount_details" style="display:none;">
	

	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'discount_percentage'); ?>
		<?php echo $form->dropDownList($iyerpoojas,'discount_percentage',array('10'=>'10%','20'=>'20%','30'=>'30%','40'=>'40%','50'=>'50%','60'=>'60%','70'=>'70%','80'=>'80%','90'=>'90%','100'=>'100%',),array('prompt'=> 'Select Percentage','class'=>'select_box')); ?>
		<div style="clear:both; height:10px; margin-left:32.5%; color:#ff0000;  " id="discount_percentage_error" ></div>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	
	<div class="row">
		<?php echo $form->labelEx($iyerpoojas,'discount_dates_from'); ?>
		<?php echo $form->textField($iyerpoojas,'discount_dates_from',array('class'=>'input_box','style'=>"width:23%;",'placeholder'=>'Discount From','readonly'=>'readonly'))."&nbsp;&nbsp;to".$form->textField($iyerpoojas,'discount_dates_to', array('class'=>'input_box','style'=>"width:23%;",'placeholder'=>'Discount To')); ?>
		<div style="clear:both; height:10px; margin-left:32.5%; color:#ff0000;  " id="discount_dates_from_new" ></div>
	</div>
	

		 </div>	
		
	<div style="clear:both; height:30px;" ></div>

	<div style="float:left; margin-left:32%;">
		<?php echo CHtml::submitButton($iyerpoojas->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-danger','onclick'=>'return submitformvalues();')); ?>
		<button class="btn  btn-large" onclick="window.location.href ='<?php echo CController::CreateUrl('profile/iyeractivity'); ?>'" type="button"  style="margin-left:10px;">Cancel</button>
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

var Iyerpoojas_discount =  $('#Iyerpoojas_discount').val();
if(Iyerpoojas_discount=='Yes')
$('#discount_details').show();
else
$('#discount_details').hide();
</script>
<script type="text/javascript">
function submitformvalues()
{
var Iyerpoojas_submit=  $('#Iyerpoojas_discount').val();
if(Iyerpoojas_submit=='Yes')
{
  var Iyerpoojas_discount_percentage = $('#Iyerpoojas_discount_percentage').val();
  var Iyerpoojas_discount_dates_from = $('#Iyerpoojas_discount_dates_from').val();
  var Iyerpoojas_discount_dates_to = $('#Iyerpoojas_discount_dates_to').val();

  if(Iyerpoojas_discount_percentage=='')
  {
  $('#discount_percentage_error').html('Select Discount Percentage');  
   return false;
  }
  
  if((Iyerpoojas_discount_dates_from=='') && (Iyerpoojas_discount_dates_to==''))
  {
  $('#discount_percentage_error').hide();
   $('#discount_dates_from_new').html('Select Discount Dates');  
   return false;
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
jQuery("#Iyerpoojas_discount_dates_from").datepicker({
  beforeShowDay: available,
  changeMonth : true,
  changeYear : true,
  dateFormat: 'yy-mm-dd',	
  onSelect: function(selected) {
          $("#Iyerpoojas_discount_dates_to").datepicker("option","minDate", selected)
        }
 });

jQuery("#Iyerpoojas_discount_dates_to").datepicker({
  beforeShowDay: available,
  changeMonth : true,
  changeYear : true,
  dateFormat: 'yy-mm-dd',	
   onSelect: function(selected) {
           $("#Iyerpoojas_discount_dates_from").datepicker("option","maxDate", selected)
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

#check span
{
display:none;
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
