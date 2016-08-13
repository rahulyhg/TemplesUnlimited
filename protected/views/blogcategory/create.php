<?php
/* @var $this BlogcategoryController */
/* @var $model Blogcategory */

$this->breadcrumbs=array(
	'Blogcategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Blogcategory', 'url'=>array('index')),
	array('label'=>'Manage Blogcategory', 'url'=>array('admin')),
);
?>

<h1>Create Blogcategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
