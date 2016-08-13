<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>


	
	<div class="gallery_image_item" id="image<?php echo $key; ?>">
	
	<?php if( (int)$key > 1){ echo CHtml::link('Remove','javascript:void(0);',array('onclick'=>'remove_temple_galleryimage_form(\''.$key.'\')','class'=>'btn btn-danger pull-right color-white nounderline')); } ?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($gallery,'image_caption'); ?>
		<?php echo CHtml::textField('Gallery['.$key.'][image_caption]','',array('required'=>true,' maxlength'=>'50')); ?>
	</div>

	<div class="row">
		<?php echo  CHtml::activeLabelEx($gallery,'image_path'); ?>
		<?php /* $this->widget('CMultiFileUpload', array(
				'model' => $gallery,
                'name' => 'image_path',
                'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
            ));*/ ?>
		<?php echo CHtml::fileField('Gallery['.$key.'][image_path]','',array('required'=>true)); ?>
		<?php echo  CHtml::activeHiddenField($gallery,'temple_id'); ?>
	</div>
	</div>	
