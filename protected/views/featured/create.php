<?php
/* @var $this FeaturedController */
/* @var $model FeaturedListing */

$this->breadcrumbs=array(
	'Featured Listings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FeaturedListing', 'url'=>array('index')),
	array('label'=>'Manage FeaturedListing', 'url'=>array('admin')),
);
?>

<h1>Create FeaturedListing</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
