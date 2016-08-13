<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ptitle')); ?>:</b>
	<?php echo CHtml::encode($data->ptitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pdescription')); ?>:</b>
	<?php echo CHtml::encode($data->pdescription); ?>
	<br />


</div>
