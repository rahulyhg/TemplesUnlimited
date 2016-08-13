<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'Languages'=>array('admin'),
	$model->language_name=>array('#'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Language', 'url'=>array('create')),
	array('label'=>'Manage Languages', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Update Language <?php echo $model->language_name; ?></h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	  </div>
   </div>
</div>
