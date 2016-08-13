<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Pooja'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create Pooja</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model,'poojaoptions'=>$poojaoptions)); ?>		
	   </div>
  </div>
</div>
