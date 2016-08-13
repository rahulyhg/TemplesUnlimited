<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Pooja'=>array('index'),
	$model->pooja_name,
);

?>

<?php

$this->menu=array(
	array('label'=>'Create Iyer Pooja', 'url'=>array('create')),
	array('label'=>'Update Iyer Pooja', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Iyer Pooja', 'url'=>array('admin')),
);
?>

<h1>View Iyer Categories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		 array(

			'name'=>'Category',
			'value'=>Iyercategories::model()->getname($model->category_id),
			'type'=>'raw',

		),
		'pooja_name',
	),
)); ?>
