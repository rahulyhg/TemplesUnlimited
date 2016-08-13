<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Iyer Details',
);

$this->menu=array(
	//array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Guide Details</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<?php $this->renderPartial('_iyerdetailsform', array('model'=>$model,'iyer'=>$iyer)); ?>		
	   </div>
  </div>
</div>
