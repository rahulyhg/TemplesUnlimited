<?php
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';

?>

<div  class="wrapper itemclass" style="margin-bottom:40px;">
		<?php
		$dataProvider->pagination->pageSize=16;
		$this->widget('ext.widgets.EColumnListView', array(
		'dataProvider' => $dataProvider,
		'emptyText' => "We're sorry, no product's found for this category. Try refining this category above to get more results.",
		'columns' => 4,
		'itemView' => 'products_grid',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
		));
		
		$this->widget('CLinkPager', array(
		'currentPage'=>$pages->getCurrentPage(),
		'itemCount'=>$items_count,
		'pageSize'=>$page_size,
		'header'=>'',
		'htmlOptions'=>array('style'=>'float:right; margin-bottom:20px; margin-top:-50px;'),
		));
		?>
					
</div>		
