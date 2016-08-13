<div class="mainpage onecolumn" id="main">
<div class="wrapper">
<h3 class="section-title">Contact Us</h3>
<article id="post-4177" class="post-4177 page type-page status-publish hentry">
	

	<div class="entry-content">

<h3>Contact Form</h3>
<!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>-->
<p></p>



<?php if(Yii::app()->user->hasFlash('contact')): ?>
 
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('contact'); ?>
</div>
 
<?php endif; ?>

<style>
.flash-success
{
    background-color: #fcefd4;
    border: 1px solid #fae1c6;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	background-color: #caeecf;
    border-color: #b7e8b6;
    color: #38b44a;
}
</style>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temples-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
					'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
	'htmlOptions' => array(
		'class'=>"wpcf7-form",
    ),
)); ?>

<p>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required','style'=>'background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;','placeholder'=>'Enter Name')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	</p>
	
	<p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required','style'=>'background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;','placeholder'=>'Enter Email')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	</p>
	
	<p>
	<div class="row">
	
	<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('class'=>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required','style'=>'background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;','placeholder'=>'Enter Subject')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
	</p>
	
	<p>
	
	<div class="row">
		<div class="row">
	
	<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('style'=>'background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:95%;','placeholder'=>'Enter Message',"cols"=>"40","rows"=>"10")); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>
	</div>
	</p>
	
	
	
		
	
	
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Send Message' : 'Save', array('style'=>' background: none repeat scroll 0 0 #333333;
    border: medium none;
    color: #ffffff;
    cursor: pointer;
    display: inline;
    float: right;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    margin: 0;
    width: auto;padding: 10px 8px;margin-right:30px; margin-bottom:50px;')); ?>

		</div>

<?php $this->endWidget(); ?>

</div>



<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>-->

	</div>

</article>
</div>
  
</div>
