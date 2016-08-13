<?php
/* @var $this FeaturedController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Featured Listings',
);

$this->menu=array(
	/*array('label'=>'Create FeaturedListing', 'url'=>array('create')),*/
	array('label'=>'Manage FeaturedListing', 'url'=>array('admin')),
);
?>

<h1>Featured Listings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
