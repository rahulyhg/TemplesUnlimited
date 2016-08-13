<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Forgot Password';
$this->breadcrumbs=array(
	'Forgot Password',
);
?>
<link rel='stylesheet' id='jquery-ui-css-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/new_style_red.css' type='text/css' media='all' />
<style type="text/css">
#user_login_form p, #iyer_login_form p, #guide_login_form p{ margin-bottom:0px;  }
.button-primary{     background: none repeat scroll 0 0 #CB202D;
    border-color: -moz-use-text-color -moz-use-text-color #CB2056;
    border-image: none;
    border-radius: 5px;
    border-style: none none solid;
    border-width: medium medium 3px;
    color: #FFFFFF;
    font-family: "ralewayextrabold";
    padding: 6px 13px !important;
	}
	
	.zocial:before {
    content: "" !important;
    }
.zocial.linkedin {
    background-color: rgba(0, 0, 0, 0);
    background-image: url("/temples/image/linkedin.png");
    background-repeat: no-repeat;
    border: medium none;
    height: 50px !important;
    width: 37px;
}

.zocial.google {
    background-color: rgba(0, 0, 0, 0);
    background-image: url("/temples/image/google.png");
    background-repeat: no-repeat;
    border: medium none;
    height: 50px !important;
    width: 37px;
}
.zocial.facebook {
    background-color: rgba(0, 0, 0, 0);
    background-image: url("/temples/image/fb.png");
    background-repeat: no-repeat;
    border: medium none;
    height: 50px !important;
    width: 37px;
}
.zocial.twitter {
    background-color: rgba(0, 0, 0, 0);
    background-image: url("/temples/image/twitter.png");
    background-repeat: no-repeat;
    border: medium none;
    height: 50px !important;
    width: 37px;
}
</style>

<br/>

<br/>
<br/>


	<aside class="widget widget_directory login-main login-main1" id="ait-directory-widget-2" style="margin-left:auto; margin-right:auto;">

<div>
<div id="user_form1">
<h3 class="section-title" style="margin:0px 0px 20px 0px;">Unsubscribe Newsletter</h3>	
		
	<div class="not-logged">

		<div id="ait-login-tabs">

<?php

 $check = Newsletter::model()->findByAttributes(array('emailid'=>$_REQUEST['email']));
  
  if(count($check)=='0')
  {  ?>

 <div class="flashmessage success" id="flashmessage" >
	<p>Our records show that  &nbsp; <?php echo $_GET['email']; ?> &nbsp;has already been unsubscribed from this email list.</p>
</div>

<?php } ?>

<?php   if(count($check)!='0')
  { ?>

				<!-- login -->
				<div id="ait-dir-login-tab">			
		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unsubscribe_form',
	'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>
		
		<p class="note"><span  style="color: #ff0000;">*</span> All Fields are required.</p>
		
			<p class="login-username">
				 <?php echo $form->labelEx($model,'emailid',array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'emailid',array('value'=>(count($check)!='0')?$_REQUEST['email']:'')); ?>
				<div style="margin-top:-30px;" id="User_language_em_" class="errorMessage"></div>
			</p>

			 <?php echo  CHtml::link('Please click here to home', CController::CreateUrl('/front/default/index'),array( 'class'=>'right')); ?>
			<br>
<br>


			<p class="login-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Unsubscribe' : 'Save', array('class'=>'button-primary','onclick'=>'return submitformvalues();')); ?>
			</p>

		  <?php $this->endWidget(); ?>
	</div>


<?php } ?>
</div>
			</div></div>
			
<!-- #page -->
<!---------location-------->

	
	

			
			
			</div>
			
			</aside>

<style>
.required
{
display:none;
}
</style>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>

<script type="text/javascript">
function submitformvalues()
{ 
 var email = $('#Newsletter_emailid').val();
  $.ajax({
              url : '<?php echo CController::CreateUrl('/front/default/checkemailunsubscripe'); ?>',
              type : "post",
              data : "email="+email,
              success:function(data)
              {
                  $('#User_language_em_').html(data);
			  } 
         });
		  return false;
}
    </script>
