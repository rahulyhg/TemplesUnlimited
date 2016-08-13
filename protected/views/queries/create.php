<?php
/* @var $this QueriesController */
/* @var $model Queries */

$this->breadcrumbs=array(
	'Queries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Queries', 'url'=>array('index')),
	array('label'=>'Manage Queries', 'url'=>array('admin')),
);
?>

<h1>Create Queries</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
