<?php
/* @var $this SliderController */
/* @var $data Slider */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stitle')); ?>:</b>
	<?php echo CHtml::encode($data->stitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sdescription')); ?>:</b>
	<?php echo CHtml::encode($data->sdescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sfile')); ?>:</b>
	<?php echo CHtml::encode($data->sfile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sstatus')); ?>:</b>
	<?php echo CHtml::encode($data->sstatus); ?>
	<br />


</div>
