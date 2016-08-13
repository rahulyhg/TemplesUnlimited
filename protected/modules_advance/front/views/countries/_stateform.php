<div class="form">

<?php $form=$this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal'))); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="control-group">
	<?php echo CHtml::errorSummary($model); ?>
	</div>
	 <?php
	$countries=Countries::model()->findAll();
    $countries_data=CHtml::listData($countries,'idCountry','countryName');
	?>
	<div class="control-group">
		<?php echo $form->labelEx($model,'idCountry',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo  $form->dropDownList($model,'idCountry',$countries_data, array('options' => array($country=>array('selected'=>true)))); ?>
		
		<?php echo $form->error($model,'idCountry'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'statename',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'statename',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'statename'); ?>
		</div>
	</div>

    <?php if($model->isNewRecord){ ?>
	<?php echo $form->hiddenField($model,'created',array('value'=>date('Y-m-d H:i:s'))); ?>
  <?php } ?>
	

	<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->