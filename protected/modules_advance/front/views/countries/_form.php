<div class="form">

<?php $form=$this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal'))); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="control-group">
	<?php echo CHtml::errorSummary($model); ?>
     </div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'countryName',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'countryName',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'countryName'); ?>
		</div>
	</div>

	
   <div class="control-group">
	<div class="controls">
		
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->