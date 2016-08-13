<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>
<div style="clear:both">&nbsp;</div>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>

	<div class="control-group">
		<?php echo $form->label($model,'id',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'id'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->label($model,'ptitle',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'ptitle',array('size'=>60,'maxlength'=>200)); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->label($model,'pdescription',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textArea($model,'pdescription',array('rows'=>6, 'cols'=>50)); ?>
		</div>
	</div>

	<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary ')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->