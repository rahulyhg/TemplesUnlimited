<?php
/* @var $this TemplesController */
/* @var $model Temples */
/* @var $form CActiveForm */
?>
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" rel="stylesheet">-->
<style type="text/css">
.radio input[type="radio"], .checkbox input[type="checkbox"]{ margin-left:0px; }
</style>


	
	
	<?php $guidedetails =  Yii::app()->session['guide']; 
	$userdetails =  User::model()->findByPk($guidedetails->user_id); 
	$guidecategories = explode(',',$guidedetails->guide_categories);
	$guidelanguages =  explode(',',$guidedetails->guide_sec_languages);
	$guideservices =  explode(',',$guidedetails->guide_services);
	$guidelocations =  explode(',',$guidedetails->secondary_locations);
	array_push($guidelocations,$guidedetails->guide_city);
	array_push($guidelanguages,$userdetails->language);
	$guidelocations = array_unique($guidelocations);
	$guidelanguages = array_unique($guidelanguages);
	?>
  
	  <div id="<?php echo $key; ?>" class="activitieslist activitieslist<?php echo $key; ?>">
	  
	  <div class="control-group">
	  <h3>Activities plan <?php echo $key; ?></h3>
	  </div>
	  
	<div class="control-group">
		<?php echo CHtml::activeLabelEx($model,'activity_title'); ?>
		 <div class="controls">
		<?php echo CHtml::textField('Guideactivities['.$key.'][activity_title]',$model->activity_title,array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
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
		<?php echo CHtml::textField('Guideactivities['.$key.'][activity_duration]',$model->activity_duration,array('size'=>250,'maxlength'=>250,'class'=>'')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_language'); ?>
		 <div class="controls">
		<?php echo CHtml::dropDownList( 'Guideactivities['.$key.'][activity_language]', $model->activity_language,CHtml::listData(Languages::model()->getall_byids($guidelanguages),'language_id','language_name'), array('prompt'=> 'Please Select')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'category_id'); ?>
		 <div class="controls">
		<?php echo  CHtml::dropDownList( 'Guideactivities['.$key.'][category_id]', $model->category_id, CHtml::listData(Categories::model()->getall_byids($guidelanguages),'id','category_name'), array('prompt'=> 'Please Select')); ?>
		</div>
	</div>
	
	<!--<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'service_id'); ?>
		 <div class="controls">
		<?php echo  CHtml::dropDownList('Guideactivities['.$key.'][service_id]', $model->service_id, CHtml::listData(Services::model()->getall_byids($guideservices),'service_id','service_name'), array('prompt'=> 'Please Select')); ?>
		</div>
	</div>-->
	

	
	
	
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'starting_point_content',array('class'=>'')); ?>
		<div style=" clear:both">&nbsp;</div>
		  <?php
			$this->widget('ext.editor.CKkceditor',array(
			"name"=>'Guideactivities['.$key.'][starting_point_content]',         # Attribute in the Data-Model
			"height"=>'200px',
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			  ) );
		?>
	</div>
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'starting_point_addr'); ?>
		 <div class="controls">
		<?php echo CHtml::textArea('Guideactivities['.$key.'][starting_point_addr]',$model->starting_point_addr,array('rows'=>3)); ?>
		</div>
	</div>
		
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'availability_dates',array('class'=>'')); ?>
		 <div class="controls">
		<div id="multidatepicker<?php echo $key; ?>"></div>
		<?php echo CHtml::hiddenField('Guideactivities['.$key.'][availability_dates]',$model->availability_dates,array('id'=>'availabledate'.$key)); ?>
		</div>
	</div>
	
	
	
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_start_timings',array('class'=>'')); ?>
		 <div class="controls">
		 <?php $timearr  = array('0.30'=>'0.30','1.00'=>'1.00','1.30'=>'1.30','2.00'=>'2.00','2.30'=>'2.30','3.00'=>'3.00','3.30'=>'3.30','4.00'=>'4.00','4.30'=>'4.30','5.00'=>'5.00','5.30'=>'5.30','6.00'=>'6.00','6.30'=>'6.30','7.00'=>'7.00','7.30'=>'7.30','8.00'=>'8.00','8.30'=>'8.30','9.00'=>'9.00','9.30'=>'9.30','10.00'=>'10.00','10.30'=>'10.30','11.00'=>'11.00','11.30'=>'11.30','12.00'=>'12.00','12.30'=>'12.30','13.00'=>'13.00','13.30'=>'13.30','14.00'=>'14.00','14.30'=>'14.30','15.00'=>'15.00','15.30'=>'15.30','16.00'=>'16.00','16.30'=>'16.30','17.00'=>'17.00','17.30'=>'17.30','18.00'=>'18.00','18.30'=>'18.30','19.00'=>'19.00','19.30'=>'19.30','20.00'=>'20.00','20.30'=>'20.30','21.00'=>'21.00','21.30'=>'21.30','22.00'=>'22.00','22.30'=>'22.30','23.00'=>'23.00','23.30'=>'23.30','24.00'=>'24.00'); ?>
		<?php echo  CHtml::dropDownList('Guideactivities['.$key.'][activity_start_timings]', $model->service_id, $timearr, array('prompt'=> 'Please Select','multiple'=>'multiple')); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<?php echo  CHtml::activeLabelEx($model,'activity_plans',array('class'=>'')); ?>
		 <div class="controls">
		 <?php echo  CHtml::dropDownList( 'Guideactivities['.$key.'][plan_per]', '', array('per_person'=>'Per Person','per_group'=>'Per Group'), array('prompt'=> 'Please Select','onchange'=>'selectactivityplanper(this.value,\''.$key.'\')','required'=>true)); ?>
		 <?php  $g = '1';   ?>
		 <div class="activitiesgroupforms activitiesgroupforms<?php echo $key; ?>"  id="<?php echo $key; ?><?php echo $g; ?>" style="display:none">
		   <input type="button" class="btn btn-success pull-right get_Guide_activities_group_form<?php echo $key; ?>" value="Add more group" data-id="<?php echo $key; ?>" />	
		   <?php $this->renderPartial('_activiesgroupform', array('model'=>$model,'key'=>$key,'g'=>$g)); ?>			 
		 </div>
		 
		 <?php  $p = '1';   ?>
		 <div class="activitiespersonforms activitiespersonforms<?php echo $key; ?>"  id="<?php echo $p; ?>" style="display:none">
		   <input type="button" class="btn btn-success pull-right get_Guide_activities_person_form<?php echo $key; ?>" value="Add more person" data-id="<?php echo $key; ?>" />	
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
				numberOfMonths: [1,2]
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
																$.get(SITE_BASE_URL+'index.php/user/guideactivitygroupform/key/'+key3+'/g/'+key2, function(data){
																								   parent.append(data);
																								   });
		   
		     });
			 
			   $('.activitieslists .get_Guide_activities_person_form<?php echo $key; ?>').click(function(){
																var parent = $(this).parent();
															var key4 = parseInt($(this).parent().attr('id'));
															key4++;
															$(this).parent().attr('id',key4);
															var key5 =  parseInt($(this).attr('data-id'));
																$.get(SITE_BASE_URL+'index.php/user/guideactivitypersonform/key/'+key5+'/p/'+key4, function(data){
																								   parent.append(data);
																								   });
		   
		     });
		   });
		</script>
