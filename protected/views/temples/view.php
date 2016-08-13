<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Temples'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Temples', 'url'=>array('index')),
	array('label'=>'Create Temple', 'url'=>array('create')),
	array('label'=>'Update Temple', 'url'=>array('update', 'id'=>$model->id)),
	/*array('label'=>'Delete Temple', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),*/
	array('label'=>'Manage Temples', 'url'=>array('admin')),
);
?>
<style type="text/css">
img{ max-width:600px; }
</style>
<h1>View Temple #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'temple_name',
		'temple_other_names',
		'temple_deity',
		'temple_description',
		'temple_address',
		array(
            'name'=>'city_id',
            'value'=>($model->city_id!='0')?$model->city->name:'Nil',
        ),		
		array(
            'name'=>'state_id',
            'value'=>$model->State->state_name,
        ),		
		'temple_phone_number',
		array(
            'name'=>'category_id',
            'value'=>$model->category->category_name
        ),
		array(
            'name'=>'main_image',
            'value'=>(!empty($model->main_image))?CHtml::image(Yii::app()->request->baseUrl."/temple_images/detail/".$model->main_image,"",array("style"=>"max-width:500px;")):"no image",
			'type'=>'html',
        ),		
		'temple_timings',
		array(
            'name'=>'temple_information',
            'value'=>$model->temple_information,
			'type'=>'html',
        ),		
		array(
            'name'=>'temple_pooja_timings',
            'value'=>$model->temple_pooja_timings,
			'type'=>'html',
        ),		
		array(
            'name'=>'temple_offerings',
            'value'=>$model->temple_offerings,
			'type'=>'html',
        ),		
		array(
            'name'=>'temple_events',
            'value'=>$model->temple_events,
			'type'=>'html',
        ),		
		array(
            'name'=>'temple_map_content',
            'value'=>$model->temple_map_content,
			'type'=>'html',
        ),		
		'latitude',
		array(
            'name'=>'logtitute',
        ),
	),
)); ?>
