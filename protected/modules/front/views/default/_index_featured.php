<?php
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';

?>

<?php  $featured =FeaturedListing::model()->findAll(); ?>
   <div id="pane1" class="tab-pane" style="height:380px;">
	
     <div class="" style="margin-left:10px; height:320px;" >
	 
	 <?php
	    $this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' =>$dataProvider_pop,
					'emptyText' => "We're sorry, no results found for your search.",
					'columns' => 3,
					'itemView' => 'popular_grid',
					'template'=>'{items}{pager}',
					'ajaxUpdate'=>true,
					'ajaxUrl'=>array($this->getRoute().$urlextra),
					));
	 ?>
	 </div>
	 	<div  style="clear:both;"></div>
	 <div class="right" style="margin-right:20px;">
            <a href="<?php echo $this->createUrl('list/temples/id/1'); ?>" style="color:#cb202d; padding-top:-20px;">View all <?php echo strtolower($featured[0]->name);  ?>  &raquo;</a></div>
    </div>
    <div id="pane2" class="tab-pane" style="height:380px;">
   <div class="" style="margin-left:10px; height:320px;" >
   
   
   	 <?php
	    $this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' =>$dataProvider_pop_india,
					'emptyText' => "We're sorry, no results found for your search.",
					'columns' => 3,
					'itemView' => 'popular_grid',
					'template'=>'{items}{pager}',
					'ajaxUpdate'=>true,
					'ajaxUrl'=>array($this->getRoute().$urlextra),
					));
	 ?>
        </div>
		<div  style="clear:both;"></div>
		<div class="right" style="margin-right:20px;">
            <a href="<?php echo $this->createUrl('list/temples/id/2'); ?>" style="color:#cb202d;">View all <?php echo strtolower($featured[1]->name);  ?>  &raquo;</a></div>
    </div>
	
    <div id="pane3" class="tab-pane" style="height:380px;">
     <div class="" style="margin-left:10px; height:320px;" >
          <?php
	    $this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' =>$dataProvider_merriage_prms,
					'emptyText' =>  "We're sorry, no results found for your search.",
					'columns' => 3,
					'itemView' => 'popular_grid',
					'template'=>'{items}{pager}',
					'ajaxUpdate'=>true,
					'ajaxUrl'=>array($this->getRoute().$urlextra),
					));
	 ?>
        </div>
		<div  style="clear:both;"></div>
		<div class="right" style="margin-right:20px;">
            <a href="<?php echo $this->createUrl('list/temples/id/3'); ?>" style="color:#cb202d; padding-top:-20px;">View all <?php echo strtolower($featured[2]->name);  ?>  &raquo;</a></div>
		
    </div>
    <div id="pane4" class="tab-pane" style="height:380px;">
     <div class="" style="margin-left:10px; height:320px;" >
         <?php
	    $this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' =>$dataProvider_child_birth,
					'emptyText' => "We're sorry, no results found for your search.",
					'columns' => 3,
					'itemView' => 'popular_grid',
					'template'=>'{items}{pager}',
					'ajaxUpdate'=>true,
					'ajaxUrl'=>array($this->getRoute().$urlextra),
					));
	 ?> 
        </div>
		<div  style="clear:both;"></div>
		<div class="right" style="margin-right:20px;">
            <a href="<?php echo $this->createUrl('list/temples/id/4'); ?>" style="color:#cb202d; ">View all <?php echo strtolower($featured[3]->name);  ?>  &raquo;</a></div>
		
    </div>
	<style>
	.items
	{
	/*margin-top:5px;*/
	}
	</style>
	<script>
	var href= $('.nav-tabs > li.active > a').attr('href');
	$(href).addClass("active");
	</script>
	
