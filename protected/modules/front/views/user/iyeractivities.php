<?php
/* @var $this TemplesController */
/* @var $model Temples */



$this->menu=array(
	//array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>
<link rel='stylesheet'   href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap_custom.css' type='text/css' media='all' />
<div class="" >

<div class="">



<h3>Iyer activities</h3>
<div class="rule"></div>
<br>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temples-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
		'class'=>'wpcf7-form',
    ),
)); ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p>
-->
	<?php echo $form->errorSummary($model); ?>
	 <!--  <input type="button" class="btn btn-success pull-right" value="Add more activity plan" onclick="get_Guide_activities_form('<?php echo $id; ?>')" />	-->
	  <div class="activitieslists">
	   <?php  $iyercategories = explode(',',$iyer->iyer_categories); 
	   
	               $poojas = Iyerpooja::model()->getall_byids($iyercategories);

				  if(count($poojas) && !empty($poojas)){
				     $count = 0;
				     foreach($poojas as $pooja){ $count++;
					    $model = new Iyeractivities;
						if(isset($_POST['Iyeractivities']) && isset($_POST['Iyeractivities'][$pooja->id]) )
						 $model->attributes = $_POST['Iyeractivities'][$pooja->id];
				        $this->renderPartial('_iyeractiviesform', array('model'=>$model,'pooja'=>$pooja,'key'=>$pooja->id,'id'=>$id, 'errors'=>$errors,)); 
					 }
				   }
	                
	   ?>
		<?php ?>		
		</div>
		
	
	<div class="control-group">
	<label for="" class=" ">&nbsp;</label>
	  <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'sc-form-button')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

<div style="clear:both;"><br/><br/></div>
          </div>
</div>
