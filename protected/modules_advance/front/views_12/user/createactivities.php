<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
		<!-- loads mdp -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">
<link rel='stylesheet'   href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap_custom.css' type='text/css' media='all' />
<div class="sc-column sc-column-last" >

<div class="">



<h3>Guide activities</h3>
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	 <!--  <input type="button" class="btn btn-success pull-right" value="Add more activity plan" onclick="get_Guide_activities_form('<?php echo $id; ?>')" />	-->
	  <div class="activitieslists">
	   <?php  $quidecategories = explode(',',$guide->guide_categories); 
	               $temples = Temples::model()->getall_byids($quidecategories);
				  
				  if(count($temples) && !empty($temples)){
				     $templecount = 0;
				     foreach($temples as $temple){ $templecount++;
				        $this->renderPartial('_activiesform', array('model'=>$model,'temple'=>$temple,'key'=>$templecount,'id'=>$id)); 
					 }
				   }
	                
	   ?>
		<?php ?>		
		</div>
		
	
	<div class="control-group">
	<label for="" class=" ">&nbsp;</label>
	  <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Continue', array('class'=>'sc-form-button')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

<div style="clear:both;"></div>
          </div>
</div>