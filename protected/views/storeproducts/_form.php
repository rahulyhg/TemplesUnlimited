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
	'id'=>'storeproducts-form',
	'enableAjaxValidation'=>true,
					'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>
<p class="note">Fields with <span class="required">*</span> are required.</p>


	<?php //echo $form->errorSummary($model); ?>
<style type="text/css">
.productscategories_list{ padding:10px; border:1px solid #ccc; margin-left: 0px !important; }
.productscategories_list li{ list-style-type:none; padding:9px 5px; cursor:pointer; }
.productscategories_list li:hover{ border:1px solid #ccc; }
.productcategory{ color: #008000;    font-size: 19px; }
.product_option{ border-bottom:1px solid #ccc; }
.product_options_list 
{
    border: 1px solid #CCCCCC;
    padding: 20px;
}
.myTextEditor
{
width:100%;
height:300px;
  
}
</style>

	
	<div class="row">
		<?php echo $form->labelEx($model,'store_category_id'); ?><b class="productcategory"><?php echo ($model->store_category_id)?$model->category->category_name:''; ?></b>
		<div class="productscategories_list_div">
		<ul class="span4 productscategories_list">
		<?php $productcategories = Storecategories::model()->getall_parent(); ?>
		<?php foreach( $productcategories as  $productcategory){ ?>
			<li class="productscategories" onclick="selectproductcategories('<?php echo $productcategory->category_id; ?>')">
			<?php echo $productcategory->category_name; ?>
			</li>
		<?php } ?>
		</ul>
		</div>
		<?php echo $form->hiddenField($model,'store_category_id'); ?></b>
		<?php echo $form->error($model,'store_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>150,'maxlength'=>150,'class'=>'span5','maxlength'=>'40')); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'product_code'); ?>
		<?php echo $form->textField($model,'product_code',array('size'=>150,'maxlength'=>150,'class'=>'span5')); ?>
		<?php echo $form->error($model,'product_code'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>150,'maxlength'=>150,'class'=>'span5','onkeypress'=>'return isNumber(event)')); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>150,'maxlength'=>150,'class'=>'span5')); ?>
		<?php echo $form->error($model,'location'); ?>
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
		<?php echo $form->labelEx($model,'payment_options'); ?>
		<?php echo $form->dropDownList($model, 'payment_options', array('Credit/Debit Card'=>'Credit/Debit Card','Bank deposit'=>'Bank deposit','COD'=>'COD' ), array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'payment_options'); ?>
	</div>

	<div class="row">
	    <label class="checkbox">
		<?php echo $form->checkBox($model,'product_have_variations'); ?>&nbsp;Product has multiple variations
		</label>
		<?php echo $form->error($model,'product_have_variations'); ?>
	</div>
	
	<div class="product_have_options_no">
	<div class="row">
		<?php echo $form->labelEx($model,'product_price'); ?>
		<?php echo $form->textField($model,'product_price',array('size'=>150,'maxlength'=>150,'class'=>'span5','onkeypress'=>'return isNumber(event)')); ?>
		<?php echo $form->error($model,'product_price'); ?>
	</div>
	
	 <div class="row">
		<?php echo $form->labelEx($model,'product_shipping_price'); ?>
		<?php echo $form->textField($model,'product_shipping_price',array('size'=>150,'maxlength'=>150,'class'=>'span5','onkeypress'=>'return isNumber(event)')); ?>
		<?php echo $form->error($model,'product_shipping_price'); ?>
	</div>
	</div>
	
	
	  <div class="product_have_options" style="display:none">	
	<div class="row">
		<?php echo cHtml::link('Add more','javascript:void(0);',array('onclick'=>'get_product_option_form()','class'=>'btn btn-success pull-right color-white nounderline')); ?>
	</div>
	<div class="product_options_list">
	<h3><b>Product variations</b></h3>
	<?php
	
	 if(isset($_POST['Productvariations']) && count($_POST['Productvariations'])){
	  $productoptionscount = 0;
	    foreach($_POST['Productvariations'] as $Productvariations){ $productoptionscount++;
		 $productvariations = new Productvariations;
		  $productvariations->attributes=$Productvariations;
		   $this->renderPartial('variations_form', array('model'=>$model,'productvariations'=>$productvariations,'key'=>$productoptionscount)); 
		}
	 }else if($model->isNewRecord!='1' && $model->product_have_variations == '1'){ 
	   $variations = $model->variations;
	   
	   $productoptionscount = 0;
		   if(count($variations)){
		      foreach($variations as $variation){ $productoptionscount++;
		       $this->renderPartial('variations_form', array('model'=>$model,'productvariations'=>$variation,'key'=>$productoptionscount)); 
			   }
			  } 
	   }else{
	    $this->renderPartial('variations_form', array('model'=>$model,'productvariations'=>$productvariations,'key'=>1)); 
		} ?>
		</div>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'product_image'); ?>
        <?php echo CHtml::activeFileField($model, 'product_image',array('onchange'=>'javascript:ajaxFileUpload(this.value);')); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/store/main_image/'.$model->product_image,"product_image",array("width"=>200)); ?>
	<?php } ?>
        <?php echo $form->error($model,'product_image'); ?>
	</div>
	
	
	<script>
	function ajaxFileUpload(imagename)
	{ 
	   $('#ytStoreproducts_product_image').val(imagename);
	}
	</script>
	

	<!--<div class="row">
        <?php //echo $form->labelEx($productimages,'product_image'); ?>
      	<?php  //echo $form->fileField($productimages,'product_image'); ?>&nbsp;
		<input type="button" class="btn btn-success" onclick="uploadpicture('Storeproductsimages_product_image')"  value="Upload" />&nbsp;<span class="upload_progress"></span>

        <?php //echo $form->error($productimages,'product_image'); ?>
		<div>
		<ul class="pimagelist">
		<?php //if(isset($productimagesalready) && count($productimagesalready)){
		//foreach($productimagesalready as $productimagesalreadyimg){ 
		?>
		<li class="span3 thumbnail" id="imagelist<?php //echo $productimagesalreadyimg->product_image_id; ?>"><a class="deleteqimage" href="javascript:void(0);" onclick="deletepimage('Storeproductsimages_product_image','<?php //echo $productimagesalreadyimg->product_image_id; ?>','2')"></a><img src="<?php// echo Yii::app()->request->baseUrl.'/'.$productimagesalreadyimg->product_image; ?>" style="max-width:100%;"/></li>
		<?php// } } ?>
		<?php //if(isset($productimagesarr) && count($productimagesarr)){
		//foreach($productimagesarr as $productimage){ 
		?>
		<li class="span3 thumbnail"><a class="deleteqimage" href="javascript:void(0);" onclick="deletepimage('Storeproductsimages_product_image','<?php //echo $productimage; ?>','1')"></a><img src="<?php //echo Yii::app()->request->baseUrl.'/'.$productimage; ?>" style="max-width:100%;"/></li>
		
		<?php// } } ?>
		</ul></div>
	</div>-->


	<div class="row">
			<?php echo $form->labelEx($model,'product_overview'); ?>
		<?php echo $form->textArea($model,'product_overview',array('rows'=>5,'class'=>'span5 myTextEditor','style'=>'max-width:450px;min-width:450px;')); ?>
		<?php echo $form->error($model,'product_overview'); ?>
	</div>
	
	
	
	 <input type="hidden" name="key" id="key" value="1"  />


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large','id'=>'submit','onclick'=>'return checkvalues();')); ?>
		
		 <button type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/storeproducts/admin'; ?>'"  class="btn  btn-large" >Cancel</button>
	</div>

<?php $this->endWidget(); ?>

</div>


<script>
function checkvalues()
{
  var check;
  
  check = $("#Storeproducts_product_have_variations").is(":checked");
    if(check)
	 {
    var count = $('#key').val();
	
	var res = count.split(","); 
	
	for(i=0;i<res.length;i++)
	{ 
	  if(( $('#Productvariations_'+res[i]+'_product_variation_title').val()=='' ) || ( $('#Productvariations_'+res[i]+'_product_price').val()=='') )
	  {
	  $('#Productvariations_'+res[i]+'_product_variation_title_em_').html('Options Title cannot be blank.');
	  $('#Productvariations_'+res[i]+'_product_price_em_').html('Options Price cannot be blank.');
	  $('#Productvariations_'+res[i]+'_product_variation_title_em_').show();
	  $('#Productvariations_'+res[i]+'_product_price_em_').show();
	  }
	  else
	  {
	   $('#Productvariations_'+res[i]+'_product_variation_title_em_').html('');
	   $('#Productvariations_'+res[i]+'_product_price_em_').html('');
	  }
    }

 } 
}
</script>

<script type="text/javascript">
	 $(function(){
		$('input[type="file"]').change(function(){
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
			     if(fileupload.size > 1048576){
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
		
		$('li.productscategories').click(function(){
		   $(this).parent().nextAll().remove();
		});
		
		
		$('#Storeproducts_product_have_variations').change(function(){
			if($(this).is(':checked')){
			$('.product_have_options_no').css('display','none');
			$('.product_have_options').css('display','block');
			$('.optionform_required').attr('required',true);
			}else{
			$('.product_have_options').css('display','none');
			$('.product_have_options_no').css('display','block');
			$('.optionform_required').attr('required',false);
			}
			});
			if($('#Storeproducts_product_have_variations').is(':checked')){
			$('#Storeproducts_product_have_variations').click();
			}

	<?php 
	 if(isset($_POST['Productvariations']) && count($_POST['Productvariations'])  && $model->product_have_variations == '1'){ ?>
	    option_form_count = parseInt('<?php echo $productoptionscount; ?>');
	    $('#Storeproducts_product_have_variations').click();
	<?php  }else if($model->isNewRecord!='1' && $model->product_have_variations == '1'){ ?>
	    option_form_count = parseInt('<?php echo $productoptionscount; ?>');
	    $('#Storeproducts_product_have_variations').click();
	<?php } ?>
	
	<?php if(isset( $_POST['Storeproductsimages'] ) && isset( $_POST['Storeproductsimages']['product_image'] )){
	   ?>
	     $('#ytStoreproductsimages_product_image').val('<?php echo $_POST['Storeproductsimages']['product_image']; ?>');
	<?php } ?>
	  });
	  
	  $('#submit').click(function() {
     tinymce.triggerSave();
});


 var product_image  ='<?php echo $model->product_image; ?>';
  
  if(product_image!='')
  {
  $('#ytStoreproducts_product_image').val(product_image);
  }
 


	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57 )) {
        return false;
    }
    return true;
}
	</script>	
