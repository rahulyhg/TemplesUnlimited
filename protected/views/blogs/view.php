<?php
/* @var $this BlogsController */
/* @var $model Blogs */

$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Blogs', 'url'=>array('admin')),
	array('label'=>'Create Blogs', 'url'=>array('create')),
	array('label'=>'Update Blogs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Blogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Blogs', 'url'=>array('admin')),
);
?>

<h1>View Blogs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
            'name'=>'category',
            'value'=>$model->State->categoryname,
        ),
		'blog_name',
		
		array(
            'name'=>'files',
            'value'=>($model->file_type=='1')?CHtml::image(Yii::app()->request->baseUrl."/uploads/blogs/".$model->files,"",array("style"=>"width:300px;")):$model->video_url,
			'type'=>'html',
        ),	
		


		array(
            'name'=>'content',
            'value'=>$model->content,
			'type'=>'html',
        ),
		
		
		'created',
	),
)); ?>
