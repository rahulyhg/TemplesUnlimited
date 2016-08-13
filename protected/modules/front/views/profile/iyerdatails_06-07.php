<link rel="stylesheet"   href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css">
<div class="">
<div class="profileimagecontainer">
<div class="profileimage" onClick="change_profileimage()" style="cursor:pointer">
<?php echo helpers::view_userimage($model->user_image,'thumb'); ?>
</div>
<div style="clear:both;"></div>

<a  href="javascript:void(0);" style="float: left;font-size: 10px; margin-left: 8px;" id="picture1" onClick="change_profileimage()"  name="test[image]">Change Picture</a>
<?php 
$usermodel = new User;
echo  CHtml::activefileField($usermodel,'user_image',array('style'=>'opacity:0;height: 0px;')); ?>
</div>
<div style="clear:both;"></div>
<div class="profileimageuploadprogress" style="cursor:pointer; display:none;">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/progress.gif">
</div>
</div>

<?php  if($model->role == '4'){
                $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));	

				$phone_field = 'iyer_phone';
				$address_field = 'iyer_address';
				$city_field = 'iyer_city';
				$state_field = 'iyer_state';
				$country_field = 'iyer_country';
				
				
				if($detailsmodel->iyer_city!='0')
				$city_fieldval =  $detailsmodel->iyercity->name;
				
				if($detailsmodel->iyer_state!='0')
				$state_fieldval =  $detailsmodel->iyerstate->state_name;
				
				if($detailsmodel->iyer_country!='0')
				$country_fieldval =  $detailsmodel->iyercountry->country;

				
					if(count($detailsmodel)>0)
					{
					$secondarylanguages = implode(',',CHtml::listData(Languages::model()->getall_byids(explode(',',$detailsmodel->iyer_sec_languages)),'language_id','language_name'));
					}
					$availability_dates = explode(',',$detailsmodel->availability_dates);
					$availability = array();
					for($i=0;$i<count($availability_dates);$i++)
					{
					if($availability_dates[$i]>=date('Y-m-d'))
					 array_push($availability,$availability_dates[$i]);
					}
					$dates = '';
					for($i=0;$i<count($availability);$i++)
					{
					  $dates .= $availability[$i].','; 
					}
			}
  ?>

<br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
?>


<!--<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Full Name</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="fullnameedit">  

   <div class="editfields">
		<?php echo $form->dropDownList($model,'gender',array('Mr'=>'Mr.','Ms'=>'Ms.','Mrs'=>'Mrs.'),array('class'=>'editfields_field')); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields">
		<?php echo $form->textField($model,'first_name',array('maxlength'=>20,'class'=>'editfields_field','placeholder'=>'First Name','required'=>true,'oncopy'=>"return false",'onpaste'=>"return false" ,'onkeypress'=>"return onlyAlphabets(event,this);")); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields">
		<?php echo $form->textField($model,'last_name',array('maxlength'=>20,'class'=>'editfields_field','placeholder'=>'Last Name','required'=>true,'oncopy'=>"return false",'onpaste'=>"return false" ,'onkeypress'=>"return onlyAlphabets(event,this);")); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

 <div class="clear"></div>  

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Gender</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $model->gender1; ?> 
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="genderedit">  
    <div class="editfields">
		<?php echo $form->dropDownList($model,'gender1',array('Male'=>'Male','Female'=>'Female'),array('class'=>'editfields_field')); ?>
		<span class="errormsg"></span>
	</div>
	<div style="clear:both;"> </div>
	<div class="editfields" style="text-align:right; ">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

 <div class="clear"></div> 
<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Birthday</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php  echo (trim($model->dob) == '0000-00-00')?'------':date('M d, Y',strtotime($model->dob)); ?> 
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="dobedit">  


   <div class="editfields">
		<?php echo $form->textField($model,'dob',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Bithday','required'=>true)); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear"></div>  
<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Email</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $model->email; ?>
</div>
</div>
</div>

<?php if($model->social_provider!=''){ ?>
<div class="clear"/>  
<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Logged via </strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $model->social_provider; ?>
</div>
</div>
</div>
<?php } ?>
 <div class="clear"></div>  

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Phone</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo ($detailsmodel->$phone_field!='')?$detailsmodel->$phone_field:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="phoneedit">  

<div class="editfields">
		<?php echo $form->textField($detailsmodel,$phone_field,array('maxlength'=>25,'class'=>'editfields_field','placeholder'=>'Phone')); ?>
		<span class="errormsg" id="phone_error"></span>
	</div>

	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>
 
 
 <div class="clear"></div>  
 
<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Address</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $detailsmodel->$address_field; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="addressedit">  

<div class="editfields">
		<?php echo $form->textArea($detailsmodel,$address_field,array('rows'=>0,'class'=>'editfields_field','style'=>'height:100px;')); ?>
		<span class="errormsg"></span>
	</div>

	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" style="margin-top:10px;" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


<div class="clear"></div>  

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Country</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($country_fieldval))?$country_fieldval:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<?php 
	 echo $form->dropDownList($detailsmodel,$country_field,CHtml::listData(Country::model()->getall(),'id','country'),array('prompt'=> 'Please Country','required'=>true,'class'=>'editfields_field'));
?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear"></div>  

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>State</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($state_fieldval))?$state_fieldval:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<?php 
			   echo $form->dropDownList($detailsmodel,$state_field,CHtml::listData(States::model()->getallbycountry($detailsmodel->$country_field),'id','state_name'),array('prompt'=> 'Please Select','required'=>true,'class'=>'editfields_field'));
			 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Current City</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($city_fieldval))?$city_fieldval:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="cityedit">  
<div class="editfields">
<?php 
      echo $form->dropDownList($detailsmodel,$city_field,CHtml::listData(Cities::model()->getallbystate($detailsmodel->$state_field),'id','name'),array('prompt'=> 'Please Select','required'=>true,'class'=>'editfields_field')); 
			 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear"></div>  

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Mother Tongue</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $model->languagename->language_name; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="languageedit"> 

<div class="editfields">
<?php echo $form->dropDownList($model,'language',CHtml::listData(Languages::model()->findAll(),'language_id','language_name'),array('prompt'=> 'Please Select','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear"></div> 


<div class="clear"></div> 

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Experience</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows" > 
<span><?php echo  $detailsmodel->iyer_experience; ?>&nbsp;<?php echo  $detailsmodel->iyer_experience_type; ?></span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="experience_edit"> 

<div class="editfields">
      <?php 
	  echo $form->textField($detailsmodel,'iyer_experience',array('class'=>'span1 editfields_field','style'=>'margin:0px !important','onkeypress'=>'return onlyNos(event,this);')); ?>&nbsp;<?php echo $form->dropDownList($detailsmodel, 'iyer_experience_type', array('Month(s)'=>'Month(s)','Year(s)'=>'Year(s)'), array('class'=>'span2 editfields_field','style'=>'margin:0px !important')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear"></div> 

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Payment Currency</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $detailsmodel->	iyer_amount_option; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php echo $form->dropDownList($detailsmodel,'iyer_amount_option', CHtml::listData(Currency::model()->getall(),'currency','currency'), array('class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


<div class="clear"></div> 


<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Starting Price</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<span><?php echo  $detailsmodel->iyer_amount." ".$detailsmodel->iyer_amount_option; ?></span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php  echo $form->textField($detailsmodel,'iyer_amount',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


<div class="clear"></div> 

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Overview</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<span><?php echo  $detailsmodel->iyer_overview; ?></span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php  echo $form->textArea($detailsmodel,'iyer_overview',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'','style'=>'height:100px;')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear"></div> 

<?php if($detailsmodel->iyer_wh!='')  {?>

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Woking Hours</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<span><?php echo  $detailsmodel->iyer_wh; ?>&nbsp;Hours</span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
           <div class="input-append bootstrap-timepicker">
			<?php
			 echo $form->textField($detailsmodel,'iyer_wh',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small editfields_field')); 
			 ?>
			<span class="add-on"  ><i class="icon-time"></i></span><span  style=" margin:12px; float:left;">Hours</span>
			</div>
			
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<?php } ?>

<div class="clear"></div> 

<div> 
<div  class="examples1" style="" align="left"><strong>Available Dates</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"  style="height:auto"> 
<span><?php echo ($dates=='')?"You don't have any available dates now. User can't book any of your activity until you select your available dates.":str_replace(',',', ',$dates); ?></span>
</div>


<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
	 <div id="multidatepicker" style="margin-top:50px; float:left; margin-left:-200px;" ></div>
		<?php echo $form->hiddenField($detailsmodel,'availability_dates',array('required'=>true,'class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


<div class="clear"></div> 

<div  class=""> 


		
<div  class="examples1" style="" align="left"><strong>Description</strong><span class="right" style="margin-right:20px;">:</span></div>

<div  class="examples3" style="float:right"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>

<div style="clear:both;">&nbsp;</div>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit" style="margin-left:20px"> 

<div class="editfields">
	   <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$detailsmodel,                # Data-Model
			"attribute"=>'iyer_description',
			'width'=>'100%',         # Attribute in the Data-Model
			"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
			"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
			'htmlOptions'=>array('class'=>'editfields_field','id'=>'overview_editor'),
			  ) );
		?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</div>

<div class="clear"></div> 
</div>-->




<?php $this->endWidget(); ?>

</div>

<script>
$(function(){ pageloadinitialfunctions(); });

function pageloadinitialfunctions(){

$("#Profile_dob1").datepicker({
dateFormat:'yy-mm-dd',
changeYear: true,
changeMonth: true,

});



$('.timepicker1').timepicker({
showMeridian: false,
defaultTime: false
    });

<?php if($model->role == '4'){  ?>
$('textarea[name="Iyer[iyer_description]"]').addClass('editfields_field');

var today = new Date();
var y = today.getFullYear();
$('#multidatepicker').multiDatesPicker({
altField: '#<?php  echo 'Iyer_availability_dates'; ?>',
dateFormat: "yy-mm-dd",
numberOfMonths: [1,2],
minDate: "-0D",
addDates: <?php echo  json_encode(explode(',',$detailsmodel->availability_dates)); ?>,
});

<?php } ?>

$('a.editfiledlink').click(function(){
$(this).parent().parent().find('#check_shows,.editfiledlink').toggle();
$(this).parent().parent().find('.editfieldsdiv').toggle();
});





$('button.submitedits').click(function(){

var objects = $(this).parent().parent();
objects.css('opacity','0.1');
objects.parent().find('.feedbackoverlay').css('display','block');
var errorcount = 0;
objects.find('.editfields_field').each(function(){
<?php if($model->role == '4'){  ?>
if($(this).attr('name') == 'Iyer[iyer_description]'){
$(this).val(CKEDITOR.instances['Iyer[iyer_description]'].getData());
} 
<?php } ?>

if($(this).attr('required') != undefined){
if($(this).val().trim() == ''){
errorcount++;
$(this).next('.errormsg').html('This field is required');
}else{
$(this).next('.errormsg').html('');
}
}
});

if(errorcount>0){
objects.css('opacity','1');
objects.parent().find('.feedbackoverlay').css('display','none');
}else{

var postdata = objects.find('.editfields_field').serialize();

$.post('<?php echo CHtml::normalizeUrl(array("profile/user")); ?>', postdata, function(data){
if(data == '1'){
$('.profile-tab').css("-ms-filter","progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"); 	 
$('.profile-tab').css("filter","alpha(opacity=50)"); 	 
$('.profile-tab').css("-moz-opacity",'0.5'); 
$('.profile-tab').css("-khtml-opacity",'0.5'); 
$('.profile-tab').css("opacity",'0.5'); 

$('.profiledetailspart').load('<?php echo CHtml::normalizeUrl(array("profile/iyerdatails")); ?>',function(data){

});

}else{
objects.css('opacity','1');
objects.parent().find('.feedbackoverlay').css('display','none');
if(data=='0')
{
$('#phone_error').html('Please enter valid mobile number.');
}
else if(data=='invalid1')
{
$('.guide_errormsg_time').html('Please enter valid Woking Hours.');
}
else
{
alert('unable to save details');
}
}
});
}

});

}

$(function() {
$("#Profile_dob").datepicker({
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true, 
yearRange: '1900:2050',
});
});

function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode != 46 && charCode > 31 
&& (charCode < 48 || charCode > 57))
return false;

return true;
}

function bring() {
$('.profile-tab').css("-ms-filter",'progid:DXImageTransform.Microsoft.Alpha(Opacity=100)'); 	 
$('.profile-tab').css("filter",'alpha(opacity=100)'); 	 
$('.profile-tab').css("-moz-opacity",'1.0'); 
$('.profile-tab').css("-khtml-opacity",'1.0'); 
$('.profile-tab').css("opacity",'1.0'); 

}


function change_profileimage(){

$('#User_user_image').click();
}


$(function(){
$('#User_user_image').change(function(){
var errorcountimage = 0;
var file = $(this).val();
var fileupload = this.files[0];
var exts = ['jpeg','jpg','png','gif'];
if ( file ) {
var get_ext = file.split('.');
get_ext = get_ext.reverse();
if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
if(fileupload.size != 'undefind' && fileupload.size){
if(fileupload.size > 1048576){
$(this).val('');
alert( 'File size exceeds 1MB!' );
errorcountimage++;
}
}
} else {
$(this).val('');
alert( 'File format not allowed!' );
errorcountimage++;
}
}

if(errorcountimage == 0){
changeprofileimage('User_user_image','<?php echo Yii::app()->user->id; ?>');
}
});

});

function onlyNos(e, t)
 {
try 
{
if (window.event) 
{
var charCode = window.event.keyCode;
}
else if (e) 
{
var charCode = e.which;
}
else { return true; }
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
return true;
}
catch (err) {
alert(err.Description);
}
}

function onlyAlphabets(e, t)
{
try 
{
if (window.event) 
{
var charCode = window.event.keyCode;
}
else if (e) 
{
var charCode = e.which;
}
else { return true; }
if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
return true;
else
return false;
}
catch (err) {
alert(err.Description);
}
} 
</script>


<?php 
 $currency = Currency::model()->getall();
 $optionscurrency ='<option value="">Select</option>';
 for($i=0;$i<count($currency);$i++)
 {
  $optionscurrency .='<option value="'.$currency[$i]->currency.'">'.$currency[$i]->currency.'</option>';
 }
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<h4 class="modal-title" id="myModalLabel">Iyer Basic Details</h4>
</div>
		<div class="modal-body">
		<form class="form-horizontal" role="form" method="post"  action="<?php echo CHtml::normalizeUrl(array("profile/iyerinitial")); ?>" >
		<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Experience<span class="required">&nbsp;*</span></label>
		<div class="col-sm-3" style="float:left;">
		<input type="text" class="form-control" id="experience" name="experience" placeholder="Experience" onkeypress="return onlyNos(event,this);">
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="experiece_error"></span>
		</div>
		<div class="col-sm-3">
		<select  class="form-control" style="margin-top:0px;" name="experience_type" id="experience_type">
		<option value="Month(s)">Month(s)</option>
		<option value="Year(s)">Year(s)</option>
		</select>
		</div>
		</div>
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Payment Currency<span class="required">&nbsp;*</span></label>
		<div class="col-sm-6">
		<select  class="form-control" style="margin-top:0px;" name="currency_type" id="currency_type">
		<?php echo $optionscurrency; ?>
		</select>
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="ecurrency_type_error"></span>
		</div>
		</div>
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Starting Price<span class="required">&nbsp;*</span></label>
		<div class="col-sm-6">
		<input type="text" class="form-control"  placeholder="Starting Price" name="amount" id="amount" onkeypress="return onlyNos(event,this);" >
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="price_error"></span>
		</div>
		</div>
		<div style="clear:both;">&nbsp;</div>
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Overview<span class="required">&nbsp;*</span></label>
		<div class="col-sm-6">
		<textarea class="form-control"  placeholder="Overview" name="overview" id="overview" ></textarea>
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="overview_error"></span>
		</div>
		</div>

       <div style="clear:both;">&nbsp;</div>
	   
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Woking Hours<span class="required">&nbsp;*</span></label>
		<div class="col-sm-8">
		<div class="wpcf7" style="display: block; margin-bottom:0px;"> 
		<div class="editfields">
		<div class="input-append bootstrap-timepicker">
		<input type="text"  id="iyer_wh" name="iyer_wh" class="timepicker1 input-small editfields_field" maxlength="50" size="50">
		<span class="add-on"><i class="icon-time"></i></span> <span  style=" margin:12px; float:left;">Hours</span> 
		</div>
		</div>
		<br />
		<br />
		<br />
		<span style="color:#FF0000;" class="guide_errormsg_time" id="hours_error"></span>
		<div style="clear:both;">&nbsp;</div>
		</div>
		</div>
		</div>
		<div style="clear:both;">&nbsp;</div>
		<div class="form-group">
		<div class="col-sm-offset-4 col-sm-10">
		<button type="submit" class="btn btn-success" onclick="return basicdetails();">Submit</button>
		</div>
		</div>
		</form>
</div>
</div>
</div>
</div>

<script>
function basicdetails()
{
	var experience = $('#experience').val();
	var currency_type = $('#currency_type').val();
	var amount = $('#amount').val();
	var overview = $('#overview').val();
	var iyer_wh = $('#iyer_wh').val();

 
 if(experience=='')
 {
   $('#experiece_error').html('Enter experience');
   return false;
 }
 else if(currency_type=='')
 { 
   $('#experiece_error').html('');
   $('#ecurrency_type_error').html('Select payment currency');
   return false;
 }
 else if(amount=='')
 {
  $('#ecurrency_type_error').html('');
  $('#experiece_error').html('');
  $('#price_error').html('Enter starting price');
  return false;
 }
 else if(overview=='')
 {
	$('#ecurrency_type_error').html('');
	$('#experiece_error').html('');
	$('#price_error').html('');
	$('#overview_error').html('Enter overview');
	 return false;
 }
 else if((iyer_wh==''))
 {
   $('#ecurrency_type_error').html('');
   $('#experiece_error').html('');
   $('#price_error').html('');
   $('#overview_error').html('');
   $('#hours_error').html('Select working hours');
   return false;
 }
 else
 {
 return true
 }
}


</script>
<style>
.wpcf7 input {
    background: none repeat scroll 0 0 #ffffff;
    border: 2px solid #e8e8e8;
    color: #666666;
    display: block;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    padding: 10px 8px;
    height:40px;
}
</style>
