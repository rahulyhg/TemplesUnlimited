<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples',
);

$this->menu=array(
	array('label'=>'Create Temple', 'url'=>array('create')),
	array('label'=>'Manage Temples', 'url'=>array('admin')),
);
?>

<div class="box" id="box-5">
  <h4 class="box-header round-top">Temples</h4>         
  <div class="box-container-toggle">
	  <div class="box-content">
		<ul class="dashboard-member-activity">
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
			)); ?>
		</ul>
	  </div>
  </div>
</div>
