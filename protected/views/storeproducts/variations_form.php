<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>


	
	<div class="product_option" id="option<?php echo $key; ?>">
	
	<?php if( (int)$key > 1){ echo CHtml::link('Remove','javascript:void(0);',array('onclick'=>'remove_product_option_form(\''.$key.'\')','class'=>'btn btn-danger pull-right color-white nounderline')); } ?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($productvariations,'product_variation_title'); ?>
		<?php echo CHtml::textField('Productvariations['.$key.'][product_variation_title]',$productvariations->product_variation_title,array('class'=>'optionform_required')); ?>
		<div  id="Productvariations_<?php echo $key; ?>_product_variation_title_em_" class="errorMessage"></div>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabelEx($productvariations,'product_price'); ?>
		<?php echo CHtml::textField('Productvariations['.$key.'][product_price]',$productvariations->product_price,array('class'=>'optionform_required','onkeypress'=>'return isNumber(event)','oncopy'=>"return false",'onpaste'=>"return false;")); ?>
		<div  id="Productvariations_<?php echo $key; ?>_product_price_em_" class="errorMessage"></div>
	</div>
	<div class="row">
		<?php echo CHtml::activeLabelEx($productvariations,'product_shipping_price'); ?>
		<?php echo CHtml::textField('Productvariations['.$key.'][product_shipping_price]',$productvariations->product_shipping_price,array('onkeypress'=>'return isNumber(event)','oncopy'=>"return false",'onpaste'=>"return false;")); ?>
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
