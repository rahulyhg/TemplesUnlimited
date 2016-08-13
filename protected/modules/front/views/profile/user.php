<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Profile - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<link rel="stylesheet"   href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet"   href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">

<?php if( Yii::app()->user->hasFlash('success')){ ?>
 <div class="flashmessage success">
	<button class="close" data-dismiss="alert">X</button>
	<p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
</div>
<?php } ?>

<?php

 
if($model->role=='4')
{
  $this->renderPartial('iyerdatails', array('model'=>$model)); 
}
else
{
 $this->renderPartial('maindetails', array('model'=>$model)); 
}
		
?>
</div>
<!---------two-third--------->

