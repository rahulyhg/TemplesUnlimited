<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Guide'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'Create Pooja', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#Guide-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Guide</h1>
<style type="text/css">
.grid-view .button-column{ width:90px; }
</style>
<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php  echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'Guide-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		'name'=>'guide_id',
		'filter'=>false,
		 ),
		 array(
		'name'=>'user_name',
		 'filter'=>false,
		 ),
		 array(
		'name'=>'user_name',
		 'filter'=>false,
		 ),
		//'city_id',
		//'category_id',
		array(
		'name'=>'pooja_image',
		 'type'=>'html',
            'value'=>'(!empty($data->pooja_image))?CHtml::image(Yii::app()->request->baseUrl."/".$data->pooja_image,"",array("style"=>"width:50px;height:50px;")):"no image"',
			'filter'=>false,		
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{update}{delete}',
			'buttons' => array(),
		),
	),
)); 
 ?>
