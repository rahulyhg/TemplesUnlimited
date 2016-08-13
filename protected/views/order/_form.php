<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_amount'); ?>
		<?php echo $form->textField($model,'total_amount',array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'total_amount'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array('Packed'=>'Packed','Delivered'=>'Delivered','Shipped'=>'Shipped','Cancelled'=>'Cancelled')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>



	<div class="row buttons">
			<?php  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit')); ?>
		
		  <input type="button" value="Cancel" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/order/admin/'; ?>'"  class="btn  btn-large" >
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
