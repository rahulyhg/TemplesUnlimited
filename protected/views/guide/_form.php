<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temples-form',
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
		<?php echo $form->labelEx($model,'pooja_name'); ?>
		<?php echo $form->textField($model,'pooja_name',array('size'=>150,'maxlength'=>150,'class'=>'span5')); ?>
		<?php echo $form->error($model,'pooja_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_description'); ?>
		<?php echo $form->textArea($model,'pooja_description',array('rows'=>5,'class'=>'span5')); ?>
		<?php echo $form->error($model,'pooja_description'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'pooja_image'); ?>
        <?php echo CHtml::activeFileField($model, 'pooja_image'); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.$model->pooja_image,"pooja_image",array("width"=>200)); ?>
	<?php } ?>
        <?php echo $form->error($model,'pooja_image'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>150,'maxlength'=>150,'class'=>'span5')); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'delivery_time_1'); ?>
		<?php echo $form->textField($model,'delivery_time_1',array('size'=>250,'maxlength'=>250,'class'=>'span5')); ?>
		<?php echo $form->error($model,'delivery_time_1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'delivery_time_2'); ?>
		<?php echo $form->textField($model,'delivery_time_2',array('size'=>250,'maxlength'=>250,'class'=>'span5')); ?>
		<?php echo $form->error($model,'delivery_time_2'); ?>
	</div>
	
	<div class="row">
	    <label class="checkbox">
		<?php echo $form->checkBox($model,'pooja_have_options'); ?>&nbsp;Pooja has multiple options
		</label>
		<?php echo $form->error($model,'pooja_have_options'); ?>
	</div>
	
	<div class="pooja_have_options_no">
		<div class="row">
		<?php echo $form->labelEx($model,'pooja_price'); ?>
		<?php echo $form->textField($model,'pooja_price',array('size'=>250,'maxlength'=>250,'class'=>'span5')); ?>
		<?php echo $form->error($model,'pooja_price'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_shipping_price'); ?>
		<?php echo $form->textField($model,'pooja_shipping_price',array('size'=>250,'maxlength'=>250,'class'=>'span5')); ?>
		<?php echo $form->error($model,'pooja_shipping_price'); ?>
	</div>
	</div>
	
	
  <div class="pooja_have_options" style="display:none">	
	<div class="row">
		<?php echo cHtml::link('Add more','javascript:void(0);',array('onclick'=>'get_pooja_option_form()','class'=>'btn btn-success pull-right color-white nounderline')); ?>
	</div>
	<div class="pooja_options_list">
	<h3><b>Pooja Options</b></h3>
	<?php if($model->isNewRecord!='1' && $model->pooja_have_options == '1'){ 
	   $options = $model->poojaoptions;
	   
	   $poojaoptionscount = 0;
		   if(count($options)){
		      foreach($options as $option){ $poojaoptionscount++;
		       $this->renderPartial('options_form', array('model'=>$model,'poojaoptions'=>$option,'key'=>$poojaoptionscount)); 
			   }
			  } 
	   }else{
	    $this->renderPartial('options_form', array('model'=>$model,'poojaoptions'=>$poojaoptions,'key'=>1)); 
		} ?>
		</div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'payment_options'); ?>
		<?php echo $form->dropDownList($model, 'payment_options', array('Credit/Debit Card'=>'Credit/Debit Card','Bank deposit'=>'Bank deposit','COD'=>'COD' ), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'payment_options'); ?>
	</div>
	
	
	
	
	<div class="row">
	<?php echo $form->labelEx($model,'pooja_overview'); ?>
        <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$model,                # Data-Model
			"attribute"=>'pooja_overview',         # Attribute in the Data-Model
			"height"=>'400px',
			"width"=>'100%',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
	</div>
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
$('.timepicker1').timepicker();
</script>-->
<script type="text/javascript">
$(document).ready(function(){
$('#Pooja_pooja_have_options').change(function(){
if($(this).is(':checked')){
$('.pooja_have_options_no').css('display','none');
$('.pooja_have_options').css('display','block');
$('.optionform_required').attr('required',true);
}else{
$('.pooja_have_options').css('display','none');
$('.pooja_have_options_no').css('display','block');
$('.optionform_required').attr('required',false);
}
});
if($('#Pooja_pooja_have_options').is(':checked')){
$('#Pooja_pooja_have_options').click();
}

	<?php if($model->isNewRecord!='1' && $model->pooja_have_options == '1'){ ?>
	    option_form_count = parseInt('<?php echo $poojaoptionscount; ?>');
	    $('#Pooja_pooja_have_options').click();
	<?php } ?>
});
</script>
