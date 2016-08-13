<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Store Products'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Store Products', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create Store Product</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model,'productimages'=>$productimages,'productimagesarr'=>$productimagesarr,'productvariations'=>$productvariations,)); ?>		
	   </div>
  </div>
</div>
