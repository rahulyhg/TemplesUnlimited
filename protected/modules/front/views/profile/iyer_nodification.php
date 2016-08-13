<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Pooja - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/bootstrap.min.css' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>


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


<div class="tabbable" style="float:right;">
<ul class="nav nav-tabs"  id="myTab">
<li class="active"><a href="#pane1" data-toggle="tab" onclick="$('#tab').val('pane1');">Booking Notification</a></li>
<li><a href="#pane2" data-toggle="tab" onclick="$('#tab').val('pane2');">Queries Notification</a></li>
</ul>
</div>


<div class="tab-content" >

<div id="pane1" class="tab-pane active">

<div class="">

<h3>Notifications (<?php echo count($count_notify);  ?>)</h3>

<div class="rule"></div>

<?php 
$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$iyernodification,
			'emptyText' => "We're sorry, no notifications found.",
			'itemView'=>'iyerbooked_nodification',
			'template'=>'{items}{pager}',
		));
?>
</div>
</div>

<div id="pane2" class="tab-pane">
<div class="">
<h3>Notifications (<?php echo count($queries_nodify);  ?>)</h3>

<div class="rule"></div>

<?php 
$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$queries_notification,
			'emptyText' => "We're sorry, no notifications found.",
			'itemView'=>'iyernodification',
			'template'=>'{items}{pager}',
		));
?>
</div>
<div class="rule"></div>
</div>
</div>
</div>

<style>
.list-view .pager {
    margin: 11px 16px 0;
    text-align: right;
}
ul.yiiPager a:link {
    color: #404040 !important;
}
ul.yiiPager a:link, ul.yiiPager a:visited {
    border: 1px solid #9aafe5;
    color: #404040;
    padding: 4px 12px;
    text-decoration: none;
}
.pager .previous > a, .pager .previous > span {
    float: none;
}
.pager li > a, .pager li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0px;
    display: inline-block;
    padding: 5px 14px;
}
.pager .next > a, .pager .next > span {
    float: none;
}

.wpcf7 input {
    background: none repeat scroll 0 0 #ffffff;
    border: 2px solid #e8e8e8;
    color: #666666;
    display: block;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    padding: 10px 8px;
    height:40px;
}
</style>
