<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'Temples'=>array('index'),
	$model->temple_name.' Image Gallery',
);

$this->menu=array(
	array('label'=>'List Temples', 'url'=>array('index')),
	array('label'=>'Manage Temples', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top"><?php echo $model->temple_name.' Image Gallery'; ?></h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
	  
	  <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temple-gallery-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="row">
			 <div class="alert success fade in">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Success!</strong>&nbsp;<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
		</div>
		<?php endif; ?>
	
	<div class="row">
		<?php echo cHtml::link('Add more','javascript:void(0);',array('onclick'=>'get_temple_galleryimage_form()','class'=>'btn btn-success pull-right color-white nounderline')); ?>
	</div>

   <div class="gallery_image_items">
	<?php echo $form->errorSummary($model); ?>
		<?php $this->renderPartial('gallery_form', array(
			'model'=>$model,
			'gallery'=>$gallery,
			'galleryimages'=>$galleryimages,
			'key'=>1,
		)); ?>		
		</div>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'btn btn-success btn-large pull-right')); ?>
	</div>
		
		<?php if($model->isNewRecord!='1'){ ?>
	<!--<div class="row">
		 <?php
		 //galleryimages
		  echo CHtml::image(Yii::app()->request->baseUrl.'/temple_images/'.$model->main_image,"main_image",array("width"=>200)); ?>
	</div>-->
	
	<?php } ?>




      <div class="row gallery_image_list">
   
     <?php if(count($galleryimages)){ 
	      foreach($galleryimages as $galleryimage){?>
            <div class="span2" id="<?php echo $galleryimage->image_id; ?>">
                <span class="gallery_img_remove" onclick="remove_uploaded_galleryimage('<?php echo $galleryimage->image_id; ?>')"><img src="<?php echo Yii::app()->request->baseUrl.'/images/remove.png'; ?>" alt="Remove" /></span>
                <a href="#" class="thumbnail">

                    <img src="<?php echo Yii::app()->request->baseUrl.'/'.$galleryimage->image_thumb_path; ?>" alt="<?php echo $galleryimage->image_caption; ?>" />

                </a>

            </div>

     <?php } } ?>
        </div>

    

	

<?php $this->endWidget(); ?>

</div><!-- form -->
	   </div>
  </div>
</div>
