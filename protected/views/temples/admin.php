<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Temples'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Temples', 'url'=>array('index')),
	array('label'=>'Create Temple', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#temples-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Temples</h1>
<style type="text/css">
.grid-view .button-column{ width:90px; }
</style>
<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'temples-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		array(
		'name'=>'id',
		'filter'=>false,
		 ),
		array(
		'name'=>'temple_name',
		'filter'=>false,
		 ),
		 
		   array(
		'name'=>'temple_deity',
		'filter'=>false,
		 ),
		 
		 array(
		'name'=>'category_id',
		'value'=>'$data->category->category_name',
		'filter'=>false,
		 ),

		/*array(
		'name'=>'main_image',
		 'type'=>'html',
            'value'=>'(!empty($data->main_image))?CHtml::image(Yii::app()->request->baseUrl."/temple_images/".$data->main_image,"",array("style"=>"width:50px;height:50px;")):"no image"',
		'filter'=>false,
		 ),*/
		  array(
		'name'=>'is_active',
		'value'=>'($data->is_active==1)?"Yes":"No"',
		'filter'=>false,
		 ),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{update}{delete}{gallery}{active}',
			'buttons' => array(
               'gallery' => array( //the name {reply} must be same
                 'label' => 'Gallery', // text label of the button
                   'url' => 'CHtml::normalizeUrl(array("temples/gallery/id/".$data->id))', //Your URL According to your wish
                      'imageUrl' => Yii::app()->baseUrl . '/images/gallery.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),
				'active' => array( //the name {reply} must be same
                 'label' => 'Activate/Inactivate', // text label of the button
                   'url' => 'CHtml::normalizeUrl(array("temples/status/id/".$data->id."/st/".$data->is_active))', //Your URL According to your wish
                      'imageUrl' => Yii::app()->baseUrl . '/images/status.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),
               ),
		),
	),
)); ?>
