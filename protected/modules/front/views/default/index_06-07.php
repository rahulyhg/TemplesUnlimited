<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.plugins.min.js'></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/jquery.feedBackBox.css" rel="stylesheet" type="text/css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/jquery.feedBackBox.js"></script>
 <div id="RahuKaalam"></div>
  
<style>
.tp-simpleresponsive > ul li {
    list-style: outside none none;
    position: relative;
    visibility: hidden;
}

@media (min-width: 768px) and (max-width: 979px) {
.tp-caption.lfl.start
{

left:35% !important;
width:37%; 
}
}


@media only screen and (min-width: 768px) {
.tp-caption.lfl.start
{

left:35% !important;
width:37%; 
}
}

@media (max-width: 480px) {
.tp-caption.lfl.start
{

left:15% !important;
width:63%; 
}
}

.mainpage h2, .entry-content h2, .page-footer h2 {
    font-size: 16px;
    line-height: 1.3;
    margin: 0 0 16px;
	color:#FFFFFF;
}

</style>
  
  <div class="map-holder">
  <div id="directory-main-bar" data-category="0" data-location="0" data-search="" data-geolocation="false">
    <!-- START REVOLUTION SLIDER 2.2.3 -->
    <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container jcarousel" style="margin:0px;background-color:#E9E9E9;padding:0px;margin-top:0px;margin-bottom:0px;min-height:586px;" >
      <div id="rev_slider_1_1"  class="rev_slider fullwidthabanner" style="display:none;max-height:586px;height:586px;" >
    
		<ul>
          <li tabindex="1" data-transition="fade" data-slotamount="7" data-masterspeed="0" class="first-flip"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/img6.jpg" data-fullwidthcentering="true">
		 

		
			<div class="tp-caption lfl clearfix"  
			data-x="0" 
			data-y="50" 
			data-speed="0" 
			data-start="0"
			data-easing="easeOutExpo" >
			
			
			<div  class="homepage-search" style="height:210px;" >			 
			<div class="search-header"><span  style="font-weight:Bold; color:#FFFFFF; margin-top:10px;" class="header_fortab">Find Your Temple</span></div>
		
		    <div  style="width:100%; margin-top:35px;" >

					<form class="form-inline" method="post" action="<?php echo $this->createUrl('/temples'); ?>">
					
					<div>
					<div style="width:33.33%; float:left; text-align:center;"  class="first_slide"><center>
					<div style=" background:#FFFFFF; text-align:center;  border-radius:5px; height: auto; width:70%" class="styleforwidth">
			<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/temple_y1.png"><span style="color:#000000;font-weight:bold; cursor:pointer; vertical-align:middle; " class="test123">&nbsp;Temple</span>
					</div></center>
					</div>
					
					<div style="width:33.33%;float:left;text-align:center;"  class="second_slide"><center>
					<div style=" text-align:center;  border-radius:5px; height: auto; width:70% " class="styleforwidth">
		<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/iyer_w1.png"><span style="color:#fff;font-weight:bold; cursor:pointer; vertical-align:middle;  " class="test123">&nbsp;Book Iyer</span>
					</div></center> 
					</div>
					
					
					<div  style="width:33.33%; text-align:center; float:left;"  class="third_slide"><center>
					<div style="  text-align:center;  border-radius:5px; height: auto; width:70% "  class="styleforwidth">
		<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/i_w1.png"><span style="color:#fff;font-weight:bold; cursor:pointer;  vertical-align:middle; " class="test123">&nbsp;Book Guide</span>
					</div></center>
					</div>
					
					</div>


<div class="clearfix"></div>

<div style=" margin-top:30px; margin-bottom:30px;">
<input type="text" id="temple_name" name="title" placeholder="Enter Temple or Deity Name..."  style=" width:87%;margin-left:5%; height:36px; text-align: left; padding-left:6px; " class="filteritem12345 ">
<input type="submit"  class="dir-go test" value="Go"  style="height:42px; width:43px;"  onClick="return checkempty('1');" >

</div>
		     </form>

		</div>
		
		   </div>
		   </div>

          </li>

          <li tabindex="2" data-transition="fade" data-slotamount="7" data-masterspeed="0" class="second-flip" > <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/img5.jpg" data-fullwidthcentering="true">
            
			
			<div class="tp-caption lfl clearfix"  
			data-x="0" 
			data-y="50" 
			data-speed="0" 
			data-start="0"
			data-easing="easeOutExpo" >
			
            <div  class="homepage-search" style="height:210px;" >			 
			<div class="search-header"><span  style="font-weight:Bold; color:#FFFFFF; margin-top:10px;" class="header_fortab">Find Your Iyer</span></div>
		
		    <div  style="width:100%; margin-top:35px;" >

					<form class="form-inline" method="get" action="<?php echo $this->createUrl('/iyernew'); ?>">
					
					<div>
					<div style="width:33.33%; float:left; text-align:center;"  class="first_slide"><center>
					<div style=" text-align:center;  border-radius:5px; height: auto; width:70% " class="styleforwidth">
	<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/temple_w12.png"><span style="font-weight:bold; cursor:pointer; vertical-align:middle; color:#fff; " class="test123">&nbsp;Temple</span>
					</div></center>
					</div>
					
					<div style="width:33.33%;float:left;text-align:center;"  class="second_slide"><center>
					<div style=" background:#FFFFFF; text-align:center;  border-radius:5px; height: auto; width:70%" class="styleforwidth">
	<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/iyer_y1.png"><span style="color:#000;font-weight:bold; cursor:pointer; vertical-align:middle; " class="test123">&nbsp;Book Iyer</span>
					</div></center> 
					</div>
					
					
					<div  style="width:33.33%; text-align:center; float:left;"  class="third_slide" ><center>
					<div style="  text-align:center;  border-radius:5px; height: auto; width:70%" class="styleforwidth">
<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/i_w1.png"><span style="color:#fff;font-weight:bold; cursor:pointer;  vertical-align:middle; color: #fff; " class="test123">&nbsp;Book Guide</span>
					</div></center>
					</div>
					
					</div>


<div class="clearfix"></div>

<div style=" margin-top:30px; margin-bottom:30px;">
<input type="text"  name="title"  id="iyer_name" placeholder="Enter Iyer or Pooja Name..."  style=" width:87%;margin-left:5%; height:36px; text-align: left; padding-left:6px; "  class="filteritem12345 ">
<input type="submit"  class="dir-go test" value="Go"  style="height:42px; width:43px;"  onClick="return checkempty('2');" >
 
 

    
</div>

		     </form>
		
	
		</div>
		
		   </div>
		   </div>
            
            
            
          </li>
         
          <li tabindex="3" data-transition="fade" data-slotamount="7" data-masterspeed="0"  class="third-flip"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/img2.jpg" data-fullwidthcentering="true">
            
             <div class="tp-caption lfl clearfix"  
			data-x="0" 
			data-y="50" 
			data-speed="0" 
			data-start="0"
			data-easing="easeOutExpo" >
			
            <div  class="homepage-search" style="height:210px;" >			 
			<div class="search-header"><span  style="font-weight:Bold; color:#FFFFFF; margin-top:10px;" class="header_fortab">Find Your Guide</span></div>
		
		    <div  style="width:100%; margin-top:35px;" >

					<form class="form-inline" method="get" action="<?php echo $this->createUrl('/guide'); ?>">
					
					<div>
					<div style="width:33.33%; float:left; text-align:center;"  class="first_slide"><center>
					<div style=" text-align:center;  border-radius:5px; height: auto; width:70% " class="styleforwidth">
					<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/temple_w12.png"><span style="font-weight:bold; cursor:pointer; vertical-align:middle; color:#fff; " class="test123">&nbsp;Temple</span>
					</div></center>
					</div>
					
					<div style="width:33.33%;float:left;text-align:center;"  class="second_slide"><center>
					<div style="text-align:center;  border-radius:5px; height: auto; width:70% " class="styleforwidth">
					<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/iyer_w1.png"><span style="color:#fff;font-weight:bold; cursor:pointer; vertical-align:middle;" class="test123">&nbsp;Book Iyer</span>
					</div></center> 
					</div>
					
					
					<div  style="width:33.33%; text-align:center; float:left;"  class="third_slide"><center> 
					<div style=" background:#FFFFFF;   text-align:center;  border-radius:5px; height: auto; width:70% " class="styleforwidth">
		<img  src="<?php echo Yii::app()->request->baseUrl; ?>/image/i_y1.png"><span style="color:#000;font-weight:bold; cursor:pointer;  vertical-align:middle; " class="test123">&nbsp;Book Guide</span>
					</div></center>
					</div>
					
					</div>


<div class="clearfix"></div>

<div style=" margin-top:30px; margin-bottom:30px;">
<input type="text" name="title" id="guide_name" placeholder="Enter Destination or Guide Name"  style=" width:87%;margin-left:5%; height:36px; text-align: left; padding-left:6px; " class="filteritem12345 ">
<input type="submit"  class="dir-go test" value="Go" style="height:42px; width:43px;"  onClick="return checkempty('3');">
 
 

    
</div>

		     </form>
		
	
		</div>
		
		   </div>
		   </div>
           
          </li>
        
        </ul>
      </div>
    </div>
	
	<script>
	
		function checkempty(value)
		{
			var  temple_name =  $("#temple_name").val(); 
			var  iyer_name =  $("#iyer_name").val(); 
			var  guide_name =  $("#guide_name").val();
			
			if(value=='1' && ((temple_name=='') || (temple_name=='Enter Temple or Deity Name...')))
			{
			$("#temple_name").css("background-color","#fbd9d9");
			$("#temple_name").css("border","2px solid red"); 
			return false;
			}
			else if(value=='2' && ((iyer_name=='') || (iyer_name=='Enter Iyer or Pooja Name...')))
			{
			$("#iyer_name").css("background-color","#fbd9d9");
			$("#iyer_name").css("border","2px solid red");
			return false; 
			}
			else if(value=='3' && ((guide_name=='') || (guide_name=='Enter Destination or Guide Name')))
			{
			$("#guide_name").css("background-color","#fbd9d9");
			$("#guide_name").css("border","2px solid red"); 
			return false;
			}
			else
			{
			return true;
			}
		}
	
		  
		  $('#temple_name').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : '<?php echo $this->createUrl('auto/templesgod'); ?>',
					dataType: "json",
					data: {
					   name_startsWith: request.term,
					},
					 success: function( data ) {
						 response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0      	
		  });	
		  
		  
		  $('#iyer_name').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : '<?php echo $this->createUrl('auto/iyermain'); ?>',
					dataType: "json",
					data: {
					   name_startsWith: request.term,
					},
					 success: function( data ) {
						 response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0      	
		  });	
		  
		  
		  $('#guide_name').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : '<?php echo $this->createUrl('auto/guidemain'); ?>',
					dataType: "json",
					data: {
					   name_startsWith: request.term,
					},
					 success: function( data ) {
						 response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0      	
		  });		
	</script>	
    

    <!-- END REVOLUTION SLIDER -->
  </div>
</div>



   <?php   $socail = Social::model()->findAll();  ?>
<?php if(Yii::app()->controller->action->id =='index' ){  ?>
  
<div class="sc-column sc-column-last one-half-last" style="width: 100%; margin-top: -6px;" >
        <div class="social-icons contact-info right" align="center" style="width:100%;" >
	<a href="<?php echo $socail[0]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/facebook-ff.png"  alt="Facebook"> </a> 
	<a href="<?php echo $socail[1]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/pinterest-ff.png" alt="Pinterest."></a> 
	<a href="<?php echo $socail[2]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/twitter-ff.png" alt="Twitter"></a> 
	<a href="<?php echo $socail[3]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/flickr-ff.png" alt="Flickr"></div></a> 
      </div>
	  
	  <?php }  ?>
<style>
@media (min-width: 768px) and (max-width: 979px) {
#welcome-image
{
font-size:16px;
}
}


@media only screen and (min-width: 768px) {
#welcome-image
{
font-size:16px;
}
}

@media (max-width: 480px) {
#welcome-image
{
font-size:11px;
}
}

.onecolumn .sc-column.one-fourth, .onecolumn .sc-column.one-fourth-last {
  width: 198px;
}
</style>


<style>
.slider-wrap {
position: relative;
height:290px;
margin-top:20px;
overflow:hidden;
}
.slider ul li {
text-align: center;
width:300px;
}
.slider-arrow {
position: absolute;
top: 40px;
width: 20px;
height: 20px;
background: #318EA2;
color: #fff;
text-align: center;
text-decoration: none;
border-radius: 50%;
}
.sa-left {
left: 10px;
}
.sa-right {
right: 10px;
}
.nav-tabs.nav-stacked > li > a {
    border: 1px solid #000 !important; 
    border-radius: 0;
	color:#cb202d;
	font-family:"ralewayextrabold" !important;
	font-size:14px;
}



.mainpage a,.textwidget a
{
color:#222222;-webkit-transition:color 1s;-moz-transition:color 1s;-ms-transition:color 1s;-o-transition:color 1s;transition:color 1s;text-decoration:none;
}
.active
{
color:#000000;
}


::-webkit-input-placeholder {
   color: #000000;
}

:-moz-placeholder { /* Firefox 18- */
   color: #000000;  
}

::-moz-placeholder {  /* Firefox 19+ */
   color: #000000;  
}

:-ms-input-placeholder {  
   color: #000000;  
}


#directory-search .dir-searchsubmit {
    background: none repeat scroll 0 0 #cb202d;
    border-bottom: 0px solid #cb2056;
    color: #000000;
}

</style>	

<div id="wrapper-row">
<div class="section-best-places">
<div class="wrapper">
<h3 class="section-title">Recent Temples</h3>

<div class="best-places-wrap">
<ul class="items-grid-view clearfix onecolumn">

<?php  
    $criteriatemples = new CDbCriteria();
	$criteriatemples->order = 'id DESC';
	$criteriatemples->limit = 5;
	$criteriatemples->select='main_image,temple_name,id';
	$RecentTemples = Temples::model()->findAll($criteriatemples);
?>
<div class="slider-wrap">
<div class="slider">
<ul>
<?php
for($i=0;$i<count($RecentTemples);$i++)
{
?>
<li> 

<div class="item-thumbnail" style="width:310px; height:240px;vertical-align:middle;display:table-cell;text-align:center;"> 
<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($RecentTemples[$i]->id))); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/slider/<?php echo $RecentTemples[$i]->main_image;  ?>" alt="Item thumbnail"  style="padding-left:10px;"/></a>
</div>
<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($RecentTemples[$i]->id))); ?>"><h3 class="item-title" id="welcome-image"><?php echo $RecentTemples[$i]->temple_name;  ?></h3 ></a>


</li>
<?php } ?>
</ul>
</div>
<a href="#" style="display:none;" class="slider-arrow sa-left">&lt;</a> <a href="#"  style="display:none;"  class="slider-arrow sa-right">&gt;</a> </div>
<div class="clearfix"></div>
</ul>
</div>
</div>
</div>
</div>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lbslider.js"></script> 	

<script>
jQuery('.slider').lbSlider({
leftBtn: '.sa-left',
rightBtn: '.sa-right',
visible: 3,
autoPlay: true,
autoPlayDelay: 2
});

</script>
  
<?php
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

  



<style>
@media (min-width: 768px) and (max-width: 979px) {
.filteritem12345
{
 width:40%;
}

}


@media only screen and (min-width: 768px) {
.filteritem12345
{
 width:40%;
}

}

@media (max-width: 480px) {
.filteritem12345
{
 width:51%;
}
}
</style>


<div class="wrapper tab-font">
    <h3 class="section-title">Recent User Reviews</h3>
    <div class="ait-tabs" id="ait-tabs-641">
      <ul>
      </ul>
      <br />
<div class="ait-tab tab-content" data-ait-tab-title="Temple Reviews">	  
<?php
$criteria1 = new CDbCriteria();
$condition = ' review_itemtype ="temple" ';
$criteria1->condition = $condition;
$criteria1->order = 'review_id DESC';
$criteria1->limit = 3;
$reviews = Reviews::model()->findAll($criteria1);

if(count($reviews)>0)
{
for($i=0;$i<count($reviews);$i++) 
{ 
$temple1 = Temples::model()->getinfo($reviews[$i]->review_itemid);
$user1 = User::model()->getinfo($reviews[$i]->review_by);
$date1 = explode('-',$reviews[$i]->review_date);
$date1timere1 = explode(' ',$date1[2]); 
$monthName1 = date('F', mktime(0, 0, 0, $date1[1], 10)); 
$temple_review1 =   $monthName1."&nbsp;&nbsp;".$date1timere1[0].",&nbsp;&nbsp;".$date1[0];
?>         
<div class="sc-column one-third" style="border-right:2px solid #f9f9f9; margin-right:25px; ">
<div class="item-content-wrapper clearfix left" style="margin-top:10px; margin-bottom:10px; width:100%">
<div class="item-thumbnail left" style="width:25%"> <a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($temple1->id)."#tab-641-4")); ?>"><img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/review/<?php echo CHtml::encode($temple1->main_image); ?>"  ></a> </div>
<div class="item-description left" style="width:75%">
<h5 class="item-title" style="font-weight:bold; margin-left:10px;"><a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($temple1->id)."#tab-641-4")); ?>"><?php echo $temple1->temple_name; ?></a></h5>
<div class="entry-meta clearfix" style="margin-top:20px;"> 
<a  class="date meta-info" title="<?php echo $temple_review1; ?>" rel="bookmark"><?php echo $temple_review1; ?></a> 
</div>
</div>
</div> 

<div style="width:100%; ">	
<div class="item-content-wrapper clearfix left" style="margin-top:10px; margin-bottom:10px;">
<div style="float:left; width:25%;">
<div style="display:table-cell; vertical-align:middle; text-align:center; height:80px; width:70px; "  align="center">
<?php echo helpers::view_userimage($user1->user_image,'thumb',array('style'=>'width:40px;border-radius:50px;')); ?>
</div>
</div>
<div class="item-description left" style="width:71%; margin-left:4%;">
<span><?php echo $user1->first_name." ".$user1->last_name; ?></span><br />
<blockquote>
<p><?php echo  substr_replace($reviews[0]->review_content,'...',80); ?></p>
</blockquote>
</div>
<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($temple1->id)."#tab-641-4")); ?>" class="right" style="padding-right:5px; color:#cb202d; font-size:13px; ">View More &raquo;</a> 
</div>
</div>
</div>
<?php } }else { echo "No Reviews Found"; } ?>
</div>
<br />

<div class="ait-tab tab-content" data-ait-tab-title="Iyer Reviews">


<?php
$criteria1 = new CDbCriteria();
$condition1 = '  review_itemtype ="iyer" ';
$criteria1->condition = $condition1;
$criteria1->order = 'review_id DESC';
$criteria1->limit = 3;
$reviews1 = Reviews::model()->findAll($criteria1);
if(count($reviews1)>0)
{
for($j=0;$j<count($reviews1);$j++)
{
$iyer11 = User::model()->getinfo($reviews1[$j]->review_itemid);
$user11 = User::model()->getinfo($reviews1[$j]->review_by);
$date11 = explode('-',$reviews1[$j]->review_date);
$date1timere11 = explode(' ',$date11[2]);
$monthName11 = date('F', mktime(0, 0, 0, $date11[1], 10)); 
$iyer_review1 =  $monthName11."&nbsp;&nbsp;".$date1timere11[0].",&nbsp;&nbsp;".$date11[0];

if($iyer11->user_image!='')
$imageiyer1 = explode('/',$iyer11->user_image);
?>	
<div class="sc-column one-third" style="border-right:2px solid #f9f9f9; margin-right:25px; ">
<div class="item-content-wrapper clearfix left" style="margin-top:10px; margin-bottom:10px; width:100%">
<div class="item-thumbnail left" style="width:25%"> <a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($iyer11->user_id)."#tab-641-2")); ?>">
<?php 	if($iyer11->user_image!='') {?>
<img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/users/review/<?php echo $imageiyer1[2]; ?>"  >
<?php }else { ?>
<?php echo helpers::view_userimage($iyer11->user_image,'thumb'); ?> 
<?php } ?>
</a> </div>
<div class="item-description left" style="width:75%">
<h5 class="item-title" style="font-weight:bold; margin-left:10px;"><a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($iyer11->user_id)."#tab-641-2")); ?>"><?php echo $iyer11->first_name.' '.$iyer11->last_name; ?></a></h5>
<div class="entry-meta clearfix" style="margin-top:20px;"> 
<a class="date meta-info" title="<?php echo $iyer_review1; ?>" rel="bookmark"><?php echo $iyer_review1; ?></a> 
</div>
</div>
</div> 
   
<div style="width:100%; ">	
<div class="item-content-wrapper clearfix left" style="margin-top:10px; margin-bottom:10px;">
<div style="float:left; width:25%;">
<div style="display:table-cell; vertical-align:middle; text-align:center; height:80px; width:70px; "  align="center">
<?php  echo helpers::view_userimage($user11->user_image,'thumb',array('style'=>'width:40px;border-radius:50px;')); ?>
</div>
</div>
<div class="item-description left" style="width:71%; margin-left:4%;">
<span><?php  echo $user11->first_name.'   '.$user11->last_name; ?></span><br />
<blockquote>
<p><?php echo  substr_replace($reviews1[0]->review_content,'...',80); ?></p>
</blockquote>
</div>
<a href="<?php  echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($iyer11->user_id)."#tab-641-2")); ?>" class="right" style="padding-right:5px; color:#cb202d; font-size:13px; ">View More &raquo;</a> 
</div>
</div>
</div>
<?php } }else {echo "No Reviews Found"; } ?>
</div>

<br />

<div class="ait-tab tab-content" data-ait-tab-title="Guide Reviews">
	  
	  <?php

	$criteria2 = new CDbCriteria();
	
	$condition2= '  review_itemtype ="guide" ';
	$criteria2->condition = $condition2;
	
	$criteria2->order = 'review_id DESC';
$criteria2->limit = 3;
	
	$reviews2 = Reviews::model()->findAll($criteria2);
        
    if(count($reviews2)>0)
    {
        for($k=0;$k<count($reviews2 );$k++)
        {
	$guide31 = User::model()->getinfo($reviews2[$k]->review_itemid);
	$user13 = User::model()->getinfo($reviews2[$k]->review_by);
	$date12 = explode('-',$reviews1[0]->review_date);
	$date1timere12 = explode(' ',$date12[2]);
	$monthName12 = date('F', mktime(0, 0, 0, $date12[1], 10)); 
	$guide_review1 = $monthName12."&nbsp;&nbsp;".$date1timere12[0].",&nbsp;&nbsp;".$date12[0];
	if($guide31->user_image!='')
	$imageguide1 = explode('/',$guide31->user_image);
?>
<div class="sc-column one-third" style="border-right:2px solid #f9f9f9;  margin-right:25px">
<div class="item-content-wrapper clearfix left" style="margin-top:10px; margin-bottom:10px; width:100%">
<div class="item-thumbnail left" style="width:25%"> <a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($guide31->user_id)."#tab-641-2")); ?>">
<?php 	if($guide31->user_image!='') {?>
<img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/users/review/<?php echo $imageguide1[2]; ?>"  >
<?php }else { ?>
<?php echo helpers::view_userimage($guide31->user_image,'thumb'); ?> 
<?php } ?>
</a> </div>
<div class="item-description left" style="width:75%">
<h5 class="item-title" style="font-weight:bold; margin-left:10px;"><a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($guide31->user_id)."#tab-641-2")); ?>"><?php echo $guide31->first_name.' '.$guide31->last_name; ?></a></h5>
<div class="entry-meta clearfix" style="margin-top:20px;"> 
<a  class="date meta-info" title="<?php echo $guide_review1; ?>" rel="bookmark"><?php echo $guide_review1; ?></a> 
</div>
</div>
 </div>
    
<div style="width:100%; ">	
<div class="item-content-wrapper clearfix left" style="margin-top:10px; margin-bottom:10px;">
<div style="float:left; width:25%;">
<div style="display:table-cell; vertical-align:middle; text-align:center; height:80px; width:70px; "  align="center">
<?php echo helpers::view_userimage($user13->user_image,'thumb',array('style'=>'width:40px;border-radius:50px;')); ?>
</div>
</div>
<div class="item-description left" style="width:71%; margin-left:4%;">
<span><?php  echo $user13->first_name.'  '.$user13->last_name; ?></span><br />
<blockquote>
<p><?php echo  substr_replace($reviews2[0]->review_content,'...',80); ?></p>
</blockquote>
</div>
<a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt($guide31->user_id)."#tab-641-2")); ?>" class="right" style="padding-right:5px; color:#cb202d; font-size:13px; ">View More &raquo;</a> 
</div>
</div>
</div>
<?php } } else { echo "No Reviews Found";  } ?> 
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



<div id="subcats-holder no-margin" style="margin:30px;">
<div class="wrapper ">
<h3 class="section-title">Featured Listing</h3>
	 
	 
<div class="one-half" style="width:68%;float: right;height:50px; margin:20px;">
<input type="text" placeholder="Search City..."  style="margin-left:18px; height:36px; text-align: left; padding-left:6px; " id="city" name="city" class="filteritem12345 ">
<input type="submit"  class="dir-go test" value="Go"   onclick="filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >

<span id="directory-search" class="dir-searchsubmit">
<input type="hidden" name="all" value="all" id="all" class="temp_all" />
<input type="submit" style="margin-left:4px;  font-size:14px; background-color:#cb202d;font-weight:bold;color:#ffffff; height:40px; width:20%;"  class="dir-searchsubmit" value="All City" onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
</span>


<script>


$('#city').autocomplete({
source: function( request, response ) {
$.ajax({
url : '<?php echo $this->createUrl('default/cityauto'); ?>',
dataType: "json",
data: {
name_startsWith: request.term,
},
success: function( data ) {
response( $.map( data, function( item ) {
return {
label: item,
value: item
}
}));
}
});
},
autoFocus: true,
minLength: 0      	
});	
		  
		  
function filterlist2(url)
{
var city =  $('#city').val();

if((city=='') || (city=='Search City...'))
{
$("#city").css("background-color","#fbd9d9");
$("#city").css("border","2px solid red"); 
}
else
{
$.post(url, $('.filteritem12345').serialize(), function(data)
{
$('#featured_listing').html(data);
});
}
}

function filterlist(url)
{
$.post(url, $('.temp_all').serialize(), function(data)
{
$('#featured_listing').html(data);
});
}
</script>

<style>
.test
{
   margin-left:-46px;
   width:41px;
   height:40px;
   cursor:pointer; 
   font-weight:bold; 
   border:0px solid;  
   background-color:#cb202d !important;
   border-top-right-radius:1px;
   border-bottom-right-radius:1px;
    color:#ffffff; 
}
@-moz-document url-prefix() { 
  .dir-go {
     margin-left:-47px !important; 
  }
 .zss-go-button
 {
  margin-top:1px !important;
 }
}


@media screen and (-webkit-min-device-pixel-ratio:0) 
{ 
    .dir-go {
     margin-left:-45px !important; 
  }     
}
</style>




</div>



<?php  $featured =FeaturedListing::model()->findAll(); ?>




 <div class="tabbable ">
  <ul class="nav nav-tabs nav-stacked" style="width:30%; float:left; ">

    <li class="active"><a href="#pane1" data-toggle="tab"  style="border: 1px solid #ddd !important;"><?php echo $featured[0]->name; ?></a></li>
    <li><a href="#pane2" data-toggle="tab"   style="border: 1px solid #ddd !important;"><?php echo $featured[1]->name; ?></a></li>
    <li><a href="#pane3" data-toggle="tab"  style="border: 1px solid #ddd !important;"><?php echo $featured[2]->name; ?></a></li>
    <li><a href="#pane4" data-toggle="tab"  style="border: 1px solid #ddd !important;"><?php echo $featured[3]->name; ?></a></li>
  </ul>
  

  
  <div class="tab-content" id="featured_listing" style="width:68%;float: right;border: 2px solid #ddd; height:380px;">
    <div id="pane1" class="tab-pane active" style="height:380px;">
	
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
            <a href="<?php echo $this->createUrl('list/temples/id/1'); ?>" style="color:#cb202d; padding-top:-20px;">View all  <?php echo strtolower($featured[0]->name);  ?>  &raquo;</a></div>
    </div>
    <div id="pane2" class="tab-pane" style="height:280px;">
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
            <a href="<?php echo $this->createUrl('list/temples/id/2'); ?>" style="color:#cb202d;">View all <?php echo strtolower($featured[1]->name);  ?> &raquo;</a></div>
    </div>
    <div id="pane3" class="tab-pane" style="height:380px;">
     <div class="" style="margin-left:10px; height:320px;" >
          <?php
	    $this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' =>$dataProvider_merriage_prms,
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
            <a href="<?php echo $this->createUrl('list/temples/id/3'); ?>" style="color:#cb202d; padding-top:-20px;">View all <?php echo strtolower($featured[2]->name);  ?> &raquo;</a></div>
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
            <a href="<?php echo $this->createUrl('list/temples/id/4'); ?>" style="color:#cb202d; ">View all <?php echo strtolower($featured[3]->name);  ?> &raquo;</a></div>
    </div>
  </div>
</div>
</div></div>


    <script type="text/javascript">
		  var j = jQuery.noConflict();
        j(document).ready(function () {
            j('#RahuKaalam').feedBackBox();
			
			 j("#rahu-date").datepicker({
			  showOn: "button",
			  buttonImage: "image/calendar.gif",
			  buttonImageOnly: true,
			  dateFormat: 'dd-mm-yy',
	          changeMonth: true,
              changeYear: true,
			  onSelect: function(date) {
			  
			  
			   $.ajax({
              url :'<?php echo $this->createUrl('default/raahukaalam'); ?>',
              type : "post",
			  data :  "date="+date,
              success:function(data)
              {
			    $('#load_div').html(data);
			  } 
    });
			  
			  
				  }
			});
        });
		
		
    </script>
	

<script>
$(document).ready(function(){
         $.ajax({
              url :'<?php echo $this->createUrl('default/raahukaalam'); ?>',
              type : "post",
              success:function(data)
              {
			    $('#load_div').html(data);
			  } 
    });
});
</script>


<style>
.ie9 .nav li a
{
 font-weight:bold !important;
 border: 1px solid #ddd !important;
}

img.ui-datepicker-trigger {
    left: -18px;
    position: relative;
    top: -1px;
}
.state {
    color: #000;
    font-weight: bolder;
}
</style>

<script type="text/javascript">
var tpj=jQuery;
tpj.noConflict();
var revapi1;
tpj(document).ready(function() {
if (tpj.fn.cssOriginal != undefined)
tpj.fn.css = tpj.fn.cssOriginal;
if(tpj('#rev_slider_1_1').revolution == undefined)
revslider_showDoubleJqueryError('#rev_slider_1_1');
else
{
revapi1 = tpj('#rev_slider_1_1').show().revolution(
{
delay:9000,
startwidth:1000,
startheight:586,
hideThumbs:200,

thumbWidth:100,
thumbHeight:50,
thumbAmount:2,

navigationType:"none",
navigationArrows:"verticalcentered",
navigationStyle:"round",

touchenabled:"on",
onHoverStop:"on",

navOffsetHorizontal:1,
navOffsetVertical:0,

shadow:0,
fullWidth:"on",

stopLoop:"on",/*off*/
stopAfterLoops:0,
stopAtSlide:1,

shuffle:"off",

hideSliderAtLimit:0,
hideCaptionAtLimit:0,

hideAllCaptionAtLilmit:0
});
}			
tpj('.first_slide').click(function(){
revapi1.revshowslide(1);
});
tpj('.second_slide').click(function(){
revapi1.revshowslide(2);
});
tpj('.third_slide').click(function(){
revapi1.revshowslide(3);
});
});	
</script>
