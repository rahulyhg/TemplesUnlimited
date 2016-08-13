<style type="text/css">
.errorMessage{ color:#FF0000; }
</style><div class="box" id="box-5">
  <h4 class="box-header round-top">Site Config</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
	<?php
	$this->pageTitle=Yii::app()->name . ' - Config';
	$this->breadcrumbs=array(
		'Config',
	);
	?>

	<?php if(Yii::app()->user->hasFlash('success')){ ?>
		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>	

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changeconfig-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal','enctype'=>'multipart/form-data'),
)); ?>


	<div class="control-group">
		<?php echo $form->labelEx($model,'company_name',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'company_name'); ?>
		<?php echo $form->error($model,'company_name'); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'company_email',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'company_email'); ?>
		<?php echo $form->error($model,'company_email'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'company_phone',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'company_phone'); ?>
		<?php echo $form->error($model,'company_phone'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'company_address',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textArea($model,'company_address',array('style'=>'max-width:210px;min-width:210px;')); ?>
		<?php echo $form->error($model,'company_address'); ?>
		</div>
	</div>
    
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'company_logo',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->fileField($model,'company_logo'); ?>
		<?php echo $form->error($model,'company_logo'); ?>
		 <?php if($model->company_logo != ''){ ?><br/>
				 <?php echo helpers::render_image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$model->company_logo,array('height'=>'100px','width'=>'100px')); ?>
				 <br/>
		<?php } ?>
		</div>
	</div>
	
<!--	<div class="control-group">
		<?php echo $form->labelEx($model,'individual_allowed',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'individual_allowed',array('0'=>'No','1'=>'Yes')); ?>
		<?php echo $form->error($model,'individual_allowed'); ?>
		</div>
	</div>-->

	<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton('Update',array('class'=>'btn btn-success btn-large ')); ?>
            
            <input type="button"  onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/site/index/'; ?>'"  onclick="window.location.reload();"  class="btn  btn-large" value="Cancel" >
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

		
	  </div>
  </div>
</div>

<script>

$(function(){
$('#Config_company_logo').change(function(){
var errorcountimage = 0;
var file = $(this).val();
var fileupload = this.files[0];
var exts = ['jpeg','jpg','png','gif'];
// first check if file field has any value
if ( file ) {

var get_ext = file.split('.');
// reverse name to check extension
get_ext = get_ext.reverse();
// check file type is valid as given in 'exts' array
if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
//alert( 'Allowed extension!' );
if(fileupload.size != 'undefind' && fileupload.size){
if(fileupload.size > 2048576){
$(this).val('');
alert( 'File size exceeds 2MB!' );
errorcountimage++;
}
}
} else {
$(this).val('');
alert( 'File format not allowed!' );
errorcountimage++;
}
}

if(errorcountimage == 0){
changeprofileimage('User_user_image','<?php echo Yii::app()->user->id; ?>');
}
});
});
</script>
