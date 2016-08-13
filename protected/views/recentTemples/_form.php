<?php
/* @var $this RecentTemplesController */
/* @var $model RecentTemples */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recent-temples-form',
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

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'temple_name'); ?>
		<?php echo $form->textField($model,'temple_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'temple_name'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'temple_image'); ?>
        <?php echo CHtml::activeFileField($model,'temple_image'); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/recent/thumb/'.$model->temple_image,"temple_image",array("width"=>200)); ?>
	<?php } ?>
        <?php echo $form->error($model,'temple_image'); ?>
	</div>
	<?php if(!isset(Yii::app()->session['width1'])) { ?>
	<p class="hint">Note: Image size must graater then 290*220(Width*height).</p>
	<?php } ?>
	<p style="color:#FF0000;"><?php  if(isset(Yii::app()->session['width1'])) { echo Yii::app()->session['width1']; } ?></p>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
