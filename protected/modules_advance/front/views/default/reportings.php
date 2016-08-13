<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#report-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<!-- set up the modal to start hidden and fade in and out -->

<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Reportings</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Reportings Listing
             <?php if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
					 echo CHtml::link('Delete All', Yii::app()->controller->createUrl('//admin/default/deletereportall'),array('class'=>'btn btn-danger pull-right','style'=>'margin-right:20px;'));
					 } ?>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'report-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'report_id',
		
		
		array( 
		'name'=>'report_data_type',
		'header'=>'Type', 
		'filter' => array('quote_additional_info' => 'quote_additional_info','message' => 'message','question' => 'question', 'answer' => 'answer', 'profile' => 'profile'),
		'value'=>'$data->report_data_type',
		),
		
		array( 
		'name'=>'report_data_id',
		'header'=>'Data ID', 
		'value'=>'$data->report_data_id',
		'filter'=>false,
		),
		
		array( 
		'name'=>'report_data_owner',
		'header'=>'Reported User', 
		'value'=>'User::model()->username($data->reported_user_details)',
		'type'=>'raw',
		'filter'=>false,
		),
		
		array( 
		'name'=>'report_data_content',
		'header'=>'Reported Content', 
		'value'=>'$data->report_data_content',
		),
		
		
		array( 
		'name'=>'report_status',
		'header'=>'Status', 
		'filter' => array('white' => 'white','yellow' => 'yellow','green' => 'green', 'red' => 'red'),
		'value'=>'$data->report_status',
		),
		
		array( 
		'name'=>'created_on',
		'header'=>'Reported On', 
		'value'=>'$data->created_on',
		'filter'=>false,
		),
		
		
		 array(
        'header' => 'Actions',
        'value'=>'$data->getaction($data->report_status,$data->report_id)', 
		'type'=>'raw',   
       ),
	   array(
				'header' => '',
				'htmlOptions' => array('style' => 'width: 85px'),
				'class' => 'CButtonColumn',
				'template' => '{delete}',
				'buttons' => array(
					
					'delete' => array(  
					   'url'=>'Yii::app()->controller->createUrl("deletereport",array("id"=>$data->primaryKey))',
                       'options'=>array('class'=>'superadmin_only_Access'),

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
	<script type="text/javascript">
	function onChangeaction(value,id){
	  $.get(SITE_BASE_URL+'/index.php/common/update_report_status', { status:value,id:id },function(data){
			            $.fn.yiiGridView.update("report-grid");												
	   });
	
	}
	</script>