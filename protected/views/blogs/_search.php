<?php
/* @var $this BlogsController */
/* @var $model Blogs */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php $clist = CHtml::listData(Blogcategory::model()->findAll(array('order' => 'categoryname')), 'id', 'categoryname');
			echo $form->dropDownList($model, 'category', $clist, array('empty'=>'Select a Category'));    ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'blog_name'); ?>
		<?php echo $form->textField($model,'blog_name',array('size'=>60,'maxlength'=>1000)); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
