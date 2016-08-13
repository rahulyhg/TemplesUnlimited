<div class="sc-column sc-column-last three-fourth-last" id="right-pane" >
	 <ul class="items items-list-view onecolumn">
			<?php
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'emptyText' => "We're sorry, no temple's found for your search. Try refining your search above to get more results.",
				'itemView'=>'_view',
				'template'=>'{items}{pager}',
				/*'template'=>'{items}',*/
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
		</ul>
	  </div>
