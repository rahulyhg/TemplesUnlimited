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
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">



<div class="">



<h3>Change Password</h3>
<div class="rule"></div>
<br>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-password-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
		'class'=>'wpcf7-form',
    ),
)); ?>

      <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>
	
	
	<?php if( Yii::app()->user->hasFlash('success')){ ?>
	 <div class="flashmessage success">
	    <button class="close" data-dismiss="alert">X</button>
	    <p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
	</div>
	<?php } ?>
	

        <div class="left">
		  <?php echo $form->labelEx($model,'currentpassword',array('class'=>'alignleft password-label')); ?> 
            <div class="wpcf7 alignright">				
			<?php echo $form->passwordField($model,'currentpassword',array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
			<?php echo $form->error($model,'currentpassword'); ?>
            </div> 
       </div>
	   
	   
	   
	   
	   
	   <div class="left">
		  <?php echo $form->labelEx($model,'newpassword',array('class'=>'alignleft password-label')); ?>
            <div class="wpcf7 alignright">				
			<?php echo $form->passwordField($model,'newpassword',array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
			<?php echo $form->error($model,'newpassword'); ?>
            </div> 
       </div>
	   
	   
	   <div class="left">
		  <?php echo $form->labelEx($model,'connewpassword',array('class'=>'alignleft password-label')); ?>
            <div class="wpcf7 alignright">				
			<?php echo $form->passwordField($model,'connewpassword',array('size'=>450,'maxlength'=>450,'class'=>'')); ?>
			<?php echo $form->error($model,'connewpassword'); ?>
            </div> 
       </div>
	   
	   
       
        
      
     
   <div style="clear:both;"></div>
				<p class="left save-pwd" style="">
        <label for="your-number"  class="alignleft password-label"><span class="right"> </span></label>
      <button style="background-color: #CB202D; color: #fff; width: 150px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button alignright light profile-font">Save Password</button>
	</p> 	
					 		 
    
        
<?php $this->endWidget(); ?>
        
        <div style="clear:both;"></div>


<!--<a href="" class="sc-button alignright light" style="background-color: #FF3355; border-color: #FF3355; width: 28%; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">Save Profile</span></span></span></a>-->
<!--<a href="" class="sc-button alignright light" style="background-color: #eeeeee; border-color: #eeeeee; width: 180px; "><span class="border"><span class="wrap"><span class="title" style="color: #2370BD;">&laquo; Back</span></span></span></a>-->
</div>	

</div>
<!---------two-third--------->
