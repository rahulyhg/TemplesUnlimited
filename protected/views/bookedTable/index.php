<?php
/* @var $this BookedTableController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Booked Tables',
);

$this->menu=array(
	array('label'=>'Create BookedTable', 'url'=>array('create')),
	array('label'=>'Manage BookedTable', 'url'=>array('admin')),
);
?>

<h1>Booked Tables</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
