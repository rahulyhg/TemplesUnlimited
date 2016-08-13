<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Pooja - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/bootstrap.min.css' type='text/css' media='all' />

<!-----one-third------->
<?php  $this->renderPartial('./profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">

<?php if( Yii::app()->user->hasFlash('success')){ ?>
 <div class="flashmessage success">
	<button class="close" data-dismiss="alert">X</button>
	<p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
</div>
<?php } ?>

<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">


<?php   $this->renderPartial('guidetemple/_form', array('model'=>$model,'guideactivities'=>$guideactivities)); ?>

</div>
</div>
<style>
table.detail-view {
    background: none repeat scroll 0 0 white;
    border-collapse: collapse;
    margin: 0;
    width: 80%;
	margin-left:20px;
}
</style>
