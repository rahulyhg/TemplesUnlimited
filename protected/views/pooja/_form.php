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
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temples-form',
	'enableAjaxValidation'=>true,
	//'enableClientValidation'=>true,
					'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>
<style type="text/css">
.productscategories_list{ padding:10px; border:1px solid #ccc; margin-left: 0px !important; }
.productscategories_list li{ list-style-type:none; padding:9px 5px; cursor:pointer; }
.productscategories_list li:hover{ border:1px solid #ccc; }
.productcategory{ color: #008000;    font-size: 19px; }
</style>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
		<?php  //echo $form->errorSummary($model); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_category_id'); ?><b class="productcategory"><?php echo ($model->pooja_category_id)?$model->category->category_name:''; ?></b>
		<div class="productscategories_list_div">
		<ul class="span4 productscategories_list">
		<?php $productcategories = Poojacategories::model()->getall_parent(); ?>
		<?php foreach( $productcategories as  $productcategory){ ?>
			<li class="productscategories" onclick="selectpoojacategories('<?php echo $productcategory->category_id; ?>')">
			<?php echo $productcategory->category_name; ?>
			</li>
		<?php } ?>
		</ul>
		</div>
		<?php echo $form->hiddenField($model,'pooja_category_id'); ?></b>
		<?php echo $form->error($model,'pooja_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pooja_name'); ?>
		<?php echo $form->textField($model,'pooja_name',array('size'=>150,'maxlength'=>150,'class'=>'span5','maxlength'=>'40')); ?>
		<?php echo $form->error($model,'pooja_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_code'); ?>
		<?php echo $form->textField($model,'pooja_code',array('size'=>150,'maxlength'=>150,'class'=>'span5')); ?>
		<?php echo $form->error($model,'pooja_code'); ?>
	</div>
	
	<!--<div class="row">
		<?php  //echo $form->labelEx($model,'pooja_description'); ?>
		<?php //echo $form->textArea($model,'pooja_description',array('rows'=>5,'class'=>'span5')); ?>
		<?php //echo $form->error($model,'pooja_description'); ?>
	</div>-->
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_address'); ?>
		<?php echo $form->textArea($model,'pooja_address',array('rows'=>3,'class'=>'span5')); ?>
		<?php echo $form->error($model,'pooja_address'); ?>
	</div>
	
	
	<div class="row">     
		<?php echo $form->labelEx($model,'pooja_country'); ?>
		<?php
			$list = CHtml::listData(Country::model()->findAll(array('order' => 'country')), 'id', 'country');
			echo $form->dropDownList($model,'pooja_country', $list,array('empty'=>'Select Country', 'onchange'=>'javascript:onChangecountry(this.value);','class'=>'span5'));   
		?>
		<?php echo $form->error($model,'pooja_country'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_state'); ?>
		<?php 
		
		 if($model->isNewRecord)
		 $list =array();
		 else
		 $list = CHtml::listData(States::model()->findAll(array('order' => 'state_name')), 'id', 'state_name');
			
			
			echo $form->dropDownList($model, 'pooja_state', $list, array('empty'=>'Select State','class'=>'span5','onchange'=>'javascript:onChangestate(this.value);'));   
		?>
		<?php echo $form->error($model,'pooja_state'); ?>
	</div>
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_city'); ?>
		<?php 
		 if($model->isNewRecord)
		 $list =array();
		 else
		 $list = CHtml::listData(Cities::model()->findAll(array('order' => 'name')), 'id', 'name');
			
			echo $form->dropDownList($model, 'pooja_city', $list, array('empty'=>'Select City','class'=>'span5'));   
		?>
		<?php echo $form->error($model,'pooja_city'); ?>
	</div>


	
	
<!--	<div class="row">
          <?php //echo $form->labelEx($model,'pooja_image'); ?>
      	<?php //echo CHtml::activeFileField($model, 'pooja_image'); ?>&nbsp;
		<input type="button" class="btn btn-success" onclick="uploadpoojapicture('Pooja_pooja_image')"  value="Upload" />&nbsp;<span class="upload_progress"></span>

        <?php //echo $form->error($model,'pooja_image'); ?>
		<div>
		<ul class="pimagelist">
		<?php //if(isset($poojaimagesalready) && count($poojaimagesalready)){
		//foreach($poojaimagesalready as $poojaimagesalreadyimg){ 
		?>
		<li class="span3 thumbnail" id="imagelist<?php //echo $poojaimagesalreadyimg->image_id; ?>"><a class="deleteqimage" href="javascript:void(0);" onclick="deletepoojaimage('Pooja_pooja_image','<?php// echo $poojaimagesalreadyimg->image_id; ?>','2')"></a><img src="<?php// echo Yii::app()->request->baseUrl.'/'.$poojaimagesalreadyimg->image_path; ?>" style="max-width:100%;"/></li>
		<?php// } } ?>
		<?php //if(isset($productimagesarr) && count($productimagesarr)){
	//	foreach($productimagesarr as $productimage){ 
		?>
		<li class="span3 thumbnail"><a class="deleteqimage" href="javascript:void(0);" onclick="deletepoojaimage('Pooja_pooja_image','<?php //echo $productimage; ?>','1')"></a><img src="<?php //echo Yii::app()->request->baseUrl.'/'.$productimage; ?>" style="max-width:100%;"/></li>
		
		<?php// } } ?>
		</ul></div>
	</div>-->
	
	
		
	<div class="row">
        <?php echo $form->labelEx($model,'pooja_image'); ?>
        <?php echo CHtml::activeFileField($model,'pooja_image',array('onchange'=>'javascript:ajaxFileUpload(this.value);')); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/pooja/main_image/'.$model->pooja_image,"pooja_image",array("width"=>200)); ?>
	<?php } ?>
        <?php echo $form->error($model,'pooja_image'); ?>
	</div>
	
	
	<script>
	function ajaxFileUpload(imagename)
	{ 
	   $('#ytPooja_pooja_image').val(imagename);
	}
	</script>
	
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>150,'maxlength'=>150,'class'=>'span5')); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>
	
	<?php $durationarr = array();
		for($i=1; $i<=60; $i++){
		$durationarr[$i] = $i;
		}
		$durationoptionarr = array('Minute(s)'=>'Minute(s)','Hour(s)'=>'Hour(s)','Day(s)'=>'Day(s)','Week(s)'=>'Week(s)','Month(s)'=>'Month(s)');
	?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'delivery_time_1'); ?>
		<?php echo $form->dropDownList($model,'delivery_time_1',$durationarr,array('class'=>'span1')); ?>&nbsp;<?php echo $form->dropDownList($model,'delivery_time_1option',$durationoptionarr,array('class'=>'span2')); ?>
		<?php echo $form->error($model,'delivery_time_1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'delivery_time_2'); ?>
		<?php echo $form->dropDownList($model,'delivery_time_2',$durationarr,array('class'=>'span1')); ?>&nbsp;<?php echo $form->dropDownList($model,'delivery_time_2option',$durationoptionarr,array('class'=>'span2')); ?>
		<?php echo $form->error($model,'delivery_time_2'); ?>
	</div>
	
	<div class="row">
	    <label class="checkbox">
		<?php echo $form->checkBox($model,'pooja_have_options'); ?>&nbsp;Pooja has multiple options
		</label>
		<?php echo $form->error($model,'pooja_have_options'); ?>
	</div>
	
	<div class="pooja_have_options_no">
		<div class="row">
		<?php echo $form->labelEx($model,'pooja_price'); ?>
		<?php echo $form->textField($model,'pooja_price',array('size'=>250,'maxlength'=>250,'class'=>'span5','onkeypress'=>'return isNumber(event)')); ?>
		<?php echo $form->error($model,'pooja_price'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_shipping_price'); ?>
		<?php echo $form->textField($model,'pooja_shipping_price',array('size'=>250,'maxlength'=>250,'class'=>'span5','onkeypress'=>'return isNumber(event)')); ?>
		<?php echo $form->error($model,'pooja_shipping_price'); ?>
	</div>
	</div>
	
	
  <div class="pooja_have_options" style="display:none">	
	<div class="row">
		<?php echo cHtml::link('Add more','javascript:void(0);',array('onclick'=>'get_pooja_option_form()','class'=>'btn btn-success pull-right color-white nounderline')); ?>
	</div>
	<div class="pooja_options_list">
	<h3><b>Pooja Options</b></h3>
	<?php if($model->isNewRecord!='1' && $model->pooja_have_options == '1'){ 
	   $options = $model->poojaoptions;
	   
	   $poojaoptionscount = 0;
		   if(count($options)){
		      foreach($options as $option){ $poojaoptionscount++;
		       $this->renderPartial('options_form', array('model'=>$model,'poojaoptions'=>$option,'key'=>$poojaoptionscount)); 
			   }
			  } 
	   }else{
	    $this->renderPartial('options_form', array('model'=>$model,'poojaoptions'=>$poojaoptions,'key'=>1)); 
		} ?>
		</div>
	</div>
	
	 
	  
	
	<div class="row">
		<?php echo $form->labelEx($model,'payment_options'); ?>
		<?php echo $form->dropDownList($model, 'payment_options', array('Credit/Debit Card'=>'Credit/Debit Card','Bank deposit'=>'Bank deposit','COD'=>'COD' ), array( 'multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'payment_options'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'pooja_overview'); ?>
		<?php echo $form->textArea($model,'pooja_overview',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'pooja_overview'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit','onclick'=>'return checkvalues();')); ?>
		
		 <input type="button" value="Cancel" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/pooja/admin'; ?>'"  class="btn  btn-large" >
	</div>
	
	 <input type="hidden" name="key" id="key" value="1"  />

<?php $this->endWidget(); ?>

</div>


<script>
function checkvalues()
{
  var check;
  
  check = $("#Pooja_pooja_have_options").is(":checked");
    if(check)
	 {
    var count = $('#key').val();
	
	var res = count.split(","); 
	
	for(i=0;i<res.length;i++)
	{ 
	  if(( $('#Poojaoptions_'+res[i]+'_option_desc').val()=='' ) || ( $('#Poojaoptions_'+res[i]+'_option_price').val()=='') )
	  {
	  $('#Poojaoptions_'+res[i]+'_option_desc_em_').html('Options Title cannot be blank.');
	  $('#Poojaoptions_'+res[i]+'_option_price_em_').html('Options Price cannot be blank.');
	  $('#Poojaoptions_'+res[i]+'_option_desc_em_').show();
	  $('#Poojaoptions_'+res[i]+'_option_price_em_').show();
	  }
	  else
	  {
	   $('#Poojaoptions_'+res[i]+'_option_desc_em_').html('');
	  $('#Poojaoptions_'+res[i]+'_option_price_em_').html('');
	  }
    }

 } 
}
</script>

<script type="text/javascript">
$('#submit').click(function() {
     tinymce.triggerSave();
});


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
	
		<?php if(isset($productimagesarr) && count($productimagesarr)){
	   ?>
	     $('#ytPooja_pooja_image').val('<?php echo $_POST['Pooja']['pooja_image']; ?>');
	<?php } ?>
});
</script>

<style>
.myTextEditor
{
width:100%;
height:300px;
  
}
</style>

<script>
 function onChangecountry(country_id)
 {
 
 if(country_id=='')
 {
   $('#Pooja_pooja_state').html('<option value="">Select State</option>');
 }
 else
 {
       $.ajax({
              url : '<?php echo  CController::createUrl('states/list_country'); ?>',
              type : "post",
              data : 'country_id='+country_id,
              success:function(data)
              {
			   $('#Pooja_pooja_state').html(data);
			  } 
         });
    }
 }
 
 function onChangestate(state_id)
 {
  if(state_id=='')
 {
   $('#Pooja_pooja_city').html('<option value="">Select City</option>');
 }
 else
 {
 $.ajax({
              url : '<?php echo  CController::createUrl('states/list_cities'); ?>',
              type : "post",
              data : 'state_id='+state_id,
              success:function(data)
              {
			   $('#Pooja_pooja_city').html(data);
			  } 
         });
	}
 }
 
   var pooja_image  ='<?php echo $model->pooja_image; ?>';
  
  if(pooja_image!='')
  {
  $('#ytPooja_pooja_image').val(pooja_image);
  }
 

</script>

		<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57 )) {
        return false;
    }
    return true;
}

	</script>	
