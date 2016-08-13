<?php
/* @var $this NewsletterController */
/* @var $model Newsletter */

$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Newsletter Subscribers', 'url'=>array('index')),

	array('label'=>'Delete Newsletter Subscribers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Newsletter Subscribers', 'url'=>array('admin')),
);
?>

<h1>View Newsletter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'emailid',
		'date',
	),
)); ?>
