<?php
/* @var $this CountryController */
/* @var $model Country */
/* @var $form CActiveForm */
?>
<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Countries</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Update <i><?php echo CHtml::encode($model->statename); ?>
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->controller->createUrl('//admin//countries/view/id/'.$model->idCountry); ?>" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
            
<div class="form">


<?php echo $this->renderPartial('_stateform', array('model'=>$model,'country'=>$model->idCountry)); ?>


</div><!-- form -->


			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>