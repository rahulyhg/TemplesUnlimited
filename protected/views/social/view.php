<?php
/* @var $this SocialController */
/* @var $model Social */

$this->breadcrumbs=array(
	'Socials'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Update Social', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Social', 'url'=>array('admin')),
);
?>

<h1>View Social #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
	),
)); ?>
