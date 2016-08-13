<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples - '.$model->temple_name,
);

$this->menu=array(
);
$data = $model;

?>
<style type="text/css">
.pp_content{  display:table; }
</style>
<div id="wrapper-row">
      <div id="content" role="main">
        <div id="primary">
          <h2 class="section-title"><a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($model->id))); ?>"><?php echo $model->temple_name; ?></a></h2>
          <div class="item-stars clearfix left" style="margin-right:10px;"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div>
          <div style="margin-top:-5px;"> <strong> 10 </strong> Customer reviews </div>
          <br>
          <div id='gallery-1' class='gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail'>
            <dl class='gallery-item'>
              <dt class='gallery-icon landscape'> <a href='<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($model->id))); ?>'> <img src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/<?php echo CHtml::encode($model->main_image); ?>" class="attachment-thumbnail" alt="<?php echo $model->temple_name; ?>" /></a> </dt>
              <dd class='wp-caption-text gallery-caption'> </dd>
            </dl>
            <br style='clear: both;' />
          </div>
          <div class="tab-font">
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />
             <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Information">
		<?php echo $model->temple_information; ?>
                
              </div>
              <div class="ait-tab tab-content" data-ait-tab-title="Pooja Timings">
			  <?php echo $model->temple_pooja_timings; ?>
              </div>
			  <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Offerings">
                  <?php echo $model->temple_offerings; ?>
              </div>
              <div class="ait-tab tab-content" data-ait-tab-title="Reviews">
                <h3>Reviews (1)</h3>
				<a style="background-color:#CB202D; color: #fff; font-size:13px; border-radius:3px; margin-top:-40px;" class="sc-button light right" href="review.html"><strong>Write a Review</strong></a>
                <br>
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
                  
                <div class="rule"></div>
                <div>
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/user.png" class="left">
                    <p style="color:#000;"><strong>"Excellent Driver and Excellent Tour Guide. Enjoyed the tour"</strong></p>
					<div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> <span>
                    </span> </div>
                  <p style="font-size:12px; margin-top:-20px;">Reviewed by <strong>a Temples Unlimited Customer from Ozamiz City, Philippines</strong> on May 7th, 2014 </p>
                  <p>Exceeded all expectations. Fantastic guide!!! Cannot speak highly enough. Best decision </p>
				  <div style="" class="summary">
            
                   <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Architecture</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star  last"></span> <span>
             
              </span> </div>
            <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Tourist friendly</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star "></span> <span class="star last"></span> <span>
              
              </span> </div>
            <div class="item-stars clearfix"  style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">cleanliness</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span> <span>
              
              </span> </div>
            <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">staffs</span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
              
              </span> </div>
            <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Darshan</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span> <span>
              
              </span> </div>
            
            
            
			  
          </div>
		  <p style="margin-top:20px;"><strong>Was this review helpful?</strong></p>
		  <div class="sc-column one-fourth"><input type="radio" name="radio"> Yes</div><div class="sc-column one-fourth"><input type="radio" name="radio"> No</div>
                </div>
                <div class="rule"></div>
                <div class="pagin" id="rev-pagin" style="float: right; margin-top: 16px; width: 40%;">
<div class="pagination">
    <ul>
    <li><a href="#">«</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
	<li><a href="#">..</a></li>
    <li><a href="#">»</a></li>
    </ul>
    </div>
	</div>
              </div>
			  <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Events">
               <?php echo $model->temple_events; ?>
              </div>
         	  <div class="ait-tab tab-content" data-ait-tab-title="Images">
                <h3 style="text-align:left">Image Gallery</h3>
				
				<div id='gallery-1' class='gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail'>
			
				
				
				
				<?php $galleries = $model->gallery; 
				if(count($galleries)){
				foreach($galleries as $gallery){?>
				<dl class='gallery-item sc-column one-fourth'>
			<dt class='gallery-icon landscape'>
				<a href='<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $gallery->image_path; ?>'><img width="150" height="150" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $gallery->image_thumb_path; ?>" class="attachment-thumbnail" alt="<?php echo $gallery->image_caption; ?>" /></a>
			</dt>
				<dd class='wp-caption-text gallery-caption'>
				<?php echo $gallery->image_caption; ?>
				</dd></dl>
				<?php } } ?>
				
			
				
		</div>
              </div>
        	  <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Map">
			  <?php echo $model->temple_map_content; ?>
			  <div class="rule"></div>
<div class="wrapper item-map clearfix" style="margin-top:20px;">
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
	<?php $address =  $model->temple_address.','.$data->city->name.','.$data->State->state_name;
	            $addresslatlng = helpers::getLatLong($address);	 
			 ?>
	<script>
			jQuery(document).ready(function($) {
		smallMapDiv = $(".item-map");

		smallMapDiv.width(500).height(400).gmap3({
			map: {
				options: {
					center: ["<?php echo $addresslatlng[0]; ?>", "<?php echo $addresslatlng[1]; ?>"],
					zoom: 10,
					scrollwheel: false
				}
			},
			marker: {
				values: [
					{
						latLng: ["<?php echo $addresslatlng[0]; ?>", "<?php echo $addresslatlng[1]; ?>"]
					}
				]
			}
		});
});
		</script>
          </div>
        </div>
        <!-- /#primary -->
        <div id="secondary" class="widget-area" role="complementary" style="font-size:12px;">
		
          <!--<div align="center" style="border-radius:5px; background:#FBFBFB; margin-bottom:15px; padding:10px;"> <a style="background-color:#CB202D; color: #fff; font-size:18px; margin:15px; border-radius:3px; width:180px;" class="sc-button light" href=""><strong>Book Now</strong></a> <br>
            <h5>From <strong>Rs.5000</strong></h5>
            <p>( Per group up to 1 ) </p>
          </div>-->
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Temple Details</strong></h5>
		  <div class="rule"></div>
            <ul class="style1">
              <li><strong>Also Known As :</strong> <?php echo $model->temple_other_names; ?></li>
              <li><strong>Phone number :</strong> <?php echo $model->temple_phone_number; ?></li>
			  <li><strong>Address : </strong> 	<?php echo $address; ?></li>
			  <li><strong>Timings : </strong><?php echo $model->temple_timings; ?></li>
			  <li><strong>Estimated Time Taken : </strong> <?php echo $model->estimated_time.' '.$model->estimated_timeopt; ?></li>
            </ul>
			<div class="rule"></div>
			<div class="right" style="margin-top:-15px;"><a href="review.html">Ask Queries &raquo;</a></div>
          </div>
          <!--<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>We Promise</strong></h5>
            <ul class="style1">
              <li>Speedy booking and reserved spots</li>
              <li>No-hassle Best Price Guarantee</li>
            </ul>
          </div>-->
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>10 Customer Reviews</strong></h5>
            <div class="rule"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">5 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> <span>
              <p> (2) </p>
              </span> </div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">4 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span> <span>
              <p> (0) </p>
              </span> </div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">3 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span> <span>
              <p> (0) </p>
              </span> </div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">2 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
              <p> (0) </p>
              </span> </div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">1 Star &nbsp;</span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
              <p> (0) </p>
              </span> </div>
			  
			  <div class="right" style="margin-top:-15px;"><a href="review.html">See all Reviews &raquo;</a></div>
          </div>
		  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" class="summary">
            <h5><strong>Rating Summary</strong></h5>
            <div class="rule"></div>
            
                   <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Architecture</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star  last"></span> <span>
             
              </span> </div>
            <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Tourist friendly</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star "></span> <span class="star last"></span> <span>
              
              </span> </div>
            <div class="item-stars clearfix"  style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">cleanliness</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span> <span>
              
              </span> </div>
            <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">staffs</span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
              
              </span> </div>
            <div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Darshan</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span> <span>
              
              </span> </div>
            
            
            
			  
          </div>
          
		  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>You might also like..</strong></h5>
            <p><strong>Oneday trip to Meenakshi Amman Temple</strong></p>
			<div>
			<img class="left" src="<?php echo Yii::app()->request->baseUrl; ?>/image/img-5_84.jpg">
			<div class="right"><div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span>
			</div><p style="padding-top:20px;">From <strong>Rs.5000</strong>( Per Group)</p></div>
			
			</div>
			<div class="rule"></div>
			<p><strong>Oneday trip to Meenakshi Amman Temple</strong></p>
			
			<img class="left" src="<?php echo Yii::app()->request->baseUrl; ?>/image/img-5_84.jpg">
			<div class="right"><div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span>
			</div><p style="padding-top:20px;">From <strong>Rs.5000</strong>( Per Group)</p></div>
			<div class="rule"></div>
			<a href="">See all related activites &raquo;</a>

          </div>
		  <!--<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Locations</strong></h5>
            <ul>
              <li><a href="#">Madurai, TN, India</a></li>
              <li><a href="#">Tanjore, TN, India</a></li>
            </ul>
          </div>-->
		  <!--<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Similar Categories</strong></h5>
            <ul>
              <li><a href="#">Tamilnadu trips</a></li>
            </ul>
          </div>-->
        </div>
      </div>
    </div>