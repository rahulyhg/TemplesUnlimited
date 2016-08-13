<?php
/* @var $this QueriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Queries',
);

$this->menu=array(
	
	array('label'=>'Manage Queries', 'url'=>array('admin')),
);
?>

<h1>Queries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
