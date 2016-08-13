<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>

<div class="form form-horizontal">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Guidedetails-form',
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

	<?php echo $form->errorSummary($guide); ?>
	
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_title'); ?>
		 <div class="controls">
		<?php echo $form->textField($guide,'guide_title',array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
		<?php echo $form->error($guide,'guide_title'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_description'); ?>
		 <div class="controls">
		<?php echo $form->textArea($guide,'guide_description',array('rows'=>5)); ?>
		<?php echo $form->error($guide,'guide_description'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_state'); ?>
		 <div class="controls">
		
		<?php echo $form->dropDownList($guide,'guide_state',CHtml::listData(States::model()->getall(),'id','state_name'),
                array(
                'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('user/dynamicCities'), //url to call.
                        //Style: CController::createUrl('currentController/methodToCall')
                        'update'=>'#Guide_guide_city', //selector to update
                        array('class'=>'ajaxlink'),
                        //'data'=>'js:javascript statement' 
                        //leave out the data key to pass all form values through
                ),'prompt'=> 'Please Select')); ?>
		<?php echo $form->error($guide,'guide_state'); ?>
		</div>
	</div>
	
	

	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_city'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide,'guide_city',CHtml::listData(Cities::model()->getall(),'id','name'),array('prompt'=> 'Please Select')); ?>
		<?php echo $form->error($guide,'guide_city'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_address'); ?>
		 <div class="controls">
		<?php echo $form->textArea($guide,'guide_address',array('rows'=>5)); ?>
		<?php echo $form->error($guide,'guide_address'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_phone'); ?>
		 <div class="controls">
		<?php echo $form->textField($guide,'guide_phone',array('size'=>50,'maxlength'=>50,'class'=>'')); ?>
		<?php echo $form->error($guide,'guide_phone'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'secondary_locations'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'secondary_locations', CHtml::listData(Cities::model()->getall(),'id','name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($guide,'secondary_locations'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_sec_languages'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'guide_sec_languages', CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($guide,'guide_sec_languages'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_categories'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'guide_categories', CHtml::listData(Guidecategories::model()->getall(),'category_id','category_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($guide,'guide_categories'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_services'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'guide_services', CHtml::listData(Services::model()->getall(),'service_id','service_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($guide,'guide_services'); ?>
		</div>
	</div>
	
	<div  class="control-group">
		 <div  class="controls">
		 <label  class="checkbox">
		<?php echo $form->checkBox($guide, 'guide_have_certificate',array('onchange'=>'guide_have_certificate_change(this)')); ?>&nbsp;Has Licence/Certificate
		</label>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_license',array('class'=>'required')); ?>
		 <div class="controls">
		<?php echo $form->fileField($guide,'guide_license'); ?>
		<input type="button" class="btn btn-success" onclick="uploadguidelicense('Guide_guide_license')"  value="Upload" />&nbsp;<span class="upload_progress">
		<?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_license'])){ 
		    echo helpers::render_image($_POST['Guide']['guide_license'],array('height'=>'100px','width'=>'100px')); 
		}?>
		
			
		
		</span>
		<?php echo $form->error($guide,'guide_license'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_experience',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->textField($guide,'guide_experience',array('class'=>'span1')); ?>&nbsp;<?php echo $form->dropDownList($guide, 'guide_experiencetype', array('1'=>'Month(s)','2'=>'Year(s)'), array('class'=>'span2')); ?>
		<?php echo $form->error($guide,'guide_experience'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_amount_option',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide,'guide_amount_option',array('per person'=>'per person','per group'=>'per group')); ?>
		<?php echo $form->error($guide,'guide_amount_option'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_amount',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->textField($guide,'guide_amount'); ?>
		<?php echo $form->error($guide,'guide_amount'); ?>
		</div>
	</div>
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'highlights',array('class'=>'')); ?>
		 <div class="controls">
		  <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$guide,                # Data-Model
			"attribute"=>'highlights',         # Attribute in the Data-Model
			"height"=>'200px',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
		<?php echo $form->error($guide,'guide_amount_option'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_overview',array('class'=>'')); ?>
		 <div class="controls">
		  <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$guide,                # Data-Model
			"attribute"=>'guide_overview',         # Attribute in the Data-Model
			"height"=>'400px',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
		<?php echo $form->error($guide,'guide_amount_option'); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_video',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->fileField($guide,'guide_video'); ?>
		<input type="button" class="btn btn-success" onclick="uploadguidevideo('Guide_guide_video')"  value="Upload" />&nbsp;<span class="upload_progress">
		<?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_video'])){ 
		    echo helpers::render_image($_POST['Guide']['guide_video'],array('height'=>'100px','width'=>'100px')); 
		}?></span>
		<?php echo $form->error($guide,'guide_video'); ?>
		</div>
	</div>
		
		<?php $images = new Images; $productimagesalready = $productimagesarr = array();
		if(isset($_POST['Images']) && isset($_POST['Images']['image_path']))
		$productimagesarr = array_filter(explode('SPLITIMAGESHERE',$_POST['Images']['image_path']));
		 ?>
		
		
	<div class="control-group">
        <?php echo $form->labelEx($images,'image_path'); ?>
		 <div class="controls">
      	<?php  echo $form->fileField($images,'image_path'); ?>&nbsp;
		<input type="button" class="btn btn-success" onclick="uploadguidepicture('Images_image_path')"  value="Upload" />&nbsp;<span class="upload_progress"></span>

        <?php echo $form->error($images,'image_path'); ?>
		<div>
		<ul class="pimagelist">
		<?php if(isset($productimagesalready) && count($productimagesalready)){
		foreach($productimagesalready as $productimagesalreadyimg){ 
		?>
		<li class="span3 thumbnail" id="imagelist<?php echo $productimagesalreadyimg->product_image_id; ?>"><a class="deleteqimage" href="javascript:void(0);" onclick="deletepimage('Images_image_path','<?php echo $productimagesalreadyimg->product_image_id; ?>','2')"></a><img src="<?php echo Yii::app()->request->baseUrl.'/'.$productimagesalreadyimg->product_image; ?>" style="max-width:100%;"/></li>
		<?php } } ?>
		<?php if(isset($productimagesarr) && count($productimagesarr)){
		foreach($productimagesarr as $productimage){ 
		if(trim($productimage) != ''){
		?>
		<li class="span3 thumbnail"><a class="deleteqimage" href="javascript:void(0);" onclick="deletepimage('Images_image_path','<?php echo $productimage; ?>','1')"></a><img src="<?php echo Yii::app()->request->baseUrl.'/'.$productimage; ?>" style="max-width:100%;"/></li>
		
		<?php } } } ?>
		</ul></div>
		</div>
	</div>
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Continue', array('class'=>'btn btn-success btn-large')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
$('.timepicker1').timepicker();
</script>-->
<script type="text/javascript">


function change_userrole(role){
alert(role);
}

	 $(function(){
	
	 <?php if(isset($_POST['Images']) && isset($_POST['Images']['image_path'])){ ?>
	     $('#ytImages_image_path').val('<?php echo $_POST['Images']['image_path']; ?>');
	 <?php } ?>
	 
	 <?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_license'])){ ?>
	     $('#ytGuide_guide_license').val('<?php echo $_POST['Guide']['guide_license']; ?>');
	 <?php } ?>
	 
	 <?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_video'])){ ?>
	     $('#ytGuide_guide_video').val('<?php echo $_POST['Guide']['guide_video']; ?>');
	 <?php } ?>
	 
		$('#Guide_guide_license').change(function(){
		  var file = $(this).val();
		  var fileupload = this.files[0];
		  var exts = ['jpeg','jpg','png','gif','pdf','doc','docx'];
		  // first check if file field has any value
		  if ( file ) {
			// split file name at dot
			var get_ext = file.split('.');
			// reverse name to check extension
			get_ext = get_ext.reverse();
			// check file type is valid as given in 'exts' array
			if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
			  //alert( 'Allowed extension!' );
			   if(fileupload.size != 'undefind' && fileupload.size){
			     if(fileupload.size > 2048576){
				   $(this).val('');
				   alert( 'File size exceeds 1MB!' );
				 }
			   }
			} else {
			  $(this).val('');
			  alert( 'File format not allowed!' );
			}
		  }
		});
		
		
		$('#Guide_guide_video').change(function(){
		  var file = $(this).val();
		  var fileupload = this.files[0];
		  var exts = ['avi','mp4','3gp','flv'];
		  // first check if file field has any value
		  if ( file ) {
			// split file name at dot
			var get_ext = file.split('.');
			// reverse name to check extension
			get_ext = get_ext.reverse();
			// check file type is valid as given in 'exts' array
			if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
			  //alert( 'Allowed extension!' );
			  
			} else {
			  $(this).val('');
			   alert( 'File format not allowed! please try to upload any of (avi,mp4,3gp,flv) ');
			}
		  }
		});
		
		$('#Images_image_path').change(function(){
		  var file = $(this).val();
		  var fileupload = this.files[0];
		  var exts = ['jpeg','jpg','png','gif'];
		  // first check if file field has any value
		  if ( file ) {
			// split file name at dot
			var get_ext = file.split('.');
			// reverse name to check extension
			get_ext = get_ext.reverse();
			// check file type is valid as given in 'exts' array
			if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
			  //alert( 'Allowed extension!' );
			   if(fileupload.size != 'undefind' && fileupload.size){
			     if(fileupload.size > 2048576){
				   $(this).val('');
				   alert( 'File size exceeds 1MB!' );
				 }
			   }
			} else {
			  $(this).val('');
			  alert( 'File format not allowed!' );
			}
		  }
		});
		
	  });
	</script>
