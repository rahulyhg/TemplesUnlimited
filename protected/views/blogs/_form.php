<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
mode : "specific_textareas",
editor_selector : "myTextEditor",
theme: "modern",
plugins: [
"advlist autolink lists link image charmap print preview hr anchor pagebreak",
"searchreplace wordcount visualblocks visualchars code fullscreen",
"insertdatetime media nonbreaking save table contextmenu directionality",
"emoticons template paste textcolor colorpicker textpattern"
],
toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
toolbar2: "print preview media | forecolor backcolor emoticons",
image_advtab: true,
templates: [
{title: 'Test template 1', content: 'Test 1'},
]
});
</script>

<style>
.myTextEditor
{
width:100%;
height:300px;
  
}
</style>

<?php
/* @var $this BlogsController */
/* @var $model Blogs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blogs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
/*	'enableClientValidation'=>true,*/
				'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	  'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
			),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php  //echo $form->errorSummary($model); ?>
	
		<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php 
			$clist = CHtml::listData(Blogcategory::model()->findAll(array('order' => 'categoryname')), 'id', 'categoryname');
			echo $form->dropDownList($model, 'category', $clist, array('empty'=>'Select a Category'));   
		?>
		<?php //echo $form->error($model,'category'); ?>
	</div>
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'blog_name'); ?>
		<?php echo $form->textField($model,'blog_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'blog_name'); ?>
	</div>
	
	<div class="row">
    <?php echo $form->labelEx($model,'file_type'); ?>
	<?php $locations = array('1'=>'image','2'=>'video') ?>
    <?php echo $form->dropDownList($model,'file_type', $locations, array('prompt'=>'Select File Type','onchange'=>'javascript:showdiv(this.value);')); ?>
    <?php echo $form->error($model,'file_type'); ?>
   </div>

	<div class="row"  id="files_div" style="display:none;">
		<?php echo $form->labelEx($model,'files'); ?>
		<?php echo CHtml::activeFileField($model,'files',array('onchange'=>'javascript:ajaxFileUpload(this.value);')); ?>
		<?php if($model->isNewRecord!='1' && $model->files!=''){ ?>
		  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/blogs/'.$model->files,"files",array("width"=>200)); ?>
	<?php } ?>
		<?php echo $form->error($model,'files'); ?>
	</div>


			<div class="row" id="video_div" style="display:none;">
			<?php echo $form->labelEx($model,'video_url'); ?>
			<?php echo $form->textField($model,'video_url',array('size'=>60,'class'=>'span6')); ?>
			<?php echo $form->error($model,'video_url'); ?>
			<p class="hint">Note (URL Format Example) : https://www.youtube.com/watch?v=8wOPs6qyi0s.</p>
			</div>


	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>		
		<?php echo $form->error($model,'content'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit')); ?>
		
		 <input type="button" value='Cancel' onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/blogs/admin/'; ?>'"  class="btn  btn-large" >
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$('#submit').click(function() {
     tinymce.triggerSave();
});

function ajaxFileUpload(imagename)
{ 
$('#ytBlogs_files').val(imagename);
}

var files  ='<?php echo $model->files; ?>';

if(files!='')
{
$('#ytBlogs_files').val(files);
}



function  showdiv(value)
{
		if(value=='1')
		{
		$('#files_div').show();
		$('#video_div').hide();
		}
		else
		{
		$('#video_div').show();
		$('#files_div').hide();
		}
}
</script>

<?php if($model->file_type =='2'){ ?>	


<script>
$('#video_div').show();
$('#files_div').hide();
</script>


<?php } ?>	


<?php  if($model->file_type =='1'){  ?>

<script>
$('#files_div').show();
$('#video_div').hide();
</script>


<?php } ?>	
