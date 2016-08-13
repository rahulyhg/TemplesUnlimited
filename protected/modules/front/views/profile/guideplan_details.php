<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapfront.css" />
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.js"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
		<!-- loads mdp -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<div class="">

<div style="clear:both;"></div>
<div class="profileimageuploadprogress" style="cursor:pointer; display:none;">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/progress.gif">
</div>
<!-- Modal -->

<?php  if($model->role == '3'){
                $detailsmodel = Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));			
      			
				$temples = explode(',',$detailsmodel->guide_categories);
				
					
					$temple_names =  '';
					
					if(count($temples)>1)
					{
					for($i=0;$i<count($temples);$i++)
						{
						   $temples1 = Temples::model()->getinfo($temples[$i]);
						 
						 if(isset($temples1->temple_name))
						   $temple_names .= $temples1->temple_name.',';
						}
					}
			     }	
				 
	
				    $guideactivities = Guideactivities::model()->findAll('user_id=:user_id',array(':user_id'=>$model->user_id));   
					$languages = Languages::model()->getall();
					
					$language= '';
					$lang_array = array();
					
					for($i=0;$i<count($languages);$i++)
					{
					$language .='<option value='.$languages[$i]->language_id.'>'.$languages[$i]->language_name.'</option>';
					$lang_array[$languages[$i]->language_id] =  $languages[$i]->language_name;
					}

				 //$guidelanguages =  explode(',',$guideactivities->guide_sec_languages);
				 
				 //print_r($guidelanguages);
				 
				 
				 $detailslseclocations =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));

            
			  
			  $secobdary = explode(',',$detailslseclocations->secondary_locations);
			  
			  
			  $array = array();

			  
			 for($i=0;$i<count($secobdary);$i++)
			 {
			     $templesarray = Temples::model()->getinfo($secobdary[$i]); 
				 
				 
				 $array[$templesarray->id] =  $templesarray->temple_name;
				 
			 }
			 
		
		
			 ?>
<!--<hr style="border-color:1px solid #BEBEBE;">-->
<br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
?>


<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">


<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Temples</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo $temple_names; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit" style="display:block;"> 

<div class="editfields">

<?php echo $form->dropDownList($detailsmodel, 'guide_categories',$array,array('multiple' => 'multiple','class'=>'editfields_field'));?>

      <?php 
	// echo $form->dropDownList($detailsmodel,'guide_categories',CHtml::listData(Temples::model()->getall(),'id','temple_name'), array('multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<button type="button" name="submitedits" class="submitedits btn btn-success">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
</div></div>
</div>


<?php 
for($j=0;$j<count($guideactivities);$j++)
 { 

 $temples1 = Temples::model()->getinfo($temples[$j]);

 
  $langu= explode(',',$guideactivities[$j]->activity_language);
  
  $simple_langu = '';
  
	  for($k=0;$k<count($langu);$k++)
	  {
	  if(isset($lang_array[$langu[$k]]))
	      $simple_langu .= $lang_array[$langu[$k]].',';
	  }
 ?>

<div style="float:left; width:100%; margin-top:20px; margin-left:15px;" align="left"><strong><b><?php  echo $temples1->temple_name; ?></b></strong></div>

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Description</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php  echo  $guideactivities[$j]->activity_description; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<textarea name="activity_description" id="activity_description" class="editfields_field" style= 'max-width:300px;min-width:300px;'><?php  echo  $guideactivities[$j]->activity_description; ?></textarea> 
<input type="hidden" name="activity_id" value="<?php echo $guideactivities[$j]->activity_id; ?>" class="editfields_field" />

      <?php    // echo $form->textArea($iyeractivities,'activity_description',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


 <div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Duration</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php  echo  $guideactivities[$j]->activity_duration; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<input type="text" name="activity_duration" id="activity_duration" class="editfields_field timepicker1" value="<?php  echo  $guideactivities[$j]->activity_duration; ?>" />
<input type="hidden" name="activity_id" value="<?php echo $guideactivities[$j]->activity_id; ?>" class="editfields_field" />

      <?php    // echo $form->textArea($iyeractivities,'activity_description',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>



<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Live Guide</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php  echo $simple_langu; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit">

<div class="editfields">
<select name="activity_language[]" id="activity_language" class="editfields_field" multiple="multiple">
<option value="">--Select--</option>
<?php echo $language;  ?>
</select>

<input type="hidden" name="activity_id" value="<?php echo $guideactivities[$j]->activity_id; ?>" class="editfields_field" />

<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>



<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Guide Amount</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php  echo  $guideactivities[$j]->amount."  ".$detailsmodel->guide_amount_option; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit">

<div class="editfields">
<input type="text" name="amount" id="amount" class="editfields_field" value="<?php  echo  $guideactivities[$j]->amount; ?>" />
<input type="hidden" name="activity_id" value="<?php echo $guideactivities[$j]->activity_id; ?>" class="editfields_field" />

<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div class="clear" style=" height:20px; float:left; width:100%;"></div>

<?php
 }
?>
</div>




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
	
	<?php //if($model->role == '3'){  ?>
	  $('textarea[name="Guide[guide_overview]"]').addClass('editfields_field');
	<?php //}else if($model->role == '4'){  ?>
	 
			
	<?php //} ?>
	
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
	$.post('<?php echo CHtml::normalizeUrl(array("profile/guideplan")); ?>', postdata, function(data){
	     if(data == '1'){
		 $('.profiledetailspart').load('<?php echo CHtml::normalizeUrl(array("profile/guideplan_details")); ?>',function(data){
		   
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
<style>
.examples1
{
float:left; width:40%;
padding-left:30px; 
margin-top:20px;
font-family: "ralewayregular" !important;
font-size: 13px !important;
padding: 17px;
text-indent: 28px;
}
.examples2
{
font-family: "ralewayregular" !important;
font-size: 13px !important;
padding: 17px;
text-indent: 28px;
float:left; width:40%; 
margin-top:20px;
}
.examples3
{
font-family: "ralewayregular" !important;
font-size: 13px !important;
padding: 17px;
text-indent: 28px;
float:left; 
width:20%; 
margin-top:20px; 
}
.editfieldsdiv
{
font-family: "ralewayregular" !important;
font-size: 13px !important;
padding: 17px;
text-indent: 28px;
margin-top:-10px !important;
}

</style>
