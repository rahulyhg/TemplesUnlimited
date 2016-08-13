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


<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Pooja's</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $total_poojas; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit" style="display:block;"> 

<div class="editfields">
      <?php 
	 echo $form->dropDownList($detailsmodel,'iyer_categories',CHtml::listData(Iyerpooja::model()->getall(),'id','pooja_name'), array('multiple' => 'multiple','class'=>'editfields_field')); ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<button type="button" name="submitedits" class="submitedits btn btn-success">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
</div></div>
</div>



<?php 
for($j=0;$j<count($iyeractivities);$j++)
 {
  $pooja = Iyerpooja::model()->getinfo($poojas[$j]);
 ?>
 
 <div style="float:left; width:100%; margin-top:20px; margin-left:15px;" align="left"><strong><b><?php  echo $pooja->pooja_name; ?></b></strong></div>
 
 <div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Description</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows" > 
<p style="float:left; text-align:left;"><?php  echo   str_replace('  ', '', $iyeractivities[$j]->activity_description);?></p>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<textarea name="activity_description" id="activity_description"  style= 'max-width:300px;min-width:300px;' class="editfields_field"  maxlength="250"><?php  echo  $iyeractivities[$j]->activity_description; ?></textarea> 
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />

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
<div  class="examples1" style="" align="left"><strong>Mantra Languages</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<span>
<?php if($iyeractivities[$j]->mantra_language!='') {$iyeractivities[$j]->mantra_language = explode(',',$iyeractivities[$j]->mantra_language); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($iyeractivities[$j]->mantra_language),'language_id','language_name'));
echo  $secondarylanguages; }?></span>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
       <?php  echo $form->dropDownList($iyeractivities[$j], 'mantra_language', CHtml::listData(Languages::model()->getall(),'language_id','language_name'), array( 'multiple' => 'multiple','class'=>'editfields_field')); ?>
	  <input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" /> 
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
<div  class="examples1" style="" align="left"><strong>Duration </strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $iyeractivities[$j]->duration." Hours"; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<input type="text" name="duration"    id="duration"  class="editfields_field" value="<?php echo  $iyeractivities[$j]->duration; ?>"  onkeypress="return isNumberKey(event)" />
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />


      <?php    // echo $form->textField($iyeractivities,'amount_without_items',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Amount with items')); 	 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>


  <div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Price (with Items)</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $iyeractivities[$j]->amount_with_items." ".$detailsmodel->iyer_amount_option; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<input type="text" name="amount_with_items"   onkeypress="return isNumberKey(event)"   id="amount_with_items"  class="editfields_field" value="<?php echo  $iyeractivities[$j]->amount_with_items; ?>" />
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />
      <?php   //  echo $form->textField($iyeractivities,'amount_with_items',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Amount with items')); 	 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Price (without Items)</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $iyeractivities[$j]->amount_without_items." ".$detailsmodel->iyer_amount_option; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
<input type="text" name="amount_without_items"   onkeypress="return isNumberKey(event)"  id="amount_without_items"  class="editfields_field" value="<?php echo  $iyeractivities[$j]->amount_without_items; ?>" />
<input type="hidden" name="activity_id" value="<?php echo $iyeractivities[$j]->activity_id; ?>" class="editfields_field" />


      <?php    // echo $form->textField($iyeractivities,'amount_without_items',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Amount with items')); 	 ?>
<span class="errormsg"></span>
</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="button">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>
 
 
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
$(function(){ pageloadinitialfunctions(); });

function pageloadinitialfunctions(){

	
$('a.editfiledlink').click(function(){
$(this).parent().parent().find('#check_shows,.editfiledlink').toggle();
$(this).parent().parent().find('.editfieldsdiv').toggle();
});



$('button.submitedits').click(function(){

var objects = $(this).parent().parent();
 objects.css('opacity','0.1');
 objects.parent().find('.feedbackoverlay').css('display','block');
 var errorcount = 0;
 objects.find('.editfields_field').each(function(){});
 
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

function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
 
          return true;
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
.ui-datepicker-year
{
margin-top:-30px !important;
}
.ui-datepicker-month
{
float:left;
}
</style>
