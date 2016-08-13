<?php
/* @var $this BookedTableController */
/* @var $model BookedTable */

$this->breadcrumbs=array(
	'Booked Tables'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BookedTable', 'url'=>array('index')),
	array('label'=>'Create BookedTable', 'url'=>array('create')),
	array('label'=>'View BookedTable', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BookedTable', 'url'=>array('admin')),
);
?>

<h1>Update BookedTable <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
