<?php
/* @var $this BlogcategoryController */
/* @var $model Blogcategory */

$this->breadcrumbs=array(
	'Blogcategories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Blogcategory', 'url'=>array('index')),
	array('label'=>'Create Blogcategory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#blogcategory-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Blogcategories</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'blogcategory-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
				 array(
		'name'=>'category Name',
		'value'=>'$data->categoryname',
		 ),
		'created_date',
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>'Are you sure,you want to delete this category? By confirming this the Blogs under this category also get deleted. If you would like to continue, click on "ok" button below.',
			'template'=>'{update}{delete}',
			'buttons'=>array
			(
			'delete'=>array(
			'url'=>'Yii::app()->controller->createUrl("blogcategory/delete1",array("id"=>$data->primaryKey))',
			),
			),
		),
	),
)); ?>

<style>
.grid-view table.items th {
  
    color: #cb2056 !important;
    text-align: center;
}
</style>
