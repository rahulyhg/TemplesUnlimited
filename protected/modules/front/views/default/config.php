<style type="text/css">
.errorMessage{ color:#FF0000; }
</style><div class="span9">
      <ul class="breadcrumb">
      <li><i class="icon-user"></i>&nbsp;Config Setting</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Change Config
            
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
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
		<?php echo $form->emailField($model,'company_email'); ?>
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
		<?php echo $form->textArea($model,'company_address'); ?>
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
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'individual_allowed',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'individual_allowed',array('0'=>'No','1'=>'Yes')); ?>
		<?php echo $form->error($model,'individual_allowed'); ?>
		</div>
	</div>

	<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton('Update',array('class'=>'btn btn-success btn-large ')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

		
			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
