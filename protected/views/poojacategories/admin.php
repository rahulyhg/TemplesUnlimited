<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Pooja Categories'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Pooja Category', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#categories-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Categories</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		'name'=>'category_id',
		'filter'=>false,
		),
		array(
		'name'=>'category_name',
		'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>'Are you sure,you want to delete this category? By confirming this the Epoojas under this category also get deleted. If you would like to continue, click on "ok" button below.',
			'template'=>'{update}{delete}',
			'buttons'=>array
			(
			'delete'=>array(
			'url'=>'Yii::app()->controller->createUrl("poojacategories/delete1",array("id"=>$data->primaryKey))',
			),
			),
		),
	),
)); ?>
