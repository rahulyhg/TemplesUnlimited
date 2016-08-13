<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(
   )); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo CHtml::errorSummary($model); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'category_name'); ?>
		<?php echo $form->textField($model,'category_name',array('size'=>50,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'category_name'); ?>
	</div>
	
	
	
	
	
	

<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large')); ?>
		
				 <input type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/iyercategories/admin/'; ?>'"  class="btn  btn-large" value="Cancel" >
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
div.form input,
div.form textarea,
div.form select
{
	margin: 0.2em 0 0.5em 0;
}

div.form fieldset
{
	border: 1px solid #DDD;
	padding: 10px;
	margin: 0 0 10px 0;
    -moz-border-radius:7px;
}

div.form label
{
	font-weight: bold;
	font-size: 0.9em;
	display: block;
}

div.form .row
{
	margin: 5px 0;
}

div.form .hint
{
	margin: 0;
	padding: 0;
	color: #999;
}

div.form .note
{
	font-style: italic;
}

div.form span.required
{
	color: red;
}

div.form div.error label:first-child,
div.form label.error,
div.form span.error
{
	color: #C00;
}

div.form div.error input,
div.form div.error textarea,
div.form div.error select,
div.form input.error,
div.form textarea.error,
div.form select.error
{
	background: #FEE;
	border-color: #C00;
}

div.form div.success input,
div.form div.success textarea,
div.form div.success select,
div.form input.success,
div.form textarea.success,
div.form select.success
{
	background: #E6EFC2;
	border-color: #C6D880;
}

div.form div.success label
{
	color: inherit;
}

div.form .errorSummary
{
	border: 2px solid #C00;
	padding: 7px 7px 12px 7px;
	margin: 0 0 20px 0;
	background: #FEE;
	font-size: 0.9em;
}

div.form .errorMessage
{
	color: red;
	font-size: 0.9em;
}

div.form .errorSummary p
{
	margin: 0;
	padding: 5px;
}

div.form .errorSummary ul
{
	margin: 0;
	padding: 0 0 0 20px;
}

div.wide.form label
{
	float: left;
	margin-right: 10px;
	position: relative;
	text-align: right;
	width: 100px;
}

div.wide.form .row
{
	clear: left;
}

div.wide.form .buttons, div.wide.form .hint, div.wide.form .errorMessage
{
	clear: left;
	padding-left: 110px;
}
</style>
