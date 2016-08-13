<?php
/* @var $this BlogcategoryController */
/* @var $model Blogcategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blogcategory-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'categoryname'); ?>
		<?php echo $form->textField($model,'categoryname',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'categoryname'); ?>
	</div>


	<div class="row buttons">
	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit')); ?>
		
	 <button type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/blogcategory/admin/'; ?>'"  class="btn  btn-large" >Cancel</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->