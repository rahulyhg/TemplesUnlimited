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
		<?php echo CHtml::label('Title','',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo CHtml::label('created','',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                        'model' => $model,
                                        'attribute' => 'created',
                                        'language' => 'pl',
										'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
                                        'htmlOptions' => array(
                                                'id' => 'Deliveries_created',
                                                'dateFormat' => 'yy-mm-dd',
                                        ),
                                        'options' => array(  // (#3)
                  'showOn' => 'focus', 
                  'dateFormat' => 'yy-mm-dd',
                  'showOtherMonths' => true,
                  'selectOtherMonths' => true,
                  'changeMonth' => true,
                  'changeYear' => true,
                  'showButtonPanel' => true,
          )
                                ),
                                true); ?>
		</div>
	</div>

	

	<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary ')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->