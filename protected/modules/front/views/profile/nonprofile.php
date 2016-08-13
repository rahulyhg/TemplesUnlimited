<div class="sc-column one-fourth" style="border-radius:5px;">

 <div class="onecolumn">
          <div class="one-fourth" style="border: 1px solid #CCCCCC;border-radius:5px;">
	
 <h6 style="" class="leftside-tab current"><a href="#" class="item-title" ><strong>My Account</strong></a></h6>

  <div class="one-fourth" style="padding:9px;"> 
	  
<h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'user'){ ?>profile-highlight <?php } ?>" style="border-bottom:1px solid #CCCCCC; margin-top:-10px;"  id="my-account"><a href="<?php echo CController::CreateUrl('/login'); ?>" class="item-title heading"><strong>Profile</strong> </a></h6>

	   <h6  class="leftside-tab <?php if(Yii::app()->controller->action->id == 'cart'){ ?>profile-highlight <?php } ?>"><a href="<?php echo CController::CreateUrl('/cart'); ?>" class="item-title heading-pages" ><strong>My Cart</strong></a></h6>

            
          </div>     
  
        </div>        
             
</div>

</div>
