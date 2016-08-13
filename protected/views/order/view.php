<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('admin')),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php if($model->id!=''){

           $product = '';
		   
		    $mycart = MyCart::model()->findAll('order_id=:order_id',array(':order_id'=>$model->id));
			

			foreach($mycart as $mycart1){
			
			$product_name = Storeproducts::model()->find('product_id=:product_id',array(':product_id'=>$mycart1->product_id));
			 $product .= $product_name->product_name.'&nbsp;-&nbsp; Amount : &nbsp;&nbsp;'.helpers::to_currency($mycart1->amount).'&nbsp;,&nbsp; Shipping Amount :&nbsp;&nbsp;'.helpers::to_currency($mycart1->shipping_amount).'<br/>';
			  }      

}

 ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_name',
		
		array(
		     'name'=>'total_amount',
            'value'=>helpers::to_currency($model->total_amount),
			'filter'=>false,
		),
		
		array(
		     'name'=>'user_type',
            'value'=>($model->user_type=="0")? "Site User":"Non Site User" ,
			'filter'=>false,
		),
		array(
            'name'=>'Product Details',
			'value'=>$product,
			 'type'=>'html',
        ),	
		'status',
		'created',
	),
)); ?>
