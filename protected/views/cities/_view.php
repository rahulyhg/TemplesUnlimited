<?php
/* @var $this CitiesController */
/* @var $data Cities */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('state_id')); ?>:</b>
	<?php
		$criteria = new CDbCriteria;  
		$state_id = CHtml::encode($data->state_id);
		$criteria->addCondition('id' == $state_id);
		$state = States::model()->find($criteria);
		echo $state->state_name;
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>
