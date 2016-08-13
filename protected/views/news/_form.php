<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>
<link rel="stylesheet" type="text/css" media="screen"     href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.min.css">

	 
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'events-form',
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

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'news_title'); ?>
		<?php echo $form->textField($model,'news_title',array('size'=>450,'maxlength'=>450,'class'=>'span5')); ?>
		<?php echo $form->error($model,'news_title'); ?>
	</div>
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'news_date'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model' => $model,
		'attribute' => 'news_date',
		'language'=>'en-GB',
		 'options'=>array(
				'dateFormat' => 'yy-mm-dd',
				'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
				'changeMonth'=>true,
				'changeYear'=>true,
				'yearRange'=>'2000:2099',
				'minDate' => '2000-12-31',      // minimum date
				'maxDate' => date('Y-m-d'),      // maximum date
				),
		'htmlOptions' => array(
		'size' => '10',         // textField size
		'maxlength' => '10',
		'autocomplete'=>'off',    // textField maxlength
                'readonly'=>'readonly',
		),
		));
		?>
		<?php echo $form->error($model,'news_date'); ?>
		</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'news_image'.'*'); ?>
		<?php echo $form->fileField($model,'news_image'); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.$model->news_image,"news_image",array("style"=>'max-width:200px')); ?>
	<?php } ?>
		<?php echo $form->error($model,'news_image'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'news_content'); ?>
        <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$model,                # Data-Model
			"attribute"=>'news_content',         # Attribute in the Data-Model
			"height"=>'400px',
			"width"=>'100%',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
			  
		?>
		<?php  //echo $form->textArea($model, "news_content", array('style'=>'width: 600px; height: 300px;')); ?>
		<?php //echo $form->error($model,'news_content'); ?>
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large')); ?>
		
				 <input type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/news/admin/'; ?>'"  class="btn  btn-large" value="Cancel" >
		</div>

<?php $this->endWidget(); ?>

</div>

 <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/datetimepicker.js"></script>
	
	
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
    });
  });
  var news_image  ='<?php echo $model->news_image; ?>';
  
  if(news_image!='')
  {
  $('#ytNews_news_image').val(news_image);
  }
  
</script>
