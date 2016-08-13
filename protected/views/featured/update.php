<?php
/* @var $this FeaturedController */
/* @var $model FeaturedListing */

$this->breadcrumbs=array(
	'Featured Listings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FeaturedListing', 'url'=>array('index')),
/*	array('label'=>'Create FeaturedListing', 'url'=>array('create')),*/
	array('label'=>'View FeaturedListing', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FeaturedListing', 'url'=>array('admin')),
);
?>

<h1>Update FeaturedListing <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
