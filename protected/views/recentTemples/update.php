<?php
/* @var $this RecentTemplesController */
/* @var $model RecentTemples */

$this->breadcrumbs=array(
	'Recent Temples'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RecentTemples', 'url'=>array('index')),
	array('label'=>'Create RecentTemples', 'url'=>array('create')),
	array('label'=>'View RecentTemples', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RecentTemples', 'url'=>array('admin')),
);
?>

<h1>Update RecentTemples <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
