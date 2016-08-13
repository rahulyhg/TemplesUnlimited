<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Password - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<style type="text/css">
.wpcf7.alignright > input {
    width: 310px;
}
.wpcf7-form span.required {
    color: #FF0000;
    font-size: 14px;
    font-weight: bold;
}


</style>

<?php


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
				
				
?>
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">



<div class="">



<h3>Guide Certificates</h3>
<div class="rule"></div>
<br>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl('/certificates'),
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
?>

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
/*text-indent: 28px;*/
float:left; 
margin-top:20px;
}
.examples3
{
font-family: "ralewayregular" !important;
font-size: 13px !important;
padding: 17px;
text-indent: 28px;
float:left; 

margin-top:20px; 
}
.editfieldsdiv
{
font-family: "ralewayregular" !important;
font-size: 13px !important;
padding: 17px;
/*text-indent: 28px;*/
margin-top:-10px !important;
}
</style>


<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">

<div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Professional License No</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  $detailsmodel->guide_license; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">
      <?php     echo $form->textField($detailsmodel,'guide_license',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Enter License No')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="submit">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div>

 <div class="clear"></div>
 
 
 
 <div style="height:40px" class=""> 
<div  class="examples1" style="" align="left"><strong>Professional Certificate</strong><span class="right" style="margin-right:20px;">:</span></div>
<div class="examples2" >
<div id="check_shows"> 
<?php echo  ($detailsmodel->guide_have_certificate=='1')?'Yes':'No'; ?>
</div>

<div  class="feedbackoverlay"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /></div>
<div class="wpcf7 editfieldsdiv" id="stateedit"> 

<div class="editfields">


	<?php echo $form->fileField($detailsmodel,'guide_have_certificate',array('style'=>"width:244px")); ?>
        <?php   //  echo $form->textField($detailsmodel,'guide_have_certificate',array('maxlength'=>250,'class'=>'editfields_field','placeholder'=>'Enter License No')); 	 ?>
<span class="errormsg"></span>
</div>
<div style="clear:both;">&nbsp;</div>

<div class="editfields" style="text-align:right">
		<button class="submitedits btn btn-success" name="submitedits" type="submit">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
	</div>

</div></div>
<div  class="examples3"><a href="javascript:void(0)"  class="editfiledlink"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/1402918860_new-24.png"></a></div>
</div> 


</div>


<?php $this->endWidget(); ?>


        <div style="clear:both;"></div>


<!--<a href="" class="sc-button alignright light" style="background-color: #FF3355; border-color: #FF3355; width: 28%; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">Save Profile</span></span></span></a>-->
<!--<a href="" class="sc-button alignright light" style="background-color: #eeeeee; border-color: #eeeeee; width: 180px; "><span class="border"><span class="wrap"><span class="title" style="color: #2370BD;">&laquo; Back</span></span></span></a>-->
</div>	

</div>

<!---------two-third--------->

<style type="text/css">
.editfieldsdiv{ display:none; }
.editfields input, select, textarea {
    margin: 10px 0;
    text-align: left;
    width: 100%;
}
.editfields select {
padding:10px;
}
.btn-success
{
 background-color: #5cb85c;
    border-color: #4cae4c;
    color: #fff;
	}
	
	.btn {
    -moz-user-select: none;
    border: 1px solid transparent;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
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
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">

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
  
	 $("#Profile_dob1").datepicker({
	    dateFormat:'yy-mm-dd',
		changeYear: true,
		  changeMonth: true,
           
	});
	

	
$('a.editfiledlink').click(function(){
$(this).parent().parent().find('#check_shows,.editfiledlink').toggle();
$(this).parent().parent().find('.editfieldsdiv').toggle();
});

}
</script>


