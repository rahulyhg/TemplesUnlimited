<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-home"></i>&nbsp;Dashboard</li>
      </ul>
	  
	      <div class="hero-unit" style="padding:126px;">
    <h1 style=" font-size:44px; line-height:59px;">Welcome to Control Panel</h1>
    <p>
    <a class="btn btn-primary btn-large" href="<?php echo Yii::app()->controller->createUrl("/"); ?>" title="_blank">
   Visit Site
    </a>
    </p>
    </div>
	
	<?php 
	$providers = User::model()->findAll('role = "3" AND intial_approve="0" AND fully_registered="1" AND email_verified="1" AND status="0"');
	
	if(count($providers)){ 
	 foreach($providers as $provider){
	 
	 if(Provider::model()->percentage_profile($provider->id) == '100'){
	?>
	
	<div>
	 <div class="alert alert-warning fade in ">
            <strong>Warning</strong> provider "<?php echo User::model()->username($provider); ?>" already complete profile and need admin approval, <a href="<?php echo   Yii::app()->controller->createUrl('//admin/user/view/id/'.$provider->id); ?>" >view profile</a>
     </div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php } } } ?>	
	  
	  
	  
	  
