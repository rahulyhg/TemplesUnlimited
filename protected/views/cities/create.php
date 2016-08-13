<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Cities', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create City</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	  </div>
  </div>
</div>
