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
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temple_name'); ?>
		<?php echo $form->textField($model,'temple_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
			<?php 
			$list = CHtml::listData(Cities::model()->findAll(array('order' => 'name')), 'id', 'name');
			echo $form->dropDownList($model, 'city_id', $list, array('empty'=>'Select a City','class'=>'span5'));   
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_id'); ?>
		<?php 
			$clist = CHtml::listData(Categories::model()->findAll(array('order' => 'category_name')), 'id', 'category_name');
			echo $form->dropDownList($model, 'category_id', $clist, array('empty'=>'Select a Category','class'=>'span5'));   
		?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
