<?php
/* @var $this SliderController */
/* @var $model Slider */
/* @var $form CActiveForm */
?>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Sliders</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Add / Edit Slider
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/slider/admin" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slider-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false, 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'stitle'); ?>
		<?php echo $form->textField($model,'stitle'); ?>
		<?php echo $form->error($model,'stitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sdescription'); ?>
		<?php echo $form->textField($model,'sdescription',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'sdescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sfile'); ?>
		<?php //echo $form->textField($model,'sfile',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo cHtml::activeFileField($model,'sfile'); ?>
		<?php echo $form->error($model,'sfile'); ?>
	</div>
	
	<?php if($model->isNewRecord!='1'){ ?>
<div class="row">
     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/sliders/thumb/'.$model->sfile,"image"); ?> 
</div>
 <? } ?>
	

	<div class="row">
		<?php echo $form->labelEx($model,'sstatus'); ?>
		<?php //echo $form->textField($model,'sstatus'); ?>
                
        <?php echo $form->dropDownList($model,'sstatus',array("1"=>"Active","0"=>"InActive"),array('empty'=>'Select Status')); ?>			  
			  
		<?php echo $form->error($model,'sstatus'); ?>
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