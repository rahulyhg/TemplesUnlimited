<div class="latest-posts wrapper" style="margin-top:30px; margin-bottom:30px;">	
	<?php
	if(isset($_REQUEST['vt']))
	$urlextra = '/vt/'.$_REQUEST['vt'];
	else
	$urlextra = '';
	
	$dataProvider->pagination->pageSize=12; ?>
	<?php  $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'emptyText' => "We're sorry, no product's found for this category. Try refining this category above to get more results.",
	'itemView'=>'_product_list_view',
	'template'=>'{items}{pager}',
	'ajaxUpdate'=>true,
	'ajaxUrl'=>array($this->getRoute()),
	));

	$this->widget('CLinkPager', array(
	'currentPage'=>$pages->getCurrentPage(),
	'itemCount'=>$items_count,
	'pageSize'=>$page_size,
	'header'=>'',
	'htmlOptions'=>array('style'=>'float:right; margin-bottom:20px; margin-top:-30px;'),
	));
	?>
</div>
