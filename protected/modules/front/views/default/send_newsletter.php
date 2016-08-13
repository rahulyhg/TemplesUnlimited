<?php
/* @var $this CastsController */
/* @var $model Casts */
/* @var $form CActiveForm */
?>


<div class="span9">
      <ul class="breadcrumb">
      <li><i class="icon-user"></i>&nbsp;Send Newsletter</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Newsletter
            
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

	<?php if(Yii::app()->user->hasFlash('success')){ ?>
		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>	

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changePassword-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('class'=>"span8","required"=>true)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('application.extensions.editor.CKkceditor',array(
				"model"=>$model,                # Data-Model
				"attribute"=>'content',         # Attribute in the Data-Model
				"height"=>'400px',
				"width"=>'100%',
				"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
				"filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
				  ) 

			);
				
		?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Send',array('class'=>"btn btn-large btn-success")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

		
			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
	
	<style>
form {margin: 0 30px 18px;}
p {
    margin: 0;
    padding: 5px;
}
span.required {
    color: red;
}
.errorSummary {
    background: none repeat scroll 0 0 #FFEEEE;
    border: 2px solid #CC0000;
    font-size: 0.9em;
    margin: 0 0 20px;
    padding: 7px 7px 12px;
}
div.form .row {
    margin: 5px 0;
}
div.form .errorMessage {
    color: red;
    font-size: 0.9em;
}
div.form select.error {
    background: none repeat scroll 0 0 #FFEEEE;
    border-color: #CC0000;
}
</style>	
