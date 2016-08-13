<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Deliveries'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#delivery-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Deliveries</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Delivery Listing
		   <?php if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
 echo CHtml::link('Delete All', Yii::app()->controller->createUrl('//admin/delivery/deletedeliveryall'),array('class'=>'btn btn-danger pull-right','style'=>'margin-right:20px;')); 
            }?>
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


<?php $this->widget('zii.widgets.grid.CGridView', array(
     'id'=>'delivery-grid',
    'dataProvider'=>$model->allsearch(),
	'filter'=>$model,
       'columns'=>array(
	   'id',
                array(
                    'name'=>'title',
                    'header'=>'Item',
                    'value'=>'CHtml::link(Deliveries::model()->rendertitle($data), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$data->id),array("target"=>"_blank"))',
					'type'  => 'raw',
					'htmlOptions'=> array(),
                    ),
				array(
					'header'=>'Quotes',
                    'value'=>'CHtml::link( Deliveries::model()->quotecount($data->id), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$data->id),array("target"=>"_blank"))',
                    'htmlOptions'=>array('style'=>'text-align:center'),
					'type'  => 'raw',
                ),
                array(
                    'name'=>'col_country',
                    'header'=>'Pick Up',
                    'value'=>'Deliveries::model()->getcollectionaddress($data)',
					'filter'=>false,
					'type'  => 'raw',
                    ),
				array(
                    'name'=>'del_country',
                    'header'=>'Delivery',
                    'value'=>'Deliveries::model()->getdeliveryaddress($data)',
					'filter'=>false,
                    ),
				array(
                    'name'=>'status',
                    'header'=>'Status',
                    'value'=>'Deliveries::model()->getstatus($data->status)',
					'filter' => array('1'=>'Active','0'=>'Expired','3'=>'Success','2'=>'Accepted','8'=>'Deleted','9'=>'Removed'),
                    ),		
			array(
                    'name'=>'created',
                    'header'=>'Posted',
                    'value'=>'date("d/m/Y",strtotime($data->created))',
					'filter'=>false,

                    ),	
			array(
				'header' => 'Actions',
				'htmlOptions' => array('style' => 'width: 85px'),
				'class' => 'CButtonColumn',
				'template' => '{view} {delete}',
				'buttons' => array(
					'view' => array(
							  'url'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))',
					),
					'delete' => array(  
					   'url'=>'Yii::app()->controller->createUrl("deletedelivery",array("id"=>$data->primaryKey))',
                       'options'=>array('class'=>'superadmin_only_Access'),

					),
				)
			
			),		
               
    ),
)); 




?>

			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
