<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	$model->ptitle,
);

$this->menu=array(
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<!--<h1>View Page #<?php echo $model->id; ?></h1>
-->


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'ptitle',
		
		
		array(
            'name'=>'pdescription',
            'value'=>$model->pdescription,
			'type'=>'html',
        ),
	),
)); ?>
