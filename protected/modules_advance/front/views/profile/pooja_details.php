<div class="">


<div style="clear:both;"></div>
<div class="profileimageuploadprogress" style="cursor:pointer; display:none;">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/progress.gif">
</div>
<!-- Modal -->

<?php  if($model->role == '4'){
                $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));		
				
					$poojas = explode(',',$detailsmodel->iyer_categories);
					
					$total_poojas =  '';
					
					if(count($poojas)>1)
					{
					for($i=0;$i<count($poojas);$i++)
						{
						   $pooja = Iyerpooja::model()->getinfo($poojas[$i]);
						 
						   $total_poojas .= $pooja->pooja_name.',';
						}
					}
			     }	
				 
				 $iyeractivities = Iyeractivities::model()->findAll('user_id=:user_id',array(':user_id'=>$model->user_id));	  
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

<table class="style1 alignleft profile-tab" width="100%"  >
<thead>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Pooja's</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $total_poojas; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit" style="display:block;"> 

<div class="editfields">
      <?php 
	 echo $form->dropDownList($detailsmodel,'iyer_categories',CHtml::listData(Iyerpooja::model()->getall(),'id','pooja_name'), array('prompt'=> 'Please Select', 'multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<button type="button" name="submitedits" class="submitedits btn btn-success">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
</div>
</th>
</tr>



<?php 
for($j=0;$j<count($iyeractivities);$j++)
 {
  $pooja = Iyerpooja::model()->getinfo($poojas[$j]);
 ?>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong><?php  echo $pooja->pooja_name; ?></strong></th>
</tr>

<tr height="40px" class="">
<th width="2%" align="left" class="profile-odd-content" ><strong>Description</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php  echo  $iyeractivities[$j]->activity_description; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<textarea name="activity_description" id="activity_description" class="editfields_field"><?php  echo  $iyeractivities[$j]->activity_description; ?></textarea> 
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />

      <?php    // echo $form->textArea($iyeractivities,'activity_description',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'')); 	 ?>
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
<th width="2%" align="left" class="profile-odd-content" ><strong>Price (without Items)</strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $iyeractivities[$j]->amount_without_items; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<input type="text" name="amount_without_items" id="amount_without_items"  class="editfields_field" value="<?php echo  $iyeractivities[$j]->amount_without_items; ?>" />
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />


      <?php    // echo $form->textField($iyeractivities,'amount_without_items',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Amount with items')); 	 ?>
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
<th width="2%" align="left" class="profile-odd-content" ><strong>Price (with Items) </strong><span class="right">:</span></th>
<th width="2%" align="left" class="profile-right-content"><span><?php echo  $iyeractivities[$j]->amount_with_items; ?></span>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<input type="text" name="amount_with_items" id="amount_with_items"  class="editfields_field" value="<?php echo  $iyeractivities[$j]->amount_with_items; ?>" />
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />
      <?php   //  echo $form->textField($iyeractivities,'amount_with_items',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Amount with items')); 	 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div>
</th>
<th  width="2%" align="left" class=""><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></th>
</tr>
 
<?php
 }
?>




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
	$.post('<?php echo CHtml::normalizeUrl(array("profile/poojas")); ?>', postdata, function(data){
	     if(data == '1'){
		 $('.profiledetailspart').load('<?php echo CHtml::normalizeUrl(array("profile/pooja_details")); ?>',function(data){
		   
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