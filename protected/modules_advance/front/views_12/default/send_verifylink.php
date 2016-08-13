<?php
/* @var $this CastsController */
/* @var $model Casts */
/* @var $form CActiveForm */
?>


<div class="span9">
      <ul class="breadcrumb">
      <li><i class="icon-user"></i>&nbsp;Send email verification link</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Email verification
            
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Send email verification';
$this->breadcrumbs=array(
	'Send email verification',
);
?>

	<?php if(Yii::app()->user->hasFlash('success')){ ?>
		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>	
	
	<?php if(Yii::app()->user->hasFlash('error')){ ?>
		<div class="alert alert-warning">
			<?php echo Yii::app()->user->getFlash('error'); ?>
		</div>
	<?php } ?>	


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resendverifylink-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>"span4","required"=>true)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	
	
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Send',array('class'=>"btn btn-large btn-success")); ?>
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
