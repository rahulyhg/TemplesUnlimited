<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pooja_id'); ?>
		<?php echo $form->textField($model,'pooja_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pooja_name'); ?>
		<?php echo $form->textField($model,'pooja_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pooja_have_options'); ?>
		<?php echo $form->dropDownList($model,'pooja_have_options',array('1'=>'Yes','0'=>'No'),array('prompt'=> 'Please Select')); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
