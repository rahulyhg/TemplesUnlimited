<div class="wrapper"> 

<?php if(Yii::app()->user->isGuest){   ?>
	
	<?php $this->renderPartial('nonprofile'); ?>	
	
	<?php }else {  ?> 
	<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
	
	<?php } ?>
	
	
<div class="sc-column sc-column-last three-fourth-last" id="testdiv" >



<h3>My Cart - Place Order</h3>



<div class="rule"></div>
<p><strong>Your item(s) will be delivered to the  following address</strong></p>
<div class="rule"></div>
	
	
	<style>
	.rule 
	{
	border-bottom: 1px solid #000 !important;
	}
	</style>
	
	
	<div class="form">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iyerpoojas-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
	'validateOnSubmit' => true,
	),
	'htmlOptions' => array('style' => 'float:left; margin-left: 5%; width:90%'),
	)); ?>
	
	<?php
	if(isset( Yii::app()->session['nonsite']))
	{
			$nonsite = Yii::app()->session['nonsite'];
			$name = ($nonsite['name']!='')?$nonsite['name']:'';
			$email = ($nonsite['email']!='')?$nonsite['email']:'';
			$address = ($nonsite['address']!='')?$nonsite['address']:'';
			$city = ($nonsite['city']!='')?$nonsite['city']:'';
			$state = ($nonsite['state']!='')?$nonsite['state']:'';
			$country = ($nonsite['country']!='')?$nonsite['country']:'';
			$postal_code = ($nonsite['postal_code']!='')?$nonsite['postal_code']:'';
	}
	else
	{ 
	        $name = '';
			$email = '';
			$address ='';
			$city = '';
			$state = '';
			$country ='';
			$postal_code = '';
	}
	
	
	
	?>
	
	
	
	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'name',array('style'=>'width:25% !important; float:left;')); ?>
	<?php echo $form->textField($model,'name',array('class'=>'input_box','value'=>$name)); ?>
	<?php echo $form->error($model,'name'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	
	<div class="row">
	<?php echo $form->labelEx($model,'email',array('style'=>'width:25% !important; float:left;')); ?>
	<?php  echo $form->textField($model,'email',array('class'=>'input_box','value'=>$email));  ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div style="clear:both; height:10px;" ></div>
	
	
	<div class="row">
	<?php echo $form->labelEx($model,'address',array('style'=>'width:25% !important; float:left;')); ?>
	<?php  echo $form->textArea($model,'address',array('maxlength'=>250,'class'=>'input_box','style'=>'max-width:50%;min-width:50%;','value'=>$address));  ?>
	<?php echo $form->error($model,'address'); ?>
	</div>
	
	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'city',array('style'=>'width:25% !important; float:left;')); ?>
	<?php echo $form->textField($model,'city',array('class'=>'input_box','value'=>$city)); ?>
	<?php echo $form->error($model,'city'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'state',array('style'=>'width:25% !important; float:left;')); ?>
	<?php echo $form->textField($model,'state',array('class'=>'input_box','value'=>$state)); ?>
	<?php echo $form->error($model,'state'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	
	<div class="row">
	<?php echo $form->labelEx($model,'country',array('style'=>'width:25% !important; float:left;')); ?>
	<?php echo $form->textField($model,'country',array('class'=>'input_box','value'=>$country)); ?>
	<?php echo $form->error($model,'country'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	
	<div class="row">
	<?php echo $form->labelEx($model,'postal_code',array('style'=>'width:25% !important; float:left;')); ?>
	<?php echo $form->textField($model,'postal_code',array('class'=>'input_box','value'=>$postal_code)); ?>
	<?php echo $form->error($model,'postal_code'); ?>
	</div>
	<div style="clear:both; height:10px;" ></div>
	
	
	
	<div style="float:left; margin-left:26%;">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Proceed to Pay' : 'Save', array('class'=>'sc-button alignleft right','style'=>'background-color: #CB202D; color: #fff;  font-size:12px;border-radius:3px;float:right; margin-bottom:10px; margin-left:5px;border:2px solid #cb202d;font-family: "Arial",sans-serif;')); ?>
	</div>
	
	<?php $this->endWidget(); ?>
	
</div>

<script>


$('#Nonsiteuser_city').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : '<?php echo $this->createUrl('auto/cityauto'); ?>',
					dataType: "json",
					data: {
					   name_startsWith: request.term,
					},
					 success: function( data ) {
						 response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0      	
		  });


$('#Nonsiteuser_state').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : '<?php echo $this->createUrl('auto/stateauto'); ?>',
					dataType: "json",
					data: {
					   name_startsWith: request.term,
					},
					 success: function( data ) {
						 response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0      	
		  });
		  
$('#Nonsiteuser_country').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : '<?php echo $this->createUrl('auto/countryauto'); ?>',
					dataType: "json",
					data: {
					   name_startsWith: request.term,
					},
					 success: function( data ) {
						 response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0      	
		  });		  
</script>
<style>
.input_box
{
     margin: 10px 0;
    text-align: left;
    width: 50%;
	border: 2px solid #e8e8e8;
    color: #666666;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
	margin-left:10px;
}

.select_box
{
     margin: 10px 0;
    text-align: left;
    width: 50%;
    color: #666666;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;
	margin-left:10px;
}
.row {
    margin-left: 0px;
    margin-right: 0px;
}
#iyerpoojas-form
{
    font-family: "ralewayregular" !important;
    font-size: 13px !important;
    padding: 17px;
}
#iyerpoojas-form label
{
width:30%;
}

.errorMessage
{
margin-left:27%;
}

#page .ui-icon {
    display: block;
}

</style>
</div>
</div>
<style>
.light
{
display:none;
}
</style>

