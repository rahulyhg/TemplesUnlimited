<?php
/* @var $this CastsController */
/* @var $model Casts */
/* @var $form CActiveForm */
?>



<div class="box" id="box-5">
  <h4 class="box-header round-top">Change Password</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
            
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Change Password';
$this->breadcrumbs=array(
	'Change Password',
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
		<?php echo CHtml::submitButton('Update',array('class'=>'btn btn-success btn-large')); ?>
            
                            <input type="button"  onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/site/index/'; ?>'"  onclick="window.location.reload();"  class="btn  btn-large" value="Cancel" >
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
