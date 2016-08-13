<?php
/* @var $this QueriesController */
/* @var $model Queries */

$this->breadcrumbs=array(
	'Queries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Queries', 'url'=>array('index')),
	array('label'=>'Create Queries', 'url'=>array('create')),
	array('label'=>'View Queries', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Queries', 'url'=>array('admin')),
);
?>

<h1>Update Queries <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
