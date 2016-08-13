<?php
/* @var $this BlogsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blogs',
);

$this->menu=array(
	array('label'=>'Create Blogs', 'url'=>array('create')),
	array('label'=>'Manage Blogs', 'url'=>array('admin')),
);
?>

<h1>Blogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
