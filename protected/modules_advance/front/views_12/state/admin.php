<?php
/* @var $this StateController */
/* @var $model State */

$this->breadcrumbs=array(
	'States'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List State', 'url'=>array('index')),
	array('label'=>'Create State', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#state-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage States</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;State Listing
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="#" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-cog icon-white"></i>&nbsp;Action</a> <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret" style="padding-bottom:1px;"></span></a>
              <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/state/create"><i class="icon-plus"></i> Add new state</a></li>
              </ul>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">


<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'state-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'country_id',
		array( 
		'name'=>'country_id',
		'header'=>'Country', 
		'value'=>'$data->country->name',
		'filter'=>CHtml::listData(Country::model()->findall(),'id','name' ),
		/*//'filter'=>CHtml::dropDownList('State[country_id]','',CHtml::listData(Country::model()->findall(), 'id', 'name')
		 //,array('prompt' => '-- Select Country--'),array('options'=>array('$data->country->name'=>'selected'))
		//),*/
		),
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<!-- <div class="pagination" style="float:right;">
              <ul>
                <li class="disabled"><a href="#">&laquo; Previous</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">Next &raquo;</a></li>
              </ul>
            </div>-->
			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>