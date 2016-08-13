<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Temples'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Temples', 'url'=>array('index')),
	array('label'=>'Manage Temples', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create Temple</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>		
	   </div>
  </div>
</div>
