<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
		<!-- loads mdp -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create User</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
	  <div class="form form-horizontal">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temples-form',
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
	   <input type="button" class="btn btn-success pull-right" value="Add more activity plan" onclick="get_Guide_activities_form()" />	
	  <div class="activitieslists">
	 
		<?php $this->renderPartial('_activiesform', array('model'=>$model,'key'=>1)); ?>		
		</div>
		
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Continue', array('class'=>'btn btn-success btn-large')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
	   </div>
  </div>
</div>
