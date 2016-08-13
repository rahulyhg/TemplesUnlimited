<link rel='stylesheet'   href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap_custom.css' type='text/css' media='all' />
<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Guide Details',
);

$this->menu=array(
	//array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>

<div class="sc-column sc-column-last" >

<div class="guidedetailsform">



<h3>Guide Details</h3>
<div class="rule"></div>
<br>
<?php $this->renderPartial('_guidedetailsform', array('model'=>$model,'guide'=>$guide)); ?>		
<div style="clear:both;"></div>
          </div>
</div>
