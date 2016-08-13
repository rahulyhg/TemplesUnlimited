<?php if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

<?php
	 $dataProvider->pagination->pageSize=5;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'emptyText' => "We're sorry, no news found for your search. Try refining your search above to get more results.",
		'itemView'=>'_news_view',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
	)); ?>
	
