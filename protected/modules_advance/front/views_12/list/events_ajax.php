<?php if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

<?php
	 $dataProvider1->pagination->pageSize=10;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider1,
		'itemView'=>'_events_view',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
	)); ?>