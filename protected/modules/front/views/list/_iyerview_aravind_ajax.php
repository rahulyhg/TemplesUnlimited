<div class="sc-column sc-column-last three-fourth-last" id="right-pane" >
	 <ul class="items items-list-view onecolumn">
			<?php
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'emptyText' => "We're sorry, no Iyer found in this category.",
				'itemView'=>'iyer_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),
			)); ?>
		</ul>
	  </div>
