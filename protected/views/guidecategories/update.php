<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Guide Categories'=>array('index'),
	$model->category_name=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Guide Category', 'url'=>array('create')),
	array('label'=>'Manage Guide Categories', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Update Guide Category <?php echo $model->category_name; ?></h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	  </div>
   </div>
</div>
