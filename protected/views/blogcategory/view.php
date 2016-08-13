<?php
/* @var $this BlogcategoryController */
/* @var $model Blogcategory */

$this->breadcrumbs=array(
	'Blogcategories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Blogcategory', 'url'=>array('index')),
	array('label'=>'Create Blogcategory', 'url'=>array('create')),
	array('label'=>'Update Blogcategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Blogcategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Blogcategory', 'url'=>array('admin')),
);
?>

<h1>View Blogcategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'categoryname',
		'created_date',
	),
)); ?>
