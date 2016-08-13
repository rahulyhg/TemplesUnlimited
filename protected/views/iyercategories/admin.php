<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Iyer Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Iyer Categories', 'url'=>array('create')),
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

<h1>Manage Iyer Categories</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(

	'dataProvider'=>$model->search(),
	'id'=>'categories-grid',
	'columns'=>array(
	
array(

			'name'=>'id',

			'type'=>'raw',

			'value'=>'CHtml::encode($data->id)',

			'htmlOptions' => array('style' => 'width:250px; '),

		),
		array(

			'name'=>'category_name',

			'type'=>'raw',

			'value'=>'CHtml::encode($data->category_name)',

			'htmlOptions' => array('style' => 'width:250px; '),

		),

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>
