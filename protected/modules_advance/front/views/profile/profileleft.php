<div class="sc-column one-fourth" style="border-radius:5px;">

 <div class="onecolumn">
          <div class="one-fourth" style="border: 1px solid #CCCCCC;border-radius:5px;">
	
 <h6 style="" class="leftside-tab current"><a href="#" class="item-title" ><strong>My Account</strong></a></h6>

  <div class="one-fourth" style="padding:9px;"> 
	  
<h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'user'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" class="" id="my-account"><a href="<?php echo CController::CreateUrl('//front/profile/user'); ?>" class="item-title heading"><strong>Profile</strong> </a></h6>


 <?php if(helpers::isiyer()){ ?>
<h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'poojas'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" class="" id="my-account"><a href="<?php echo CController::CreateUrl('//front/profile/poojas'); ?>" class="item-title heading"><strong>Pooja</strong> </a></h6>
<?php } ?>


 <?php if(helpers::isguide()){ ?>
<h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'guideplan'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;" class="" id="my-account"><a href="<?php echo CController::CreateUrl('//front/profile/guideplan'); ?>" class="item-title heading"><strong>Temples</strong> </a></h6>
<?php } ?>
 
 <!-- <h6  class="leftside-tab" style="border-bottom:1px solid #CCCCCC;"><a href="edit-profile.html" class="item-title" ><strong>Edit Profile</strong></a></h6>-->
  
 <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'password'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('//front/profile/password'); ?>" class="item-title heading-pages" ><strong>Change Password</strong></a></h6>
 
 
  <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'reviews'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('//front/profile/reviews'); ?>" class="item-title heading-pages" ><strong>My Reviews</strong></a></h6>
 
 <?php if(helpers::isnormaluser()){ ?>
 <h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'favourites'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('//front/profile/favourites'); ?>" class="item-title" ><strong>Favorite Products</strong></a></h6>
 <?php }else{ ?>
  <h6 class="leftside-tab <?php if(Yii::app()->controller->action->id == 'photos'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('//front/profile/photos'); ?>" class="item-title" ><strong>My Photos</strong></a></h6>
  <?php } ?>
  
    <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'cart'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('//front/profile/cart'); ?>" class="item-title heading-pages" ><strong>My Cart</strong></a></h6>
	
	     <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'order'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?php echo CController::CreateUrl('//front/profile/orders'); ?>" class="item-title heading-pages" ><strong>My Orders</strong></a></h6>
	
	   <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'logout'){ ?>profile-highlight <?php } ?>" "><a href="<?php echo CController::CreateUrl('//front/default/logout'); ?>" class="item-title heading-pages" ><strong>Logout</strong></a></h6>

            
          </div>     
  
        </div>        
             
</div> <!-------one-fourth------>

</div>