<?php
$this->breadcrumbs=array(
	'Update',
);

$this->menu=array(
	array('label'=>'Create Iyer Pooja', 'url'=>array('create')),
	array('label'=>'View Iyer Pooja', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Iyer Pooja', 'url'=>array('admin')),
);

?>

<h1>Update <i><?php echo CHtml::encode($model->pooja_name); ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
