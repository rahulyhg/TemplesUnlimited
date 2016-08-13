<div role="main" id="content">



<div id="primary" style="margin-bottom:20px;">

<?php if(Yii::app()->user->hasFlash('reviewsuccess')){ ?>
<div class="flashmessage success flashmessage-review">
<button class="close" data-dismiss="alert">X</button>
<p><?php echo Yii::app()->user->getFlash('reviewsuccess'); ?></p>
</div>
<?php } ?>


<div class="latest-posts">
<div class="sc-page">
<div class="item clearfix shadow">
<div class="image">
<a class="greyscale" href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($model->id))); ?>">
<img width="150" height="150" alt="dharshan" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/main_image/<?php echo CHtml::encode($model->main_image); ?>"></a>
</div>
<div class="text">


				
<div class="title">
<h3><a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($model->id))); ?>"><?php echo CHtml::encode($model->temple_name); ?></a></h3>
</div>

<?php
if($model->city_id!='0') 
$address =  $model->city->name.' , '.$model->State->state_name.' , '.$model->Country->country.'.';
else
$address = $model->State->state_name.' , '.$model->Country->country.'.';

?>
<p><?php echo $address; ?></p>
</div><!-- /.text -->

</div></div>
</div>

<div class="rule"></div>
<h3>Your Overall Ratings for this Temple</h3>
<div id="ait-rating-system">
	<div class="rating-send-form rating-send-form1 left" style="padding:10px;" id="overall">		
<div class="ratings ratings1">

<div class="rating clearfix" data-rating-id="1" data-rated-value="0">
<div class="stars clearfix">
<div class="star" data-star-id="1" onclick="ratingvalues('1','overall_ratings');" ></div>
<div class="star" data-star-id="2" onclick="ratingvalues('2','overall_ratings');" ></div>
<div class="star" data-star-id="3" onclick="ratingvalues('3','overall_ratings');" ></div>
<div class="star" data-star-id="4" onclick="ratingvalues('4','overall_ratings');" ></div>
<div class="star" data-star-id="5" onclick="ratingvalues('5','overall_ratings');" ></div>
</div>
</div>

</div><!-- .rating-inputs -->


</div>	<!-- .rating-send-form -->
<div><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/left.png" style="margin-top:10px;"><p style="text-indent:30px; margin-top:-25px;"><strong>Click to rate</strong></p></div>	
</div>

<script>
function ratingvalues(value,id)
{
  $('#'+id).val(value); 
}
</script>


<div class="closeable">
<div id="comments">
<div id="respond" class="comment-respond">
<h3 id="reply-title" class="comment-reply-title">Leave a Review</h3>
<form action="<?php echo CHtml::normalizeUrl(array("review/addreview")); ?>" method="post" id="commentform" class="comment-form" enctype="multipart/form-data">
<input type="hidden" name="overall_ratings" id="overall_ratings" />
<input type="hidden" name="architechture" id="architechture" />
<input type="hidden" name="tourist_friendly" id="tourist_friendly" />
<input type="hidden" name="cleanliness" id="cleanliness" />
<input type="hidden" name="staffs" id="staffs" />
<input type="hidden" name="dharshan" id="dharshan" />

<p class="comment-form-url"><input id="title" name="title" type="text" value="" size="30" placeholder="Your Review Title here.." maxlength="150"/></p>
<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Write Your Review here.." style="max-width:100%;min-width:100%;"></textarea></p>	

<input type="hidden" name="temple_id" id="temple_id" value="<?php echo $model->id; ?>"	 />		

<input type="hidden" name="review_by" id="review_by" value="<?php echo Yii::app()->user->id; ?>"	 />								

</div><!-- #respond -->

</div><!-- #comments -->
</form>
</div>

<div class="rule"></div>
<h3>Rating Summary</h3>	
<div id="ait-rating-system">
	<div class="rating-send-form rating-send-form1 left" style="padding:10px;">	
	
<div class="ratings ratings1">

<ul>

			<li><div class="rating clearfix" data-rating-id="1" data-rated-value="0"><div class="rating-title left">Architecture</div>
			<div class="stars clearfix right" id="archi_error">
												<div class="star" data-star-id="1" onclick="ratingvalues('1','architechture');" ></div>
												<div class="star" data-star-id="2" onclick="ratingvalues('2','architechture');" ></div>
												<div class="star" data-star-id="3" onclick="ratingvalues('3','architechture');" ></div>
												<div class="star" data-star-id="4" onclick="ratingvalues('4','architechture');" ></div>
												<div class="star" data-star-id="5" onclick="ratingvalues('5','architechture');" ></div>
							  </div>
		</div></li>
								<li><div class="rating clearfix" data-rating-id="2" data-rated-value="0"><div class="rating-title left">Tourist friendly</div>
			<div class="stars clearfix right" id="tour_error">
												<div class="star" data-star-id="1" onclick="ratingvalues('1','tourist_friendly');" ></div>
												<div class="star" data-star-id="2" onclick="ratingvalues('2','tourist_friendly');" ></div>
												<div class="star" data-star-id="3" onclick="ratingvalues('3','tourist_friendly');" ></div>
												<div class="star" data-star-id="4" onclick="ratingvalues('4','tourist_friendly');" ></div>
												<div class="star" data-star-id="5" onclick="ratingvalues('5','tourist_friendly');" ></div>
								  </div>
		</div></li>
								<li><div class="rating clearfix" data-rating-id="3" data-rated-value="0"><div class="rating-title left">Cleanliness</div>
			<div class="stars clearfix right"  id="clea_error">
											    <div class="star" data-star-id="1" onclick="ratingvalues('1','cleanliness');" ></div>
												<div class="star" data-star-id="2" onclick="ratingvalues('2','cleanliness');" ></div>
												<div class="star" data-star-id="3" onclick="ratingvalues('3','cleanliness');" ></div>
												<div class="star" data-star-id="4" onclick="ratingvalues('4','cleanliness');" ></div>
												<div class="star" data-star-id="5" onclick="ratingvalues('5','cleanliness');" ></div>
								  </div>
		</div></li>
								<li><div class="rating clearfix" data-rating-id="4" data-rated-value="0"><div class="rating-title left">Staffs</div>
			<div class="stars clearfix right"  id="staf_error">
												<div class="star" data-star-id="1" onclick="ratingvalues('1','staffs');" ></div>
												<div class="star" data-star-id="2" onclick="ratingvalues('2','staffs');" ></div>
												<div class="star" data-star-id="3" onclick="ratingvalues('3','staffs');" ></div>
												<div class="star" data-star-id="4" onclick="ratingvalues('4','staffs');" ></div>
												<div class="star" data-star-id="5" onclick="ratingvalues('5','staffs');" ></div>
								  </div>
		</div></li>
								<li><div class="rating clearfix" data-rating-id="5" data-rated-value="0"><div class="rating-title left">Dharshan</div>
			<div class="stars clearfix right"  id="dhar_error">
												<div class="star" data-star-id="1" onclick="ratingvalues('1','dharshan');" ></div>
												<div class="star" data-star-id="2" onclick="ratingvalues('2','dharshan');" ></div>
												<div class="star" data-star-id="3" onclick="ratingvalues('3','dharshan');" ></div>
												<div class="star" data-star-id="4" onclick="ratingvalues('4','dharshan');" ></div>
												<div class="star" data-star-id="5" onclick="ratingvalues('5','dharshan');" ></div>
								  </div>
		</div></li>
		</ul>
		
								
</div><!-- .rating-inputs -->


</div>	<!-- .rating-send-form -->

</div>
<!--<h3 class="left">Do you have Photos to Share ?</h3>
<p style="text-indent:10px;">(optional)</p>
<input type="file" name="review_image" id="review_image">-->
<div class="rule"></div>
<h3 style="margin-bottom:25px;padding:5px;">Submit your review</h3>
<input type="checkbox" class="left" id="conditions" name="conditions"> 

<p style="text-indent:20px; margin-top:-5px; padding:3px;" id="terms1">I certify that this review is based on my own experience and that I have no personal or business relationship with this establishment, and have not been offered any incentive or payment originating from the establishment to write this review. I understand that temples unlimited has a zero-tolerance policy on fake reviews. <!--<a href="">Learn more</a>--></p>


 <?php if(Yii::app()->user->isGuest){?>
 
 <input type="button" class="sc-button alignleft light right button-primary tootltiptrigger triggerlogin" style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:3px; width:30%; font-weight:bold;" value="Submit Review" title="Please login to submit review."  />
 
<!-- onclick="window.location.href ='<?php // echo Yii::app()->request->baseUrl.'/login/'; ?>'"-->
 
 <?php }else{?>
<input type="submit" class="sc-button alignleft light right" style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:3px; width:30%; font-weight:bold;" value="Submit Review" onclick="return checkvalues();" />
<?php } ?>


</div>				   
		
		
<script>
function checkvalues()
{
var temp = 1;

var overall_ratings =$('#overall_ratings').val(); 
var title =$('#title').val();
var comment =$('#comment').val();
var conditions =  document.getElementById("conditions").checked;
var architechture =$('#architechture').val(); 
var tourist_friendly =$('#tourist_friendly').val(); 
var cleanliness =$('#cleanliness').val(); 
var staffs =$('#staffs').val(); 
var dharshan =$('#dharshan').val(); 

if(overall_ratings=='')
{
$("#overall").css("border","2px solid red"); 
temp = 0;
}
else
$("#overall").css("border","0px solid red");


if(architechture=='')
{
$("#archi_error").css("border","2px solid red"); 
temp = 0;
}
else
$("#archi_error").css("border","0px solid red");


if(tourist_friendly=='')
{
$("#tour_error").css("border","2px solid red"); 
temp = 0;
}
else
$("#tour_error").css("border","0px solid red");


if(cleanliness=='')
{
$("#clea_error").css("border","2px solid red"); 
temp = 0;
}
else
$("#clea_error").css("border","0px solid red");

if(staffs=='')
{
$("#staf_error").css("border","2px solid red"); 
temp = 0;
}
else
$("#staf_error").css("border","0px solid red");


if(dharshan=='')
{
$("#dhar_error").css("border","2px solid red"); 
temp = 0;
}
else
$("#dhar_error").css("border","0px solid red");


if(title=='')
{
$("#title").css("border","2px solid red"); 
temp = 0;
}
else
$("#title").css("border","2px solid #eeeeee");

if(comment=='')
{
$("#comment").css("border","2px solid red"); 
temp = 0;
}
else
$("#comment").css("border","2px solid #eeeeee");

if(!conditions)
{
$("#terms1").css("border","2px solid red"); 
temp = 0;
}
else
$("#terms1").css("border","0px solid red");


if(temp=='1')
{
$('#commentform').submit();
}
else
{
return false;
}
}

$(function(){
$('#review_image').change(function(){
var errorcountimage = 0;
var file = $(this).val();
var fileupload = this.files[0];
var exts = ['jpeg','jpg','png','gif'];
if ( file ) {
var get_ext = file.split('.');
get_ext = get_ext.reverse();
if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
if(fileupload.size != 'undefind' && fileupload.size){
if(fileupload.size > 2048576){
$(this).val('');
alert( 'File size exceeds 1MB!' );
errorcountimage++;
}
}
} else {
$(this).val('');
alert( 'File format not allowed!' );
errorcountimage++;
}
}
});
});
</script>


<?php
$criteria1 = new CDbCriteria;
$criteria1->order= 'review_id DESC';
$criteria1->condition='review_itemid=:review_itemid and review_itemtype=:review_itemtype';
$criteria1->params=array(':review_itemid'=>$model->id,':review_itemtype'=>'temple');
$criteria1->limit = 5;
$latestreviews = Reviews::model()->findAll($criteria1);
?>
											


<!-- /#primary -->
<div role="complementary" class="widget-area subcats-holder" id="secondary">
<div style="padding:20px;">
<h5><strong>Recent reviews of this temple</strong></h5>

<?php if(count($latestreviews)>0) { ?>

<?php for($i=0;$i<count($latestreviews);$i++) { 


$user1 = User::model()->getinfo($latestreviews[$i]->review_by);



$date1 = explode('-',$latestreviews[$i]->review_date);

$monthName1 = date('F', mktime(0, 0, 0, $date1[1], 10));

$dateonly  = explode(' ',$date1[2]);

?>
<div class="rule"></div>
<div>
<?php echo helpers::view_userimage($user1->user_image,'thumb',array('style'=>'width:40px;margin-right:20px;','class'=>'left')); ?> <p><strong><?php echo $user1->first_name." ".$user1->last_name; ?></strong><br>
<span style="font-size:12px;"><?php echo $monthName1."&nbsp;&nbsp;".$dateonly[0].",&nbsp;&nbsp;".$date1[0]; ?></span></p>

 <div class="comment more"><?php echo $latestreviews[$i]->review_content; ?></div>

</div>
<div class="rule"></div>

<?php }  } else { ?>
<div class="rule"></div>

<div style="text-align:center;">No reviews Found</div>

<div class="rule"></div>
<?php } ?>
</div>
</div>
</div>





					<!-- /.closeable -->
<style type="text/css">
.requirederror {
    border: 2px solid #FF0000 !important;
}
.stars.requirederror{
    padding:10px;
    border: 2px solid #FF0000 !important;
}
</style>



<script>
$(document).ready(function() {
var showChar = 350;
var ellipsestext = "...";
var moretext = "More...";
var lesstext = "Less...";
$('.more').each(function() {
var content = $(this).html();

if(content.length > showChar) {

var c = content.substr(0, showChar);
var h = content.substr(showChar-1, content.length - showChar);

var html = c + '<span class="moreellipses">' + ellipsestext+ ' </span><span class="morecontent"><span>' + h + '</span>  <a href="" class="morelink">' + moretext + '</a></span>';

$(this).html(html);
}

});

$(".morelink").click(function(){
if($(this).hasClass("less")) {
$(this).removeClass("less");
$(this).html(moretext);
} else {
$(this).addClass("less");
$(this).html(lesstext);
}
$(this).parent().prev().toggle();
$(this).prev().toggle();
return false;
});
});
</script>

<style>
a.morelink {
text-decoration:none;
outline: none;
}
.morecontent span {
display: none;
}
</style>

