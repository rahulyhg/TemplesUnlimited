<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'states-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
	
	
	<div class="row">     
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php
			$list = CHtml::listData(Country::model()->findAll(array('order' => 'country')), 'id', 'country');
			echo $form->dropDownList($model, 'country_id', $list,array('empty'=>'Select Country'));   
		?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state_name'); ?>
		<?php echo $form->textField($model,'state_name',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'state_name'); ?>
	</div>

	<div class="row buttons">
			<?php  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit')); ?>
		
<input type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/states/admin/'; ?>'"  class="btn  btn-large" value="Cancel" >
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
