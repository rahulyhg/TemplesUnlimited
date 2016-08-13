<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'View Iyer - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);

 $iyer_image=  $model->user_image;
?>
<div class="">
<style type="text/css">
.pp_content{ display:table; }
a.pp_close{ position:relative; float:right; }

.pager{ float:right; }
.activitiesplans li {
    
    border-bottom: 1px solid #CCCCCC;
    border-image: none;
    border-left: 0 none;
    border-top: 1px solid #CCCCCC;
    padding: 10px;
	margin-bottom: 20px;
}
.activitiesplans li .leftside{ float:left;  max-width: 70%; }
.activitiesplans li .rightside{ float:right; }
.activitiesplans p{ margin-bottom:0px; }
.activitiesplans li .leftside .title{ font-weight:bold; }
</style>
<?php  $reviewdetail = Reviews::model()->get_reviews_count('iyer',$model->user_id); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids(explode(',',$model->iyermoredetails->iyer_sec_languages)),'language_id','language_name'));
?>
      <div id="content" role="main">
		  
        <div id="primary">
          <h2 class="section-title"><?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?></h2>
          <div class="item-stars clearfix left" style="margin-right:10px;">  <?php echo Reviews::model()->show_average_stars('iyer',$model->user_id); ?>  </div>
          <div style="margin-top:-5px;"> <strong> <?php echo $reviewdetail['count']; ?> </strong> Customer reviews</div>
          <br>
          <div id='gallery-1' class='gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail'>
            <dl class='gallery-item'>
              <dt class='gallery-icon landscape'> 
			  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $iyer_image; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $iyer_image; ?>" class="attachment-thumbnail" alt="<?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>" /></a>
			   </dt>
              <dd class='wp-caption-text gallery-caption'> </dd>
            </dl>
            <br style='clear: both;' />
          </div>
          <div class="tab-font">
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />
              <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Details">
				<p style="margin-bottom:0"> <strong>Total Experience:</strong> <?php echo $model->iyermoredetails->iyer_experience; ?>&nbsp;year(s)<br>
				
				<strong>Total Booked:</strong> 63 time(s) <br>
				
				<strong>City of Residence:</strong> <?php echo $model->iyermoredetails->iyercity->name; ?><br>
				
				
				<p><strong>Gender:</strong> <?php echo $model->gender1; ?><br>
				<strong>Primary Language:</strong> <?php echo $model->languagename->language_name; ?><br>
				<strong>Languages Spoken:</strong> <?php echo $secondarylanguages; ?><br>
              
			  <div class="rule">&nbsp;</div>
			  <div id="bookingpart">
			  <b>Activity Options </b>
			  
			  <?php $activities = Iyeractivities::model()->get_all($model->user_id);  ?>
			  
			  
			
				<ul class="activitiesplans">
				<?php if($activities){
				
				           foreach($activities as $activity){ 
							 $minprice = $activity->amount_without_items;
						   ?>
								<li class="option" id="to_5459">
								<div class="leftside">
								<div class="title"><?php echo $activity->activity_title; ?></div>
								<p>
								<?php echo $activity->activity_description; ?>
								</p>
							
								</div>
								<div class="rightside">
								<span class="price">
								<span>From</span>
								<b class="min-price"><?php echo helpers::to_currency( $minprice); ?></b>
								<br>
								</span>
								<a href="#" data-name="ChooseOptionButton" class="book-option btn btn--green btn--small">Choose option</a>
								</div>
								
								<div class="clear">&nbsp;</div>
								
								</li>
				<?php } } ?>		
				   </ul>
			  </div>
			  <div class="rule">&nbsp;</div>
			  <?php echo   $model->iyermoredetails->iyer_overview; ?>
              </div>
              
              <div class="ait-tab tab-content" data-ait-tab-title="Reviews">
				  
     
                   <div class="reviewlistdiv">
				
				
			
		  
                  
                </div>
           
              </div>
        
              <div class="ait-tab tab-content" data-ait-tab-title="Photos">
                  
                <div class="gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail photolistdiv" id="gallery-1">
				
				
		</div>
                
                
                
              </div>
            </div><!---------primary------------>
               
            
            <script type="text/javascript">
		(function($){

			$(function(){

				var $tabs = $("#ait-tabs-641" ),
					$tabsList = $tabs.find("> ul"),
					$tabDivs = $tabs.find(".ait-tab.tab-content"),
					tabsCount = $tabDivs.length;

				$tabs.find("> p, > br").remove();

				var tabId = 0;
				$tabDivs.each(function(){
					tabId++;
					var tabName = "tab-641-"+tabId;
					var sharp = "#";
					$(this).attr("id",tabName);
					var tabTitle = $(this).data("ait-tab-title");
					$('<li><a class="tab-link" href="'+sharp+tabName+'">'+tabTitle+'</a></li>').appendTo($tabsList);
				});

				$tabs.tabs();

				if(typeof Cufon !== "undefined")
					Cufon.refresh();
			});

		})(jQuery);
	</script>
          </div>
        </div>


        <!-- /#primary -->
        
        
        <div id="secondary" class="widget-area" role="complementary">
			
			
      
      <div align="center" style="border-radius:5px; background:#FBFBFB; margin-bottom:15px; padding:10px;"> <a style="background-color:#CB202D; color: #fff; font-size:18px; margin:15px; border-radius:3px; width:180px;" href="#bookingpart"  class=" sc-button light "><strong>Book Now</strong></a>  <br>
                  <h5>From <strong><?php echo  helpers::to_currency($model->iyermoredetails->iyer_amount);  //sc-modal-link sc-modal-link-sc-modal-window-modal1 ?></strong></h5>
            

<div style="display: none;"><div id="sc-modal-window-modal1" style="position:relative; width:600px; height:550px;"><div class="sc-modal-content entry-content content-style">
<h3 style="text-align: center;">Iyer Booking Details</h3>

<div class="tab-font">
            <div id="ait-tabs-641" class="">
              
              
        <h3 class="section-title">Booking Details</h3><br>
				<div style="width:70%; font-size:14px;" class="sc-column one-half">
					<div class="left">Amount<br><br>Working Hours<br><br>Choose your Option</div>
				<div class="right"><?php echo  helpers::to_currency($model->iyermoredetails->iyer_amount); ?>/-<br><br><?php echo  $model->iyermoredetails->iyer_wh1.' - '.$model->iyermoredetails->iyer_wh2; ?><br><br>
				
                 <label class="checkbox"> <input type="radio" checked="checked" value="with_pooja" name="test" id="test">&nbsp;&nbsp;With Pooja Items (<?php //echo  helpers::to_currency($model->iyermoredetails->iyer_amount_with_items); ?>)</label><br><br>
                  <label class="checkbox"> <input type="radio" value="without_pooja" name="test" id="test">&nbsp;&nbsp;Without Pooja Items (<?php //echo  helpers::to_currency($model->iyermoredetails->iyer_amount); ?>)</label><br><br>
                  </div></div>
				
				 
                    
                    
               <a style="background-color:#CB202D; color: #fff; font-size:18px; margin:15px; border-radius:3px; width:180px;" href="#sc-modal-window-modal1"  class=" sc-button light sc-modal-link sc-modal-link-sc-modal-window-modal1 right"><strong>Book Now</strong></a><br>

                
               </div></div>

</div></div></div>

            <!--<p>( Per group up to 1 ) </p>--->
          </div>
   
   <script>           
		jQuery(document).ready(function() {		jQuery("a.sc-modal-link").attr("rel", "prettyPhoto").prettyPhoto({ social_tools:false, deeplinking: false, default_width: 600, default_height: 550 });	});</script>
	
     
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>We Promise</strong></h5>
            <ul class="style1">
              <li>Speedy booking and reserved spots</li>
              <li>No-hassle Best Price Guarantee</li>
            </ul>
            			<div class="rule"></div>
			<div class="right" style="margin-top:-15px;" id="column"><a href="review.html">Ask Queries &raquo;</a></div>
          </div>
          
           
  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" id="column">
            <h5><strong><?php echo $reviewdetail['count']; ?> Customer Reviews</strong></h5>
            <div class="rule"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">5 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['5stars']; ?>&nbsp;Customer(s)</span></div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">4 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['4stars']; ?>&nbsp;Customer(s)</span></div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">3 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['3stars']; ?>&nbsp;Customer(s)</span>
             </div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">2 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['2stars']; ?>&nbsp;Customer(s)</span>
              </div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">1 Star &nbsp;</span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['1stars']; ?>&nbsp;Customer(s)</span>
              </div><br>
			  
			  <!--<div class="right" style="margin-top:-15px;"><a href="">See all Reviews &raquo;</a></div>-->
          </div>
          
          
		 <?php $relatedproducts = Iyer::model()->getrelatedproducts($model->user_id,'2'); 
					
					
		if(count($relatedproducts)){ ?>
		 
		<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" id="column">
            <h5><strong>You might also like..</strong></h5>
			
		<?php	
					  foreach($relatedproducts as $relatedproduct){
					     $relatedproduct->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$relatedproduct->user_id ));
			?>
			
            <p><strong><a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($relatedproduct->user_id))); ?>"><?php echo  $relatedproduct->gender.'. '.$relatedproduct->first_name.' '.$relatedproduct->last_name; ?></a></strong></p>
			<div>
			<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($relatedproduct->user_id))); ?>">
			<?php echo helpers::view_thumb150($relatedproduct->user_image,array("class"=>"left","style"=>'max-width:125px')); ?>
			</a>
			<div class="right"><div class="item-stars clearfix"> <?php echo Reviews::model()->show_average_stars('iyer',$relatedproduct->user_id); ?></span>
			</div><p style="padding-top:20px;">From <strong><?php echo  helpers::to_currency($relatedproduct->iyermoredetails->iyer_amount); ?></strong></p></div>
			
			</div>
			<div class="rule"></div>
			
			<?php } ?>
		
			<div class="right-align"><a href="<?php echo CHtml::normalizeUrl(array("list/iyer/cid/".helpers::simple_encrypt($model->user_id))); ?>">See all related activites &raquo;</a></div>

          </div>
		  <?php } ?>
		 <!--<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Locations</strong></h5>
            <ul>
              <li><a href="#">Madurai, TN, India</a></li>
              <li><a href="#">Tanjore, TN, India</a></li>
            </ul>
          </div>--->
		<!--  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Similar Categories</strong></h5>
            <ul>
              <li><a href="#">Tamilnadu trips</a></li>
            </ul>
          </div>-->
     
     
        </div>
     
   <?php
   
   if(Yii::app()->user->isGuest || helpers::isnormaluser()){
		 $reviews = new Reviews;
		 $reviews->review_itemtype = 'iyer';
		 $reviews->review_itemid = $model->user_id;
		 $this->renderPartial('reviews', array('reviews'=>$reviews));
	 }
	  ?>	

     
    
     <div> 
      <!--<div class="left">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/user.png"/>
</div>
<div style="margin-left:15px;">
<strong style="margin-left:5px;">Sunsree</strong><br>
<div class="item-stars clearfix left" style="margin-right:10px; margin-left:5px;"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div><br>
<p style="margin-left:15px;">business is business. everywhere you have to believe or no result. God is inside us so know self and then tell the truth. our self is our own enemy in the world: comments must help to others not to spoil them. Ohm Nama Shivayah</p><br>
<span class="right">
3 &nbsp;<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/thumb.png" width="20px" onMouseOver="this.src='image/hup.png'" onMouseOut="this.src='image/thumb.png'" border="0" alt=""/></a>&nbsp;
0 &nbsp;<a href="#"><img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/unlike.png" width="20px;" onMouseOver="this.src='image/hdown.png'" onMouseOut="this.src='image/unlike.png'" border="0" alt=""/></a>
</span>

</div>-->
   </div>  
							
							
    </div>
								
    </div>
	<script type="text/javascript">
jQuery(function(){
      jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/iyer/id/'.$model->user_id); ?>');
	  jQuery('.photolistdiv').load('<?php echo CController::CreateUrl('//front/detail/photolist/type/iyer/id/'.$model->user_id); ?>');

  
});
</script>