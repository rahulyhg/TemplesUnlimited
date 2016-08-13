<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage Sliders</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;Slider Listing
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/slider/admin" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content"><?php
/* @var $this SliderController */
/* @var $model Slider */

$this->breadcrumbs=array(
	'Sliders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Slider', 'url'=>array('index')),
	array('label'=>'Create Slider', 'url'=>array('create')),
	array('label'=>'Update Slider', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Slider', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Slider', 'url'=>array('admin')),
);
?>

<h1>View Slider #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'stitle',
		'sdescription',
		/*'sfile',*/
		array(
            'name'=>'sfile',
            'type'=>'html',
            'value'=>(!empty($model->sfile))?CHtml::image(Yii::app()->request->baseUrl."/images/sliders/thumb/".$model->sfile):"no image",
        ),
		
		'sstatus',
	),
)); ?>
<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>