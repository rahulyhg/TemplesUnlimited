<?php
/* @var $this RecentTemplesController */
/* @var $model RecentTemples */

$this->breadcrumbs=array(
	'Recent Temples'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RecentTemples', 'url'=>array('index')),
	array('label'=>'Create RecentTemples', 'url'=>array('create')),
	array('label'=>'Update RecentTemples', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RecentTemples', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RecentTemples', 'url'=>array('admin')),
);
?>

<h1>View RecentTemples #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'temple_name',
		array(
		'name'=>'news_image',
		 'type'=>'html',
            'value'=>'<div class="span4 thumbnail">'.(!empty($model->news_image))?CHtml::image(Yii::app()->request->baseUrl.'/uploads/recent/thumb/'.$model->temple_image,"",array("style"=>"width:100px;")):"no image".'</div>',
		),
	),
)); ?>
