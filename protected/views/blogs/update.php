<?php
/* @var $this BlogsController */
/* @var $model Blogs */

$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Blogs', 'url'=>array('admin')),
	array('label'=>'Create Blogs', 'url'=>array('create')),
	array('label'=>'View Blogs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Blogs', 'url'=>array('admin')),
);
?>

<h1>Update Blogs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
