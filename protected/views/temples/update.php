<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Temples'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Temples', 'url'=>array('index')),
	array('label'=>'Create Temple', 'url'=>array('create')),
	array('label'=>'View Temple', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Temples', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Update Temple <?php echo $model->id; ?></h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	  </div>
   </div>
</div>
