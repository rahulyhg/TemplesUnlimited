<?php
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = ''
?>
<?php
$dataProvider->pagination->pageSize=12;
$this->widget('ext.widgets.EColumnListView', array(
'dataProvider' => $dataProvider,
'emptyText' => "We're sorry, no pooja's found for this category. Try refining this category above to get more results.",
'columns' => 3,
'itemView' => 'pooja_grid',
'template'=>'{items}{pager}',
'ajaxUpdate'=>true,
'ajaxUrl'=>array($this->getRoute().$urlextra),
));

$this->widget('CLinkPager', array(
'currentPage'=>$pages->getCurrentPage(),
'itemCount'=>$items_count,
'pageSize'=>$page_size,
'header'=>'',
'htmlOptions'=>array('style'=>'float:right; margin-bottom:20px; margin-top:20px;'),
));
?>
