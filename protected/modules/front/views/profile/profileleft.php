<div class="sc-column one-fourth" style="border-radius:5px;">

 <div class="onecolumn">
          <div class="one-fourth" style="border: 1px solid #CCCCCC;border-radius:5px;">
	
 <h6 style="" class="leftside-tab current"><a href="#" class="item-title" ><strong>My Account</strong></a></h6>

  <div class="one-fourth" style="padding:9px;"> 

	  
<h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'user'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC; margin-top:-10px;"  id="my-account"><a href="<?php echo CController::CreateUrl('/user'); ?>" class="item-title heading"><strong>Profile</strong> </a></h6>


<?php $Usermodel = User::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id)); ?>

 <?php if(helpers::isiyer()){ ?>

<h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'iyeractivity' || Yii::app()->controller->action->id == 'iyeractivity' || Yii::app()->controller->action->id == 'create' || Yii::app()->controller->action->id == 'view'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" id="my-account"><a href="<?php echo CController::CreateUrl('profile/iyeractivity'); ?>" class="item-title heading"><strong>Activity Management</strong> </a></h6>

<h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'iyernodification'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" id="my-account"><a href="<?php echo CController::CreateUrl('profile/iyernodification'); ?>" class="item-title heading"><strong>Notification</strong> </a></h6>

<?php } ?>


 <?php if(helpers::isguide()){ ?>
<h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'guidetemple'){ ?>profile-highlight<?php } ?>" style="border-bottom:1px solid #CCCCCC;"  id="my-account"><a href="<?php echo CController::CreateUrl('profile/guidetemple'); ?>" class="item-title heading"><strong>Activity Management</strong> </a></h6>

<h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'iyernodification'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" id="my-account"><a href="<?php echo CController::CreateUrl('profile/iyernodification'); ?>" class="item-title heading"><strong>Notification</strong> </a></h6>
<?php } ?>




<?php  if(($model->social_provider=='') && ($model->social_identifier=='')) { ?>
 <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'password'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/password'); ?>" class="item-title heading-pages" ><strong>Change Password</strong></a></h6>
 <?php } ?>
 
 <?php  if( ($Usermodel['role']=='2')){ ?>
 <h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'usernotify'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" id="my-account"><a href="<?php echo CController::CreateUrl('profile/usernotify'); ?>" class="item-title heading"><strong>Notification</strong> </a></h6>
 <?php } ?>
 
 
  <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'reviews'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/reviews'); ?>" class="item-title heading-pages" ><strong>My Reviews</strong></a></h6>
 
<?php  if( ($Usermodel['role']=='2')){ ?>
 <h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'favourites'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/favourites'); ?>" class="item-title" ><strong>Favorite Products</strong></a></h6>
 <?php }else{ ?>
  <h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'photos'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/photos'); ?>" class="item-title" ><strong>My Photos</strong></a></h6>
  <?php } ?>
  
  
    <?php  if( ($Usermodel['role']=='2')){ ?>
    <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'cart'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/cart'); ?>" class="item-title heading-pages" ><strong>My Cart</strong></a></h6>
		
     <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'orders'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/orders'); ?>" class="item-title heading-pages" ><strong>My Orders</strong></a></h6>		 
	 <?php }else{ ?>
     <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'orderig'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('/orderig'); ?>" class="item-title heading-pages" ><strong>My Orders</strong></a></h6>		 
         <?php } ?>
     <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'logout'){ ?>profile-highlight <?php } ?>"><a href="<?php echo CController::CreateUrl('/logout'); ?>" class="item-title heading-pages" ><strong>Logout</strong></a></h6>

            
          </div>     
  
        </div>        
             
</div>

</div>
