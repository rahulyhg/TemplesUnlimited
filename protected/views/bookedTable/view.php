<?php
/* @var $this BookedTableController */
/* @var $model BookedTable */

$this->breadcrumbs=array(
	'Booked Tables'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BookedTable', 'url'=>array('index')),
	array('label'=>'Create BookedTable', 'url'=>array('create')),
	array('label'=>'Update BookedTable', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BookedTable', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BookedTable', 'url'=>array('admin')),
);
?>

<h1>View BookedTable #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
		'name'=>'name',
		'value'=>Profile::model()->username($model->user_id),
		'filter'=>false,
		),
		
		array(
		'name'=>'Activity',
		'value'=>$model->type=='iyer'?Iyerpoojas::model()->activityname($model->activity_id):Guidetemple::model()->activityname($model->activity_id),
		'filter'=>false,
		),

		'book_date',
		
		array(
		'name'=>'Option',
		'value'=>$model->type=='iyer'?($model->option=='1'?'Without Pooja Items':'With Pooja Items'):'Nil',
		'filter'=>false,
		),
		'created',
		
		array(
		'name'=>'Iyer/Guide Status',
		'value'=>$model->iyer_status==""?"In-progress":ucfirst($model->iyer_status),
		'filter'=>false,
		),
		'type',
		array(
		'name'=>'name',
		'value'=>Profile::model()->username($model->from_user),
		'filter'=>false,
		),
	),
)); ?>
