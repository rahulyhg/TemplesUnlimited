<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	$model->ptitle=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('admin')),
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>
<!--
<h1>Update Page <?php echo $model->id; ?></h1>-->
<div class="box" id="box-5">
  <h4 class="box-header round-top">Update Page</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
   </div>
  </div>
</div>
