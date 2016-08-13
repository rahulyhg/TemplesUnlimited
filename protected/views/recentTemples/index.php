<?php
/* @var $this RecentTemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recent Temples',
);

$this->menu=array(
	array('label'=>'Create RecentTemples', 'url'=>array('create')),
	array('label'=>'Manage RecentTemples', 'url'=>array('admin')),
);
?>

<h1>Recent Temples</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
