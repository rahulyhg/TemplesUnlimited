<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'Services'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Services', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create Service</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	   </div>
  </div>
</div>
