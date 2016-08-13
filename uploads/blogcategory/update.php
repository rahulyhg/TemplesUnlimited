<?php
/* @var $this BlogcategoryController */
/* @var $model Blogcategory */

$this->breadcrumbs=array(
	'Blogcategories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Blogcategory', 'url'=>array('index')),
	array('label'=>'Create Blogcategory', 'url'=>array('create')),
	array('label'=>'View Blogcategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Blogcategory', 'url'=>array('admin')),
);
?>

<h1>Update Blogcategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>