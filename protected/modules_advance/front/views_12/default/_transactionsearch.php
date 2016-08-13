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
		<?php echo CHtml::label('Id','',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'tranID'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo CHtml::label('Username','',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'transaction_by'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo CHtml::label('Item','',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'transaction_item'); ?>
		</div>
	</div>
	
	
	
	<div class="control-group">
		<?php echo CHtml::label('Paid on','',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                        'model' => $model,
                                        'attribute' => 'paydate',
                                        'language' => 'en',
                                        'htmlOptions' => array(
                                                'id' => 'Transaction_paydate',
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