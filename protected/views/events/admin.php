<?php
/* @var $this TemplesController */
/* @var $model Temples */
$this->breadcrumbs=array(
	'Events'=>array('admin'),
	'Manage',
);
$this->menu=array(
	array('label'=>'Create Event', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#events-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Events</h1>
<style type="text/css">
.grid-view .button-column{ width:90px; }
</style>
<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>
<link rel="stylesheet" type="text/css" media="screen"     href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.min.css">
<?php  echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'events-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	
		array(
		'name'=>'event_id',
		'filter'=>false,
		),
		array(
		'name'=>'event_name',
		'filter'=>false,
		),
		
		array(
		'name'=>'event_start_date',
		'filter'=>false,
		),
		
		array(
		'name'=>'event_end_date',
		'filter'=>false,
		),
		
		array(
		'name'=>'event_address',
		'filter'=>false,
		),
		//'city_id',
		//'category_id',
		array(
		
		   'name'=>'event_content',

			'type'=>'raw',

			'value'=>'CHtml::encode(substr_replace(strip_tags($data->event_content),"...",50))',

			'htmlOptions' => array('style' => 'max-width:150px; overflow-x: auto'),
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
   <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/datetimepicker.js"></script>
	  <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/bootstrap.min.js"></script>
	
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
    });
  });
</script>
