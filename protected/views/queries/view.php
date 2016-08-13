<?php
/* @var $this QueriesController */
/* @var $model Queries */

$this->breadcrumbs=array(
	'Queries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Queries', 'url'=>array('index')),
	array('label'=>'Delete Queries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Queries', 'url'=>array('admin')),
);
?>

<h1>View Queries #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'name',
		'email',
		'ph_no',
		'question',
	),
)); ?>
