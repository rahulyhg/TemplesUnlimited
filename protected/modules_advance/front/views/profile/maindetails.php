<div class="">

<!--<h3>Profile</h3>-->
<div class="profileimagecontainer">
<div class="profileimage" onClick="change_profileimage()" style="cursor:pointer">
<?php echo helpers::view_userimage($model->user_image,'thumb',array('height'=>'84px','width'=>'84px')); ?>
</div>
<div style="clear:both;"></div>

<!--<a href="#sc-modal-window-modal1"  class="sc-modal-link sc-modal-link-sc-modal-window-modal1" style="float: left;font-size: 10px; margin-left: 8px;margin-top: -7px;" rel="">Change Picture</a>-->

<!--
<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>-->
<!--
<a href="#sc-modal-window-modal1"  class="sc-modal-link sc-modal-link-sc-modal-window-modal1" style="float: left;font-size: 10px; margin-left: 8px;margin-top: -7px;">Change Picture</a>
-->

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

<?php if($model->role == '2'){
                $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
				if(!count($detailsmodel )){
				$detailsmodel = new  Userdetails;
				}
				$phone_field = 'phone';
				$address_field = 'address';
				$city_field = 'city';
				$state_field = 'state';
				$city_fieldval =  $detailsmodel->city;
				$state_fieldval = $detailsmodel->state;
				
			}else if($model->role == '3'){
                $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
				$phone_field = 'guide_phone';
				$address_field = 'guide_address';
				$city_field = 'guide_city';
				$state_field = 'guide_state';
				$city_fieldval =  $detailsmodel->guidecity->name;
				$state_fieldval =  $detailsmodel->guidestate->state_name;
			}else if($model->role == '4'){
                $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));		
			
				$phone_field = 'iyer_phone';
				$address_field = 'iyer_address';
				$city_field = 'iyer_city';
				$state_field = 'iyer_state';
				$city_fieldval =  $detailsmodel->iyercity->name;
				$state_fieldval =  $detailsmodel->iyerstate->state_name;
				$secondarylanguages = implode(',',CHtml::listData(Languages::model()->getall_byids(explode(',',$detailsmodel->iyer_sec_languages)),'language_id','language_name'));
				
					$poojas = explode(',',$detailsmodel->iyer_categories);
					
				
					
					$total_poojas =  '';
					
					for($i=0;$i<count($poojas);$i++)
					{
					   $pooja = Iyerpooja::model()->getinfo($poojas[$i]);
					 
					   $total_poojas .= $pooja->pooja_name.',';
					}
			}	
				
  ?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
     

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
     
    </div>
  </div>
</div>







<div style="display: none;"><div id="sc-modal-window-modal1" style="position:relative; width:600px; height:550px;"><div class="sc-modal-content entry-content content-style">
<h3 style="text-align: center;">Modal Window</h3>

<p><img class="thumb sc-image aligncenter size-medium wp-image-2475" title="Scheme Home" src="http://preview.ait-themes.com/creator/wp/wp-content/uploads/2011/09/scheme_home-300x300.jpg" alt="" width="300" height="300"></p>
<p></p></div></div></div>
<script type="text/javascript">	/*$(document).ready(function() {		$("a.sc-image").attr("rel", "prettyPhoto").prettyPhoto({ social_tools:false, deeplinking: false, default_width: 600, default_height: 550 });	});*/</script>



<!--<hr style="border-color:1px solid #BEBEBE;">-->
<br>
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
)); 


?>

<table class="style1 alignleft profile-tab" width="100%"  >
<thead>
<tr height="40px" class=""> 
<th width="2%" align="left" class="profile-odd-content" onClick="fun5()"><strong>Full Name</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="fullnameedit">  

   <div class="editfields">
		<?php echo $form->dropDownList($model,'gender',array('Mr'=>'Mr.','Ms'=>'Ms.','Mrs'=>'Mrs.'),array('class'=>'editfields_field')); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields">
		<?php echo $form->textField($model,'first_name',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'First Name','required'=>true)); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields">
		<?php echo $form->textField($model,'last_name',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Last Name','required'=>true)); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>


</tr>
<tr height="40px" class=""> 
<th width="2%" align="left" class="profile-odd-content" onClick="fun7()"><strong>Gender</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><?php echo  $model->gender1; ?> 
	<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="genderedit">  
    <div class="editfields">
		<?php echo $form->dropDownList($model,'gender1',array('Male'=>'Male','Female'=>'Female'),array('class'=>'editfields_field')); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div> </th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
<tr height="40px" class=""> 
<th width="2%" align="left" class="profile-odd-content" onClick="fun9()"><strong>Birthday</strong><span class="right">:</span></th>
<th width="2%" align="left" class=""><span class="profile-right-content" style="margin-left: 36px;"><?php echo  (trim($model->dob) != '')?date('M d, Y',strtotime($model->dob)):'-'; ?> </span>
	<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="dobedit">  


   <div class="editfields">
		<?php echo $form->textField($model,'dob',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Bithday','required'=>true)); ?>
		<span class="errormsg"></span>
	</div>
	
	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>

</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" onClick="fun11()"><strong>Email</strong><span class="right">:</span></th>
<th width="2%" align="left" style="" class="profile-right-content"><?php echo  $model->email; ?> </th>
<th  width="2%" align="left" class="">&nbsp;</th>
</tr>
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" onClick="fun13()"><strong>Phone</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><?php echo  $detailsmodel->$phone_field; ?>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="phoneedit">  

<div class="editfields">
		<?php echo $form->textField($detailsmodel,$phone_field,array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Phone')); ?>
		<span class="errormsg"></span>
	</div>

	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>

</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" onClick="fun13()"><strong>Address</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><?php echo  $detailsmodel->$address_field; ?>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="addressedit">  

<div class="editfields">
		<?php echo $form->textArea($detailsmodel,$address_field,array('rows'=>0,'class'=>'editfields_field')); ?>
		<span class="errormsg"></span>
	</div>

	<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>

</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>


</tr>
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" onClick="fun17()"><strong>Current City</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><?php echo  	$city_fieldval ; ?>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="cityedit">  
<div class="editfields">

<?php if($model->role == '2'){ 
                 echo $form->textField($detailsmodel,$city_field,array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'City')); 
			}else{
              echo $form->dropDownList($detailsmodel,$city_field,CHtml::listData(Cities::model()->getallbystate($detailsmodel->$state_field),'id','name'),array('prompt'=> 'Please Select','required'=>true,'class'=>'editfields_field')); 
			}  ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>

</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>State</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><?php echo  	$state_fieldval ; ?>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<?php if($model->role == '2'){ 
                 echo $form->textField($detailsmodel,$state_field,array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'State')); 
			}else{
			   echo $form->dropDownList($detailsmodel,$state_field,CHtml::listData(States::model()->getall(),'id','state_name'),array('prompt'=> 'Please Select','required'=>true,'class'=>'editfields_field'));
			}  ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<?php if($model->role == '2'){  ?>
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Country</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->country; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textField($detailsmodel,'country',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Country')); 	 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
<?php } ?>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" onClick="fun15()"><strong>Languages</strong><span class="right">:</span></th>
<th width="2%" align="left" style="" class="profile-right-content"><?php echo $model->languagename->language_name; ?>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="languageedit"> 

<div class="editfields">
<?php echo $form->dropDownList($model,'language',CHtml::listData(Languages::model()->findAll(),'language_id','language_name'),array('prompt'=> 'Please Select','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>


<?php if($model->role == '3'){  ?>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Experience</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->guide_experience; ?>&nbsp;year(s)</span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php echo $form->textField($detailsmodel,'guide_experience',array('class'=>'span1 editfields_field')); ?>&nbsp;<?php echo $form->dropDownList($detailsmodel, 'guide_experiencetype', array('1'=>'Month(s)','2'=>'Year(s)'), array('class'=>'span2 editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Title</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->guide_title; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textField($detailsmodel,'guide_title',array('maxlength'=>450,'class'=>'editfields_field','placeholder'=>'Enter title')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>About Me</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->guide_description; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textArea($detailsmodel,'guide_description',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Starting Price</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  helpers::to_currency($detailsmodel->guide_amount); ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textField($detailsmodel,'guide_amount',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Enter Starting Price')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Woking Hours</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->guide_wh; ?>&nbsp;Hours</span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <div class="input-append bootstrap-timepicker">
			<?php
			 echo $form->textField($detailsmodel,'guide_wh1',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small editfields_field')); 
			 ?>
			<span class="add-on"  ><i class="icon-time"></i></span>
			</div>
			<!--<div class=" bootstrap-timepicker"><span class="topart">&nbsp; to &nbsp;<span></div>-->
			 <div class="input-append bootstrap-timepicker">
			<?php  echo $form->textField($detailsmodel,'guide_wh2',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small editfields_field'));  ?>
			<span class="add-on" ><i class="icon-time"></i></span>
			</div>
			<div class="clear">&nbsp;</div>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>



	
<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Services</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span>
<?php $detailsmodel->guide_services = explode(',',$detailsmodel->guide_services); 
$guideservices = implode(', ',CHtml::listData(Services::model()->getall_byids($detailsmodel->guide_services),'service_id','service_name'));
echo  $guideservices; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php echo $form->dropDownList($detailsmodel, 'guide_services', CHtml::listData(Services::model()->getall(),'service_id','service_name'), array( 'multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Languages Spoken</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span>
<?php $detailsmodel->guide_sec_languages = explode(',',$detailsmodel->guide_sec_languages); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($detailsmodel->guide_sec_languages),'language_id','language_name'));
echo  $secondarylanguages; ?></span>

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

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>secondary Locations</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span>
<?php $detailsmodel->secondary_locations = explode(',',$detailsmodel->secondary_locations); 
$secondarylocations =  implode(', ',CHtml::listData(Cities::model()->getall_byids($detailsmodel->secondary_locations),'id','name'));
echo  $secondarylocations; ?></span>

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

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content"  colspan="2"><strong>Overview Content</strong><span class=""></span><br/>
<div style="clear:both;">&nbsp;</div>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
	   <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$detailsmodel,                # Data-Model
			"attribute"=>'guide_overview',         # Attribute in the Data-Model
			"height"=>'400px',
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
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
<?php } ?>

<?php if($model->role == '4'){  ?>

<!--<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Pooja's</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $total_poojas; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php 
	 echo $form->dropDownList($detailsmodel, 'iyer_categories', CHtml::listData(Pooja::model()->getall(),'pooja_id','pooja_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple','class'=>'span1 editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
-->


<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Experience</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->iyer_experience; ?>&nbsp;year(s)</span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php 
	  $detailsmodel->iyer_experiencetype = 2;
	  echo $form->textField($detailsmodel,'iyer_experience',array('class'=>'span1 editfields_field','style'=>'margin:0px !important')); ?>&nbsp;<?php echo $form->dropDownList($detailsmodel, 'iyer_experiencetype', array('1'=>'Month(s)','2'=>'Year(s)'), array('class'=>'span2 editfields_field','style'=>'margin:0px !important')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>About Me</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->iyer_description; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textArea($detailsmodel,'iyer_description',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>


<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Woking Hours</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $detailsmodel->iyer_wh; ?>&nbsp;Hours</span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <div class="input-append bootstrap-timepicker">
			<?php
			 echo $form->textField($detailsmodel,'iyer_wh1',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small editfields_field')); 
			 ?>
			<span class="add-on"  ><i class="icon-time"></i></span>
			</div>
			<!--<div class=" bootstrap-timepicker"><span class="topart">&nbsp; to &nbsp;<span></div>-->
			 <div class="input-append bootstrap-timepicker">
			<?php  echo $form->textField($detailsmodel,'iyer_wh2',array('size'=>50,'maxlength'=>50,'class'=>'timepicker1 input-small editfields_field'));  ?>
			<span class="add-on" ><i class="icon-time"></i></span>
			</div>
			<div class="clear">&nbsp;</div>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Languages Spoken</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span>
<?php $detailsmodel->iyer_sec_languages = explode(',',$detailsmodel->iyer_sec_languages); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($detailsmodel->iyer_sec_languages),'language_id','language_name'));
echo  $secondarylanguages; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
    <?php echo $form->dropDownList($detailsmodel, 'iyer_sec_languages', CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array( 'multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>



<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content"  colspan="2"><strong>Available Dates</strong><span class=""></span><br/>
<div style="clear:both;">&nbsp;</div>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
	 <div id="multidatepicker"></div>
		<?php echo $form->hiddenField($detailsmodel,'availability_dates',array('required'=>true,'class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
	

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content"  colspan="2"><strong>Overview Content</strong><span class=""></span><br/>
<div style="clear:both;">&nbsp;</div>
<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
	   <?php
			$this->widget('ext.editor.CKkceditor',array(
			"model"=>$detailsmodel,                # Data-Model
			"attribute"=>'iyer_overview',         # Attribute in the Data-Model
			"height"=>'400px',
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
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>


<?php } ?>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content"></th>
<th width="2%" align="left" class="profile-right-content"></th>
<th  width="2%" align="left" class=""></th>
</tr>
</thead>


</table>

<?php $this->endWidget(); ?>

</div>



<style type="text/css">
.editfieldsdiv{ display:none; }
.editfields input, select, textarea {
    clear: both !important;
    float: right;
    margin: 10px 0;
    text-align: left;
    width: 100%;
}
.editfields select {
padding:10px;
}

.feedbackoverlay {
  left: 57%;
    position: absolute;
    top: 76%;
	display:none;
}
.editfields .errormsg{ color:#FF0000; }

.timepicker1.input-small {
    float: left;
    width: 80px;
	margin: 0;
}
.bootstrap-timepicker {
    display: table;
	float:left;
}
.bootstrap-timepicker .add-on {
    border: 1px solid #CCCCCC;
    border-radius: 0 5px 5px 0;
    box-shadow: 1px 1px 3px #CCCCCC;
    float: left;
    height: 38px !important;
    padding: 11px 3px !important;
    text-align: center;
    width: 22px;
}
.bootstrap-timepicker .add-on i{ float:left; }
.cke_skin_kama .cke_editor {
    display: table;
    width: 100%;
}
#page .ui-icon {
    display: block;
}
</style>
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapfront.css" />
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.js"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
		<!-- loads mdp -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<script>
  
	
	function fun1()
{
	//alert('asfd');
	
	document.getElementById("location").style.display = "block";
	document.getElementById("user").style.display = "none";
	document.getElementById("guide").style.display = "none";

}
function fun2()
{
	//alert('123');
	document.getElementById("location").style.display = "none";
	document.getElementById("user").style.display = "block";
	document.getElementById("guide").style.display = "none";
}
function fun3()
{
	//alert('@!#!');
	
	document.getElementById("location").style.display = "none";
	document.getElementById("user").style.display = "none";
	document.getElementById("guide").style.display = "block";
}


function fun4()
{
document.getElementById("fullnameedit").style.display = "block";
}

function fun5()
{
document.getElementById("username").style.display = "none";
}

function fun6()
{
	document.getElementById("gender").style.display = "block";
} 
function fun7()
{
document.getElementById("gender").style.display = "none";
}
function fun8()
{
	document.getElementById("date").style.display = "block";
}
function fun9()
{
document.getElementById("date").style.display = "none";
}
function fun10()
{
document.getElementById("email").style.display = "block";
}
function fun11()
{
document.getElementById("email").style.display = "none";
}
function fun12()
{
		document.getElementById("phone").style.display = "block";
}
function fun13()
{
		document.getElementById("phone").style.display = "none";
}

function fun14()
{
		document.getElementById("tags").style.display = "block";
}
function fun15()
{
		document.getElementById("tags").style.display = "none";
}

function fun16()
{
document.getElementById("city").style.display = "block";	
}
function fun17()
{
document.getElementById("city").style.display = "none";	
}
function fun18()
{
document.getElementById("hometown").style.display = "block";	
}
function fun19()
{
document.getElementById("hometown").style.display = "none";	
}
$(function(){ pageloadinitialfunctions(); });

function pageloadinitialfunctions(){
  
	 $("#Profile_dob").datepicker({
	    dateFormat:'yy-mm-dd'
	});
	
     /*   $('#sample_input').awesomeCropper(
        { width: 150, height: 150, debug: true }
        );*/
   
    $('.timepicker1').timepicker();
	
	<?php if($model->role == '3'){  ?>
	  $('textarea[name="Guide[guide_overview]"]').addClass('editfields_field');
	<?php }else if($model->role == '4'){  ?>
	  $('textarea[name="Iyer[iyer_overview]"]').addClass('editfields_field');
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
$(this).parent().parent().find('.editfieldsdiv').toggle();
});



$('button.submitedits').click(function(){

var objects = $(this).parent().parent();
 objects.css('opacity','0.1');
 objects.parent().find('.feedbackoverlay').css('display','block');
 var errorcount = 0;
 objects.find('.editfields_field').each(function(){
 <?php if($model->role == '3'){  ?>
		  if($(this).attr('name') == 'Guide[guide_overview]'){
			 $(this).val(CKEDITOR.instances['Guide[guide_overview]'].getData());
		  } 
  <?php }else if($model->role == '4'){  ?>
	  	  if($(this).attr('name') == 'Iyer[iyer_overview]'){
		    $(this).val(CKEDITOR.instances['Iyer[iyer_overview]'].getData());
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
		 $('.profiledetailspart').load('<?php echo CHtml::normalizeUrl(array("profile/maindetails")); ?>',function(data){
		   
		 });
		 }else{
		     objects.css('opacity','1');
            objects.parent().find('.feedbackoverlay').css('display','none');
			alert('unable to save details');
		 }
	});
 }
 
 
});



}
</script>