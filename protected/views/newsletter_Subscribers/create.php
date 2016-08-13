<?php
/* @var $this Newsletter_SubscribersController */
/* @var $model Newsletter */

$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Newsletter', 'url'=>array('index')),
	array('label'=>'Manage Newsletter', 'url'=>array('admin')),
);
?>

<h1>Create Newsletter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
