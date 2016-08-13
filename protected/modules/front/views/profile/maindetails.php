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
<!-- Modal -->
</div>

<?php if($model->role == '2')
{
                $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
				if(!count($detailsmodel )){
				$detailsmodel = new  Userdetails;
				}
				$phone_field = 'phone';
				$address_field = 'address';
				$city_field = 'city';
				$state_field = 'state';
				$country_field = 'country';
                                $pincode = 'pincode';
               
				
				if($detailsmodel->city!='0')
				$city_fieldval =  $detailsmodel->usercity->name;
				
				if($detailsmodel->state!='0')
				$state_fieldval = $detailsmodel->userstate->state_name;
				
				if($detailsmodel->country!='0')
				$country_fieldval =  $detailsmodel->usercountry->country;
				
			}else {
                $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
				
				$phone_field = 'guide_phone';
				$address_field = 'guide_address';
				$city_field = 'guide_city';
				$state_field = 'guide_state';
				$country_field = 'guide_country';
				if($detailsmodel->guide_city!='0')
				$city_fieldval =  $detailsmodel->guidecity->name;
				
				if($detailsmodel->guide_state!='0')
				$state_fieldval =  $detailsmodel->guidestate->state_name;
				
				if($detailsmodel->guide_country!='0')
				$country_fieldval =  $detailsmodel->guidecountry->country;		
				
				
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
	'id'=>'iyerpoojas-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
?>

<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">

<div style="" class=""> 
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
		<?php echo $form->textField($model,'first_name',array('maxlength'=>15,'class'=>'editfields_field','placeholder'=>'First Name','required'=>true,'oncopy'=>"return false",'onpaste'=>"return false",'onkeypress'=>"return onlyAlphabets(event,this);" )); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields">
		<?php echo $form->textField($model,'last_name',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Last Name','required'=>true,'oncopy'=>"return false",'onpaste'=>"return false",'onkeypress'=>"return onlyAlphabets(event,this);" )); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
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
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
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

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Email</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php //if($model->social_provider=='Twitter'){echo  "Email Not provided By twitter";} else{echo $model->email;}  ?>
<?php echo $model->email; ?>
</div>
</div>
</div>

<?php if($model->social_provider!=''){ ?>
<div class="clear"/>  
<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Logged via </strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $model->social_provider; ?>
</div>
</div>
</div>
<?php } ?>

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
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
 
 
<div style="clear:both;">&nbsp;</div>
 
<div style="" class=""> 
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


<div style="clear:both;">&nbsp;</div> 

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Country</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($country_fieldval))?$country_fieldval:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<?php /*if($model->role == '2'){ 
                 echo $form->textField($detailsmodel,$country_field,array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'State')); 
			}else{*/
			   echo $form->dropDownList($detailsmodel,$country_field,CHtml::listData(Country::model()->getall(),'id','country'),array('prompt'=> 'Please Country','required'=>true,'class'=>'editfields_field'));
			//}  ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div> 

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>State</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($state_fieldval))?$state_fieldval:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<?php /*if($model->role == '2'){ 
                 echo $form->textField($detailsmodel,$state_field,array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'State')); 
			}else{*/
			   echo $form->dropDownList($detailsmodel,$state_field,CHtml::listData(States::model()->getallbycountry($detailsmodel->$country_field),'id','state_name'),array('prompt'=> 'Please Select','required'=>true,'class'=>'editfields_field'));
			//}  ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Current City</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($city_fieldval))?$city_fieldval:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="cityedit">  
<div class="editfields">

<?php /*if($model->role == '2'){ 
                 echo $form->textField($detailsmodel,$city_field,array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'City')); 
			}else{*/
              echo $form->dropDownList($detailsmodel,$city_field,CHtml::listData(Cities::model()->getallbystate($detailsmodel->$state_field),'id','name'),array('prompt'=> 'Please Select','required'=>true,'class'=>'editfields_field')); 
			//}  ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>



<?php if($model->role == '2'){  ?>

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Pin code</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo (isset($detailsmodel->pincode))?$detailsmodel->pincode:''; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="cityedit">  
<div class="editfields">
<?php echo $form->textField($detailsmodel,$pincode,array('maxlength'=>25,'class'=>'editfields_field','placeholder'=>'Phone','onkeypress'=>"return onlyNos(event,this);")); ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>

<?php } ?>

<?php if($model->role == '3'){  ?>
<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Tour Locations</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<span>
<?php $detailsmodel->secondary_locations = explode(',',$detailsmodel->secondary_locations); 
$secondarylocations =  implode(', ',CHtml::listData(Cities::model()->getall_byids($detailsmodel->secondary_locations),'id','name'));
echo  $secondarylocations; ?></span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
    <?php echo $form->dropDownList($detailsmodel, 'secondary_locations', CHtml::listData(Cities::model()->getall(),'id','name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple', 'class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<?php } ?>

<div style="clear:both;">&nbsp;</div>


<div style="" class=""> 
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

<div style="clear:both;">&nbsp;</div>



<?php if($model->role == '3'){  ?>

<!--<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Other Languages</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<span>
<?php $detailsmodel->guide_sec_languages = explode(',',$detailsmodel->guide_sec_languages); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($detailsmodel->guide_sec_languages),'language_id','language_name'));
echo  $secondarylanguages; ?></span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
    <?php echo $form->dropDownList($detailsmodel, 'guide_sec_languages', CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array( 'multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>-->

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Experience</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php  echo  $detailsmodel->guide_experience." ".$detailsmodel->guide_experiencetype; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php echo $form->textField($detailsmodel,'guide_experience',array('class'=>'span1 editfields_field','onkeypress'=>"return isNumberKey(event);",'oncopy'=>"return false",'onpaste'=>"return false")); ?>&nbsp;<?php echo $form->dropDownList($detailsmodel,'guide_experiencetype', array('Month(s)'=>'Month(s)','Year(s)'=>'Year(s)'), array('class'=>'span2 editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>About Me(Overview)</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $detailsmodel->guide_overview; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textArea($detailsmodel,'guide_overview',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'','style'=>'height:100px;')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


<div style="clear:both;">&nbsp;</div>


<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Woking Hours</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $detailsmodel->guide_wh; ?>&nbsp;Hours
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <div class="input-append bootstrap-timepicker">
			<?php
			 echo $form->textField($detailsmodel,'guide_wh',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small editfields_field')); 
			 ?>
			<span class="add-on"  ><i class="icon-time"></i></span>
			</div>
			<div class="clear">&nbsp;</div>
<span class="guide_errormsg_time" style="color:#FF0000;"></span>

</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>

<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Services</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php if($detailsmodel->guide_services!='') {$detailsmodel->guide_services = explode(',',$detailsmodel->guide_services); 
$guideservices = implode(', ',CHtml::listData(Services::model()->getall_byids($detailsmodel->guide_services),'service_id','service_name'));
echo  implode(', ',$detailsmodel->guide_services);}?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php echo $form->dropDownList($detailsmodel, 'guide_services', CHtml::listData(Services::model()->getall(),'service_name','service_name'), array( 'multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>


<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Payment Currency</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $detailsmodel->guide_amount_option; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php echo $form->dropDownList($detailsmodel,'guide_amount_option', CHtml::listData(Currency::model()->getall(),'currency','currency'), array('class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>


<div style="" class=""> 
<div  class="examples1" style="" align="left"><strong>Starting Price</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $detailsmodel->guide_amount."  ".$detailsmodel->guide_amount_option; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php  echo $form->textField($detailsmodel,'guide_amount',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Guide Amount'));  // echo $form->dropDownList($detailsmodel,'guide_amount_option', CHtml::listData(Currency::model()->getall(),'currency','currency'), array('class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="clear:both;">&nbsp;</div>

<div> 
<div  class="examples1" style="" align="left"><strong>Available Dates</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"  > 
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

<div style="clear:both;">&nbsp;</div>



<div  class=""> 
<div  class="examples1" style="" align="left"><strong>Description</strong><span class="right" style="margin-right:20px;">:</span></div>

<div  class="examples2"><a href="javascript:void(0)"  class="editfiledlink"  style="float:right"><img  style="float:right; margin-right:20%;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>

<div style="clear:both;">&nbsp;</div>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit" style="margin-left:20px"> 

<div class="editfields">
	   <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$detailsmodel,                # Data-Model
			"attribute"=>'guide_description',         # Attribute in the Data-Model
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



<div style="clear:both;">&nbsp;</div>



<?php } ?>




</div>


<?php $this->endWidget(); ?>



<?php if($model->role == '3'){  ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	   'action' => Yii::app()->createUrl('front/profile/filesubmit'),  //<- your form action here
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
?>

<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">


<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Professional Certificate</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 

<?php if($detailsmodel->guide_license!=''){?>
<?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/license/'.$detailsmodel->guide_license,"guide_license",array("width"=>100)); ?>
<?php }else{ ?>
<img  src="<?php echo Yii::app()->request->baseUrl.'/image/no_image.jpg'; ?>"   class="attachment-thumbnailnew" width="100"/>
<?php }?>

</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php    echo $form->fileField($detailsmodel,'guide_have_certificate',array('style'=>'padding:0px 0px !important;')); 	 ?>
	  
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="submit">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<?php  $this->endWidget(); ?>

</div>
<?php } ?>


</div>






<script>
$(function(){ pageloadinitialfunctions(); });

function pageloadinitialfunctions(){

$("#Profile_dob1").datepicker({
dateFormat:'yy-mm-dd',
changeYear: true,
changeMonth: true,

});


<?php if($model->role == '3'){  ?>


$('.timepicker1').timepicker({
		showMeridian: false  
    });

$('textarea[name="Guide[guide_description]"]').addClass('editfields_field');

var today = new Date();
var y = today.getFullYear();
$('#multidatepicker').multiDatesPicker({
altField: '#<?php  echo 'Guide_availability_dates'; ?>',
dateFormat: "yy-mm-dd",
numberOfMonths: [1,2],
minDate: "-0D",
addDates: <?php  echo  json_encode(explode(',',$detailsmodel->availability_dates)); ?>,

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
<?php if($model->role == '3'){  ?>

if($(this).attr('name') == 'Guide[guide_description]'){
$(this).val(CKEDITOR.instances['Guide[guide_description]'].getData());
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

$('.profiledetailspart').load('<?php echo CHtml::normalizeUrl(array("profile/maindetails")); ?>',function(data){

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
</script>

<script>
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
</script>

<script type="text/javascript">


function change_profileimage(){

$('#User_user_image').click();
}


$(function(){
$('#User_user_image').change(function(){
var errorcountimage = 0;
var file = $(this).val();
var fileupload = this.files[0];
var exts = ['jpeg','jpg','png','gif'];
// first check if file field has any value
if ( file ) {

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


$(function(){
$('#Guide_guide_have_certificate').change(function(){
var errorcountimage = 0;
var file = $(this).val();
var fileupload = this.files[0];
var exts = ['jpeg','jpg','png','gif'];
// first check if file field has any value
if ( file ) {

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


</script>

<script language="Javascript" type="text/javascript">
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

 <form class="form-horizontal" id="logout_form" role="form" method="post" action="<?php echo CController::CreateUrl('/logout'); ?>">
<!-- Modal -->
<div class="modal fade" id="twitter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="position:static;">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Email Verification</h4>
      </div>
      <div class="modal-body">
      
  <div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-8">
     <input type="email" class="form-control" id="email" name="email" placeholder="Enter valid email id">
	  <input type="hidden"  id="user_id" name="user_id" value="<?php echo $model->user_id;  ?>"> 
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="submit" class="btn btn-primary" onclick="return checkemail();">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
function checkemail()
{
   var emailpopup = $('#email').val();
   if(emailpopup=='')
   {
    $("#email").css("background-color","#fbd9d9");
	$("#email").css("border","2px solid red"); 
	return false;   
   }
   else
   {
	   if(validateEmail(emailpopup)) 
	   {
		$.ajax({
				  url : "<?php echo $this->createUrl('auto/checkmailexist'); ?>",
				  type : "post",
				  data : 'emailpopup='+emailpopup,
				  success:function(data)
				  {
				    if(data=='1')
					{
					alert('Email '+emailpopup+' has already been taken.');
					return false;
					}
					else
					{
					$( "#logout_form" ).submit();
					}
				  } 
			 });
			 return false;	 
	   }
	   else
	   {
		  alert('Invalid Email Address');
		  return false;
	   }
	   }
	   
}

function validateEmail(sEmail) {
var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}
</script>

<?php 
 $currency = Currency::model()->getall();
 $optionscurrency ='<option value="">Select</option>';
 for($i=0;$i<count($currency);$i++)
 {
  $optionscurrency .='<option value='.$currency[$i]->currency.'>'.$currency[$i]->currency.'</option>';
 }
 
  $services = Services::model()->getall();
 $optionsservice ='';
 for($i=0;$i<count($services);$i++)
 {
  $optionsservice .='<option value='.$services[$i]->service_name.'>'.$services[$i]->service_name.'</option>';
 }
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<h4 class="modal-title" id="myModalLabel">Guide Basic Details</h4>
</div>
		<div class="modal-body">
		<form class="form-horizontal" role="form" method="post"  action="<?php echo CHtml::normalizeUrl(array("profile/guideinitial")); ?>" >
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
		
		<div style="clear:both;">&nbsp;</div>
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Payment Currency<span class="required">&nbsp;*</span></label>
		<div class="col-sm-6">
		<select  class="form-control" style="margin-top:0px;" name="currency_type" id="currency_type">
		<?php echo $optionscurrency; ?>
		</select>
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="ecurrency_type_error"></span>
		</div>
		</div>
		
		<div style="clear:both;">&nbsp;</div>
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Starting Price<span class="required">&nbsp;*</span></label>
		<div class="col-sm-6">
		<input type="text" class="form-control"  placeholder="Starting Price" name="amount" id="amount" onkeypress="return onlyNos(event,this);" >
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="price_error"></span>
		</div>
		</div>
		<div style="clear:both;">&nbsp;</div>
		
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Services<span class="required">&nbsp;*</span></label>
		<div class="col-sm-6">
		<select  class="form-control" style="margin-top:0px;" name="services[]" id="services" multiple="multiple">
		<?php echo $optionsservice; ?>
		</select>
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="service_type_error"></span>
		</div>
		</div>
		
		
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
		<input type="text"  id="guide_wh" name="guide_wh" class="timepicker1 input-small editfields_field" maxlength="50" size="50">
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
	var services = $('#services').val();
	var overview = $('#overview').val();
	var guide_wh = $('#guide_wh').val();
	
 
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
 else if(services==null)
 {
  $('#ecurrency_type_error').html('');
  $('#experiece_error').html('');
  $('#price_error').html('');
  $('#service_type_error').html('Select Guide services');
  return false;
 }
 else if(overview=='')
 {
	$('#ecurrency_type_error').html('');
	$('#experiece_error').html('');
	$('#price_error').html('');
	$('#service_type_error').html('');
	$('#overview_error').html('Enter overview');
	 return false;
 }
 else if((guide_wh==''))
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

<?php 
if($model->role == '3'){  
if(($detailsmodel->guide_experiencetype=='') && ($detailsmodel->guide_amount_option=='')  && ($detailsmodel->guide_amount=='0.00') && ($detailsmodel->guide_wh=='0.00') && ($detailsmodel->guide_overview=='') && ($detailsmodel->guide_experience=='0.0')) {?>
$('#largeModal').modal('show');
<?php }  } ?>
</script>
<style>

.wpcf7 input{
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

<?php

 $list = Country::model()->findAll(array('order' => 'country'));
 
 
 $countryoption ='<option value="">Select Country</option>';
 
 for($k=0;$k<count($list);$k++)
 {
  $countryoption .='<option value='.$list[$k]->id.'>'.$list[$k]->country.'</option>';    
 }
?>

<div class="modal fade" id="userbasic" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">User Basic Details</h4>
</div>
		<div class="modal-body">
		<form class="form-horizontal" role="form" method="post"  action="<?php echo CHtml::normalizeUrl(array("auto/userinitial")); ?>" >
                 <div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Address<span class="required">&nbsp;*</span></label>
		<div class="col-sm-7">
		<textarea class="form-control"  placeholder="Address" name="address" id="address" ></textarea>
		 <span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="address_error"></span>
		</div>
		</div>
                    
                <div style="clear:both;">&nbsp;</div>   
                    
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Country<span class="required">&nbsp;*</span></label>
		<div class="col-sm-7">
                <select  class="form-control" style="margin-top:0px;" name="country" id="country" onchange="onChangecountry(this.value)">
		<?php echo  $countryoption; ?>
		</select>
                <span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="country_error"></span>
		</div>
		</div>
                
		<div style="clear:both;">&nbsp;</div>
		
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">State<span class="required">&nbsp;*</span></label>
		<div class="col-sm-7">
                <select  class="form-control" style="margin-top:0px;" name="state" id="state" onchange="onChangestate(this.value)">
		<option value="">Select State</option>
		</select>
                <span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="state_error"></span>
		</div>
		</div>

                <div style="clear:both;">&nbsp;</div>
                
                <div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">City<span class="required">&nbsp;*</span></label>
		<div class="col-sm-7">
                 <select  class="form-control" style="margin-top:0px;" name="city" id="city">
		<option value="">Select City</option>
		</select>
                <span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="city_error"></span>
		</div>
		</div>
                <div style="clear:both;">&nbsp;</div>
                <div class="form-group">
		<label for="inputPassword3" class="col-sm-4 control-label">Pin code<span class="required">&nbsp;*</span></label>
		<div class="col-sm-7">
		<input type="text" class="form-control"  placeholder="Pin code" name="pincode" id="pincode" onkeypress="return onlyNos(event,this);" >
		<span style="color:#FF0000;" class="guide_errormsg_time wpcf7" id="pincode_error"></span>
		</div>
		</div>
		<div style="clear:both;">&nbsp;</div>

		<div class="form-group">
		<div class="col-sm-offset-4 col-sm-10">
		<button type="submit" class="btn btn-success" onclick="return userbasicdetails();">Submit</button>
		</div>
		</div>
		</form>
</div>
</div>
</div>
</div>
<script>

<?php  if(($model->social_provider=='Twitter') && ($model->email=='')){ ?>
$('#twitter').modal('show');
<?php } ?>


<?php //if($model->email!='' && $detailsmodel->address=='' && $detailsmodel->pincode=='0' && $detailsmodel->city=='0' && $detailsmodel->state=='0' && $detailsmodel->	country=='0')  {?>
//$('#userbasic').modal('show');
<?php// } ?>
</script>

<script>
<?php //if(!isset($detailsmodel->address) && !isset($detailsmodel->pincode) && $model->email!='')  {?>
//$('#userbasic').modal('show');
<?php //} ?>

</script>

<script>
 function onChangecountry(country_id)
 {
 
 if(country_id=='')
 {
   $('#state').html('<option value="">Select State</option>');
 }
 else
 {
       $.ajax({
              url : '<?php echo  CController::createUrl('auto/list_country'); ?>',
              type : "post",
              data : 'country_id='+country_id,
              success:function(data)
              {
			   $('#state').html(data);
			  } 
         });
    }
 }
 
 function onChangestate(state_id)
 {
  if(state_id=='')
 {
   $('#city').html('<option value="">Select City</option>');
 }
 else
 {
 $.ajax({
              url : '<?php echo  CController::createUrl('auto/list_cities'); ?>',
              type : "post",
              data : 'state_id='+state_id,
              success:function(data)
              {
			   $('#city').html(data);
			  } 
         });
	}
 }


function userbasicdetails()
{
    var address =$('#address').val();
    var country =$('#country').val(); 
    var state =$('#state').val(); 
    var city =$('#city').val(); 
    var pincode =$('#pincode').val(); 
    
    var error = 0;
    
    if(address=='')
    {
     $('#address_error').html('Enter address');
     error ='1';
    }
    else
    {
     $('#address_error').html('');
    }
    
    if(country=='')
    { 
      
      $('#country_error').html('Select country');
      error ='1';
    }
    else
    {
       $('#country_error').html('');  
    }
    
    if(state=='')
    { 
      $('#state_error').html('Select state');
      error ='1';
    }
    else
    {
       $('#state_error').html('');  
    }
    
    if(city=='')
    { 
      $('#city_error').html('Select city');
      error ='1';
    }
    else
    {
       $('#city_error').html('');  
    }
    
    if(pincode=='')
    { 
      $('#pincode_error').html('Select pincode');
      error ='1';
    }
    else
    {
       $('#pincode_error').html('');  
    }
        
    if(error=='1')
    {
        return false;
    }
    else
    {
    return true;
    }
}
</script>
