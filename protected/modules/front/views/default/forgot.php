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
<h3 class="section-title" style="margin:0px 0px 20px 0px;">Forgot Password</h3>	
		
	<div class="not-logged">

		<div id="ait-login-tabs">





				<!-- login -->
				<div id="ait-dir-login-tab">

			
		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forgot_password_form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
                'validateOnSubmit'=>true,
                'validateOnChange'=>false,
                'validateOnType'=>false,
        ),
    'action'=>CController::CreateUrl('//front/default/login'),
	'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>
		
		<p class="note"><span  style="color: #ff0000;">*</span> All Fields are required.</p>
		
			<p class="login-username">
				 <?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'email',array('required'=>true)); ?>
				<?php echo $form->error($model,'email'); ?>
			</p>
	

			
			
			<!--<p class="login-remember"><label><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember Me</label></p>-->
			<!--<a href="" class="right"><strong>Forgot Password</strong></a>-->
			 <?php echo  CHtml::link('Please click here to login', CController::CreateUrl('/login'),array( 'class'=>'right')); ?>
			<br>
<br>
			<p class="login-submit">
				<input type="hidden" value="" name="redirect_to" id="redirect_to">
				<?php echo CHtml::ajaxSubmitButton(
                                'Send',
    array('//front/default/forgot'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#wp-submit").attr("disabled",true);
											 $("#forgot_password_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#forgot_password_form").each(function(){ }); //this.reset();
                                             $("#wp-submit").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.forgot == "success"){
                                         $("#forgot_password_form").html("<h4>"+obj.msg+"</h4>");
                                      }
          else{
                                                //$("#login-error-div").show();
                                                //$("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }' 
    ),
                         array("id"=>"wp-submit","class" => "button-primary")      
                ); ?>
			</p>

		  <?php $this->endWidget(); ?>
		

		
		
		
								</div>

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



<script type="text/javascript">

        jQuery(document).ready(function(){

           

        });

    </script>
