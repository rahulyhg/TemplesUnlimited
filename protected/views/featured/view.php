<?php
/* @var $this FeaturedController */
/* @var $model FeaturedListing */

$this->breadcrumbs=array(
	'Featured Listings'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FeaturedListing', 'url'=>array('index')),
	/*array('label'=>'Create FeaturedListing', 'url'=>array('create')),*/
	array('label'=>'Update FeaturedListing', 'url'=>array('update', 'id'=>$model->id)),
	/*array('label'=>'Delete FeaturedListing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),*/
	array('label'=>'Manage FeaturedListing', 'url'=>array('admin')),
);
?>

<h1>View FeaturedListing #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
