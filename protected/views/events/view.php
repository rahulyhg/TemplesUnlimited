<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Events'=>array('admin'),
	$model->event_name,
);

$this->menu=array(
	array('label'=>'Create Event', 'url'=>array('create')),
	array('label'=>'Update Event', 'url'=>array('update', 'id'=>$model->event_id)),
	//array('label'=>'Delete Pooja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->event_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Events', 'url'=>array('admin')),
);
?>
<style type="text/css">
img{ max-width:500px; }
</style>

<h1>View Event #<?php echo $model->event_id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'event_id',
		'event_name',
		'event_start_date',
		'event_address',
			
	array(
		'name'=>'event_image',
		 'type'=>'html',
            'value'=>'<div class="span4 thumbnail">'.(!empty($model->event_image))?CHtml::image(Yii::app()->request->baseUrl.'/'.$model->event_image,"",array("style"=>"max-width:500px;")):"no image".'</div>',
		),
		

		array(
            'name'=>'event_content',
			'type'=>'html',
        ),		
		
	),
)); ?>
