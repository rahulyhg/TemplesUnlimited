<?php
/* @var $this StateController */
/* @var $model State */

$this->breadcrumbs=array(
	'States'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List State', 'url'=>array('index')),
	array('label'=>'Create State', 'url'=>array('create')),
	array('label'=>'View State', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage State', 'url'=>array('admin')),
);
?>

<h1>Update State <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>