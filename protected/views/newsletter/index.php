<?php
/* @var $this NewsletterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Newsletters',
);

$this->menu=array(

	array('label'=>'Manage Newsletter', 'url'=>array('admin')),
);
?>

<h1>Newsletters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
