<?php
/* @var $this RecentTemplesController */
/* @var $model RecentTemples */

$this->breadcrumbs=array(
	'Recent Temples'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RecentTemples', 'url'=>array('index')),
	array('label'=>'Manage RecentTemples', 'url'=>array('admin')),
);
?>

<h1>Create RecentTemples</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
