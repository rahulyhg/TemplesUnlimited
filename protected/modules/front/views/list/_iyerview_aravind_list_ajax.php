<?php
if(isset($_REQUEST['vt']))
$urladditional = '/vt/'.$_REQUEST['vt'];
else
$urladditional = '';

if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>
<div id="ait-dir-login-tab" class="tab-pane active">
	
 <div class="sc-column sc-column-last three-fourth-last" id="right-pane" >
	 <ul class="items items-list-view onecolumn">
	 

			<?php
					$dataProvider->pagination->pageSize=12;
					$this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' => $dataProvider,
					'emptyText' => "We're sorry, no Iyer found in this category.",
					'columns' => 3,
					'itemView' => 'iyer_gridview',
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
		</ul>
		
		

	  </div>

    </div>
