<?php
/* @var $this BookedTableController */
/* @var $model BookedTable */

$this->breadcrumbs=array(
	'Booked Tables'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BookedTable', 'url'=>array('index')),
	array('label'=>'Manage BookedTable', 'url'=>array('admin')),
);
?>

<h1>Create BookedTable</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
