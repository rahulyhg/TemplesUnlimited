<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
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

	<?php //echo $form->errorSummary($model); ?>
	
<!--	<div class="row">
		<?php  //echo $form->labelEx($model,'parent_id'); ?>
		<?php //echo $form->dropDownList($model,'parent_id',CHtml::listData(Poojacategories::model()->findAll(),'category_id','category_name'),array('prompt'=> 'Please Select')); ?>
		<?php// echo $form->error($model,'parent_id'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'category_name'); ?>
		<?php echo $form->textField($model,'category_name',array('size'=>250,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'category_name'); ?>
	</div>
	
<!--	<div class="row">
		<?php //echo $form->labelEx($model,'category_image'); ?>
		<?php //echo $form->fileField($model,'category_image'); ?>
			<?php //if($model->isNewRecord!='1'){ ?>
		 <?php //echo CHtml::image(Yii::app()->request->baseUrl.'/'.$model->category_image,"category_image",array("style"=>'max-width:200px')); ?>
	<?php //} ?>
		<?php //echo $form->error($model,'category_image'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large')); ?>
		
		 <input type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/poojacategories/admin'; ?>'"  class="btn  btn-large" value="Cancel" >
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
