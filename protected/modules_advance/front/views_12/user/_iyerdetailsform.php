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
.Iyerdetailsform .wpcf7-form input[type="text"],.Iyerdetailsform  .wpcf7-form input[type="password"], .Iyerdetailsform .wpcf7-form input[type="email"], .Iyerdetailsform .wpcf7-form input[type="file"],.Iyerdetailsform  .wpcf7-form textarea, .Iyerdetailsform .wpcf7-form select {
    border: 1px solid #E8E8E8;
    color: #666666;
    font-family: 'Arial',sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
}



.Iyerdetailsform .wpcf7-form input[type="text"], .Iyerdetailsform .wpcf7-form input[type="password"], .Iyerdetailsform .wpcf7-form input[type="email"], .Iyerdetailsform .wpcf7-form input[type="file"],.Iyerdetailsform  .wpcf7-form textarea, .Iyerdetailsform .wpcf7-form select{
    border: 1px solid #D5D5D5;
    margin-bottom: 15px;
    width: 350px;
}
 .Iyerdetailsform .wpcf7-form select{
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

#page .ui-icon {
    display: block;
}
</style>
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapfront.css" />
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
		<!-- loads mdp -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">
<link rel='stylesheet'   href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap_custom.css' type='text/css' media='all' />

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $(function() {
    $('.timepicker1').timepicker();
  });
</script>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Iyerdetails-form',
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
		<?php echo $form->labelEx($iyer,'iyer_wh1'); ?>
		 <div class="controls">
		  <div class="input-append bootstrap-timepicker">
			<?php
			 if($iyer->isNewRecord && !isset( $iyer->iyer_wh1)){
				   $iyer->iyer_wh1 = '9:00 AM';
				   $iyer->iyer_wh2 = '6:00 PM';
			   }
			 echo $form->textField($iyer,'iyer_wh1',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small')); ?>
			<span class="add-on"  style="height:26px;"><i class="icon-time"></i></span>
			</div>
			<div class=" bootstrap-timepicker"><span class="topart">&nbsp; to &nbsp;<span></div>
			 <div class="input-append bootstrap-timepicker">
			<?php  echo $form->textField($iyer,'iyer_wh2',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small'));  ?>
			<span class="add-on" style="height:26px;"><i class="icon-time"></i></span>
			</div>
		 <?php 
		 $durationarray = array();
		 for($i=1; $i<=24; $i++){
		 $durationarray[] = $i;
		 }
		 ?>
		<?php // echo $form->dropDownList($iyer,'iyer_wh',$durationarray,array('class'=>'')); ?>
		<!--<b>Hours</b>-->
		</div>
		<div style="clear:both">&nbsp;</div>
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
	
	
	
	<!--<div class="control-group">
		<?php //echo $form->labelEx($iyer,'iyer_amount',array('class'=>'')); ?>
		 <div class="controls">
		<?php //echo $form->textField($iyer,'iyer_amount').'   '.Yii::app()->params['currency_symbol']; ?>
		<?php //echo $form->error($iyer,'iyer_amount'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php //echo $form->labelEx($iyer,'iyer_amount_with_items',array('class'=>'')); ?>
		 <div class="controls">
		<?php //echo $form->textField($iyer,'iyer_amount_with_items').'   '.Yii::app()->params['currency_symbol']; ?>
		<?php ///echo $form->error($iyer,'iyer_amount_with_items'); ?>
		</div>
	</div>-->
	
	
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_image',array('class'=>'')); ?>
		 <div class="controls">
		<?php echo $form->fileField($iyer,'iyer_image'); ?>
		<input type="button" class="btn btn-success upload_button span2 " onclick="uploadiyerimage('Iyer_iyer_image')"  value="Upload" />&nbsp;<span class="upload_progress">
		<?php if(isset($_POST['Iyer']['iyer_image']) && $_POST['Iyer']['iyer_image'] != ''){ 
		    echo helpers::view_image($_POST['Iyer']['iyer_image'],array('height'=>'100px','width'=>'100px')); 
		}?>
		</span>
		<?php echo $form->error($iyer,'iyer_image'); ?>
		</div>
	</div>
	
		
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'availability_dates',array('class'=>'')); ?>
		 <div class="controls "  style="margin-left:155px;">
		<div id="multidatepicker"></div>
		<?php echo $form->hiddenField($iyer,'availability_dates',array('required'=>true)); ?>
		</div>
	</div>
	
	
	
	
	
	<div class="control-group">
		<?php echo $form->labelEx($iyer,'iyer_overview',array('class'=>'')); ?>
		 <div class="controls" style="margin-left:155px;">
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
	
	


	<div class="control-group">
	<label for="" class=" ">&nbsp;</label>
	  <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Continue', array('class'=>'sc-form-button')); ?>
		</div>
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
		
		
		
		
		
		    var today = new Date();
			var y = today.getFullYear();
				$('#multidatepicker').multiDatesPicker({
				altField: '#<?php  echo 'Iyer_availability_dates'; ?>',
				dateFormat: "yy-mm-dd",
				numberOfMonths: [1,2],
				minDate: "-0D",
			});
	
		
		
	  });
	</script>