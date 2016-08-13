<?php
/* @var $this BookedTableController */
/* @var $model BookedTable */

$this->breadcrumbs=array(
	'Booked Tables'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BookedTable', 'url'=>array('index')),
	array('label'=>'Create BookedTable', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booked-table-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Booked Tables</h1>

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
	'id'=>'booked-table-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		array(
		'name'=>'Booked Iyer/Guide',
		'value'=>'Profile::model()->username($data->user_id)',
		'filter'=>false,
		),
		'book_date',
		
		array(
		'name'=>'Iyer/Guide Status',
		'value'=>'$data->iyer_status==""?"In-progress":ucfirst($data->iyer_status)',
		'filter'=>false,
		),
		array(
		'name'=>'User name',
		'value'=>'Profile::model()->username($data->from_user)',
		'filter'=>false,
		),
		'created',	
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<style>
.update,.delete
{
	 display:none;
}
</style>
