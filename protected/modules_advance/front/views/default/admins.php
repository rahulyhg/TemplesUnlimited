<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Admins'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Admins</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Admins Listing
            <a href="<?php echo Yii::app()->controller->createUrl("create"); ?>" class="btn btn-primary pull-right"> Create New</a>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>





<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
       'columns'=>array(
	   'id',
	   'name',
	   'username',
	    array(
			'name' => 'role',
			'header'=>'Role', 
			'filter' => array('admin' => 'Admin', 'superadmin' => 'Super Admin'),
			'value' => '$data->role',
	   ),
	   'created',
			array(
				'header' => 'Actions',
				'htmlOptions' => array('style' => 'width: 85px'),
				'class' => 'CButtonColumn',
				'template' => ' {delete}',
				'buttons' => array(
					
					'delete' => array(
							  'url'=>'Yii::app()->controller->createUrl("deleteadmin",array("id"=>$data->primaryKey))',
					),
				)
			),		
    ),
)); ?>

			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>