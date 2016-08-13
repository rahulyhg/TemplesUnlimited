<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Pooja Categories'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Pooja Categories', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create Pooja Category</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	  </div>
  </div>
</div>
