<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Pooja'=>array('index'),
	$model->pooja_name=>array('view','id'=>$model->pooja_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Pooja', 'url'=>array('create')),
	array('label'=>'View Pooja', 'url'=>array('view', 'id'=>$model->pooja_id)),
	array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Update Pooja <?php echo $model->pooja_id; ?></h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model,	'poojaoptions'=>$poojaoptions,)); ?>
	  </div>
   </div>
</div>
