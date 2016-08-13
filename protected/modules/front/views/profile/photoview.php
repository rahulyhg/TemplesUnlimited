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

<script type="text/javascript">
	jQuery("a[rel^='prettyPhoto']").prettyPhoto();   
</script>
<style type="text/css">
.photolistdiv .gallery-item  {
    margin-right: 32px !important;
}
.photolistdiv .pager {
    clear: both;
}
.photolistdiv .wp-caption-text {
      font-size: 13px !important;
    height: 30px;
    line-height: 17px;
}
</style>	
			
		
