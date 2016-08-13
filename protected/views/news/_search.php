<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'news_id'); ?>
		<?php echo $form->textField($model,'news_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'news_title'); ?>
		<?php echo $form->textField($model,'news_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_date'); ?>
		<div id="datetimepicker1" class="input-append date">
	<?php echo $form->textField($model,'news_date',array('data-format'=>'yyyy-MM-dd','style'=>"margin-top:0px")); ?>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
	</div>

	



	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
