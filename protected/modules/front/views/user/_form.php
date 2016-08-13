<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>

<div class="form form-horizontal wpcf7">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
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

	<?php echo $form->errorSummary($model); ?>
	
	
	
  <div class="control-group">
		<?php echo $form->labelEx($model,'registertype'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($model,'registertype',array('email'=>'Email','social'=>'Social'),array('onchange'=>'registertype(this.value)')); ?>
		<?php echo $form->error($model,'registertype'); ?>
		</div>
	</div>	
	
	<div class="socialiconwidget" style=" <?php echo ($model->registertype=='email')?'display:none':''; ?>">
	    
		 <div class="control-group">
	      <div class="controls">
			<?php $this->widget('ext.widgets.hybridAuth.SocialLoginButtonWidget', array(
					   'enabled'=>Yii::app()->hybridAuth->enabled,
					   'providers'=>Yii::app()->hybridAuth->getAllowedProviders(),
					   'route'=>'front/hybridauth/authenticate1',
					)); ?>
			</div>
		  </div>
	
	</div>
	
	<?php if($model->registertype == 'social'){ 
	     if($model->gender == 'female' || $model->gender == 'Female' || $model->gender == 'FEMALE')
		 $model->gender = 'Ms';
		 else
		  $model->gender = 'Mr';
	 } ?>
	
 <?php if($model->registertype != 'social' || ($model->registertype == 'social' &&  isset($model->social_identifier) && trim($model->social_identifier) != '') ){ 	 ?>
  <div class="control-group">
		<?php echo $form->labelEx($model,'gender'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($model,'gender',array('Mr'=>'Mr.','Ms'=>'Ms.','Mrs'=>'Mrs.'),array('prompt'=> 'Please Select')); ?>
		<?php echo $form->error($model,'gender'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'first_name'); ?>
		 <div class="controls">
		<?php echo $form->textField($model,'first_name',array('size'=>250,'maxlength'=>250,'class'=>'')); ?>
		<?php echo $form->error($model,'first_name'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'last_name'); ?>
		 <div class="controls">
		<?php echo $form->textField($model,'last_name',array('size'=>250,'maxlength'=>250,'class'=>'')); ?>
		<?php echo $form->error($model,'last_name'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'language'); ?>
		 <div class="controls">
		<?php echo $form->dropDownList($model,'language',CHtml::listData(Languages::model()->findAll(),'language_id','language_name'),array('prompt'=> 'Please Select')); ?>
		<?php echo $form->error($model,'language'); ?>
		</div>
	</div>
	
	<?php if($model->registertype == 'email' || ($model->registertype == 'social' && $model->email == '')){ ?>
	<div class="control-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<div class="controls">
		<?php echo $form->emailField($model,'email',array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>
	
	
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'conpassword'); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'conpassword'); ?>
		<?php echo $form->error($model,'conpassword'); ?>
		</div>
	</div>
	<?php }else{ 
				   echo $form->hiddenField($model,'email');
			   }	
	?>	
	
	
	<?php if(!$model->isNewRecord){ ?>
	<div class="control-group">
        <?php echo $form->labelEx($model,'user_image'); ?>
		<div class="controls">
        <?php echo CHtml::activeFileField($model, 'user_image'); ?>
		<input type="button" class="btn btn-success" onclick="uploaduserpicture('User_user_image')"  value="Upload" />&nbsp;<span class="upload_progress"></span>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.$model->pooja_image,"pooja_image",array("width"=>200)); ?>
	<?php } ?>
        <?php echo $form->error($model,'user_image'); ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'role'); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'role',array('2'=>'Nomal user','3'=>'Guide','4'=>'Iyer'),array('prompt'=> 'Please Select','onchange'=>'change_userrole(this.value)')); ?>
		<?php echo $form->error($model,'role'); ?>
		</div>
	</div>
	
	<?php echo $form->hiddenField($model,'social_identifier'); ?>
	<?php echo $form->hiddenField($model,'social_provider'); ?>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class'=>'btn btn-success btn-large')); ?>
	</div>
	
	<?php } ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
$('.timepicker1').timepicker();
</script>-->
<script type="text/javascript">
$(document).ready(function(){
$('#Pooja_pooja_have_options').change(function(){
if($(this).is(':checked')){
$('.pooja_have_options_no').css('display','none');
$('.pooja_have_options').css('display','block');
$('.optionform_required').attr('required',true);
}else{
$('.pooja_have_options').css('display','none');
$('.pooja_have_options_no').css('display','block');
$('.optionform_required').attr('required',false);
}
});
if($('#Pooja_pooja_have_options').is(':checked')){
$('#Pooja_pooja_have_options').click();
}

	<?php if($model->isNewRecord!='1' && $model->pooja_have_options == '1'){ ?>
	    option_form_count = parseInt('<?php echo $poojaoptionscount; ?>');
	    $('#Pooja_pooja_have_options').click();
	<?php } ?>
});

function change_userrole(role){
alert(role);
}

	 $(function(){
		$('input[type="file"]').change(function(){
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
		
	  });
	  
	  function registertype(typeval){
	      window.location.href = '<?php echo CController::CreateUrl('//front/user/create/type'); ?>/'+typeval;
	  }
	</script>
