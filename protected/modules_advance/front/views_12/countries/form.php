<?php
$this->pageTitle=Yii::app()->name . ' - Almost there...';
$this->breadcrumbs=array(
	'User Account',
);
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('user')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('user'); ?>
</div>

<?php else: ?>

<p>
Tell us about where the item needs to be collected from and delivered to. Set up a username / password so you can quickly and easily review quotes right here on Shiply.
</p>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="row">
		<h3>Account Setup:</h3>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password',array('maxlength'=>128)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'conpassword'); ?>
		<?php echo $form->textField($model,'conpassword',array('maxlength'=>128)); ?>
	</div>
	
	
	 <div class="row">
		<h3>Collection Details:</h3>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password',array('maxlength'=>128)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'conpassword'); ?>
		<?php echo $form->textField($model,'conpassword',array('maxlength'=>128)); ?>
	</div>
	
	 <div class="row">
		<h3>Delivery Details:</h3>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password',array('maxlength'=>128)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'conpassword'); ?>
		<?php echo $form->textField($model,'conpassword',array('maxlength'=>128)); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>