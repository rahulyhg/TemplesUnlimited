<?php
/* @var $this SocialController */
/* @var $model Social */

$this->breadcrumbs=array(
	'Socials'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View Social', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Social', 'url'=>array('admin')),
);
?>

<h1>Update Social <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
