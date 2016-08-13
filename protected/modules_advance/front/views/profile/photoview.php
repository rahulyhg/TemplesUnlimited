<?php 
$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'photo_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			));
?>		
		