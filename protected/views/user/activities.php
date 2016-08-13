<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Guide activity plans'=>array($model->user_id),
	'Manage',
);

$this->menu=array(
	//array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Activities</h1>
<style type="text/css">
.grid-view .button-column{ width:90px; }
</style>
<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->
<?php  echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none"> </div>
<!-- search-form -->
<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'activities-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		array(
		'name'=>'activity_id',
		'filter'=>false,
		 ),
		 
		 array(
		'name'=>'activity_title',
		 'filter'=>false,
		 ),
		 
		  array(
		'name'=>'activity_description',
		 'filter'=>false,
		 ),
		 
		 
		 array(
		'name'=>'category',
		 'filter'=>false,
		 'value'=>'$data->category->category_name',
		 ),
		 
		 array(
		'name'=>'activity_duration',
		 'filter'=>false,
		 ),
		 
		 array(
		'name'=>'availability_dates',
		 'filter'=>false,
		 'value'=>'implode(", ",explode(",",$data->availability_dates))',
		 ),
		 
		  array(
		'name'=>'plan_per',
		 'filter'=>false,
		 'value'=>'str_replace("_"," ",$data->plan_per)',
		 ),
		
		array(
			'class'=>'CButtonColumn',
			'template' => '{activate}',
			'buttons' => array(
			        'activate'=>array(
						'label' => 'Activate/Deactivate', // text label of the button
					   'url' => 'CHtml::normalizeUrl(array("user/activitystatus/id/".$data->user_id."/aid/".$data->activity_id."/st/".$data->status.""))', //Your URL According to your wish
                       'imageUrl' => Yii::app()->baseUrl . '/images/gallery.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
					),
			),
		),
	),
)); 
 ?>
