<?php
$this->breadcrumbs=array(
	'Update',
);

$this->menu=array(
	array('label'=>'Create Iyer categories', 'url'=>array('create')),
	array('label'=>'View Iyer categories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Iyer categories', 'url'=>array('admin')),
);

?>

<h1>Update <i><?php echo CHtml::encode($model->category_name); ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
