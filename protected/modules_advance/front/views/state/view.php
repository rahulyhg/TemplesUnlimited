<div class="span9">
      <ul class="breadcrumb">
        <li><i class="icon-user"></i>&nbsp;Manage States</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;State Listing
            <div class="btn-group" style="float:right; margin-right:10px;"> <a class="btn btn-inverse" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/admin/state/admin" style="padding: 1px 5px 1px; font-weight:normal;"><i class="icon-backward icon-white"></i>&nbsp;Back</a>
              
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="main-content"><?php
/* @var $this StateController */
/* @var $model State */

$this->breadcrumbs=array(
	'States'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List State', 'url'=>array('index')),
	array('label'=>'Create State', 'url'=>array('create')),
	array('label'=>'Update State', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete State', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage State', 'url'=>array('admin')),
);
?>

<h1>View State #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country_id',
		'name',
	),
)); ?>
<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>