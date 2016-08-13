<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Password - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">



<div class="">



<h3>Change Password</h3>
<div class="rule"></div>
<br>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iyerpoojas-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
		'class'=>'wpcf7-form',
    ),
)); ?>

      <p class="note"><span style="color:#FF0000;">*</span> All Fields are required.</p>
	
	
	<?php if( Yii::app()->user->hasFlash('success')){ ?>
	 <div class="flashmessage success">
	    <button class="close" data-dismiss="alert">X</button>
	    <p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
	</div>
	<?php } ?>

        <div class="form-group">
		    <div class="wpcf7">				
			<?php echo $form->passwordField($model,'currentpassword',array('size'=>450,'maxlength'=>450,'class'=>'','placeholder'=>'Current Password','style'=>'width:40% !important')); ?>
			<?php echo $form->error($model,'currentpassword'); ?>
            </div> 
       </div>
       
	   
	   <div class="form-group">
		    <div class="wpcf7">				
			<?php echo $form->passwordField($model,'newpassword',array('size'=>450,'maxlength'=>450,'class'=>'','onfocus'=>"theFocus()",'onblur'=>"theBlur()",'placeholder'=>'New Password','style'=>'width:40% !important')); ?>
			<?php echo $form->error($model,'newpassword',array('id'=>'newpassword','style'=>'width:300px')); ?>
			<p class="hint"  id="tooltip" style=" width:300px; display:none;">Note: Password must be 6 to 16 characters long and contain all of the following: upper case letters, lower case letters, digits and special characters.</p>
            </div> 
       </div>
	   
	   
	   <div class="form-group">
		    <div class="wpcf7">				
			<?php echo $form->passwordField($model,'connewpassword',array('size'=>450,'maxlength'=>450,'class'=>'','placeholder'=>'Confirm New Password','style'=>'width:40% !important')); ?>
			<?php echo $form->error($model,'connewpassword'); ?>
            </div> 
       </div>
	   

   <div style="clear:both;"></div>
	<p class="left " style="">
        <button style="background-color: #CB202D; color: #fff; width:100%;  font-style:bold; font-size:13px;  border-radius:3px; border:1px solid #cb202d" class="sc-button  light profile-font">Save Password</button>
	</p> 	
					 		 
    
        
<?php $this->endWidget(); ?>
        
        <div style="clear:both;"></div>


<!--<a href="" class="sc-button alignright light" style="background-color: #FF3355; border-color: #FF3355; width: 28%; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">Save Profile</span></span></span></a>-->
<!--<a href="" class="sc-button alignright light" style="background-color: #eeeeee; border-color: #eeeeee; width: 180px; "><span class="border"><span class="wrap"><span class="title" style="color: #2370BD;">&laquo; Back</span></span></span></a>-->
</div>	

</div>


	<script>
	function theFocus(value)
	{
	
	var newpassword = jQuery('#newpassword').html();
	if(newpassword=='')
	document.getElementById('tooltip').style.display = 'block';
	}
	function theBlur()
	{
	  document.getElementById('tooltip').style.display = 'none';
	}
	</script>
	
	<style>
	.wpcf7-form span.required
	{
	color: #FFFFFF;
	}
	</style>
<!---------two-third--------->


