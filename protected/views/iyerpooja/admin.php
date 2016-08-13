<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Iyer Pooja'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Iyer Pooja', 'url'=>array('create')),
);

?>

<h1>Manage Iyer Pooja</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(

	'dataProvider'=>$model->search(),
	'columns'=>array(
	
       array(

			'name'=>'id',

			'type'=>'raw',

			'value'=>'CHtml::encode($data->id)',

			'htmlOptions' => array('style' => 'width:250px; '),

		),
		
		 array(

			'name'=>'Category',
			'value'=>'Iyercategories::model()->getname($data->category_id)',
			'filter'=>CHtml::listData(Iyercategories::model()->findAll(), "id", "category_name"),
			'type'=>'raw',

		),
		
		array(

			'name'=>'pooja_name',

			'type'=>'raw',

			'value'=>'CHtml::encode($data->pooja_name)',

			'htmlOptions' => array('style' => 'width:250px; '),

		),

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>
