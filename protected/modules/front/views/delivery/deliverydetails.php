<?php $form=$this->beginWidget('CActiveForm',array('htmlOptions'=>array(
                        'class'=>'form-horizontal','style'=>'padding-left:20px;','enctype' => 'multipart/form-data'))); 
						
	$address1 = Deliveries::model()->getcollectionaddress_contact($deliveries);
	$address2 = Deliveries::model()->getdeliveryaddress_contact($deliveries);					?>
	<h4>Delivery details</h4><br/>					
   <div class="control-group">
	<?php echo CHtml::label('Delivery title','',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo Deliveries::model()->rendertitle($deliveries); ?></b>
    </div>
    </div>
	
	
	
	<div class="control-group">
	<?php echo CHtml::label('Balance left to pay','',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo Yii::app()->params['currency_symbol'].((float)$accepteddetails->quotedetails->net_quote-(float)$accepteddetails->quotedetails->paid_amount); ?></b>
    </div>
    </div>
	
	
	
	
	
	<h5>collection (FROM):</h5>
	
	
	
	<div class="control-group">
	<?php echo CHtml::label('Name','',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo $accepteddetails->col_fname.' '.$accepteddetails->col_lname; ?></b>
    </div>
    </div>
	
	
	<div class="control-group">
     <?php echo $form->labelEx($accepteddetails,'col_mobile',array('class'=>'control-label')); ?>  
    <div class="controls">
	 <b><?php echo '<span class="">'.Yii::app()->params['phone_begin'].'</span>'.$accepteddetails->col_mobile; ?></b>
    </div>
	</div>
	
	
	
	<div class="control-group">
     <?php echo $form->labelEx($accepteddetails,'col_picture',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo helpers::render_image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$accepteddetails->col_picture,array('width'=>'100px','height'=>'100px')); ?></b>
    </div>
	</div>
	
	<div class="control-group">
   <?php echo CHtml::label('Address','',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo $address1; ?></b>
    </div>
	</div>
	
	
	<h5>Items reciever (TO):</h5>

	
	<div class="control-group">
	<?php echo CHtml::label('Name','',array('class'=>'control-label')); ?> 
    <div class="controls">
	<b><?php echo $accepteddetails->del_fname.' '.$accepteddetails->del_lname; ?></b>
    </div>
    </div>

	
	<div class="control-group">
     <?php echo $form->labelEx($accepteddetails,'del_mobile',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b> <?php echo '<span class="">'.Yii::app()->params['phone_begin'].'</span>'.$accepteddetails->del_mobile; ?></b>
    </div>
	</div>
	
	
	
	<div class="control-group">
     <?php echo $form->labelEx($accepteddetails,'del_picture',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo helpers::render_image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$accepteddetails->del_picture,array('width'=>'100px','height'=>'100px')); ?></b>
    </div>
	</div>
	
	<div class="control-group">
   <?php echo CHtml::label('Address','',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo $address2; ?></b>
    </div>
	</div>
	
	
	<h5>Driver Details:</h5>
	
	
	<div class="control-group">
	<?php echo CHtml::label('Name','',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b> <?php echo $accepteddetails->send_fname.' '.$accepteddetails->send_lname; ?></b>
    </div>
    </div>
	
	
	
	<div class="control-group">
     <?php echo $form->labelEx($accepteddetails,'send_mobile',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b> <?php echo '<span class="">'.Yii::app()->params['phone_begin'].'</span>'.$accepteddetails->send_mobile; ?></b>
    </div>
	</div>
	
	<div class="control-group">
     <?php echo $form->labelEx($accepteddetails,'send_reg_no',array('class'=>'control-label')); ?>  
    <div class="controls">
	 <b><?php echo $accepteddetails->send_reg_no; ?></b>
    </div>
	</div>
	
	<div class="control-group">
    <?php echo $form->labelEx($accepteddetails,'send_picture',array('class'=>'control-label')); ?>  
    <div class="controls">
	<b><?php echo helpers::render_image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$accepteddetails->send_picture,array('width'=>'100px','height'=>'100px')); ?></b>
    </div>
	</div>
	
	<?php $this->endWidget(); ?>
