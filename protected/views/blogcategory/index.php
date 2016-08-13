<?php
/* @var $this BlogcategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blogcategories',
);

$this->menu=array(
	array('label'=>'Create Blogcategory', 'url'=>array('create')),
	array('label'=>'Manage Blogcategory', 'url'=>array('admin')),
);
?>

<h1>Blogcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
