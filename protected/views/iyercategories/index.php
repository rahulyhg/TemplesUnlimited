<?php
/* @var $this CitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Iyer Categories',
);

$this->menu=array(
	array('label'=>'Create Iyer Categories', 'url'=>array('create')),
	array('label'=>'Manage Iyer Categories', 'url'=>array('admin')),
);
?>

<h1>Cities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
