<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Create Page</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">

<?php $this->renderPartial('_form', array('model'=>$model)); ?>   
</div>
  </div>
</div>
