<?php if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

<?php
	 $dataProvider1->pagination->pageSize=5;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider1,
		'emptyText' => "We're sorry, no events found for your search. Try refining your search above to get more results.",
		'itemView'=>'_events_view',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
	)); ?>