<style type="text/css">
.itemdetails_li {
    width: 100%;
}
.deliveryitemslist {
    padding: 20px 0;
}

.quoteotherdetails {
    padding: 30px 0;
}
.form-horizontal .controls {
    margin-top: 5px;
}
</style>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Quotes</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Quote Details
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->controller->createUrl('//admin//delivery/view/id/'.$model->delivery_id); ?>" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content"><?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Quotes'=>array('index'),
	$model->quote_id,
);


?>

<h1>View quote #<?php echo $model->quote_id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'quote_id',
		array(
		'label'=>'Delivery Title',
		'value'=>CHtml::link(Deliveries::model()->rendertitle($model->delivery), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$model->delivery_id),array("target"=>"_blank")),
		'type'=>'raw',
		),  
		array(
		'label'=>'Quote Owner',
		'value'=>User::model()->username($model->provider),
		'type'=>'raw',
		),
		
		array(
		'label'=>'Delivery Owner',
		'value'=>User::model()->username($model->delivery->deliveryuser),
		'type'=>'raw',
		),
		array(
		'label'=>'Placed on',
		'value'=>$model->created_date,
		'type'=>'raw',
		),
		'vehicle_type',
		array(
		'label'=>'collection flexible',
		'value'=>($model->collection_flexible=='1')?'Yes':'No',
		'type'=>'raw',
		),
		array(
		'label'=>'Delivery flexible',
		'value'=>($model->delivery_flexible =='1')?'Yes':'No',
		'type'=>'raw',
		),
		
		array(
		'label'=>'Expired On',
		'value'=>($model->expiry_date !='1')?'0000-00-00':'Not Specified',
		'type'=>'raw',
		),
		
		array(
		'label'=>'Additional information',
		'value'=>$model->additional_info,
		'type'=>'raw',
		),
		
		array(
		'label'=>'Net Quote',
		'value'=>helpers::to_currency($model->net_quote),
		'type'=>'raw',
		),
		
		array(
		'label'=>'Minimum Amount',
		'value'=>helpers::to_currency($model->minimum_amount),
		'type'=>'raw',
		),
		
		array(
		'label'=>'Status',
		'value'=>Quotes::model()->get_status($model),
		'type'=>'raw',
		),
	
	
	),
)); ?>
<div style="clear:both;"></div>
<div class="quoteotherdetails">

<?php $deliveries = $model->delivery; 
	
    $accepteddetails = Accepted::model()->find('delivery_id=:delivery_id',array(':delivery_id'=>$deliveries->id)); 
    if(count($accepteddetails) && isset($accepteddetails->quotedetails)  && count($accepteddetails->quotedetails) && $deliveries->status == '3'){
   
      $this->renderPartial('deliverydetails',array(
				 'accepteddetails'=>$accepteddetails,
				 'deliveries'=>$deliveries,
			)); 
			
   
	 } ?>

</div>

<div style="clear:both;"></div>

 
 <div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
