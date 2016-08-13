<?php
/* @var $this BlogsController */
/* @var $model Blogs */

$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Blogs', 'url'=>array('admin')),
	array('label'=>'Manage Blogs', 'url'=>array('admin')),
);
?>

<h1>Create Blogs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
