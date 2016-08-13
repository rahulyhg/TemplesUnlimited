<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'User'=>array('user/manage/role/'.$model->role),
	$model->first_name.' '.$model->last_name,
);

if($model->role == '3'){
$this->menu=array(
	/*array('label'=>'Delete Pooja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pooja_id),'confirm'=>'Are you sure you want to delete this item?')),*/
	array('label'=>'Manage '.User::model()->getrole($model->role).'s', 'url'=>array('user/manage/role/'.$model->role)),
/*	array('label'=>'Manage Activities', 'url'=>array('user/guideactivitiesmanage/id/'.$model->user_id)),*/
);
}else{
$this->menu=array(
	/*array('label'=>'Delete Pooja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pooja_id),'confirm'=>'Are you sure you want to delete this item?')),*/
	array('label'=>'Manage '.User::model()->getrole($model->role).'s', 'url'=>array('user/manage/role/'.$model->role)),
);
}
?>

<h1>View <?php echo User::model()->getrole($model->role); ?> #<?php echo $model->first_name.' '.$model->last_name; ?></h1>
<?php $details = array(
		'user_id',
		'first_name',
		'last_name',
		'email',
		 array(
            'name'=>'language',
            'value'=>$model->languagename->language_name,
        ),		
		
	array(
		'name'=>'user_image',
		 'type'=>'html',
            'value'=>(!empty($model->user_image))?CHtml::image(Yii::app()->request->baseUrl.'/'.$model->user_image,"",array("style"=>"width:250px;height:auto;")):"no image",
		),
		
	 array(
            'name'=>'status',
            'value'=>($model->status=="1")?"Active":"Inactive",
        ),		
		
		 array(
            'name'=>'registration_completed',
            'value'=>($model->registration_completed=="1")?"Yes":"No",
        ),		
		
		'created_on',
		
		
	); 
	
	if($model->role == '4'){
	$model->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
	
	$iyerdetails = array(
	    array(
		'name'=>'City',
		'value'=>($model->iyermoredetails->iyercity->name!='')?$model->iyermoredetails->iyercity->name:'Not set',
		),
		array(
		'name'=>'State',
		'value'=>($model->iyermoredetails->iyerstate->state_name!='')?$model->iyermoredetails->iyerstate->state_name:'Not set', 
		),
		
		 array(
		'name'=>'Address',
		'value'=>($model->iyermoredetails->iyer_address!='')?$model->iyermoredetails->iyer_address:'Not set',
		),
		array(
		'name'=>'Phone',
		'value'=>($model->iyermoredetails->iyer_phone!='')?$model->iyermoredetails->iyer_phone:'Not set',
		),
		
			
		 array(
		'name'=>'Price',
		'value'=>helpers::to_currency($model->iyermoredetails->iyer_amount),
		),
		array(
		'name'=>'iyer_experience',
		'value'=>$model->iyermoredetails->iyer_experience.' '.$model->iyermoredetails->iyer_experience_type,
		),
		
		 array(
		'name'=>'Description',
                 'type'=>'html',
		'value'=>($model->iyermoredetails->iyer_description!='')?$model->iyermoredetails->iyer_description:'Not set',
		),
		
			
		array(
		'name'=>'Overview',
               'type'=>'html',
		'value'=>($model->iyermoredetails->iyer_overview!='')?$model->iyermoredetails->iyer_overview:'Not set',
		),
		
		
	);
	
	$details = array_merge($details,$iyerdetails );
	
	
	}

	
	if($model->role == '3'){
	$model->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
	
	$guidedetails = array(

	    array(
		'name'=>'City',
		'value'=>$model->guidemoredetails->guidecity->name,
		),
		array(
		'name'=>'State',
		'value'=>$model->guidemoredetails->guidestate->state_name,
		),
		
		 array(
		'name'=>'Address',
		'value'=>($model->guidemoredetails->guide_address!='')?$model->guidemoredetails->guide_address:'Not set',
		),
		array(
		'name'=>'Phone',
		'value'=>$model->guidemoredetails->guide_phone,
		),
		
		 array(
		'name'=>'Price plan',
		'value'=>$model->guidemoredetails->guide_amount_option,
		),
			
		 array(
		'name'=>'Price',
		'value'=>helpers::to_currency($model->guidemoredetails->guide_amount),
		),
		array(
		'name'=>'Experience',
		'value'=>$model->guidemoredetails->guide_experience.' '.$model->guidemoredetails->guide_experiencetype,
		),
		
		array(
		'name'=>'Has Certificate?',
		'value'=>$model->guidemoredetails->guide_have_certificate,
		),
		
		
		array(
		'name'=>'License/Certificate',
		 'type'=>'html',
            'value'=>(!empty($model->guidemoredetails->guide_license))?CHtml::image(Yii::app()->request->baseUrl.'/uploads/license/'.$model->guidemoredetails->guide_license,"",array("style"=>"width:250px;")):"no image",
		),
		
		
		
		 array(
		'name'=>'Description',
		'value'=>$model->guidemoredetails->guide_description,
		),
		
		
		array(
		'name'=>'Secondary locations',
		'value'=>($model->guidemoredetails->secondary_locations!='')?implode(',',CHtml::listData(Cities::model()->getall_byids(explode(',',$model->guidemoredetails->secondary_locations)),'id','name')):'Not set',
		),
		
		  array(
		'name'=>'Services',
		'value'=>$model->guidemoredetails->guide_services,
		),
		

		array(
		'name'=>'Overview',
		'value'=>$model->guidemoredetails->guide_overview,
		),
		
		
	);
	
	$details = array_merge($details,$guidedetails );
	
	
	}
	
	?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$details,
)); ?>

<br/><br/>
<div class="row">

<?php //if($model->role == '3'){ ?>
<!--<h3>Video</h3><br/>
<div class="thumbnail">
<video src="<?php //echo Yii::app()->request->baseUrl.'/'.$model->guidemoredetails->guide_video; ?>"  width="320" height="240" controls></video>

</div><br/>
<div class="clear">&nbsp;</div>
<h3>Images</h3><br/>-->
<?php

/*$guideimages = Images::model()->findAll('item_type=:item_type 	AND item_id=:item_id',array(':item_type'=>'guide',':item_id'=>$model->user_id));

	if($guideimages && count($guideimages)){
		foreach($guideimages as $guideimage){
		    echo '<div class="thumbnail span3">'.CHtml::image(Yii::app()->request->baseUrl.'/'.$guideimage->image_path,"",array("style"=>"max-width:100%;")).'</div>';
		}
	}
 } */?>
</div>

<style>
table.detail-view .null 
{
    color: #000 !important;
}
</style>
