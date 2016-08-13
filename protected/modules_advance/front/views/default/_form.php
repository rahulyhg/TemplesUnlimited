<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changeconfig-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal','enctype'=>'multipart/form-data'),
)); ?>


	<div class="control-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'role',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'role',array('admin'=>'Admin','superadmin'=>'Super Admin')); ?>
		<?php echo $form->error($model,'role'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'conpassword',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'conpassword'); ?>
		<?php echo $form->error($model,'conpassword'); ?>
		</div>
	</div>

	<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success btn-large ')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->