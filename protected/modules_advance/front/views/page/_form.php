<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Page</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Add / Edit Page
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->controller->createUrl('//admin/page/admin'); ?>" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'ptitle'); ?>
		<div class="controls">
		<?php echo $form->textField($model,'ptitle',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'ptitle'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'pdescription',array('id'=>'')); ?>
		<?php //echo $form->textArea($model,'pdescription',array('rows'=>6, 'cols'=>50)); ?>
		<div class="controls">
		<?php
		
		/*$this->widget('ext.niceditor.nicEditorWidget',array(
		"model"=>$model,                // Data-Model
		"attribute"=>'pdescription',        // Attribute in the Data-Model
		"defaultValue"=> $model->pdescription,
		"config"=>array("maxHeight"=>"200px"),
		"width"=>"400px",       // Optional default to 100%
		"height"=>"200px",      // Optional default to 150px
		));*/
		
		?>
		
		
				<?php
			/*	
				$this->widget('application.extensions.cleditor.ECLEditor', array(
				'model'=>$model,
				'attribute'=>'pdescription', //Model attribute name. 
				'options'=>array(
				'width'=>'600',
				'height'=>250,
				'useCSS'=>true,
				),
				'value'=>$model->pdescription, //If you want pass a value for the widget. I think you will.
				));*/
				
				$this->widget('application.extensions.editor.CKkceditor',array(
    "model"=>$model,                # Data-Model
    "attribute"=>'pdescription',         # Attribute in the Data-Model
    "height"=>'400px',
    "width"=>'100%',
	"filespath"=>Yii::app()->basePath."/assets/a9a05f57/kcfinder/",
    "filesurl"=>Yii::app()->baseUrl."/assets/a9a05f57/kcfinder/",
      ) 

);
				
				?>
		
		
		<?php echo $form->error($model,'pdescription'); ?>
		</div>
	</div>

	<div class="control-group">
	    <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success btn-large pull-right')); ?>
		</div> 
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>