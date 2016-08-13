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
.wpcf7-form input[type="text"], .wpcf7-form input[type="password"], .wpcf7-form input[type="email"],  .wpcf7-form input[type="file"], .wpcf7-form textarea, .wpcf7-form select {
    border: 1px solid #E8E8E8;
    color: #666666;
    font-family: 'Arial',sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
}



.wpcf7-form input[type="text"], .wpcf7-form input[type="password"], .wpcf7-form input[type="email"], .wpcf7-form input[type="file"], .wpcf7-form textarea, .wpcf7-form select{
    border: 1px solid #D5D5D5;
    margin-bottom: 15px;
    width: 350px;
}
 .wpcf7-form select{
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
.pull-right{ float:right; }
.pull-left{ float:left; }

.activitieslist {
    border-bottom: 1px dotted;
    margin: 15px 0;
}
.activitiesgroupform {
    border: 1px dashed #CCCCCC;
    padding: 10px;
}
.activitiespersonform {
    border: 1px dashed #CCCCCC;
    padding: 10px;
}
.activitiesgroupmemberforms, .activitiesgroupmemberform {
    clear: both;
}
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


  
	  <div id="<?php echo $key; ?>" class="activitieslist activitieslist<?php echo $key; ?>">
	  
	  <div class="control-group">
	  <!--<h3>Activities plan <?php echo $key; ?></h3>-->
	  </div>
	  
	  
	  
	 <?php 
				 if($model->isNewRecord)
				 $model->activity_title = $pooja->pooja_name; 
	             echo CHtml::hiddenField('Iyeractivities['.$key.'][activity_title]',$model->activity_title,array('size'=>450,'maxlength'=>450,'class'=>''));
				 ?> 
	<div class="control-group">
		<?php echo CHtml::activeLabelEx($model,'activity_title'); ?>
		 <div class="controls">
		<?php //echo CHtml::textField('Iyeractivities['.$key.'][activity_title]',$model->activity_title,array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
		<b><?php echo $model->activity_title; ?></b>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_description'); ?>
		 <div class="controls">
		<?php echo CHtml::textArea('Iyeractivities['.$key.'][activity_description]',$model->activity_description,array('rows'=>3)); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'amount_without_items'); ?>
		 <div class="controls">
		<?php echo CHtml::textField('Iyeractivities['.$key.'][amount_without_items]',$model->amount_without_items,array('required'=>true)).'&nbsp'.Yii::app()->params['currency_symbol']; ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'amount_with_items'); ?>
		 <div class="controls">
		<?php echo CHtml::textField('Iyeractivities['.$key.'][amount_with_items]',$model->amount_with_items,array('required'=>true)).'&nbsp'.Yii::app()->params['currency_symbol']; ?>
		</div>
	</div>
	
		<br/>
	</div>