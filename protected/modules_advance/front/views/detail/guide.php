<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'View Iyer - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);

$guide_image=  $model->user_image;
$secondarylocations = CHtml::listData(Cities::model()->getall_byids(explode(',',$model->guidemoredetails->secondary_locations)),'id','name');
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids(explode(',',$model->guidemoredetails->guide_sec_languages)),'language_id','language_name'));
$guideservices = implode(', ',CHtml::listData(Services::model()->getall_byids(explode(',',$model->guidemoredetails->guide_services)),'service_id','service_name'));
?>
<div id="">
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
		<!-- loads mdp -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">


<script type="text/javascript">
		/*jQuery(function() {
		
		
		    var today = new Date();
			var y = today.getFullYear();
						jQuery('#multidatepicker').multiDatesPicker({
				altField: '#<?php  echo 'availabledate'; ?>',
				dateFormat: "yy-mm-dd",
				numberOfMonths: [1,2]
			});
		});*/
		
	 jQuery(function() {
   jQuery("#availabilty").datepicker({
      showOn: "button",
	  dateFormat: "yy-mm-dd",
      buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/image/calendar.gif",
      buttonImageOnly: true
    });
  
    
  });
	</script>	
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
<?php  $reviewdetail = Reviews::model()->get_reviews_count('guide',$model->user_id); ?>
      <div id="content" role="main">
        <div id="primary">
          <h2 class="section-title"><?php echo  $model->guidemoredetails->guide_title; ?></h2>
          <div class="item-stars clearfix left" style="margin-right:10px;"> <?php echo Reviews::model()->show_average_stars('guide',$model->user_id); ?> </div>
          <div style="margin-top:-5px;"> <strong> <?php echo $reviewdetail['count']; ?> </strong> Customer reviews <!--| <a href="" > read more reviews &raquo;</a>--></div>
          <br>
          <div id='gallery-1' class='gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail'>
            <dl class='gallery-item'>
              <dt class='gallery-icon landscape'> <a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $guide_image; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $guide_image; ?>" class="attachment-thumbnail" alt="<?php echo  $model->guidemoredetails->guide_title; ?>" /></a> </dt>
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
                
                <div class="right"><a>Check Availability</a>
                <br>
                <input type="text" id="availabilty">
                </div>
               <p style="margin-bottom:0"> <strong>Tour Guide Experience:</strong> <?php echo $model->guidemoredetails->guide_experience; ?>&nbsp;year(s)<br>

<strong>Tours Booked:</strong> 63 time(s) <br>

<strong>City of Residence:</strong> <?php echo $model->guidemoredetails->guidecity->name; ?><br>

<strong>Other Guiding Locations:</strong>
</p>
<ul class="style5" style="margin-top:0px;" id="column1">

<?php if(count($secondarylocations)){
  foreach( $secondarylocations as $secondarylocation){ ?>
<li><?php echo  $secondarylocation; ?></li>
<?php } }?>
</ul>
<p><strong>Gender:</strong> <?php echo $model->gender1; ?><br>
<strong>Primary Language:</strong> <?php echo $model->languagename->language_name; ?><br>
<strong>Languages Spoken:</strong> <?php echo $secondarylanguages; ?><br>
<strong>Services:</strong> <?php echo $guideservices; ?><br>


<strong>Professional License/Certificate:</strong> <?php if($model->guidemoredetails->guide_have_certificate == '1' &&  trim($model->guidemoredetails->guide_license) != ''){ ?> Yes<?php }else{ ?>No<?php } ?><br>
<?php if($model->guidemoredetails->guide_have_certificate == '1' &&  trim($model->guidemoredetails->guide_have_certificate) != ''){ ?>
Tour Guide License/Certificate to verify the professional and dependable nature of this Tour Guide
<a style="background-color:transparent; margin:0;  padding:0; " href="#sc-modal-window-modal1"  class=" sc-button light sc-modal-link sc-modal-link-sc-modal-window-modal1">View License/Certificate</a></p>
<div style="display: none;"><div id="sc-modal-window-modal1" style="position:relative; width:600px; height:550px;"><div class="sc-modal-content entry-content content-style">
<h3 style="text-align: center;">Guide License Details</h3>
<div class="tab-font">
            <div id="ait-tabs-641" class="">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $model->guidemoredetails->guide_license; ?>" alt="<?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>" />
             </div></div>
</div></div></div>
   <script type="text/javascript">           
		jQuery(document).ready(function() {		jQuery("a.sc-modal-link").attr("rel", "prettyPhoto").prettyPhoto({ social_tools:false, deeplinking: false, default_width: 600, default_height: 550 });	});
  </script>

 <?php } ?>
                
                  
				
                
                <div class="rule"></div>
				<b>Activity Options </b>
				<ul class="activitiesplans">
				<?php if(count($model->guideactivities)){
				
				           foreach($model->guideactivities as $guideactivities){ 
						   
						   $activity_start_timings = unserialize($guideactivities->activity_start_timings); 
						   $activity_plans = unserialize($guideactivities->activity_plans); 
						   
						 /*    echo '<pre>';
						     print_r( $activity_plans);
						     print_r( $activity_start_timings);
							 die;*/
							 $minprice = $model->guidemoredetails->guide_amount;
							if( $guideactivities->plan_per == 'per_group'){
							  if(isset($activity_plans['type']) && count($activity_plans['type'])){
							     $pricesarr = array();
							     $plans = $activity_plans['type'];
								   foreach($plans as $plan){
								   $pricesarr = array_merge( $pricesarr ,$plan['member']);
								   }
								    $minprice = (float)min( $pricesarr);
							   }
							}
							 
						   
						   ?>
					 <li class="option" id="to_5459">
<div class="leftside">
<div class="title"><?php echo $guideactivities->activity_title; ?></div>
<p>
<?php echo $guideactivities->activity_description; ?>
</p>
<p>
<strong>Duration:</strong>
<?php echo $guideactivities->activity_duration; ?>    <?php if((float)$guideactivities->activity_duration<1){ ?> Minutes<?php }else{ ?> Hours<?php } ?>   </p>
<!--<p>
<strong>Category:</strong>
<?php //echo $guideactivities->category->category_name; ?>        </p>
<p>-->
<strong>Live guide:</strong>
<?php 
$activitylanguages = CHtml::ListData(Languages::model()->getall_byids(explode(',',$guideactivities->activity_language)),'language_id','language_name');
echo implode(', ',$activitylanguages); ?>        </p>
<p>
<strong>Starts at Meeting Point</strong>
(			<a class="meetingPointDetails"  onclick="showmeetingpointcontent('<?php echo $guideactivities->activity_id; ?>')"  href="javascript:void(0);">More details</a>			)
</p>
</div>
<div class="rightside">
<span class="price">
<span>From</span>
<b class="min-price"><?php echo helpers::to_currency( $minprice); ?></b>
<br>
<!--<span>
(<?php //echo  	str_replace('_',' ',$guideactivities->plan_per); ?>)
</span>--><br/>
</span>
<a href="#" data-name="ChooseOptionButton" class="book-option btn btn--green btn--small">Choose option</a>
</div>
<div id="starting_point_content<?php echo $guideactivities->activity_id; ?>" style="display:none">
<h3><?php echo $guideactivities->activity_title; ?></h3><br/>
<b>Details on meeting point, pick-up and drop-off: </b><br/><br/>
<?php echo $guideactivities->starting_point_content; ?>
</div>
<div class="clear">&nbsp;</div>

</li>
				<?php } } ?>		
				   </ul>
                 <div class="rule"></div>
      
              </div>
              <div class="ait-tab tab-content" data-ait-tab-title="Reviews">
                
				<!--<a style="background-color:#CB202D; color: #fff; font-size:13px; border-radius:3px; margin-top:-40px;" class="sc-button light right" href="review.html"><strong>Write a Review</strong></a>
                <br>-->
                <!--<div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> <span>
                  <p> (2) </p>
                  </span> </div>
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>-->
                  
                <div class="reviewlistdiv">
				
				
			
		  
                  
                </div>
              <span class="right">
               

</span>
	
              </div>
			  <div class="ait-tab tab-content" data-ait-tab-title="Photos">
                  
              <div class="gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail photolistdiv" id="gallery-1">
			
				
				
				
		     </div>
                
                
                
              </div>
            </div>
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
          <div align="center" style="border-radius:5px; background:#FBFBFB; margin-bottom:15px; padding:10px;"> <a style="background-color:#CB202D; color: #fff; font-size:18px; margin:15px; border-radius:3px; width:180px;" class="sc-button light" href=""><strong>Book Now</strong></a> <br>
            <h5>From <strong><?php echo  helpers::to_currency($model->guidemoredetails->guide_amount); ?></strong></h5>

          </div>
          
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>We Promise</strong></h5>
            <ul class="style1">
              <li>Speedy booking and reserved spots</li>
              <li>No-hassle Best Price Guarantee</li>
            </ul>
			<div class="rule"></div>
			<div style="margin-top:-15px;" class="right" id="column"><a href="review.html">Ask Queries &raquo;</a></div>
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
          
          
		 <!-- <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>Recently viewed</strong></h5>
            <p><strong>Oneday trip to Meenakshi Amman Temple</strong></p>
			<div>
			<img class="left" src="<?php echo Yii::app()->request->baseUrl; ?>/image/img-5_84.jpg">
			<div class="right"><div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span>
			</div><p style="padding-top:20px;">From <strong>Rs.5000</strong>( Per Group)</p></div>
			
			</div>
			<div class="rule"></div>
			<ul>
			<li>Email this list</li>
			<li>Clear All</li>
			</ul>
          </div>-->
		 <?php $relatedproducts = Guide::model()->getrelatedproducts($model->user_id,'2'); 
					
			if(count($relatedproducts)){ ?>
		  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" id="column">
            <h5><strong>You might also like..</strong></h5>
			
			<?php
					  foreach($relatedproducts as $relatedproduct){
					     $relatedproduct->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$relatedproduct->user_id ));
			?>
			
            <p><strong><a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($relatedproduct->user_id))); ?>"><?php echo  $relatedproduct->guidemoredetails->guide_title; ?></a></strong></p>
			<div>
			<a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($relatedproduct->user_id))); ?>">
			<?php echo helpers::view_userimage($relatedproduct->user_image,'thumb',array("class"=>"left","style"=>'max-width:125px')); ?>
			</a>
			<div class="right"><div class="item-stars clearfix">  <?php echo Reviews::model()->show_average_stars('guide',$relatedproduct->user_id); ?></span>
			</div><p style="padding-top:20px;">From <strong><?php echo  helpers::to_currency($relatedproduct->guidemoredetails->guide_amount); ?></strong><br/>(<?php echo  $relatedproduct->guidemoredetails->guide_amount_option; ?>)</p></div>
			
			</div>
			<div class="rule"></div>
			
			<?php }  ?>
		
			<div class="right-align"><a href="<?php echo CHtml::normalizeUrl(array("list/guides/cid/".helpers::simple_encrypt($model->user_id))); ?>">See all related activites &raquo;</a></div>

          </div>
		  <?php }  ?>
		  <!--<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Locations</strong></h5>
            <ul>
              <li><a href="#">Madurai, TN, India</a></li>
              <li><a href="#">Tanjore, TN, India</a></li>
            </ul>
          </div>
		  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Similar Categories</strong></h5>
            <ul>
              <li><a href="#">Tamilnadu trips</a></li>
            </ul>
          </div>-->
        </div>
      </div>
    </div>
	
	<div class="wrapper">
	<div id="">
<!-- .rating-system -->


	<?php
		 if(Yii::app()->user->isGuest || helpers::isnormaluser()){
			 $reviews = new Reviews;
			 $reviews->review_itemtype = 'guide';
			 $reviews->review_itemid = $model->user_id;
			 $this->renderPartial('reviews', array('reviews'=>$reviews)); 
		 }
	 ?>	
	


<!--<div class="left">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/user.png"/>
</div>
<div style="margin-left:5px;">
<strong style="margin-left:5px;">Sunsree</strong><br>
<div class="item-stars clearfix left" style="margin-right:10px; margin-left:5px;"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div><br>
business is business. everywhere you have to believe or no result. God is inside us so know self and then tell the truth. our self is our own enemy in the world: comments must help to others not to spoil them. Ohm Nama Shivayah<br><br>
<span class="right">
3 &nbsp;<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/thumb.png" width="20px" onMouseOver="this.src='image/hup.png'" onMouseOut="this.src='image/thumb.png'" border="0" alt=""/></a>&nbsp;
0 &nbsp;<a href="#"><img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/unlike.png" width="20px;" onMouseOver="this.src='image/hdown.png'" onMouseOut="this.src='image/unlike.png'" border="0" alt=""/></a>
</span>

</div>-->
</div>


</div>
<script type="text/javascript">
jQuery(function(){
      jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/guide/id/'.$model->user_id); ?>');
	  jQuery('.photolistdiv').load('<?php echo CController::CreateUrl('//front/detail/photolist/type/guide/id/'.$model->user_id); ?>');

  
});
</script>