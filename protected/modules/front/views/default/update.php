<?php
/* @var $this CastsController */
/* @var $model Casts */
/* @var $form CActiveForm */
?>


<div class="span9">
      <ul class="breadcrumb">
      <li><i class="icon-user"></i>&nbsp;Account Setting</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Change Password
            
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

	<?php if(Yii::app()->user->hasFlash('success')){ ?>
		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>	

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changePassword-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'currentPassword'); ?>
		<?php echo $form->passwordField($model,'currentPassword'); ?>
		<?php echo $form->error($model,'currentPassword'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		<?php echo $form->passwordField($model,'newPassword'); ?>
		<?php echo $form->error($model,'newPassword'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'newPassword_repeat'); ?>
		<?php echo $form->passwordField($model,'newPassword_repeat'); ?>
		<?php echo $form->error($model,'newPassword_repeat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

		
			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
	
	<style>
form {margin: 0 30px 18px;}
p {
    margin: 0;
    padding: 5px;
}
span.required {
    color: red;
}
.errorSummary {
    background: none repeat scroll 0 0 #FFEEEE;
    border: 2px solid #CC0000;
    font-size: 0.9em;
    margin: 0 0 20px;
    padding: 7px 7px 12px;
}
div.form .row {
    margin: 5px 0;
}
div.form .errorMessage {
    color: red;
    font-size: 0.9em;
}
div.form select.error {
    background: none repeat scroll 0 0 #FFEEEE;
    border-color: #CC0000;
}
</style>	
