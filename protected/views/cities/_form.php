<?php
/* @var $this CitiesController */
/* @var $model Cities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cities-form',

	'enableAjaxValidation'=>true,
	//'enableClientValidation'=>true,
					'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
	
	
	<div class="row">     
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php
			$list = CHtml::listData(Country::model()->findAll(array('order' => 'country')), 'id', 'country');
			echo $form->dropDownList($model,'country_id', $list,array('empty'=>'Select Country', 'onchange'=>'javascript:onChangecountry(this.value);'));   
		?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>
	
	
	<div class="row"> 
	
	<?php
		 if($model->isNewRecord)
		 $list =array();
		 else
		 $list = CHtml::listData(States::model()->findAll(array('order' => 'state_name')), 'id', 'state_name'); ?>
		 
		     
		<?php echo $form->labelEx($model,'state_id'); ?>
		<?php echo $form->dropDownList($model, 'state_id',$list, array('empty'=>'Select State')); ?>
		<?php echo $form->error($model,'state_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-large')); ?>

<input type="button" onclick="window.location.href ='<?php echo Yii::app()->request->baseUrl.'/index.php/cities/admin/'; ?>'"  class="btn  btn-large"  value="Cancel" >
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
 function onChangecountry(country_id)
 {
       $.ajax({
              url : '<?php echo  CController::createUrl('states/list_country'); ?>',
              type : "post",
              data : 'country_id='+country_id,
              success:function(data)
              {
			   $('#Cities_state_id').html(data);
			  } 
         });
 }
</script>
