<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	User::model()->getrole($model->role),
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

<h1>Manage <?php echo User::model()->getrole($model->role); ?>s</h1>
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
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		'name'=>'user_id',
		'filter'=>false,
		 ),
		 array(
		'name'=>'first_name',
		 'filter'=>false,
		 ),
		 array(
		'name'=>'last_name',
		 'filter'=>false,
		 ),
		 array(
		'name'=>'email',
		 'filter'=>false,
		 ),
		 array(
		'name'=>'role',
		 'filter'=>false,
		 ),
		  array(
		'name'=>'status',
		'value'=>'($data->status=="1")?"Active":"Inactive"',
		 'filter'=>false,
		 ),
		 
		  array(
		'name'=>'registration_completed',
		'value'=>'($data->registration_completed=="1")?"Yes":"No"',
		 'filter'=>false,
		 ),
		 
		 
		 array(
		'name'=>'verified',
		'value'=>'($data->verified=="0")?"Verified":"Unverified"',
		'filter'=>false,
		),
		  array(
		'name'=>'created_on',
		 'filter'=>false,
		 ),
		
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{activate}{verified}{delete}',
			'buttons' => array(
			        'activate'=>array(
						'label' => 'Activate/Deactivate', // text label of the button
					   'url' => 'CHtml::normalizeUrl(array("user/status/id/".$data->user_id."/st/".$data->status))', //Your URL According to your wish
                       'imageUrl' => Yii::app()->baseUrl . '/images/status.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
					),
					'verified'=>array(
						'label' => 'Verified/Unverified', // text label of the button
					   'url' => 'CHtml::normalizeUrl(array("user/verified/id/".$data->user_id."/st/".$data->verified))', //Your URL According to your wish
                       'imageUrl' => Yii::app()->baseUrl . '/images/verified-icon.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
					),
			),
		),
	),
)); 
 ?>
