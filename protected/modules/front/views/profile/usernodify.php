<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Pooja - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>

<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">

<?php if( Yii::app()->user->hasFlash('success')){ ?>
 <div class="flashmessage success">
	<button class="close" data-dismiss="alert">X</button>
	<p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
</div>
<?php } ?>
<?php   //$this->renderPartial('iyernodification', array('model'=>$model)); ?>	

<div class="tab-content" >

<div id="pane1" class="tab-pane active">

<div class="">

<h3>Notifications (<?php echo count($result);  ?>)</h3>

<div class="rule"></div>

<?php 
$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$user_notification,
			'emptyText' => "We're sorry, no notifications found.",
			'itemView'=>'user_nodification',
			'template'=>'{items}{pager}',
		));
?>
</div>
</div>
</div>
</div>
