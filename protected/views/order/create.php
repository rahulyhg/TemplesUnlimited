<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h1>Create Order</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
