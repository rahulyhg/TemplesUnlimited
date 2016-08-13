<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Iyer Categories'=>array('index'),
	$model->category_name,
);

?>

<?php

$this->menu=array(
	array('label'=>'Create Iyer Categories', 'url'=>array('create')),
	array('label'=>'Update Iyer Categories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Iyer Categories', 'url'=>array('admin')),
);
?>

<h1>View Iyer Categories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_name',
	),
)); ?>
