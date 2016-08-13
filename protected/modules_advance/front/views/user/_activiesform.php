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


	
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapfront.css" />
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" />

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $(function() {
    $('.timepicker1').timepicker({
	    minuteStep: 1,
		showSeconds: false,
		showMeridian: false,
		defaultTime: false
	});
  });
</script>
	
	<?php $guidedetails =   Guide::model()->findByPk($id); 
	$userdetails =  User::model()->findByPk($guidedetails->user_id); 
	$guidecategories = $guidedetails->guide_categories;
	$guidelanguages =  explode(',',$guidedetails->guide_sec_languages);
	$guideservices =  explode(',',$guidedetails->guide_services);
	$guidelocations =  explode(',',$guidedetails->secondary_locations);
	array_push($guidelocations,$guidedetails->guide_city);
	array_push($guidelanguages,$userdetails->language);
	$guidelocations = array_unique($guidelocations);
	$guidelanguages = array_unique($guidelanguages);
	$model->category_id = $guidecategories;
	?>
  
	  <div id="<?php echo $key; ?>" class="activitieslist activitieslist<?php echo $key; ?>">
	  
	  <div class="control-group">
	  <h3>Activities plan <?php echo $key; ?></h3>
	  </div>
	  
	  
	  
	 <?php 
				 if($model->isNewRecord)
				 $model->activity_title = $temple->temple_name.', '.$temple->city->name; 
	             echo CHtml::hiddenField('Guideactivities['.$key.'][activity_title]',$model->activity_title,array('size'=>450,'maxlength'=>450,'class'=>''));
				 ?> 
	<div class="control-group">
		<?php echo CHtml::activeLabelEx($model,'activity_title'); ?>
		 <div class="controls">
		<?php //echo CHtml::textField('Guideactivities['.$key.'][activity_title]',$model->activity_title,array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
		<b><?php echo $model->activity_title; ?></b>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_description'); ?>
		 <div class="controls">
		<?php echo CHtml::textArea('Guideactivities['.$key.'][activity_description]',$model->activity_description,array('rows'=>3)); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_duration'); ?>
		 <div class="controls">
		 <?php 
	/*	 $durationarray = array('0.10'=>'10 Minutes' ,'0.20'=>'20 Minutes','0.30'=>'30 Minutes','0.40'=>'40 Minutes','0.50'=>'50 Minutes');
		 for($i=1; $i<=24; $i++){
		 $durationarray[] = $i.' Hours';
		 }*/
		 ?>
		<?php // echo CHtml::dropDownList('Guideactivities['.$key.'][activity_duration]',$model->activity_duration,$durationarray,array('prompt'=>'Please select')); ?>
		<!--<b>Hours</b>-->
		  <div class="input-append bootstrap-timepicker">
			<?php  echo CHtml::textField('Guideactivities['.$key.'][activity_duration]',$model->activity_duration,array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small','required'=>true));  ?>
			<span class="add-on" style="height:26px;"><i class="icon-time"></i></span>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_language'); ?>
		 <div class="controls">
		<?php echo CHtml::dropDownList( 'Guideactivities['.$key.'][activity_language]', $model->activity_language,CHtml::listData(Languages::model()->getall_byids($guidelanguages),'language_id','language_name'), array('multiple'=>'multiple','required'=>true)); ?>
		</div>
	</div>
	
	<!--<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'category_id'); ?>
		 <div class="controls">
		<?php echo  CHtml::hiddenField( 'Guideactivities['.$key.'][category_id]', $model->category_id); ?>
		</div>
	</div>-->
	
	<?php echo  CHtml::hiddenField( 'Guideactivities['.$key.'][category_id]', $model->category_id); ?>
	
	<!--<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'service_id'); ?>
		 <div class="controls">
		<?php echo  CHtml::dropDownList('Guideactivities['.$key.'][service_id]', $model->service_id, CHtml::listData(Services::model()->getall_byids($guideservices),'service_id','service_name'), array('prompt'=> 'Please Select')); ?>
		</div>
	</div>-->
	

	
	
	
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'starting_point_content',array('class'=>'')); ?>
		<div class="controls"  style="margin-left:155px;">
		
		  <?php
			$this->widget('ext.editor.CKkceditor',array(
			"name"=>'Guideactivities['.$key.'][starting_point_content]',         # Attribute in the Data-Model
			"height"=>'200px',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
		</div>
	</div>
	
	
	<!--<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'starting_point_addr'); ?>
		 <div class="controls">
		<?php echo CHtml::textArea('Guideactivities['.$key.'][starting_point_addr]',$model->starting_point_addr,array('rows'=>3)); ?>
		</div>
	</div>-->
		
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'availability_dates',array('class'=>'')); ?>
		 <div class="controls "  style="margin-left:155px;">
		<div id="multidatepicker<?php echo $key; ?>"></div>
		<?php echo CHtml::hiddenField('Guideactivities['.$key.'][availability_dates]',$model->availability_dates,array('id'=>'availabledate'.$key,'required'=>true)); ?>
		</div>
	</div>
	
	
	
	
	
	<!--<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_start_timings',array('class'=>'')); ?>
		 <div class="controls">
		 <?php $timearr  = array('0.30'=>'0.30','1.00'=>'1.00','1.30'=>'1.30','2.00'=>'2.00','2.30'=>'2.30','3.00'=>'3.00','3.30'=>'3.30','4.00'=>'4.00','4.30'=>'4.30','5.00'=>'5.00','5.30'=>'5.30','6.00'=>'6.00','6.30'=>'6.30','7.00'=>'7.00','7.30'=>'7.30','8.00'=>'8.00','8.30'=>'8.30','9.00'=>'9.00','9.30'=>'9.30','10.00'=>'10.00','10.30'=>'10.30','11.00'=>'11.00','11.30'=>'11.30','12.00'=>'12.00','12.30'=>'12.30','13.00'=>'13.00','13.30'=>'13.30','14.00'=>'14.00','14.30'=>'14.30','15.00'=>'15.00','15.30'=>'15.30','16.00'=>'16.00','16.30'=>'16.30','17.00'=>'17.00','17.30'=>'17.30','18.00'=>'18.00','18.30'=>'18.30','19.00'=>'19.00','19.30'=>'19.30','20.00'=>'20.00','20.30'=>'20.30','21.00'=>'21.00','21.30'=>'21.30','22.00'=>'22.00','22.30'=>'22.30','23.00'=>'23.00','23.30'=>'23.30','24.00'=>'24.00'); ?>
		<?php echo  CHtml::dropDownList('Guideactivities['.$key.'][activity_start_timings]', $model->service_id, $timearr, array('prompt'=> 'Please Select','multiple'=>'multiple','required'=>true)); ?>
		</div>
	</div>-->
	
	
	<div class="control-group">
		<?php //echo  CHtml::activeLabelEx($model,'activity_plans',array('class'=>'')); ?>
		 <div class="controls">
		 <?php //echo  CHtml::dropDownList( 'Guideactivities['.$key.'][plan_per]', '', array('per_person'=>'Per Person','per_group'=>'Per Group'), array('prompt'=> 'Please Select','onchange'=>'selectactivityplanper(this.value,\''.$key.'\')','required'=>true)); ?>
		  <?php echo  CHtml::hiddenField( 'Guideactivities['.$key.'][plan_per]', 'per_person'); ?>
		 <?php  $g = '1';   ?>
		<!-- <div class="activitiesgroupforms activitiesgroupforms<?php echo $key; ?>"  id="<?php echo $key; ?><?php echo $g; ?>" style="display:none">
		   <input type="button" class="btn btn-success span2 pull-right get_Guide_activities_group_form<?php echo $key; ?>" value="Add more group" data-id="<?php echo $key; ?>" />	
		   <?php $this->renderPartial('_activiesgroupform', array('model'=>$model,'key'=>$key,'g'=>$g)); ?>			 
		 </div>-->
		 
		 <?php  $p = '1';   ?>
		 <div class="activitiespersonforms activitiespersonforms<?php echo $key; ?>"  id="<?php echo $p; ?>">
		   <!--<input type="button" class="btn btn-success span2 pull-right get_Guide_activities_person_form<?php echo $key; ?>" value="Add more person" data-id="<?php echo $key; ?>" />	-->
		   <?php $this->renderPartial('_activiespersonform', array('model'=>$model,'key'=>$key,'p'=>$p)); ?>			 
		 </div>
		
		 
		</div>
	</div>
	
	
		
	</div>


<script type="text/javascript">
		$(function() {
		
		
		    var today = new Date();
			var y = today.getFullYear();
				$('#multidatepicker<?php echo $key; ?>').multiDatesPicker({
				altField: '#<?php  echo 'availabledate'.$key; ?>',
				dateFormat: "yy-mm-dd",
				numberOfMonths: [1,2],
				minDate: "-0D",
			});
		});
		
		$(function(){
		   
		   
		   $('.activitieslists .get_Guide_activities_group_form<?php echo $key; ?>').click(function(){
																var parent = $(this).parent();
															var key2 = parseInt($(this).parent().attr('id'));
															key2++;
															$(this).parent().attr('id',key2);
															var key7 =  parseInt(<?php echo $key; ?>)*10;
															key2 = key2 - key7;
															var key3 =  parseInt($(this).attr('data-id'));
																$.get(SITE_BASE_URL+'index.php/front/user/guideactivitygroupform/key/'+key3+'/g/'+key2, function(data){
																								   parent.append(data);
																								   });
		   
		     });
			 
			   $('.activitieslists .get_Guide_activities_person_form<?php echo $key; ?>').click(function(){
																var parent = $(this).parent();
															var key4 = parseInt($(this).parent().attr('id'));
															key4++;
															$(this).parent().attr('id',key4);
															var key5 =  parseInt($(this).attr('data-id'));
																$.get(SITE_BASE_URL+'index.php/front/user/guideactivitypersonform/key/'+key5+'/p/'+key4, function(data){
																								   parent.append(data);
																								   });
		   
		     });
		   });
		</script>