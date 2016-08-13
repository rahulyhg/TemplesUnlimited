<?php
/* @var $this Newsletter_SubscribersController */
/* @var $model Newsletter */

$this->breadcrumbs=array(
	'Newsletters Subscribers'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Newsletter Subscribers', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#newsletter-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Newsletters Subscribers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div id="statusMsg">
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
 
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
</div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'newsletter-grid',
	'dataProvider'=>$model->search(),
	'ajaxUpdate'=>'false',
	'columns'=>array(
		'id',
		'emailid',
		 array(
		'name'=>'status',
		'value'=>'($data->status==0)?"Inactive":"Active"',
		'filter'=>false,
		 ),
		'date',
		 array(
        'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
    ),
    ),
)); ?>

<style>
.update
{
display:none;
}
</style>
