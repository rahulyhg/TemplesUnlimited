<?php
/* @var $this RecentTemplesController */
/* @var $data RecentTemples */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temple_name')); ?>:</b>
	<?php echo CHtml::encode($data->temple_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temple_image')); ?>:</b>
	<?php echo CHtml::encode($data->temple_image); ?>
	<br />


</div>
