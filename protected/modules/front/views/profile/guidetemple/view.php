<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Pooja - '.$model->first_name.' '.$model->last_name,
);


$guide_profile_dtails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$guideactivities->user_id));	

$this->menu=array(
);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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



<?php 
$guideactivities->activity_language = explode(',',$guideactivities->activity_language); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($guideactivities->activity_language),'language_id','language_name'));


$activity_title =  $guideactivities->activity_title ;
 ?>


<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">


<h1 style="margin:30px;">View Temple #<?php echo $guideactivities->activity_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$guideactivities,
	'attributes'=>array(
		/*array(
			'name'=>'Category',
			'value'=>Guidecategories::model()->getname($guideactivities->category_id),
			'type'=>'raw',
		),*/
		
		'category_id',

		array(
			'name'=>'Temple Name',
			'value'=>$activity_title,
			'type'=>'raw',
		),
		
		'activity_description',
		array(
			'name'=>'Activity Language',
			'value'=>$secondarylanguages,
			'type'=>'raw',
		),
		
		array(
			'name'=>'activity_duration',
			'value'=>$guideactivities->activity_duration.' '.$guideactivities->duration_time_type,
			'type'=>'raw',
		),
	     'amount',
		 'discount',
		array(
			'name'=>'discount_percentage',
			'value'=>($guideactivities->discount_percentage!='')?$guideactivities->discount_percentage.'%':'Nil',
			'type'=>'raw',
		),
		
		array(
			'name'=>'discount_dates_from',
			'value'=>($guideactivities->discount_dates_from!='')?$guideactivities->discount_dates_from:'Nil',
			'type'=>'raw',
		),
		
		array(
			'name'=>'discount_dates_to',
			'value'=>($guideactivities->discount_dates_to!='')?$guideactivities->discount_dates_to:'Nil',
			'type'=>'raw',
		),
		

		
	),
)); ?>
	
<div class="row buttons" style="margin:30px;">
<button class="btn  btn-large" onclick="window.location.href ='<?php echo CController::CreateUrl('profile/guidetemple'); ?>'" type="button">Back</button>
</div>

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
