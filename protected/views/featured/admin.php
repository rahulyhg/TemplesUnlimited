<?php
/* @var $this FeaturedController */
/* @var $model FeaturedListing */

$this->breadcrumbs=array(
	'Featured Listings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FeaturedListing', 'url'=>array('index')),
	/*array('label'=>'Create FeaturedListing', 'url'=>array('create')),*/
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#featured-listing-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Featured Listings</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'featured-listing-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<style>
.delete
{
display:none;

}
</style>
