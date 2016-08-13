<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'News'=>array('admin'),
	$model->news_title,
);

$this->menu=array(
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->news_id)),
	//array('label'=>'Delete Pooja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->event_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>
<style type="text/css">
img{ max-width:500px; }
</style>

<h1>View News #<?php echo $model->news_id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'news_id',
		'news_title',
		'news_date',
	 array(
            'name'=>'posted_by',
            'value'=>$model->newsowner->email,
        ),			
	array(
		'name'=>'news_image',
		 'type'=>'html',
            'value'=>'<div class="span4 thumbnail">'.(!empty($model->news_image))?CHtml::image(Yii::app()->request->baseUrl.'/'.$model->news_image,"",array("style"=>"max-width:500px;")):"no image".'</div>',
		),

		
		array(
            'name'=>'news_content',
			'type'=>'html',
        ),		
		
	),
)); ?>
