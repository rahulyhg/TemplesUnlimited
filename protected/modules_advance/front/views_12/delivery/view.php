<style type="text/css">
.itemdetails_li {
    width: 100%;
}
.deliveryitemslist {
    padding: 20px 0;
}
</style>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Delivery</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Delivery Details
            <?php if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
					 echo CHtml::link('Delete', Yii::app()->controller->createUrl('//admin/delivery/deletedelivery/id/'.$model->id),array('class'=>'btn btn-danger pull-right','style'=>'margin-right:20px;'));
					 } ?>
					 
					 <?php if($model->status == '1'){ ?>
&nbsp;<?php echo CHtml::ajaxLink(($model->upgraded == '0')?'Make Featured':'Make Unfeatured', Yii::app()->controller->createUrl('//admin/delivery/featurestatus'),array('type' =>'GET','data' =>array( 'id' => $model->id,'status' => $model->upgraded),'success'=>'js:function(data){ window.location.reload(); }'),array('class'=>'btn btn-success pull-right','style'=>'margin-right:20px;')); ?>&nbsp;					 
               <?php } ?>
			
			<div class="btn-group" style="float:right; margin-right:10px;margin-top:3px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->controller->createUrl('//admin/delivery/admin'); ?>" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
			
			
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content"><?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Deliveries'=>array('index'),
	$model->id,
);


?>

<h1>View Delivery #<?php echo $model->id; ?></h1>
<?php $deliveryimages = $model->deliveryimages;
      $deliveryimages = array_values($deliveryimages);
	  $deliveryimageslist = '';
	  if(isset($deliveryimages) && count($deliveryimages)){ 
	    $deliveryimagescount = 1;
		foreach($deliveryimages as $deliveryimage){ 
		if(trim($deliveryimage->iimage) != '' && $deliveryimagescount <=5){ $deliveryimagescount++; 
		$deliveryimageslist .= '<img width="100px;" height="100px" src="'.Yii::app()->request->baseUrl.'/'.$deliveryimage->iimage.'">&nbsp;&nbsp;';
		 }	
		  } }
	 
	  $earliest_pickup = '';	
	  $latest_pickup = '';	  
	  if(($model->col_epickup != '' && $model->col_epickup != '0000-00-00' ) || ($model->del_epickup != '' && $model->del_epickup != '0000-00-00')){ 
			 if($model->col_epickup != '' && $model->col_epickup != '0000-00-00'){  $earliest_pickup .= 'From '.$model->col_epickup; } 
			 if($model->del_epickup != '' && $model->del_epickup != '0000-00-00'){ $earliest_pickup .=' To '.$model->del_epickup; } 
      } 	
	  
	  
	  if(($model->col_lpickup != '0000-00-00' && $model->col_lpickup != '') || ($model->del_lpickup != '' && $model->del_lpickup != '0000-00-00')){ 
		 if($model->col_lpickup != '0000-00-00' && $model->col_lpickup != ''){ $latest_pickup .= 'From '.$model->col_lpickup; }
		 if($model->del_lpickup != '' && $model->del_lpickup != '0000-00-00'){  $latest_pickup .= ' To '.$model->del_lpickup; } 
      }  
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
		'label'=>'Title',
		'value'=>Deliveries::model()->rendertitle($model),
		'type'=>'raw',
		),  
		array(
		'label'=>'Quotes',
		'value'=>CHtml::link( Deliveries::model()->quotecount($model->id), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$model->id),array("target"=>"_blank")),
		'type'=>'raw',
		), 
		array(
		'label'=>'Pick Up',
		'value'=>Deliveries::model()->getcollectionaddress($model),
		'type'=>'raw',
		),
		array(
		'label'=>'Delivery',
		'value'=>Deliveries::model()->getdeliveryaddress($model),
		'type'=>'raw',
		),  
		array(
		'label'=>'Posted',
		'value'=>date("d/m/Y",strtotime($model->created)),
		'type'=>'raw',
		),  
		array(
		'label'=>'Status',
		'value'=>Deliveries::model()->getstatus($model->status),
		'type'=>'raw',
		),  
		
		array(
		'label'=>'Images',
		'value'=>$deliveryimageslist,
		'type'=>'raw',
		), 
		array(
		'label'=>'Distance',
		'value'=>helpers::metertokilometer($model->distance).' KM' ,
		'type'=>'raw',
		),
		'duration',
		array(
		'label'=>'Earliest Pickup',
		'value'=>$earliest_pickup ,
		'type'=>'raw',
		),
		array(
		'label'=>'Latest Pickup',
		'value'=>$latest_pickup,
		'type'=>'raw',
		),
		
		array(
		'label'=>'Owner',
		'value'=>User::model()->username($model->deliveryuser),
		'type'=>'raw',
		),
		'created',
	),
)); ?>
<div style="clear:both;"></div>
<div class="deliveryitemslist span12">
<?php 
if(isset($model->deliveryitems) && count($model->deliveryitems) && isset($model->deliveryitems[0]) && count($model->deliveryitems[0]))
$deliveryitems = $model->deliveryitems[0];
else
$deliveryitems = array();
 echo Deliveries::model()->delivery_item_details($deliveryitems); ?>
</div>

<div style="clear:both;"></div>
<br/>
<h4 class="admin_list_title">Delivery Quotes</h4>
<hr/>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>Quotes::model()->deliveryquotesearch($model->id),
	//'itemsCssClass' => 'table reviewslist',
       'columns'=>array(
	           'quote_id',
                array(
                    'name'=>'id',
                    'header'=>'Item',
                    'value'=>'CHtml::link(Deliveries::model()->rendertitle($data->delivery), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$data->delivery_id),array("target"=>"_blank"))',
					'filter'=>false,
					'type'  => 'raw',
					'htmlOptions'=> array(),
                    ),
				array(
					'header'=>'Total Quotes',
                    'value'=>'CHtml::link( Deliveries::model()->quotecount($data->delivery_id), Yii::app()->controller->createUrl("//admin/delivery/view/id/".$data->delivery_id),array("target"=>"_blank"))',
                    'htmlOptions'=>array('style'=>'text-align:center'),
					'type'  => 'raw',
                ),
                array(
                    'header'=>'My Net Quote',
                    'value'=>'helpers::to_currency($data->net_quote)',
					'filter'=>false,
					'type'  => 'raw',
                    ),
				 array(
                    'header'=>'Placed By',
                    'value'=>'User::model()->username($data->provider);',
					'filter'=>false,
					'type'  => 'raw',
                    ),	
				array(
                    'header'=>'Status',
                    'value'=>'Quotes::model()->get_status($data)',
					'filter'=>false,
                    ),
			array(
                    'name'=>'created_date',
                    'header'=>'Placed On',
                    'value'=>'date("d/m/Y",strtotime($data->created_date))',
					'filter'=>false,
                    ),				
            array(
				'header' => 'Actions',
				'htmlOptions' => array('style' => 'width: 85px'),
				'class' => 'CButtonColumn',
				'deleteConfirmation'=>'Are You Sure?',
				'template' => '{view}',
				'buttons' => array(
					'view' => array(
							  'url'=>'Yii::app()->controller->createUrl("viewquote",array("id"=>$data->primaryKey))',
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