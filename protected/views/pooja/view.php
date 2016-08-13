<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Pooja'=>array('index'),
	$model->pooja_name,
);

$this->menu=array(
	array('label'=>'Create Pooja', 'url'=>array('create')),
	array('label'=>'Update Pooja', 'url'=>array('update', 'id'=>$model->pooja_id)),
	/*array('label'=>'Delete Pooja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pooja_id),'confirm'=>'Are you sure you want to delete this item?')),*/
	array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>

<h1>View Pooja #<?php echo $model->pooja_id; ?></h1>
<?php if($model->pooja_have_options=='1'){
           $options = $model->poojaoptions;
		   $option_price = '';
		    $option_shipping_price = '';
		   if(count($options)){
		      foreach($options as $option){
			 $option_price .= $option->option_desc.'&nbsp;-&nbsp;'.helpers::to_currency($option->option_price).'<br/>';
			  }
			   foreach($options as $option){
			 $option_shipping_price .= $option->option_desc.'&nbsp;-&nbsp;'.helpers::to_currency($option->option_shipping_price).'<br/>';
			  }
		   }
}else{
 $option_price = helpers::to_currency($model->pooja_price);
  $option_shipping_price = helpers::to_currency($model->pooja_shipping_price);
}
if($model->payment_options && trim($model->payment_options) != ''){
		$model->payment_options = unserialize($model->payment_options);
		}
 ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pooja_id',
		'pooja_name',
		'pooja_code',
/*	array(
		'name'=>'pooja_image',
		 'type'=>'html',
            'value'=>(!empty($image))?CHtml::image(Yii::app()->request->baseUrl.'/'.$image,"",array("style"=>"max-width:100%;")):"no image",
		),*/
		'phone_number',
		'pooja_address',
		
			
		
		 array(
            'name'=>'pooja_city',
            'value'=>($model->pooja_city!='0')?$model->poojacity->name:'Nil',
        ),	
		
		 array(
            'name'=>'pooja_state',
            'value'=>$model->poojastate->state_name,
        ),		
		
	  array(
            'name'=>'payment_options',
            'value'=>implode('; ',$model->payment_options),
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
			'header'=>' Pooja has multiple options',
            'name'=>'pooja_have_options',
            'value'=>($model->pooja_have_options=='1')?'Yes':'No',
        ),	
		
		array(
            'name'=>'pooja_image',
            'value'=>(!empty($model->pooja_image))?CHtml::image(Yii::app()->request->baseUrl."/uploads/pooja/main_image/".$model->pooja_image,"",array("style"=>"max-width:500px;")):"no image",
			'type'=>'html',
        ),		
		
		
		
		array(
            'name'=>'pooja_price',
			'value'=>$option_price,
			 'type'=>'html',
        ),		
		array(
            'name'=>'pooja_shipping_price',
			'value'=>$option_shipping_price,
			 'type'=>'html',
        ),	
		
		
		
		array(
            'name'=>'pooja_overview',
			'type'=>'html',
        ),		
		
	),
)); ?>

<?php 
/*$productimagesstr = '<div class="">';
$productimages = Images::model()->get_image_all('pooja',$model->pooja_id);  ;
foreach($productimages as $productimage){
   $productimagesstr .= '<div class="span3 thumbnail" id="imagelist'.$productimage->image_id.'"><a class="deleteqimage" href="javascript:void(0);" onclick="$(\'#imagelist'.$productimage->image_id.'\').remove();deletepoojaimage(\'Pooja_pooja_image\',\''.$productimage->image_id.'\',\'2\')"></a>'.helpers::view_thumb($productimage->image_path).'</div>';
}
$productimagesstr .= '</div>';*/
 ?>
<?php //echo $productimagesstr; ?>
