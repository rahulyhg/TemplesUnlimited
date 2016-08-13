<?php
/* @var $this StateController */
/* @var $model State */
/* @var $form CActiveForm */
?>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage States</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Add / Edit State
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/state/admin" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'state-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	

	<div class="row">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php //echo $form->textField($model,'country_id');
				//echo CHtml::activeDropDownList($model,'country_id', Country::model()->findAll(),array('prompt' => 'Select Cast'));
				?>
 <?php echo $form->dropDownList($model, 'country_id', CHtml::listData(
Country::model()->findAll(), 'id', 'name'),
array('prompt' => 'Select a Country')
); ?>
		
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
