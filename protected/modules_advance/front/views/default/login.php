<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */



$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
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

<div align="center" style="margin:30px; background:#FBFBFB; padding:20px; border:1px solid #EEEEEE;" >
<h3 class="section-title" style="margin:10px 10px">Join With Us </h3>
<span class="User"><input type="radio" name="jointype" value="user" checked="checked" class="jointype"><strong>User</strong></span>

<span class="Iyer"><input type="radio" name="jointype" value="iyer"><strong>Iyer</strong></span>

<span class="Guide"><input type="radio" name="jointype" value="guide"><strong>Guide</strong></span>

</div>


<?php if( Yii::app()->user->hasFlash('success')){ ?>
 <div class="flashmessage success">
	<button class="close" data-dismiss="alert">X</button>
	<p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
</div>
<?php } ?>



	<aside class="widget widget_directory login-main login-main1 left" id="ait-directory-widget-2">

<div>
<div id="user_form1">
<h3 class="section-title" style="margin:0px 0px 20px 0px;">User Login</h3>	
		
	<div class="not-logged">

		<div id="ait-login-tabs">





				<!-- login -->
				<div id="ait-dir-login-tab">

			
		<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'user_login_form',
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
				 <?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'username',array('required'=>true)); ?>
				<?php echo $form->error($model,'username'); ?>
			</p>
			
	
			
			<p class="login-password">
				<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
				<?php echo $form->passwordField($model,'password',array('required'=>true)); ?>
				<?php echo $form->error($model,'password'); ?>
			</p>
			<?php 
			$model->logintype = 2;
			echo $form->hiddenField($model,'logintype',array('required'=>true)); ?>
			
			
			<!--<p class="login-remember"><label><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember Me</label></p>-->
			<!--<a href="" class="right"><strong>Forgot Password</strong></a>-->
			 <?php echo  CHtml::link('Forgot Password', CController::CreateUrl('//front/default/forgot'),array( 'class'=>'right')); ?>
			<br>
<br>
			<p class="login-submit">
				<input type="hidden" value="" name="redirect_to" id="redirect_to">
				<?php echo CHtml::ajaxSubmitButton(
                                'Log In',
    array('//front/default/login'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#wp-submit").attr("disabled",true);
											 $("#user_login_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ }); //this.reset();
                                             $("#wp-submit").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.login == "success"){
                                         $("#user_login_form").html("<h4>Login Successful! Please Wait...</h4>");
                                         parent.location.href = SITE_BASE_URL+"index.php/front/profile/user";
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
		

		
		
		<div>
				<p align="center" style="font-weight:bold">OR</p>
				<div align="center" class="social-icons contact-info" style="margin-top:0px;"> 
					<?php $this->widget('ext.widgets.hybridAuth.SocialLoginButtonWidget', array(
							   'enabled'=>Yii::app()->hybridAuth->enabled,
							   'providers'=>Yii::app()->hybridAuth->getAllowedProviders(),
							   'route'=>'front/hybridauth/authenticate',
							)); ?>
				<!--<a href="http://www.facebook.com/" target="_blank"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/fb.png" alt="Facebook"> </a> <a href="http://gmail.com/" target="_blank"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/google.png" alt="Google"> </a> <a href="http://www.twitter.com/" target="_blank"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/twitter.png" alt="Twitter"> </a> <a href="http://www.linkedin.com/" target="_blank"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/linkedin.png" alt="linkedin"> </a> -->
				
				</div>
				</div>
								</div>

</div>
			</div></div>
			
<!-- #page -->
<!---------location-------->

	
	
	<div id="iyer_form" style="display:none;"> 

<h3 class="section-title" style="margin:0px 0px 20px 0px;">Iyer Login</h3>			
<div class="not-logged">

		<div id="ait-login-tabs">

				<!-- login -->
				<div id="ait-dir-login-tab">
				<p></p>
	
	

			
				<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iyer_login_form',
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
				 <?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'username',array('required'=>true)); ?>
				<?php echo $form->error($model,'username'); ?>
			</p>
			
	
			
			<p class="login-password">
				<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
				<?php echo $form->passwordField($model,'password',array('required'=>true)); ?>
				<?php echo $form->error($model,'password'); ?>
			</p>
			<?php 
			$model->logintype = 4;
			echo $form->hiddenField($model,'logintype',array('required'=>true)); ?>
			
			<!--<p class="login-remember"><label><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember Me</label></p>-->
			 <?php echo  CHtml::link('Forgot Password', CController::CreateUrl('//front/default/forgot'),array( 'class'=>'right')); ?>
			<br>
<br>
			<p class="login-submit">
				<input type="hidden" value="" name="redirect_to" id="redirect_to">
			<?php echo CHtml::ajaxSubmitButton(
                                'Log In',
    array('//front/default/login'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#iyer_login").attr("disabled",true);
											 $("#iyer_login_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#iyer_login_form").each(function(){ }); //this.reset();
                                             $("#iyer_login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#iyer_login_form #"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.login == "success"){
                                         $("#iyer_login_form").html("<h4>Login Successful! Please Wait...</h4>");
                                         parent.location.href = SITE_BASE_URL+"index.php/front/profile/user";
                                      }
          else{
                                                //$("#login-error-div").show();
                                                //$("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }' 
    ),
                         array("id"=>"iyer_login","class" => "button-primary")      
                ); ?>
			</p>

		  <?php $this->endWidget(); ?>
		

		
		
								</div>

</div>
			</div>
			</div>
	
	
	<div id="guide_form" style="display:none"> 

			
	<h3 class="section-title" style="margin:0px 0px 20px 0px;">Guide Login</h3>			
<div class="not-logged">
			<div id="ait-login-tabs">

				<!-- login -->
				<div id="ait-dir-login-tab">
				<p></p>
	
	

			
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guide_login_form',
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
				<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'username',array('required'=>true)); ?>
				<?php echo $form->error($model,'username'); ?>
			</p>
			
			<p class="login-password">
				<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
				<?php echo $form->passwordField($model,'password',array('required'=>true)); ?>
				<?php echo $form->error($model,'password'); ?>
			</p>
			
			<?php 
			$model->logintype = 3;
			echo $form->hiddenField($model,'logintype',array('required'=>true)); ?>
			
			<!--<p class="login-remember"><label><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember Me</label></p>
			<a href="" class="right"><strong>Forgot Password</strong></a>-->
			 <?php echo  CHtml::link('Forgot Password', CController::CreateUrl('//front/default/forgot'),array( 'class'=>'right')); ?>
			<br>
<br>
			<p class="login-submit">
				<input type="hidden" value="" name="redirect_to" id="redirect_to">
			<?php echo CHtml::ajaxSubmitButton(
                                'Log In',
    array('//front/default/login'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#guide_login").attr("disabled",true);
											 $("#guide_login_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#guide_login_form").each(function(){ }); //this.reset();
                                             $("#guide_login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#guide_login_form #"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.login == "success"){
                                              $("#iyer_login_form").html("<h4>Login Successful! Please Wait...</h4>");
                                              parent.location.href = SITE_BASE_URL+"index.php/front/profile/user";
                                      }
          else{
                                                //$("#login-error-div").show();
                                                //$("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }' 
    ),
                         array("id"=>"guide_login","class" => "button-primary")      
                ); ?>
			</p>

		  <?php $this->endWidget(); ?>
		

		
		
				</div>


</div>
			</div>
			</div>
			
			
			</div>
			
			</aside>


<?php 
   $register = new User;
    $normalregister = new User; 
	
	if(isset( Yii::app()->session['social']) && count( Yii::app()->session['social']) && $_REQUEST['type'] == 'social'){
			$socialdetails = json_decode(json_encode(Yii::app()->session['social']),true);
			$normalregister->first_name = $socialdetails['firstName'];
			$normalregister->last_name = $socialdetails['lastName'];
			$normalregister->gender = $socialdetails['gender'];
			$normalregister->email = $socialdetails['email'];
			$normalregister->social_identifier = $socialdetails['identifier'];
			$normalregister->social_provider = $socialdetails['provider'];
			$normalregister->language = $socialdetails['language'];
			$normalregister->password = $socialdetails['email'].'test';
			
			/*if(isset($_POST['User']))
		    {
			    $_POST['User']['social_identifier'] = $socialdetails['identifier'];
				$_POST['User']['email'] = $socialdetails['email'];
				$_POST['User']['social_provider'] = $socialdetails['provider'];
				$_POST['User']['password'] = $socialdetails['email'].'test';
			}*/
			
		}
 ?>
<aside class="widget widget_directory login-main login-main1 right" id="ait-directory-widget-2">

<div>
<div id="user_form">
<h3 class="section-title" style="margin:0px 0px 20px 0px;">User Register</h3>	
		
	<div class="not-logged">

		<div id="ait-login-tabs">


				<!-- register -->
				<div id="ait-dir-register-tab">
				<p></p>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'user_register_form',
					'enableAjaxValidation'=>true,
						'enableClientValidation'=>true,
						'clientOptions' => array(
								'validateOnSubmit'=>true,
								'validateOnChange'=>false,
								'validateOnType'=>false,
						),
					'action'=>CController::CreateUrl('//front/user/create'),
					'htmlOptions'=>array('class'=>'form-horizontal'),
					)); ?>
					
					<p class="note"><span  style="color: #ff0000;">*</span> All Fields are required.</p>
					
					
					<div class="register-gender">
						<?php echo $form->labelEx($normalregister,'gender'); ?>
						<?php echo $form->dropDownList($normalregister,'gender',array('Mr'=>'Mr.','Ms'=>'Ms.','Mrs'=>'Mrs.'),array('prompt'=> 'Please Select')); ?>
						<?php echo $form->error($normalregister,'gender'); ?>
					</div>
					
					<div class="register-firstname">
						<?php echo $form->labelEx($normalregister,'first_name'); ?>
						<?php echo $form->textField($normalregister,'first_name',array('size'=>250,'maxlength'=>250,'class'=>'','required'=>true)); ?>
						<?php echo $form->error($normalregister,'first_name'); ?>
					</div>
					
						<div class="register-lastname">
						<?php echo $form->labelEx($normalregister,'last_name'); ?>
						<?php echo $form->textField($normalregister,'last_name',array('size'=>250,'maxlength'=>250,'class'=>'')); ?>
						<?php echo $form->error($normalregister,'last_name'); ?>
					</div>
					
					<div class="register-email">
							<?php echo $form->labelEx($normalregister,'email',array('class'=>'control-label')); ?>
							<?php echo $form->textField($normalregister,'email',array('required'=>true)); ?>
							<?php echo $form->error($normalregister,'email'); ?>
					</div>
					
					<div class="register-language">
							<?php echo $form->labelEx($normalregister,'language',array('class'=>'control-label')); ?>
							<?php echo $form->dropDownList($normalregister,'language',CHtml::listData(Languages::model()->findAll(),'language_id','language_name'),array('prompt'=> 'Please Select')); ?>
							<?php echo $form->error($normalregister,'language'); ?>
					</div>
					
			<?php if(isset( Yii::app()->session['social']) && count( Yii::app()->session['social']) && $_REQUEST['type'] == 'social'){ ?>		
					
					<?php echo $form->hiddenField($normalregister,'password'); ?>
					
					<?php }else{ ?>
					<div class="register-password">
						<?php echo $form->labelEx($normalregister,'password'); ?>
						<?php echo $form->passwordField($normalregister,'password'); ?>
						<?php echo $form->error($normalregister,'password'); ?>
				  </div>
				
				<div class="register-conpassword">
					<?php echo $form->labelEx($normalregister,'conpassword'); ?>
					<?php echo $form->passwordField($normalregister,'conpassword'); ?>
					<?php echo $form->error($normalregister,'conpassword'); ?>
						</div>
					
					<?php } ?>
					
			
				
					<?php echo $form->hiddenField($normalregister,'social_identifier'); ?>
	                <?php echo $form->hiddenField($normalregister,'social_provider'); ?>
				
				<?php 
			$normalregister->role = 2;
			echo $form->hiddenField($normalregister,'role',array('required'=>true)); ?>
				
					
		<div class="login-fields">
		<?php echo CHtml::ajaxSubmitButton(
                                'Sign Up',
                               array('//front/user/create'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#user_register").attr("disabled",true);
											 $("#user_register_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#user_register_form").each(function(){ }); //this.reset();
                                             $("#user_register").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#user_register_form #"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.login == "success"){
                                         $("#user_register_form").html("<h4>Successful! Please Wait...</h4>");
                                         parent.location.href = obj.url;
                                      }
          else{
                                                //$("#login-error-div").show();
                                                //$("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }' 
    ),
                         array("id"=>"user_register","class" => "button-primary")      
                ); ?>
				<?php 
					if(isset( Yii::app()->session['social']) && count( Yii::app()->session['social']) && $_REQUEST['type'] == 'social'){
					   Yii::app()->session['social'] = array();
					   unset(Yii::app()->session['social']);
		           } ?>
						<input type="hidden" value="" name="redirect_to" id="redirect_to">
						<input type="hidden" value="1" name="user-cookie" id="user-cookie">
					</div>
				 <?php $this->endWidget(); ?>
				<div>
				<p align="center" style="font-weight:bold">OR</p>
				<div align="center" class="social-icons contact-info" style="margin-top:0px;"> <?php $this->widget('ext.widgets.hybridAuth.SocialLoginButtonWidget', array(
							   'enabled'=>Yii::app()->hybridAuth->enabled,
							   'providers'=>Yii::app()->hybridAuth->getAllowedProviders(),
							   'route'=>'front/hybridauth/authenticate',
							)); ?></div>
				</div>
		
				</div>


</div>
			</div></div>
			
<!-- #page -->
<!---------location-------->

	
	
	<div id="iyer_form1" style="display:none;"> 

<h3 class="section-title" style="margin:0px 0px 20px 0px;">Iyer Register</h3>			
<div class="not-logged">

		<div id="ait-login-tabs">

				<!-- login -->
				<!-- register -->
			<div id="ait-dir-register-tab">
				<p></p>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'iyer_register_form',
					'enableAjaxValidation'=>true,
						'enableClientValidation'=>true,
						'clientOptions' => array(
								'validateOnSubmit'=>true,
								'validateOnChange'=>false,
								'validateOnType'=>false,  
						),
					'action'=>CController::CreateUrl('//front/user/create'),
					'htmlOptions'=>array('class'=>'form-horizontal'),
					)); ?>
						
						<p class="note"><span  style="color: #ff0000;">*</span> All Fields are required.</p>
						
					<div class="register-gender">
						<?php echo $form->labelEx($register,'gender'); ?>
						<?php echo $form->dropDownList($register,'gender',array('Mr'=>'Mr.','Ms'=>'Ms.','Mrs'=>'Mrs.'),array('prompt'=> 'Please Select')); ?>
						<?php echo $form->error($register,'gender'); ?>
					</div>
					
					<div class="register-firstname">
						<?php echo $form->labelEx($register,'first_name'); ?>
						<?php echo $form->textField($register,'first_name',array('size'=>250,'maxlength'=>250,'class'=>'','required'=>true)); ?>
						<?php echo $form->error($register,'first_name'); ?>
					</div>
					
						<div class="register-lastname">
						<?php echo $form->labelEx($register,'last_name'); ?>
						<?php echo $form->textField($register,'last_name',array('size'=>250,'maxlength'=>250,'class'=>'')); ?>
						<?php echo $form->error($register,'last_name'); ?>
					</div>
					
					<div class="register-email">
							<?php echo $form->labelEx($register,'email',array('class'=>'control-label')); ?>
							<?php echo $form->textField($register,'email',array('required'=>true)); ?>
							<?php echo $form->error($register,'email'); ?>
					</div>
					
					<div class="register-language">
							<?php echo $form->labelEx($register,'language',array('class'=>'control-label')); ?>
							<?php echo $form->dropDownList($register,'language',CHtml::listData(Languages::model()->findAll(),'language_id','language_name'),array('prompt'=> 'Please Select')); ?>
							<?php echo $form->error($register,'language'); ?>
					</div>
					
					
					<div class="register-password">
						<?php echo $form->labelEx($register,'password'); ?>
						<?php echo $form->passwordField($register,'password'); ?>
						<?php echo $form->error($register,'password'); ?>
				  </div>
				
				<div class="register-conpassword">
					<?php echo $form->labelEx($register,'conpassword'); ?>
					<?php echo $form->passwordField($register,'conpassword'); ?>
					<?php echo $form->error($register,'conpassword'); ?>
				</div>
				
	<?php echo $form->hiddenField($register,'social_identifier'); ?>
	<?php echo $form->hiddenField($register,'social_provider'); ?>
	
			<?php 
			$register->role = 4;
			echo $form->hiddenField($register,'role',array('required'=>true)); ?>
			<div class="login-fields">
			<?php echo CHtml::ajaxSubmitButton(
                                'Sign Up',
                               array('//front/user/create'),
                                array(  
                                       'beforeSend' => 'function(){ 
                                             $("#iyer_register").attr("disabled",true);
											 $("#iyer_register_form .errorMessage").html("");
                                        }',
                                        'complete' => 'function(){ 
                                             $("#iyer_register_form").each(function(){ }); //this.reset();
                                             $("#iyer_register").attr("disabled",false);
                                        }',
                                     'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#iyer_register_form #"+key+"_em_").show().html(value.toString()); });
											 }
                                      // View login errors!
                                     // alert(data);
                                     if(obj.login == "success"){
                                         $("#iyer_register_form").html("<h4>Successful! Please Wait...</h4>");
                                         parent.location.href = obj.url;
                                      }
                                       else{
                                                //$("#login-error-div").show();
                                                //$("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }' 
    ),
                         array("id"=>"iyer_register","class" => "button-primary")      
                ); ?>
						<input type="hidden" value="" name="redirect_to" id="redirect_to">
						<input type="hidden" value="1" name="user-cookie" id="user-cookie">
					</div>
				 <?php $this->endWidget(); ?>
				</div>


</div>
			</div></div>
		<!-- #page -->	

<!---------user-------->
	
	
	
	<div id="guide_form1" style="display:none"> 

			
	<h3 class="section-title" style="margin:0px 0px 20px 0px;">Guide Register</h3>			
<div class="not-logged">
			<div id="ait-login-tabs">

				<!-- register -->
				<div id="ait-dir-register-tab">
				<p></p>
					<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'guide_register_form',
					'enableAjaxValidation'=>true,
						'enableClientValidation'=>true,
						'clientOptions' => array(
								'validateOnSubmit'=>true,
								'validateOnChange'=>false,
								'validateOnType'=>false,
						),
					'action'=>CController::CreateUrl('//front/user/create'),
					'htmlOptions'=>array('class'=>'form-horizontal'),
					)); ?>
					
					
					<p class="note"><span  style="color: #ff0000;">*</span> All Fields are required.</p>
					
					
					<div class="register-gender">
						<?php echo $form->labelEx($register,'gender'); ?>
						<?php echo $form->dropDownList($register,'gender',array('Mr'=>'Mr.','Ms'=>'Ms.','Mrs'=>'Mrs.'),array('prompt'=> 'Please Select')); ?>
						<?php echo $form->error($register,'gender'); ?>
					</div>
					
					<div class="register-firstname">
						<?php echo $form->labelEx($register,'first_name'); ?>
						<?php echo $form->textField($register,'first_name',array('size'=>250,'maxlength'=>250,'class'=>'','required'=>true)); ?>
						<?php echo $form->error($register,'first_name'); ?>
					</div>
					
						<div class="register-lastname">
						<?php echo $form->labelEx($register,'last_name'); ?>
						<?php echo $form->textField($register,'last_name',array('size'=>250,'maxlength'=>250,'class'=>'')); ?>
						<?php echo $form->error($register,'last_name'); ?>
					</div>
					
					<div class="register-email">
							<?php echo $form->labelEx($register,'email',array('class'=>'control-label')); ?>
							<?php echo $form->textField($register,'email',array('required'=>true)); ?>
							<?php echo $form->error($register,'email'); ?>
					</div>
					
					<div class="register-language">
							<?php echo $form->labelEx($register,'language',array('class'=>'control-label')); ?>
							<?php echo $form->dropDownList($register,'language',CHtml::listData(Languages::model()->findAll(),'language_id','language_name'),array('prompt'=> 'Please Select')); ?>
							<?php echo $form->error($register,'language'); ?>
					</div>
					
					
					<div class="register-password">
						<?php echo $form->labelEx($register,'password'); ?>
						<?php echo $form->passwordField($register,'password'); ?>
						<?php echo $form->error($register,'password'); ?>
				  </div>
				
				<div class="register-conpassword">
					<?php echo $form->labelEx($register,'conpassword'); ?>
					<?php echo $form->passwordField($register,'conpassword'); ?>
					<?php echo $form->error($register,'conpassword'); ?>
				</div>
				
	<?php echo $form->hiddenField($register,'social_identifier'); ?>
	<?php echo $form->hiddenField($register,'social_provider'); ?>
				
				<?php 
			$register->role = 3;
			echo $form->hiddenField($register,'role',array('required'=>true)); ?>
					<div class="login-fields">
<?php echo CHtml::ajaxSubmitButton(
                                'Sign Up',
                               array('//front/user/create'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#guide_register").attr("disabled",true);
											 $("#guide_register_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#guide_register_form").each(function(){ }); //this.reset();
                                             $("#guide_register").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#guide_register_form #"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.login == "success"){
                                         $("#guide_register_form").html("<h4>Successful! Please Wait...</h4>");
                                         parent.location.href = obj.url;
                                      }
          else{
                                                //$("#login-error-div").show();
                                                //$("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }' 
    ),
                         array("id"=>"guide_register","class" => "button-primary")      
                ); ?>						<input type="hidden" value="" name="redirect_to" id="redirect_to">
						<input type="hidden" value="1" name="user-cookie" id="user-cookie">
					</div>
				<?php $this->endWidget(); ?>
				</div>


</div>
			</div>
			</div></div></aside>
<!--<div class="form form-horizontal">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<div class="control-group">
	<label><b>Login:</b></label>
	      <div class="controls">
		  
			<?php $this->widget('ext.widgets.hybridAuth.SocialLoginButtonWidget', array(
		   'enabled'=>Yii::app()->hybridAuth->enabled,
		   'providers'=>Yii::app()->hybridAuth->getAllowedProviders(),
		   'route'=>'front/hybridauth/authenticate',
		)); ?>
			</div>
	</div>


	<div class="control-group">
		<?php echo $form->labelEx($model,'username'); ?>
		 <div class="controls">
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'password'); ?>
		 <div class="controls">
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>


	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="pull-right" >
		<?php echo CHtml::submitButton('Login',array('class'=>"btn btn-success")); ?>
	</div>

<?php $this->endWidget(); ?>
</div>--><!-- form -->

<script type="text/javascript">

        jQuery(document).ready(function(){
		
		

            jQuery('input[type="radio"]').click(function(){

                if( jQuery(this).attr("value")=="user"){ 
                    jQuery("#iyer_form").hide();

                    jQuery("#user_form").show();
                    
                    jQuery("#guide_form").hide();
                    
                      jQuery("#iyer_form1").hide();

                     jQuery("#user_form1").show();
                    
                     jQuery("#guide_form1").hide();

                }

                if( jQuery(this).attr("value")=="iyer"){ 
					document.getElementById("iyer_form").style.display= 'block';
					document.getElementById("user_form").style.display= 'none';
					document.getElementById("guide_form").style.display= 'none';
					document.getElementById("iyer_form1").style.display= 'block';
					document.getElementById("user_form1").style.display= 'none';
					document.getElementById("guide_form1").style.display= 'none';
                }

                if( jQuery(this).attr("value")=="guide"){

                     jQuery("#iyer_form").hide();

                    jQuery("#user_form").hide();
                    
                     jQuery("#guide_form").show();
                    
                     jQuery("#iyer_form1").hide();

                     jQuery("#user_form1").hide();
                    
                     jQuery("#guide_form1").show();

                }

            });
			
	   <?php if(isset($_REQUEST['type']) && trim($_REQUEST['type']) == 'social'){ ?>
		setTimeout(function(){ jQuery("#user_register_form").submit(); }, 2000);
		<?php } ?>

        });

    </script>
	
<style>
.required
{
display:none;
}
</style>