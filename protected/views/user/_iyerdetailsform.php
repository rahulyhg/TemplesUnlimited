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
	'id'=>'Iyerdetails-form',
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

	<?php echo $form->errorSummary($iyer); ?>
	
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_state'); ?>
		 <div class="controls">
		
		<?php echo $form->dropDownList($iyer,'iyer_state',CHtml::listData(States::model()->getall(),'id','state_name'),
                array(
                'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('user/dynamiccitiesiyer'), //url to call.
                        //Style: CController::createUrl('currentController/methodToCall')
                        'update'=>'#Iyer_iyer_city', //selector to update
                        array('class'=>'ajaxlink'),
                        //'data'=>'js:javascript statement' 
                        //leave out the data key to pass all form values through
                ),'prompt'=> 'Please Select')); ?>
		<?php echo $form->error($iyer,'iyer_state'); ?>
		</div>
	</div>
	
	

	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_city'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($iyer,'iyer_city',CHtml::listData(Cities::model()->getall(),'id','name'),array('prompt'=> 'Please Select')); ?>
		<?php echo $form->error($iyer,'iyer_city'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_address'); ?>
		 <div class="controls">
		<?php echo $form->textArea($iyer,'iyer_address',array('rows'=>5)); ?>
		<?php echo $form->error($iyer,'iyer_address'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_phone'); ?>
		 <div class="controls">
		<?php echo $form->textField($iyer,'iyer_phone',array('size'=>50,'maxlength'=>50,'class'=>'')); ?>
		<?php echo $form->error($iyer,'iyer_phone'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_description'); ?>
		 <div class="controls">
		<?php echo $form->textArea($iyer,'iyer_description',array('rows'=>5)); ?>
		<?php echo $form->error($iyer,'iyer_description'); ?>
		</div>
	</div>
	

	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_sec_languages'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($iyer, 'iyer_sec_languages', CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($iyer,'iyer_sec_languages'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_categories'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($iyer, 'iyer_categories', CHtml::listData(Pooja::model()->getall(),'pooja_id','pooja_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple')); ?>
		<?php echo $form->error($iyer,'iyer_categories'); ?>
		</div>
	</div>
	
		
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_experience',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->textField($iyer,'iyer_experience',array('class'=>'span1')); ?>&nbsp;<?php echo $form->dropDownList($iyer, 'iyer_experiencetype', array('1'=>'Month(s)','2'=>'Year(s)'), array('class'=>'span2')); ?>
		<?php echo $form->error($iyer,'iyer_experience'); ?>
		</div>
	</div>
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_amount',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->textField($iyer,'iyer_amount'); ?>
		<?php echo $form->error($iyer,'iyer_amount'); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_image',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->fileField($iyer,'iyer_image'); ?>
		<input type="button" class="btn btn-success" onclick="uploadiyerimage('Iyer_iyer_image')"  value="Upload" />&nbsp;<span class="upload_progress">
		<?php if(isset($iyer->iyer_image) && $iyer->iyer_image != ''){ 
		    echo helpers::render_image($iyer->iyer_image,array('height'=>'100px','width'=>'100px')); 
		}?>
		</span>
		<?php echo $form->error($iyer,'iyer_image'); ?>
		</div>
	</div>
	
		
	
	
	
	
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_overview',array('class'=>'')); ?>
		 <div class="controls">
		  <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$iyer,                # Data-Model
			"attribute"=>'iyer_overview',         # Attribute in the Data-Model
			"height"=>'400px',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
		<?php echo $form->error($iyer,'iyer_overview'); ?>
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
	
	 <?php if(isset($_POST['Iyer']) && isset($_POST['Iyer']['iyer_image'])){ ?>
	     $('#ytIyer_iyer_image').val('<?php echo $_POST['Iyer']['iyer_image']; ?>');
	 <?php } ?>
	 
	 
	 
		$('#Iyer_iyer_image').change(function(){
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
