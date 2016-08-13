<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Store Products'=>array('admin'),
	$model->product_name,
);

$this->menu=array(
	array('label'=>'Create Store Product', 'url'=>array('create')),
	array('label'=>'Update Store Product', 'url'=>array('update', 'id'=>$model->product_id)),
	/*array('label'=>'Delete Store Product', 'url'=>array('delete', 'id'=>$model->product_id)),*/
	array('label'=>'Manage Store Products', 'url'=>array('admin')),
);
?>

<h1>View Store Product #<?php echo $model->product_id; ?></h1>

<?php 
$productimagesstr = '<div class="">';
$productimages = $model->productimages;
foreach($productimages as $productimage){
   
    $productimagesstr .= '<div class="span3 thumbnail" id="imagelist'.$productimage->product_image_id.'"><a class="deleteqimage" href="javascript:void(0);" onclick="$(\'#imagelist'.$productimage->product_image_id.'\').remove();deletepimage(\'Storeproductsimages_product_image\',\''.$productimage->product_image_id.'\',\'2\')"></a>'.helpers::view_thumb($productimage->product_image).'</div>';
}
$productimagesstr .= '</div>';


if($model->product_have_variations=='1'){ 
           $options = $model->variations;
		
		   $option_price = '';
		    $option_shipping_price = '';
		   if(count($options)){
		      foreach($options as $option){
			 $option_price .= $option->product_variation_title.'&nbsp;-&nbsp;'.helpers::to_currency($option->product_price).'<br/>';
			  }
			   foreach($options as $option){
			 $option_shipping_price .= $option->product_variation_title.'&nbsp;-&nbsp;'.helpers::to_currency($option->product_shipping_price).'<br/>';
			  }
		   }
}else{
 $option_price = helpers::to_currency($model->product_price);
  $option_shipping_price = helpers::to_currency($model->product_shipping_price);
}
 ?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'product_name',
		'product_code',	
	    'phone_number',
		'location',	
	array(
		'name'=>'product_image',
		 'type'=>'html',
            'value'=>(!empty($model->product_image))?CHtml::image(Yii::app()->request->baseUrl.'/uploads/store/main_image/'.$model->product_image,"",array("style"=>"max-width:100%;")):"no image",
		),
		
		
		array(
            'name'=>'store_category_id',
			'value'=>$model->category->category_name,
        ),		
		
		
		array(
            'name'=>'payment_options',
            'value'=>$model->payment_options,
        ),	
		
		 
		
	 array(
			'header'=>' Delivery time (India)',
            'name'=>'delivery_time_1',
            'value'=>$model->delivery_time_1.' '.$model->delivery_time_1option,
        ),		
		
		 array(
			'header'=>' Delivery time (International)',
            'name'=>'delivery_time_2',
            'value'=>$model->delivery_time_2.' '.$model->delivery_time_2option,
        ),		
		
		
		array(
            'name'=>'product_price',
			'value'=>$option_price,
			 'type'=>'html',
        ),		
		array(
            'name'=>'product_shipping_price',
			'value'=> $option_shipping_price,
			 'type'=>'html',
        ),	
		
			array(
            'name'=>'is_active',
			'value'=>($model->is_active=='1')?'Active':'Inactive',
        ),	
		
		
		 array(
            'name'=>'created_on',
			'value'=>$model->created_on,
        ),		
		
		/* array(
	     	 'header'=>'Product images',
            'name'=>'created_on',
			'value'=>$productimagesstr,
			 'type'=>'html',
        ),		
		*/
		
		
		
		array(
            'name'=>'product_overview',
			'type'=>'html',
        ),		
		
	),
)); ?>
<!--<br/><h3>Product Images</h3>-->
<?php //echo $productimagesstr; ?>
