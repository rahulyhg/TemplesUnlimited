<h3 class="review_hide">Reviews (<?php echo count($reviews); ?>)</h3>


<?php 
 $dataProvider->pagination->pageSize=5; ?>
                <div class="rule"></div>
				<?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'review_view',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			)); ?>
<script type="text/javascript"> 
	jQuery('.yiiPager li a').click(function(e){ 
	    e.preventDefault();
	    jQuery('.reviewlistdiv').load(jQuery(this).attr('href'));
	});

	jQuery('.tootltiptrigger').hover(function() {	 
		// first remove all existing abbreviation tooltips
		jQuery('.tootltiptrigger').next('.tooltip').remove();
		// create the tooltip
		jQuery(this).after('<span class="tooltip">' + jQuery(this).attr('title') + '</span>');
		// position the tooltip 4 pixels above and 4 pixels to the left of the abbreviation
		var left = jQuery(this).position().left + jQuery(this).width() -120;
		var top = jQuery(this).position().top - 60;
		jQuery(this).next().css('left',left);
		jQuery(this).next().css('top',top);	
	
	 },function(){
	 jQuery('.tootltiptrigger').next('.tooltip').remove();
	 }
	 );
	
	 jQuery('.triggerlogin').click(function() {	 
		// first remove all existing abbreviation tooltips
		
		 $('#Login_modal #type' ).val( jQuery(this).attr('data-type'));
	     $('#Login_modal #dataid' ).val( jQuery(this).attr('data-id'));
		 if($("#Login_modal #loginsuccess").val() == '1'){
		     closeloginmodal( jQuery(this).attr('data-type'));
          }else{
				//closeloginmodal();
				// position the tbox
				var left = jQuery(this).position().left - 180 ;
				var top = jQuery(this).offset().top - 150;
				
				jQuery('#Login_modal').css('left',left);
				jQuery('#Login_modal').css('top',top);	
				jQuery('#Login_modal').css('display','block');
		}
	});

</script>

<style>
.list-view-loading {
    background-position: bottom left  !important;
}
</style>
