<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<p>&nbsp;</p>
<div class="box" id="box-5" style="width:35%; margin:0 auto;">
  <h4 class="box-header round-top">Login</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">

		<p>Please fill out the following form with your login credentials:</p>

		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<div class="row">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
				<?php echo $form->error($model,'password'); ?>
				
			</div>

			<!--<div class="row rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>-->

			<div class="row buttons">
				<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-danger')); ?>
			</div>

		<?php $this->endWidget(); ?>
		</div><!-- form -->
	 </div>
  </div>
</div>
<p>&nbsp;</p>