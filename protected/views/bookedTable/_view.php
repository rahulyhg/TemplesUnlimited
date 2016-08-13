<?php
/* @var $this BookedTableController */
/* @var $data BookedTable */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activity_id')); ?>:</b>
	<?php echo CHtml::encode($data->activity_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_date')); ?>:</b>
	<?php echo CHtml::encode($data->book_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option')); ?>:</b>
	<?php echo CHtml::encode($data->option); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iyer_status')); ?>:</b>
	<?php echo CHtml::encode($data->iyer_status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_user')); ?>:</b>
	<?php echo CHtml::encode($data->from_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_status')); ?>:</b>
	<?php echo CHtml::encode($data->user_status); ?>
	<br />

	*/ ?>

</div>
