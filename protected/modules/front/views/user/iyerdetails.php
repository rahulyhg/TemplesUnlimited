<link rel='stylesheet'   href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap_custom.css' type='text/css' media='all' />
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


<div class="sc-column sc-column-last" >

<div class="Iyerdetailsform">



<h3>Iyer Details</h3>
<div class="rule"></div>
<br>

		<?php $this->renderPartial('_iyerdetailsform', array('model'=>$model,'iyer'=>$iyer)); ?>		
        
        <div style="clear:both;"></div>

          </div>

</div>
