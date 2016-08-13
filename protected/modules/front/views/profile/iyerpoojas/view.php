<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Pooja - '.$model->first_name.' '.$model->last_name,
);


$iyer_profile_dtails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$iyerpoojas->user_id));	

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

<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">


<h1 style="margin:30px;">View Pooja #<?php echo $iyerpoojas->id; ?></h1>

<?php 
$iyerpoojas->mantra_language = explode(',',$iyerpoojas->mantra_language); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($iyerpoojas->mantra_language),'language_id','language_name'));
 ?>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$iyerpoojas,
	'attributes'=>array(
		array(
			'name'=>'Category',
			'value'=>Iyercategories::model()->getname($iyerpoojas->category_id),
			'type'=>'raw',
		),
		'pooja_name',
		'description',
		array(
			'name'=>'Mantra Language',
			'value'=>$secondarylanguages,
			'type'=>'raw',
		),
		array(
			'name'=>'amount_with_items',
			'value'=>$iyerpoojas->duration.' '.$iyerpoojas->duration_time_type,
			'type'=>'raw',
		),
		array(
			'name'=>'amount_with_items',
			'value'=>$iyerpoojas->amount_with_items.' '.$iyer_profile_dtails->iyer_amount_option,
			'type'=>'raw',
		),
		
		array(
			'name'=>'amount_without_items',
			'value'=>$iyerpoojas->amount_without_items.' '.$iyer_profile_dtails->iyer_amount_option,
			'type'=>'raw',
		),

		'discount',
		
		array(
			'name'=>'discount_percentage',
			'value'=>($iyerpoojas->discount_percentage!='0')?$iyerpoojas->discount_percentage.'%':'Nil',
			'type'=>'raw',
		),
		array(
			'name'=>'discount_dates_from',
			'value'=>($iyerpoojas->discount_dates_from!='')?$iyerpoojas->discount_dates_from:'Nil',
			'type'=>'raw',
		),
		
		array(
			'name'=>'discount_dates_to',
			'value'=>($iyerpoojas->discount_dates_to!='')?$iyerpoojas->discount_dates_to:'Nil',
			'type'=>'raw',
		),
		
		
		/*array(
			'name'=>'status',
			'value'=>($iyerpoojas->status=='1')?'Active':'Inactive',
			'type'=>'raw',
		),*/

	),
)); ?>
	
<div class="row buttons" style="margin:30px;">
<button class="btn  btn-large" onclick="window.location.href ='<?php echo CController::CreateUrl('profile/iyeractivity'); ?>'" type="button">Back</button>
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
