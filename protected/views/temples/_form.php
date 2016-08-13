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

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temples-form',
			//'enableAjaxValidation'=>true,
				'enableClientValidation'=>true,
					'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
			'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
			),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'temple_name'); ?>
		<?php echo $form->textField($model,'temple_name',array('size'=>50,'maxlength'=>50,'class'=>'span5')); ?>
		<?php echo $form->error($model,'temple_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_deity'); ?>
		<?php echo $form->textField($model,'temple_deity',array('size'=>50,'maxlength'=>50,'class'=>'span5')); ?>
		<?php echo $form->error($model,'temple_deity'); ?>
	</div>
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_description'); ?>
		<?php echo $form->textArea($model,'temple_description',array('rows'=>5,'class'=>'span5','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_address'); ?>
		<?php echo $form->textArea($model,'temple_address',array('rows'=>5,'class'=>'span5','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_address'); ?>
	</div>
	
	
	<div class="row">     
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php
			$list = CHtml::listData(Country::model()->findAll(array('order' => 'country')), 'id', 'country');
			echo $form->dropDownList($model,'country_id', $list,array('empty'=>'Select Country', 'onchange'=>'javascript:onChangecountry(this.value);','class'=>'span5'));   
		?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'state_id'); ?>
		<?php 
		
		 if($model->isNewRecord)
		 $list =array();
		 else
		 $list = CHtml::listData(States::model()->findAll(array('order' => 'state_name')), 'id', 'state_name');
			
			
			echo $form->dropDownList($model, 'state_id', $list, array('empty'=>'Select State','class'=>'span5','onchange'=>'javascript:onChangestate(this.value);',));   
		?>
		<?php echo $form->error($model,'state_id'); ?>
	</div>
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php 
		 if($model->isNewRecord)
		 $list =array();
		 else
		 $list = CHtml::listData(Cities::model()->findAll(array('order' => 'name')), 'id', 'name');
			
			echo $form->dropDownList($model, 'city_id', $list, array('empty'=>'Select City','class'=>'span5'));   
		?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php 
			$clist = CHtml::listData(Categories::model()->findAll(array('order' => 'category_name')), 'id', 'category_name');
			echo $form->dropDownList($model, 'category_id', $clist, array('empty'=>'Select a Category','class'=>'span5'));   
		?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_phone_number'); ?>
		<?php echo $form->textField($model, 'temple_phone_number',array('class'=>'span5'));  ?>
		<?php echo $form->error($model,'temple_phone_number'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_timings'); ?>
		 <!-- <div class="input-append bootstrap-timepicker">
        <input id="timepicker1" class="input-small timepicker1" type="text"/><span class="add-on"><i class="icon-time"></i></span>
    </div>  
	<div class="input-append bootstrap-timepicker">
        <input id="timepicker1" class="input-small timepicker1" type="text"/><span class="add-on"><i class="icon-time"></i></span>
    </div>-->
		<?php echo $form->textArea($model, 'temple_timings',array('class'=>'span5','style'=>'max-width:450px;min-width:450px;'));  ?>
		<?php echo $form->error($model,'temple_timings'); ?>
	</div>
	
		
	<div class="row">
	<?php $estimated_timearr = array(); 
		for($i = 1; $i<=60; $i++ ){
		   $estimated_timearr[$i] = $i;
		}
		$estimated_timeoptarr = array('Minutes'=>'Minute(s)','Hours'=>'Hour(s)','Days'=>'Day(s)','Weeks'=>'Week(s)','Months'=>'Month(s)'); 
	?>
		<?php echo $form->labelEx($model,'estimated_time'); ?>
		<?php echo $form->dropDownList($model, 'estimated_time',  $estimated_timearr,array('class'=>'span3'));  ?>&nbsp;<?php echo $form->dropDownList($model, 'estimated_timeopt',  $estimated_timeoptarr,array('class'=>'span2'));  ?>
		<?php echo $form->error($model,'estimated_time'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_other_names'); ?>
		<?php echo $form->textArea($model, 'temple_other_names',array('class'=>'span5','style'=>'max-width:450px;min-width:450px;'));  ?>
		<?php echo $form->error($model,'temple_other_names'); ?>
	</div>
	
	<?php 
	$featured_listing = CHtml::listData(FeaturedListing::model()->findAll(array('order' => 'id')), 'id', 'name');
	?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'featured_listing'); ?>
		<?php echo $form->dropDownList($model, 'featured_listing', $featured_listing,array('empty'=>'Select Featured Listing','class'=>'span3'));  ?>
		<?php echo $form->error($model,'featured_listing'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'main_image'); ?>
		<?php echo $form->fileField($model,'main_image'); ?>

		<?php if($model->isNewRecord!='1'){ ?>
		  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/temple_images/'.$model->main_image,"main_image",array("width"=>200)); ?>
	<?php } ?>
		<?php echo $form->error($model,'main_image'); ?>
	</div>

	<?php if(!isset(Yii::app()->session['width'])) { ?>
	<p class="hint">Note: Image size must graater then 400*600(Width*height).</p>
	<?php } ?>
	<p style="color:#FF0000;"> <?php  if(isset(Yii::app()->session['width'])) { echo Yii::app()->session['width']; } ?></p>
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'temple_information'); ?>
		<?php echo $form->textArea($model,'temple_information',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_information'); ?>
	</div>
	
	
	
		<div class="row">
		<?php echo $form->labelEx($model,'temple_pooja_timings'); ?>
		<?php echo $form->textArea($model,'temple_pooja_timings',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_pooja_timings'); ?>
	</div>
	
	
		<div class="row">
		<?php echo $form->labelEx($model,'temple_offerings'); ?>
		<?php echo $form->textArea($model,'temple_offerings',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_offerings'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'temple_events'); ?>
		<?php echo $form->textArea($model,'temple_events',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_events'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'temple_map_content'); ?>
		<?php echo $form->textArea($model,'temple_map_content',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'temple_map_content'); ?>
	</div>
	

	
	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude',array('size'=>50,'maxlength'=>50,'class'=>'span5')); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'logtitute');?>
		<?php echo $form->textField($model,'logtitute',array('size'=>50,'maxlength'=>50,'class'=>'span5')); ?>
		<?php echo $form->error($model,'logtitute'); ?>
	</div>


	<div class="row buttons">
		<?php  echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit')); ?>
		
		  <button type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/temples/admin/'; ?>'"  class="btn  btn-large" >Cancel</button>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
$('.timepicker1').timepicker();
</script>

<script>
 function onChangecountry(country_id)
 {
 
 if(country_id=='')
 {
   $('#Temples_state_id').html('<option value="">Select State</option>');
 }
 else
 {
       $.ajax({
              url : '<?php echo  CController::createUrl('states/list_country'); ?>',
              type : "post",
              data : 'country_id='+country_id,
              success:function(data)
              {
			   $('#Temples_state_id').html(data);
			  } 
         });
    }
 }
 
 function onChangestate(state_id)
 {
  if(state_id=='')
 {
   $('#Temples_city_id').html('<option value="">Select City</option>');
 }
 else
 {
 $.ajax({
              url : '<?php echo  CController::createUrl('states/list_cities'); ?>',
              type : "post",
              data : 'state_id='+state_id,
              success:function(data)
              {
			   $('#Temples_city_id').html(data);
			  } 
         });
	}
 }
 
 

</script>

<script type="text/javascript">

$('#submit').click(function() {
     tinymce.triggerSave();
});

  var main_image  ='<?php echo $model->main_image; ?>';
  
  if(main_image!='')
  {
  $('#ytTemples_main_image').val(main_image);
  }
  
  $(document).ready(function(){
   $('#Temples_main_image').change(function(){
      $('#ytTemples_main_image').val($(this).val());
  });
  });
  
  
 
  
</script>
