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
		<div  id="Poojaoptions_<?php echo $key; ?>_option_desc_em_" class="errorMessage"></div>

	</div>
	<div class="row">
		<?php echo CHtml::activeLabelEx($poojaoptions,'option_price'); ?>
		<?php echo CHtml::textField('Poojaoptions['.$key.'][option_price]',$poojaoptions->option_price,array('class'=>'optionform_required','onkeypress'=>'return isNumber(event)','oncopy'=>"return false",'onpaste'=>"return false;")); ?>
		<div  id="Poojaoptions_<?php echo $key; ?>_option_price_em_" class="errorMessage"></div>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabelEx($poojaoptions,'option_shipping_price'); ?>
		<?php echo CHtml::textField('Poojaoptions['.$key.'][option_shipping_price]',$poojaoptions->option_shipping_price,array('onkeypress'=>'return isNumber(event)','oncopy'=>"return false",'onpaste'=>"return false;")); ?>
	</div>

  

	</div>	
	
	<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57 )) {
        return false;
    }
    return true;
  }
  
  
	</script>
