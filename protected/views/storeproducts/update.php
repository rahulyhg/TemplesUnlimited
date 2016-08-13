<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Store Products'=>array('admin'),
	$model->product_name=>array('view','id'=>$model->product_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Store Product', 'url'=>array('create')),
	array('label'=>'View Store Product', 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>'Manage Store Products', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Update Store Product <?php echo $model->product_id; ?></h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', 
		array(		'model'=>$model,
			'productimages'=>$productimages,
			'productimagesarr'=>$productimagesarr,
			'productimagesalready'=>$productimagesalready,
			'productvariations'=>$productvariations,
			)); ?>
	  </div>
   </div>
</div>
