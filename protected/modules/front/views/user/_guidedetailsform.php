<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }

form label {
    font-family: "ralewayregular" !important;
    font-size: 13px !important;
    opacity: 1;
    width: 159px;
}
.guidedetailsform .wpcf7-form input[type="text"], .guidedetailsform .wpcf7-form input[type="password"], .guidedetailsform .wpcf7-form input[type="email"],  .guidedetailsform .wpcf7-form input[type="file"], .guidedetailsform .wpcf7-form textarea, .guidedetailsform .wpcf7-form select {
    border: 1px solid #E8E8E8;
    color: #666666;
    font-family: 'Arial',sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
}



.guidedetailsform .wpcf7-form input[type="text"], .guidedetailsform .wpcf7-form input[type="password"], .guidedetailsform .wpcf7-form input[type="email"], .guidedetailsform .wpcf7-form input[type="file"], .guidedetailsform .wpcf7-form textarea, .guidedetailsform .wpcf7-form select{
    border: 1px solid #D5D5D5;
    margin-bottom: 15px;
    width: 350px;
}
 .guidedetailsform .wpcf7-form select{
   width: 367px;
   }
 
			
.sc-form-button {
    background-color: #CB202D;
    border-radius: 3px;
    color: #FFFFFF;
    font-size: 13px;
    margin-left: 5px;
	border:none;
    width: 150px !important;
	padding:10px;
}			
.btn{ padding:10px; }
.control-group span.required {
    color: #FF0000;
    font-size: 16px;
}	

.pimagelist img {
    height: 100px;
    width: 100px;
}
.pimagelist{ clear:both; display:table; }
.control-group  .errorMessage{ display:none; }

.timepicker1{ width:87px !important; }
.bootstrap-timepicker {
    display: table;
    float: left;
    padding: 0 20px 0 0;
    vertical-align: middle;
}

.bootstrap-timepicker .topart{
margin-top:10px;
height:50px;
}
</style>

<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapfront.css" />
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" />

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $(function() {
    $('.timepicker1').timepicker();
  });
</script>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Guidedetails-form',
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
		<?php echo $form->labelEx($guide,'guide_wh'); ?>
		 <div class="controls">
		 
		 <div class="input-append bootstrap-timepicker">
			<?php
			
			 if($guide->isNewRecord && !isset( $guide->guide_wh1)){
				   $guide->guide_wh1 = '9:00 AM';
				   $guide->guide_wh2 = '6:00 PM';
			   }
			 echo $form->textField($guide,'guide_wh1',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small')); 
			 
			 ?>
			<span class="add-on"  style="height:26px;"><i class="icon-time"></i></span>
			</div>
			<div class=" bootstrap-timepicker"><span class="topart">&nbsp; to &nbsp;<span></div>
			 <div class="input-append bootstrap-timepicker">
			<?php  echo $form->textField($guide,'guide_wh2',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small'));  ?>
			<span class="add-on" style="height:26px;"><i class="icon-time"></i></span>
			</div>
			<div class="clear">&nbsp;</div>
		 <?php 
		 $durationarray = array();
		 for($i=1; $i<=24; $i++){
		 $durationarray[] = $i;
		 }
		 ?>
		<!--<?php echo $form->dropDownList($guide,'guide_wh',$durationarray,array('class'=>'')); ?>
		<b>Hours</b>-->
		</div>
	</div>
	
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_sec_languages'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'guide_sec_languages', CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array( 'multiple' => 'multiple')); ?>
		<?php echo $form->error($guide,'guide_sec_languages'); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'secondary_locations'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'secondary_locations', CHtml::listData(Cities::model()->getall(),'id','name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple',   
                'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('/user/dynamictemplesforcities'), //url to call.
                        //Style: CController::createUrl('currentController/methodToCall')
                        'update'=>'#Guide_guide_categories', //selector to update
                        array('class'=>'ajaxlink'),
                        //'data'=>'js:javascript statement' 
                        //leave out the data key to pass all form values through
                ))); ?>
		<?php echo $form->error($guide,'secondary_locations'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_categories'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'guide_categories', (isset($_POST['Guide']['secondary_locations']) && count($_POST['Guide']['secondary_locations']))?Temples::model()->getallfordropdown($_POST['Guide']['secondary_locations']):array(), array('multiple' => 'multiple'));  //Temples::model()->getallfordropdown(), ?>
		<?php echo $form->error($guide,'guide_categories'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_services'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide, 'guide_services', CHtml::listData(Services::model()->getall(),'service_id','service_name'), array( 'multiple' => 'multiple')); ?>
		<?php echo $form->error($guide,'guide_services'); ?>
		</div>
	</div>
	
	<div  class="control-group">
	 <label>&nbsp;</label>
		 <div  class="controls">
		 <p  class="checkbox">
		<?php echo $form->checkBox($guide, 'guide_have_certificate',array('onchange'=>'guide_have_certificate_change(this)')); ?>&nbsp;Has Licence/Certificate
		</p>
		</div>
	</div>
	
	<div class="control-group guide_license_div" style="display:none">
		<?php echo $form->labelEx($guide,'guide_license',array('class'=>'required')); ?>
		 <div class="controls">
		<?php echo $form->fileField($guide,'guide_license'); ?>&nbsp;&nbsp;
		<input type="button" class="btn btn-success span2" onclick="uploadguidelicense('Guide_guide_license')"  value="Upload" />&nbsp;<span class="upload_progress">
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
	
	<!--<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_amount_option',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($guide,'guide_amount_option',array('per person'=>'per person','per group'=>'per group')); ?>
		<?php echo $form->error($guide,'guide_amount_option'); ?>
		</div>
	</div>-->
	
	<?php 
	$guide->guide_amount_option = 'per person';
	echo $form->hiddenField($guide,'guide_amount_option'); ?>
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_amount',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->textField($guide,'guide_amount'); ?>
		<?php echo $form->error($guide,'guide_amount'); ?>
		</div>
	</div>
	
	
	<!--<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_video',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->fileField($guide,'guide_video'); ?>&nbsp;&nbsp;
		<input type="button" class="btn btn-success span2" onclick="uploadguidevideo('Guide_guide_video')"  value="Upload" />&nbsp;<span class="upload_progress">
		<?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_video'])){ 
		    echo helpers::render_image($_POST['Guide']['guide_video'],array('height'=>'100px','width'=>'100px')); 
		}?></span>
		<?php echo $form->error($guide,'guide_video'); ?>
		</div>
	</div>-->
		
		<?php $images = new Images; $productimagesalready = $productimagesarr = array();
		if(isset($_POST['Images']) && isset($_POST['Images']['image_path']))
		$productimagesarr = array_filter(explode('SPLITIMAGESHERE',$_POST['Images']['image_path']));
		 ?>
		
		
	<!--<div class="control-group">
        <?php echo $form->labelEx($images,'image_path'); ?>
		 <div class="controls">
      	<?php  echo $form->fileField($images,'image_path'); ?>&nbsp;&nbsp;
		<input type="button" class="btn btn-success span2" onclick="uploadguidepicture('Images_image_path')"  value="Upload" />&nbsp;<span class="upload_progress"></span>

        <?php echo $form->error($images,'image_path'); ?>
		<div>
		<ul class="pimagelist">
		<?php if(isset($productimagesalready) && count($productimagesalready)){
		foreach($productimagesalready as $productimagesalreadyimg){ 
		?>
		<li class="span2 thumbnail" id="imagelist<?php echo $productimagesalreadyimg->product_image_id; ?>"><a class="deleteqimage" href="javascript:void(0);" onclick="deleteguideimage('Images_image_path','<?php echo $productimagesalreadyimg->product_image_id; ?>','2')"></a><img src="<?php echo Yii::app()->request->baseUrl.'/'.$productimagesalreadyimg->product_image; ?>" style="max-width:100%;"/></li>
		<?php } } ?>
		<?php if(isset($productimagesarr) && count($productimagesarr)){
		foreach($productimagesarr as $productimage){ 
		if(trim($productimage) != ''){
		?>
		<li class="span2 thumbnail"><a class="deleteqimage" href="javascript:void(0);" onclick="deleteguideimage('Images_image_path','<?php echo $productimage; ?>','1')"></a><img src="<?php echo Yii::app()->request->baseUrl.'/'.$productimage; ?>" style="max-width:100%;"/></li>
		
		<?php } } } ?>
		</ul></div>
		</div>
	</div>-->
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_image',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->fileField($guide,'guide_image'); ?>
		<input type="button" class="btn btn-success upload_button span2 " onclick="uploaduserpicture('Guide_guide_image')"  value="Upload" />&nbsp;<span class="upload_progress">
		<?php if(isset($_POST['Guide']['guide_image']) && $_POST['Guide']['guide_image'] != ''){ 
		    echo helpers::view_image($_POST['Guide']['guide_image'],array('height'=>'100px','width'=>'100px')); 
		
		}?>
		</span>
		<?php echo $form->error($guide,'guide_image'); ?>
		</div>
	</div>
	
	
	<!--<div class="control-group">
		<?php //echo $form->labelEx($guide,'highlights',array('class'=>'')); ?>
		 <div class="controls" style="margin-left:155px;">
		  <?php
			/*$this->widget('ext.editor.CKkceditor',array(
			"model"=>$guide,                # Data-Model
			"attribute"=>'highlights',         # Attribute in the Data-Model
			"height"=>'200px',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );*/
		?>
		<?php //echo $form->error($guide,'guide_amount_option'); ?>
		</div>
	</div>-->
	
	<div class="control-group">
		<?php echo $form->labelEx($guide,'guide_overview',array('class'=>'')); ?>
		 <div class="controls" style="margin-left:155px;">
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
	<label for="" class=" ">&nbsp;</label>
	  <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Continue', array('class'=>'sc-form-button')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

<!-- form -->
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
	 
	 <?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_have_certificate']) && $_POST['Guide']['guide_have_certificate'] == '1'){ ?>
	    $('.guide_license_div').css('display','block');
	 <?php } ?>
	 
	
	 <?php if(isset($_POST['Guide']) && isset($_POST['Guide']['guide_image'])){ ?>
	     $('#ytGuide_guide_image').val('<?php echo $_POST['Guide']['guide_image']; ?>');
	 <?php } ?>
	 
	 
	 
	 $('#Guide_guide_have_certificate').change(function(){
		 if($(this).is(':checked'))
		 $('.guide_license_div').css('display','block');
		 else
		  $('.guide_license_div').css('display','none');
	 });
	 
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
