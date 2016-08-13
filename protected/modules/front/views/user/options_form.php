<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>


	
	<div class="pooja_option" id="option<?php echo $key; ?>">
	
	<?php if( (int)$key > 1){ echo CHtml::link('Remove','javascript:void(0);',array('onclick'=>'remove_pooja_option_form(\''.$key.'\')','class'=>'btn btn-danger pull-right color-white nounderline')); } ?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($poojaoptions,'option_desc'); ?>
		<?php echo CHtml::textField('Poojaoptions['.$key.'][option_desc]',$poojaoptions->option_desc,array('class'=>'optionform_required')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabelEx($poojaoptions,'option_price'); ?>
		<?php echo CHtml::textField('Poojaoptions['.$key.'][option_price]',$poojaoptions->option_price,array('class'=>'optionform_required')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabelEx($poojaoptions,'option_shipping_price'); ?>
		<?php echo CHtml::textField('Poojaoptions['.$key.'][option_shipping_price]',$poojaoptions->option_shipping_price); ?>
	</div>


	</div>	
