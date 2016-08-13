<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#transaction-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


Yii::app()->clientScript->registerScript('search1', "
$('.upgrade-search-button').click(function(){
	$('.upgrade-search-form').toggle();
	return false;
});
$('.upgrade-search-form form').submit(function(){
	$('#upgrade-transaction-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<!-- set up the modal to start hidden and fade in and out -->

<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Transactions</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Transactions Listing
            <?php if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
					 echo CHtml::link('Delete All', Yii::app()->controller->createUrl('//admin/default/deletetransactionall'),array('class'=>'btn btn-danger pull-right','style'=>'margin-right:20px;'));
					 } ?>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<h5>Job Complete Transactions</h5>
<?php 
echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_transactionsearch',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transaction-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		array( 
		'name'=>'tranID',
		'header'=>'ID', 
		'value'=>'$data->tranID',
		),
		
		
	/*	array( 
		'name'=>'orderid',
		'header'=>'Invoice ID', 
		'value'=>'$data->orderid',
		),
		*/
		array( 
		'name'=>'accept_id',
		'header'=>'Item', 
		'value'=>'CHtml::link(Deliveries::model()->rendertitle($data->transactionaccepted->delivery), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$data->transactionaccepted->delivery_id),array("target"=>"_blank"))',
		'type'=>'raw',
		'filter'=>false,
		),
		
		array( 
		'name'=>'amount',
		'header'=>'Amount', 
		'value'=>'helpers::to_currency($data->amount)',
		'filter'=>false,
		),
		
		array( 
		'name'=>'deduction',
		'header'=>'Deduction', 
		'value'=>'helpers::to_currency($data->deduction)',
		'filter'=>false,
		),
		
		array( 
		'name'=>'status',
		'header'=>'Status', 
		'filter' => array('00' => 'Success','22' => 'Pending'),
		'value'=>'($data->status=="00")?"Success":"Pending"',
		),
		
		array( 
		'name'=>'accept_id',
		'header'=>'User', 
		'value'=>'User::model()->username($data->transactionaccepted->deliveryowner)',
		'type'=>'raw',
		'filter'=>false,
		),
		
		array( 
		'name'=>'paydate',
		'header'=>'Paid On', 
		'value'=>'$data->paydate',
		'filter'=>false,
		),
		array(
				'header' => 'Actions',
				'htmlOptions' => array('style' => 'width: 85px'),
				'class' => 'CButtonColumn',
				'template' => '{delete}',
				'buttons' => array(
					
					'delete' => array(  
					   'url'=>'Yii::app()->controller->createUrl("deletetransaction",array("id"=>$data->primaryKey))',
                       'options'=>array('class'=>'superadmin_only_Access'),

					),
				)
			
			),		
		
		
		
		
		
	),
)); ?>

			<div style="clear:both; height:50px;"></div>
			<h5>Job Upgrade Transactions</h5>
			
			<?php 
echo CHtml::link('Advanced Search','#',array('class'=>'upgrade-search-button')); ?>
<div class="upgrade-search-form" style="display:none">
<?php $this->renderPartial('_transactionsearch',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'upgrade-transaction-grid',
	'dataProvider'=>$model->upgrade_trans_search(),
	'filter'=>$model,
	'columns'=>array(
		
		array( 
		'name'=>'tranID',
		'header'=>'ID', 
		'value'=>'$data->tranID',
		),
		
		
	/*	array( 
		'name'=>'orderid',
		'header'=>'Invoice ID', 
		'value'=>'$data->orderid',
		),
		*/
		array( 
		'name'=>'accept_id',
		'header'=>'Item', 
		'value'=>'CHtml::link(Deliveries::model()->rendertitle(Deliveries::model()->findByPK($data->accept_id)), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$data->accept_id),array("target"=>"_blank"))',
		'type'=>'raw',
		'filter'=>false,
		),
		
		array( 
		'name'=>'amount',
		'header'=>'Amount', 
		'value'=>'helpers::to_currency($data->amount)',
		'filter'=>false,
		),
		
		array( 
		'name'=>'deduction',
		'header'=>'Deduction', 
		'value'=>'helpers::to_currency($data->deduction)',
		'filter'=>false,
		),
		
		array( 
		'name'=>'status',
		'header'=>'Status', 
		'filter' => array('00' => 'Success','22' => 'Pending'),
		'value'=>'($data->status=="00")?"Success":"Pending"',
		),
		
		array( 
		'name'=>'accept_id',
		'header'=>'User', 
		'value'=>'User::model()->username(Deliveries::model()->findByPK($data->accept_id)->deliveryuser)',
		'type'=>'raw',
		'filter'=>false,
		),
		
		array( 
		'name'=>'paydate',
		'header'=>'Paid On', 
		'value'=>'$data->paydate',
		'filter'=>false,
		),
		array(
				'header' => 'Actions',
				'htmlOptions' => array('style' => 'width: 85px'),
				'class' => 'CButtonColumn',
				'template' => '{delete}',
				'buttons' => array(
					
					'delete' => array(  
					   'url'=>'Yii::app()->controller->createUrl("deletetransaction",array("id"=>$data->primaryKey))',
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