<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Languages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'language_name'); ?>
		<?php echo $form->textField($model,'language_name',array('size'=>250,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'language_name'); ?>
	</div>

	<div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit')); ?>
		
		  <input type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/languages/admin/'; ?>'"  class="btn  btn-large" value='Cancel' >
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
