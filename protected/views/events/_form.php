<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>
<link rel="stylesheet" type="text/css" media="screen"     href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.min.css">

	 
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'events-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'event_name'); ?>
		<?php echo $form->textField($model,'event_name',array('size'=>450,'maxlength'=>450,'class'=>'span5')); ?>
		<?php echo $form->error($model,'event_name'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'event_start_date'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model' => $model,
		'attribute' => 'event_start_date',
		'language'=>'en-GB',
		
	    'options'=>array(
				'dateFormat' => 'yy-mm-dd',
				'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
				'changeMonth'=>true,
				'changeYear'=>true,
				'yearRange'=>'2000:2099',
				'minDate' => date('Y-m-d'),      // minimum date
				'maxDate' => '2099-12-31',   
				'onSelect' => 'js:function(selectedDate)
				 {$("#Events_event_end_date").datepicker( "option", "minDate", selectedDate );}',   
				),
   		'htmlOptions' => array(
		'size' => '10',         // textField size
		'maxlength' => '10',
		'autocomplete'=>'off',     // textField maxlength
		'readonly'=>'readonly',
		
		),
		));
		?>
		<?php echo $form->error($model,'event_start_date'); ?>
		</div>

		
		
		<div class="row">
		<?php echo $form->labelEx($model,'event_end_date'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model' => $model,
		'attribute' => 'event_end_date',
		'language'=>'en-GB',
		 'options'=>array(
				'dateFormat' => 'yy-mm-dd',
				'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
				'changeMonth'=>true,
				'changeYear'=>true,
				'yearRange'=>'2000:2099',
				'minDate' => date('Y-m-d'),      // minimum date
				'maxDate' => '2099-12-31',      // maximum date
				),
		'htmlOptions' => array(
		'size' => '10',         // textField size
		'maxlength' => '10',
		'autocomplete'=>'off',    // textField maxlength
		'readonly'=>'readonly',
		),
		));
		?>
		<?php echo $form->error($model,'event_end_date'); ?>
		</div>

		<div class="row">
		<?php echo $form->labelEx($model,'event_start_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
		'model'=>$model, 
		'attribute'=>'event_start_time', 
		'mode'=>'time'
		));
		?>
		<?php echo $form->error($model,'event_start_time'); ?>
		</div>
		
		<div class="row">
		<?php echo $form->labelEx($model,'event_end_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
		'model'=>$model, //Model object
		'attribute'=>'event_end_time', //attribute name
		'mode'=>'time' //use "time","date" or "datetime" (default)
		));
		?>
		<?php echo $form->error($model,'event_end_time'); ?>
		</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'event_address'); ?>
		<?php echo $form->textArea($model,'event_address',array('rows'=>5,'class'=>'span5')); ?>
		<?php echo $form->error($model,'event_address'); ?>
	</div>




	
	<div class="row">
		<?php echo $form->labelEx($model,'phone_no'); ?>
		<?php echo $form->textField($model,'phone_no',array('size'=>450,'maxlength'=>450,'class'=>'span5')); ?>
		<?php echo $form->error($model,'phone_no'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'email_id'); ?>
		<?php echo $form->textField($model,'email_id',array('size'=>450,'maxlength'=>450,'class'=>'span5')); ?>
		<?php echo $form->error($model,'email_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'event_image'); ?>
		<?php echo $form->fileField($model,'event_image'); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.$model->event_image,"event_image",array("style"=>'max-width:200px')); ?>
	<?php } ?>
		<?php echo $form->error($model,'event_image'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'event_content'); ?>
        <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$model,                # Data-Model
			"attribute"=>'event_content',         # Attribute in the Data-Model
			"height"=>'400px',
			"width"=>'100%',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
		<?php //echo $form->textArea($model, "event_content", array('style'=>'width: 600px; height: 300px;')); ?>
		<?php // echo $form->error($model,'event_content'); ?>
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','onclick'=>'return checktiming();')); ?>
		
		  <input type="button" value="Cancel"  onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/events/admin/'; ?>'"  class="btn  btn-large" >
	</div>

<?php $this->endWidget(); ?>

</div>

 <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/datetimepicker.js"></script>
	  <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/bootstrap.min.js"></script>
	
<script type="text/javascript">
	$(function()
	{
	$("#datetimepicker1").datetimepicker({
	changeYear: true, 
	dateFormat: 'dd/mm/yy'
	}); 
	});
	
	function checktiming()
	{
	var Events_event_start_date =$('#Events_event_start_date').val();
	var Events_event_end_date =$('#Events_event_end_date').val();
	var Events_event_start_time =$('#Events_event_start_time').val();
	var Events_event_end_time =$('#Events_event_end_time').val();
	
	if(Events_event_start_date!='' &&Events_event_end_date!='')
	{
	if(Events_event_start_date==Events_event_end_date)
	{
	 if(Events_event_start_time>Events_event_end_time)
	 {
	  alert('Event end time must greater then event start time');
	  return false;
	 }
	}
	}
	}
</script>
