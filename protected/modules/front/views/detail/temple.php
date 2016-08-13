<?php
$this->breadcrumbs=array(
	'Temples - '.$model->temple_name,
);

$this->menu=array(
);
$data = $model;

$reviews = new Reviews;
$type = 'temple';
$id= $data->id;



$reviewscount = Reviews::model()->get_average($type,$id);


$reviews = Reviews::model()->get_review_all($type,$id);

$avg_reviews =array();
for($i=0;$i<count($reviews);$i++)
{
array_push($avg_reviews,$reviews[$i]['review_rate']);
}
$avg_reviews = array_filter($avg_reviews);


if(count($avg_reviews)>0)	
$avg = array_sum($avg_reviews)/count($reviews);
else
$avg = '0';


$rv=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);
if(count($avg_reviews)>0)
{
foreach($reviews as $review)
{
if($review->review_rate==1)
$rv[1]=$rv[1]+1;
if($review->review_rate==2)
$rv[2]=$rv[2]+1;
if($review->review_rate==3)
$rv[3]=$rv[3]+1;
if($review->review_rate==4)
$rv[4]=$rv[4]+1;
if($review->review_rate==5)
$rv[5]=$rv[5]+1;
}



$rv_arch=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);


foreach($reviews as $review)
{
if($review->architecture_review_rate==1)
$rv_arch[1]=$rv_arch[1]+1;
if($review->architecture_review_rate==2)
$rv_arch[2]=$rv_arch[2]+2;
if($review->architecture_review_rate==3)
$rv_arch[3]=$rv_arch[3]+3;
if($review->architecture_review_rate==4)
$rv_arch[4]=$rv_arch[4]+4;
if($review->architecture_review_rate==5)
$rv_arch[5]=$rv_arch[5]+5;
}

$arch_count = array_sum($rv_arch) / count($reviews);
$arch_count=  round($arch_count);
}
?>				
<style type="text/css">
.pp_content{  display:table; }
#content {
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px;
    width: 1000px;
}
#page .ait-tabs .ui-tabs-nav li.ui-state-active a
{
font-size:13px !important;
}
</style>

<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/list/temples'); ?>">Temples </a><span style="color:#c1c1c1;">  &nbsp;>>&nbsp; </span><?php echo $model->temple_name; ?></h3>
</div>
</div>



<div id="wrapper-row">
      <div id="content" role="main">
        <div id="primary">
		
		<?php if(Yii::app()->user->hasFlash('queries')): ?>
		<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('queries'); ?>
		</div>
		<?php endif; ?>


          <h2 class="section-title"><a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($model->id))); ?>"><?php echo $model->temple_name; ?></a></h2>
          <div class="item-stars clearfix left" style="margin-right:10px;"> 	
			<span class="star <?php if($reviewscount>=1){  ?>active<?php } ?>"></span> 
			<span class="star <?php if($reviewscount>=2){  ?>active<?php } ?>"></span> 
			<span class="star <?php if($reviewscount>=3){  ?>active<?php } ?>"></span> 
			<span class="star <?php if($reviewscount>=4){  ?>active<?php } ?>"></span>
			<span class="star <?php if($reviewscount>=5){  ?>active<?php } ?> last"></span>
		</div>
          <div style="margin-top:-5px; float:left;"> <div style="width: auto; float:left;"><strong> <?php echo count($avg_reviews); ?> </strong> </div><div style="width:auto; float:left;"> &nbsp;Customer reviews </div></div>
          <br>
          <div id='gallery-1' >
            <dl class='gallery-item'>
              <dt class='gallery-icon landscape' style="">
			  <img src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/detail/<?php echo CHtml::encode($model->main_image); ?>"  alt="<?php echo $model->temple_name; ?>" style="height:450px; max-width:650px !important;" /></dt>
              <dd class='wp-caption-text gallery-caption'> </dd>
            </dl>
            <br style='clear: both;' />
          </div>
          <div class="tab-font">
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />
             <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Information" style="font-family:'ralewayregular'; max-width:650px;">
			 
			 
			 <h3 style="text-align:left">Overview</h3>
					<?php  echo $model->temple_description; ?>
					
					<br />
					<br />
				 <h3 style="text-align:left">Description</h3>
					<?php  echo  preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $model->temple_information);  ?>
					
					
					
					
              </div>
              <div class="ait-tab tab-content" data-ait-tab-title="Pooja Timings" style="font-family:'ralewayregular';">
			  <?php echo  preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $model->temple_pooja_timings);  ?>
              </div>
			  <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Offerings" style="font-family:'ralewayregular';">
                  <?php echo  preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $model->temple_offerings); ?>
              </div>
			  
			 
              <div class="ait-tab tab-content" data-ait-tab-title="Reviews" style="font-family:'ralewayregular';">
				<a style="background-color:#CB202D; color: #fff; font-size:13px; border-radius:3px;" class="sc-button light right" href="<?php echo CController::CreateUrl("review/addreviews/type/temple/id/".helpers::simple_encrypt($model->id)); ?>"><strong>Write a Review</strong></a>
           
                
               <div class="reviewlistdiv" style="font-family:'ralewayregular';"></div>
			   
	
				<script type="text/javascript">
				jQuery(function(){
				  jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/temple/id/'.$data->id); ?>');
				
				});		   
				</script>
                
              </div>
			  
			  <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Events" style="font-family:'ralewayregular';">
               <?php echo  preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $model->temple_events); ?>
              </div>
         	  <div class="ait-tab tab-content" data-ait-tab-title="Images" style="font-family:'ralewayregular';">
                <h3 style="text-align:left">Image Gallery</h3>
				
				<div id='gallery-1' class='gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail' style="width:107%;">
			
	<script>	
		$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});	
</script>

	
				
				<?php $galleries = $model->gallery; 
				if(count($galleries)>0){
				foreach($galleries as $gallery){?>
				<dl class='gallery-item sc-column one-fourth'>
			<dt class='gallery-icon landscape'>
							
     <a class="fancybox" rel="gallery1" href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $gallery->image_path; ?>" title="<?php echo $gallery->image_caption; ?>">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $gallery->image_path; ?>" alt=""   class="attachment-thumbnail" style="width:120px; height:100px; cursor:pointer;" />
</a>	
				
			</dt>
				<dd class='wp-caption-text gallery-caption' title="<?php echo $gallery->image_caption; ?>">
				<?php echo substr_replace($gallery->image_caption,'...',15); ?>
				</dd></dl>
				<?php } }else{ echo '&nbsp;No images found'; }; ?>

		</div>
              </div>
        	  <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Map" style="font-family:'ralewayregular'; font-size:13px;" >
			  <?php  echo preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $model->temple_map_content);  ?>
			  <div class="rule"></div>
                    <div style="height:auto;overflow:hidden;z-index:-999; margin-bottom:30px;">
                 <div id="googleMap" style="width: 500px; height:300px; "></div>
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
	<?php   if($model->city_id!='0') 
	$address =  $model->temple_address.','.$data->city->name.','.$data->State->state_name.', '.$data->Country->country.'.';
	else
	$address =  $model->temple_address.','.$data->State->state_name.', '.$data->Country->country.'.';

	           // $addresslatlng = helpers::getLatLong($address);	
			 ?>
	
          </div>
        </div>

        <div id="secondary" class="widget-area" role="complementary" style="font-size:12px;">
		
         
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
		  <h5><strong>Temple Details</strong></h5>
		  <div class="rule"></div>
            <ul class="style1">
              <li><strong>Also Known As :</strong> <?php echo $model->temple_other_names; ?></li>
			  <div style="height:13px; width:100%;"></div>
              <li><strong>Phone number :</strong> <?php echo $model->temple_phone_number; ?></li>
			  <div style="height:13px; width:100%;"></div>
			  <li><strong>Address : </strong> 	<?php echo $address; ?></li>
			  <div style="height:13px; width:100%;"></div>
			  <li><strong>Timings : </strong><?php echo $model->temple_timings; ?></li>
			  <div style="height:13px; width:100%;"></div>
			  <li><strong>Estimated Time Taken : </strong> <?php echo $model->estimated_time.' '.$model->estimated_timeopt; ?></li>
            </ul>
			<div class="rule"></div>
			<div class="right" style="margin-top:-25px;"><!--<a class="" style="cursor:pointer;" data-toggle="modal" data-target="#largeModal">Ask Queries &raquo;</a>-->
			<input type="button" value="Ask Queries &raquo;" name="submit" class="image_button"  data-toggle="modal" data-target="#largeModal"   >
			</div>
          </div>
		  

         
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong><?php echo count($avg_reviews); ?> Customer Reviews</strong></h5>
            <div class="rule"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">5 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> <span>
              <div style="width: auto; float:left; margin-left:5px;" class="review_test">&nbsp; ( <?php echo $rv[5]; ?>)</div>
              </span> </div>
			  <div style="height:20px; width:100%;"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">4 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span> <span>
             <div style="width: auto; float:left; margin-left:5px;" class="review_test"> &nbsp; ( <?php echo $rv[4]; ?> ) </div>
              </span> </div>
			  <div style="height:20px; width:100%;"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">3 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span> <span>
              <div style="width: auto; float:left; margin-left:5px;" class="review_test">&nbsp; ( <?php echo $rv[3]; ?> ) </div>
              </span> </div>
			  <div style="height:20px; width:100%;"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">2 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
              <div style="width: auto; float:left; margin-left:5px;" class="review_test"> &nbsp;( <?php echo $rv[2]; ?> )</div>
              </span> </div>
			  <div style="height:20px; width:100%;"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">1 Star &nbsp;</span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
            <div style="width: auto; float:left; margin-left:5px;" class="review_test"> &nbsp;( <?php echo $rv[1]; ?> )</div>
              </span> </div>
			  <div style="height:20px; width:100%;"></div>
			  
<style>

@media only screen and (min-width: 768px) and (max-width: 1600px){

.review_test
{
margin-top:-5px;
}
}
</style>	

<?php
if(count($avg_reviews)>0)
{
$rv_friendly=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);

foreach($reviews as $review)
{
if($review->friendly_review_rate==1)
$rv_friendly[1]=$rv_friendly[1]+1;
if($review->friendly_review_rate==2)
$rv_friendly[2]=$rv_friendly[2]+2;
if($review->friendly_review_rate==3)
$rv_friendly[3]=$rv_friendly[3]+3;
if($review->friendly_review_rate==4)
$rv_friendly[4]=$rv_friendly[4]+4;
if($review->friendly_review_rate==5)
$rv_friendly[5]=$rv_friendly[5]+5;
}
$rv_friendly_count = array_sum($rv_friendly) /count($reviews);
$rv_friendly_count=  round($rv_friendly_count);



$rv_cleanliness=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);

foreach($reviews as $review)
{
if($review->cleanliness_review_rate==1)
$rv_cleanliness[1]=$rv_cleanliness[1]+1;
if($review->cleanliness_review_rate==2)
$rv_cleanliness[2]=$rv_cleanliness[2]+2;
if($review->cleanliness_review_rate==3)
$rv_cleanliness[3]=$rv_cleanliness[3]+3;
if($review->cleanliness_review_rate==4)
$rv_cleanliness[4]=$rv_cleanliness[4]+4;
if($review->cleanliness_review_rate==5)
$rv_cleanliness[5]=$rv_cleanliness[5]+5;
}
$rv_cleanliness_count = array_sum($rv_cleanliness) /count($reviews);
$rv_cleanliness_count=  round($rv_cleanliness_count);




$rv_staff=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);

foreach($reviews as $review)
{
if($review->staffs_review_rate==1)
$rv_staff[1]=$rv_staff[1]+1;
if($review->staffs_review_rate==2)
$rv_staff[2]=$rv_staff[2]+2;
if($review->staffs_review_rate==3)
$rv_staff[3]=$rv_staff[3]+3;
if($review->staffs_review_rate==4)
$rv_staff[4]=$rv_staff[4]+4;
if($review->staffs_review_rate==5)
$rv_staff[5]=$rv_staff[5]+5;
}
$rv_staff_count = array_sum($rv_staff) /count($reviews);
$rv_staff_count=  round($rv_staff_count);



$rv_dharshan=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);

foreach($reviews as $review)
{
if($review->darshan_review_rate==1)
$rv_dharshan[1]=$rv_dharshan[1]+1;
if($review->darshan_review_rate==2)
$rv_dharshan[2]=$rv_dharshan[2]+2;
if($review->darshan_review_rate==3)
$rv_dharshan[3]=$rv_dharshan[3]+3;
if($review->darshan_review_rate==4)
$rv_dharshan[4]=$rv_dharshan[4]+4;
if($review->darshan_review_rate==5)
$rv_dharshan[5]=$rv_dharshan[5]+5;
}
$rv_dharshan_count = array_sum($rv_dharshan) /count($reviews);
$rv_dharshan_count=  round($rv_dharshan_count);
}
else
{
  $arch_count =  $rv_friendly_count =  $rv_cleanliness_count =  $rv_staff_count = $rv_dharshan_count =0;
}
?>		  
			  
			  
<?php $reviewscount = Reviews::model()->get_review_all('temple',$model->id); 
if(isset($reviewscount) && $reviewscount!='')
{
?>
<div class="right" style="margin-top:-15px;"><a href="javascript:void(0);" onclick="callfunction();">See all Reviews &raquo;</a></div>
<?php
}
?>

<script type="text/javascript">
function callfunction()
{
//alert('ds');
//setInterval(function(){ window.location.reload(); }, 750);
//$('#ait-tabs-641 ul li').removeClass('ui-tabs-active ui-state-active');
$('#ui-id-4').click();
//$('#ait-tabs-641 ul li:nth-child(4) a').tab('show');
//$('.ait-tab.tab-content').css('display','none');
//$('#tab-641-4').css('display','block');
return false;
}
</script>



					
					</div>
					
		
		  
		  
					<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" class="summary">
					<h5><strong>Rating Summary</strong></h5>
					<div class="rule"></div>
					<div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Architecture</span> 
					<span class="star <?php if($arch_count>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($arch_count>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($arch_count>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($arch_count>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($arch_count>=5){  ?>active<?php } ?> last"></span>
					<span></span>
					</div>
					
					<div style="height:13px; width:100%;"></div>
					<div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Tourist friendly</span> 
					<span class="star <?php if($rv_friendly_count>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_friendly_count>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_friendly_count>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_friendly_count>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($rv_friendly_count>=5){  ?>active<?php } ?> last"></span>
					<span></span>
					</div>
					
					
					<div style="height:13px; width:100%;"></div>
					<div class="item-stars clearfix"  style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">cleanliness</span>   
					<span class="star <?php if($rv_cleanliness_count>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_cleanliness_count>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_cleanliness_count>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_cleanliness_count>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($rv_cleanliness_count>=5){  ?>active<?php } ?> last"></span>
					<span></span>
					</div>
					
					<div style="height:13px; width:100%;"></div>
					<div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">staffs</span> 
					<span class="star <?php if($rv_staff_count>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_staff_count>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_staff_count>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_staff_count>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($rv_staff_count>=5){  ?>active<?php } ?> last"></span>
					<span></span>
					</div>
					
					<div style="height:13px; width:100%;"></div>
					<div class="item-stars clearfix" style="margin-top:10px;"><span style="float:left; margin-top:-5px; margin-right:10px; width:50%;">Darshan</span>  
					<span class="star <?php if($rv_dharshan_count>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_dharshan_count>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_dharshan_count>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($rv_dharshan_count>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($rv_dharshan_count>=5){  ?>active<?php } ?> last"></span>
					<span></span>
					</div>	
					
					<div style="height:13px; width:100%;"></div>	  
					</div>
<?php 
$criteria = new CDbCriteria();
$criteria->addCondition("id!=$model->id");
$criteria->limit = 3;
$temples = Temples::model()->findAll($criteria);
?>
 
 <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>You might also like..</strong></h5>
			
			<?php for($i=0;$i<count($temples);$i++) { 
			
			 $cities = Cities::model()->getall_byids($temples[$i]->city_id);
			 
			 
			 
				 $reviews1 = new Reviews;
				 $type1 = 'temple';
				 $id1= $temples[$i]->id;
				
				$reviews1222 = Reviews::model()->get_review_all($type1,$id1);
				
				$avg_reviews1 =array();
				
				for($j=0;$j<count($reviews1);$j++)
				{
				 array_push($avg_reviews1,$reviews1222[$j]['review_rate']);
				}
				$avg_reviews1 = array_filter($avg_reviews1);

				if(count($avg_reviews1)>0)	
				$avg1 = array_sum($avg_reviews1)/count($reviews1);
				else
				$avg1 = '0';
			?>
       <p><strong><a href='<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($temples[$i]->id))); ?>' style="color:#444444;"><?php echo $temples[$i]->temple_name ?></a></strong></p>
			<div>
			<a href='<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($temples[$i]->id))); ?>'><img class="left" src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/main_image/<?php echo CHtml::encode($temples[$i]->main_image); ?>"  height="84" width="84"></a>
			<div class="right"><div class="item-stars clearfix">
			         <span class="star <?php if($avg1>=1){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg1>=2){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg1>=3){  ?>active<?php } ?>"></span> 
					<span class="star <?php if($avg1>=4){  ?>active<?php } ?>"></span>
					<span class="star <?php if($avg1>=5){  ?>active<?php } ?> last"></span>
			</div><p style="padding-top:20px;">Location :<strong><?php  echo  '&nbsp;'.$cities[0]->name; ?></strong></p></div>
			
			</div>
			<div class="rule"></div>
			
			<?php } ?>
			
			<a href="<?php echo CController::CreateUrl('/front/list/temples'); ?>" style="float:right;margin-top:-15px;" >See all &raquo;&nbsp;&nbsp;&nbsp;</a>

          </div>
		  


        </div>
      </div>
    </div>
	
		<style>
		.mainpage img, .textwidget img, .entry-content img, .advertising-box img
		{
		max-width: 10000% !important;
		}
		</style>
	
		<script>
		$(document).ready(function() {
		$('a[href="#tab-641-7"]').click(function(e) {
		setTimeout(initialize, 5);
		});
		});
		
		
		function initialize()
		{
		var myLatlng = new google.maps.LatLng(<?php echo $model->latitude; ?>,<?php echo $model->logtitute; ?>);
		var mapOptions = {
		zoom: 7,
		center: myLatlng
		}
		
		var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
		
		var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: '<?php echo $model->temple_name; ?>'
		});
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		


<?php

if(isset($user->first_name))
{
$name_user = $user->first_name.' '.$user->last_name;
$function22222 ='readonly="readonly"';
}
else
{
 $name_user ='';
$function22222='';
}




if(isset($user->email))
{
$email_user =   $user->email;
}
else
{
$email_user =  '';
}

$user_basic = User::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

if($user_basic->role=='2')
{
  $userdetails = Userdetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); 
  $phone_no =   $userdetails->phone;
}
else if($user_basic->role=='3')
{
  $userdetails = Guide::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); 
  $phone_no =   $userdetails->guide_phone;  
}
else if($user_basic->role=='4')
{
  $userdetails = Iyer::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); 
  $phone_no =   $userdetails->iyer_phone;     
}
 else 
{
  $phone_no = '';    
}

?> 
	
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<input type="button" class="close"  data-dismiss="modal" aria-hidden="true"  value="&times" style="color:#000000;"/>
<h4 class="modal-title" id="myModalLabel">Ask a Queries about this Temple</h4>
</div>
<div class="modal-body">
<div class="form" style="width:85%; margin-left:5%;">
<form method="post" action="<?php echo CHtml::normalizeUrl(array("detail/queries")); ?>" id="qurey-form"  class="wpcf7-form">
<input type="hidden" name="id" value="<?php echo $model->id; ?>" id="id" />
<input type="hidden" name="type" value="temple" id="type" />

<input type="hidden" name="temple_name" value="<?php echo $model->temple_name; ?>" id="temple_name" />
<p>
</p>
<div class="row">
<label class="required" for="Contact_name">Name <span class="required">*</span></label>
<input type="text" maxlength="250" id="Contact_name" name="Contact_name" placeholder="Enter Name" value="<?php echo $name_user; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test"  <?php echo $function22222; ?>>
</div>
<p></p>
<p>
</p><div class="row">
<label class="required" for="Contact_email">Email <span class="required">*</span></label>
<input type="text" maxlength="250" id="Contact_email" name="Contact_email" placeholder="Enter Email"  value="<?php echo $email_user; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test" <?php echo $function22222; ?> >
</div>
<p></p>
<p>
</p><div class="row">
<label class="required" for="Contact_subject">Phone Number </label>		
<input type="text"  id="Contact_phone" name="Contact_phone" value="<?php echo $phone_no; ?>" placeholder="Enter Phone Number" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test" maxlength="10"> </div>
<p></p>
<p>
</p>
<div class="row">
<label class="required" for="Contact_message">Message <span class="required">*</span></label>		
<textarea id="Contact_message" name="Contact_message" rows="5" cols="20" placeholder="Enter Question" class="text_area" style=" min-width:90%; max-width:90%;margin-left:-0px;" ></textarea>
</div>

<p></p>
<div class="row buttons" style="margin-right:40px;">
<input type="submit" value="Send Message" name="submit" class="submit_test"  >
</div>
</form>
</div>
</div>
</div>
</div>
</div>



<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>

<script type="text/javascript">
jQuery('#qurey-form').validate({
rules : {
Contact_name :{required:true},
Contact_email : {required: true, email:true},
Contact_phone : {number: true},
Contact_message : {required: true},
},
messages : {
Contact_name : 'Enter Username',
Contact_email : 'Enter valid email',
Contact_phone : 'Enter valid Phone number',
Contact_message : 'Enter message',
}
});
</script>

<style type="text/css">
.error
{
color:#FF0000;
font-weight: normal;
}
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

#content {
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px !important;
    width: 1000px;
}

.ui-widget{
    font-family:"ralewayregular" !important;
}
.input_test
{
background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;
}
.submit_test
{
 background: none repeat scroll 0 0 #333333;
    border: medium none;
    color: #ffffff;
    cursor: pointer;
    display: inline;
    float: right;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    margin: 0;
    width: auto;padding: 10px 8px;
}
.text_area
{
    background: none repeat scroll 0 0 #ffffff;
	border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:95%;
	margin-left:14px;
}
.flash-success
{
    background-color: #fcefd4;
    border: 1px solid #fae1c6;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	background-color: #caeecf;
    border-color: #b7e8b6;
    color: #38b44a;
}
#page .ui-icon {
    display: block !important;
}
#fancybox-img
{
 max-height:800px !important;
 max-width:1200px !important;
}

*:before, *:after {
}
*:before, *:after {
}
.modal-header .close {
    margin-top: -2px;
}
button.close {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 0 none;
    cursor: pointer;
    padding: 0;
}
.close {
    color: #000;
    float: right;
    font-size: 42px;
    line-height: 1;
    opacity: 1;
    text-shadow: 0 1px 0 #fff;
}

input[type="button"], input[type="button"]:hover {
			background: -moz-linear-gradient(top, #FFFFFF 0%, #FFFFFF 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFFFFF), color-stop(100%,#FFFFFF)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #FFFFFF 0%,#FFFFFF 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #FFFFFF 0%,#FFFFFF 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top, #FFFFFF 0%,#FFFFFF 100%); /* IE10+ */
			background: linear-gradient(top, #FFFFFF 0%,#d5e7f3 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFFFF', endColorstr='#FFFFFF',GradientType=0 ); /* IE6-9 */
    border: 1px solid #FFFFFF;
    color: #cb202d;
    cursor: pointer;
    left: -6px;
    position: relative;
}
</style>
