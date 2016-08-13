<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/script.js'></script>
<?php
$criteria = new CDbCriteria;
$criteria->condition='product_id=:product_id';
$criteria->params=array(':product_id'=>$model->product_id);
$productvariations = Productvariations::model()->findAll($criteria);

$options ='';

//$options .= '<option value='.$model->product_id.'-'.'0>'.$model->product_name.'</option>';


for($i=0;$i<count($productvariations);$i++)
{
  $options .='<option value='.$model->product_id.'-'.$productvariations[$i]->variation_id.'>'.$productvariations[$i]->product_variation_title.'</option>';
}

$criteria1 = new CDbCriteria;
$criteria1->order= 'product_id ASC';
$criteria1->limit = 5;
$criteria1->condition='product_id!=:product_id';
$criteria1->params=array(':product_id'=>$model->product_id);
$recentproducts = Storeproducts::model()->findAll($criteria1);

if(Yii::app()->user->id!=''){
$Usermodel = User::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
$favourite_products =explode(',',$Usermodel->favourite_products);
if(in_array($model->product_id,$favourite_products))
{
$favourite ='Yes';
}
else
{
$favourite ='No';
}
}
else
{
$favourite ='No';
}
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery.tooltipster.js"></script>
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/jquery.feedBackBox1.js"></script>-->

<link href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/jquery.feedBackBox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="/text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/tooltipster.css" />

<div id="main" class="mainpage onecolumn">

<div class="" style="margin-top:15px;">
<div class="wrapper">
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/products'); ?>">Store </a><span style="color:#c1c1c1;">  &nbsp;>>&nbsp; </span><?php echo $model->product_name; ?></h3>
</div>
</div>





<div class="">
<div class="wrapper" style="padding-top:5px;">
<h3 class="left" style="font-size:30px; text-align:left; font-weight:bold;"><?php echo $model->product_name; ?></h3>
</div>
</div>

<div class="wrapper">

    <div class="flashmessage success" id="flashmessage" style="display:none;" >
	<p id="msg_display">Item added to cart successfully.</p>
</div>

    <div class="flashmessage success" id="flashmessage1" style="display:none;" >
	<p id="msg_display">Item already added in your cart.</p>
</div>


<div id="primary">
<div class="entry-content">
		
<div class="sc-column one-half">
<img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/details_page/'.$model->product_image;?>" alt="Item thumbnail">
</div>


<div class="item-grid-view sc-column sc-column-last one-half-last">

<h2  style="font-size:25px; text-align:left;">
Rs. <span id="rs_product"><?php   echo ($model->product_price!='0.00')?$model->product_price:$productvariations[0]->product_price;?></span>
</h2>

<?php


if($model->product_have_variations=='1'){ 
	$options1 = $model->variations;
	
	$option_price = '';
	$option_shipping_price = '';
	
	if(count($options1)){
	$option = $options1[0];
	$option_price = helpers::to_currency($option->product_price);
	
	$pure_amount =  floor($option->product_price);
	$pure_shipping_amount =  floor($option->product_shipping_price);
					
	}
	}else{
	$option_price = helpers::to_currency($model->product_price);
	
	
	$pure_amount =  floor($model->product_price);
	$pure_shipping_amount =  floor($model->product_shipping_price);	
	}
?>

<input type="hidden" name="pure_amount" id="pure_amount" value="<?php echo $pure_amount; ?>" />

<input type="hidden" name="pure_shipping_amount" id="pure_shipping_amount" value="<?php echo $pure_shipping_amount; ?>" />


<?php 

if(isset($productvariations[0]->variation_id))
{
 $productvariations1  = $productvariations[0]->variation_id;
}
else
{
   $productvariations1  = '1';
}

?>

<input type="hidden" name="variations" id="variations" value="<?php  echo $model->product_id.'-'.$productvariations1; ?>" />



<?php if(count($productvariations)>1) { ?>

<div style="margin-bottom:30px; ">
<select name=""  class="left" style="width:50%; padding:2%" onchange="selectvariations(this.value)">
<?php echo $options; ?>
</select>
</div>
<br />
<br />
<?php } ?>

<?php  if( (Yii::app()->user->isGuest) || (isset($Usermodel) && ($Usermodel['role']=='2'))){ ?>

<a class="sc-button light" href="javascript:void(0);" onclick="addtobooknow('<?php echo $model->product_id; ?>','product');" style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:18px;  border-radius:3px;  "><strong>Book Now</strong></a>
<br>
<br>


<?php 
if(isset(Yii::app()->session['cart'][$model->product_id.'-'.$productvariations1]['variations']))
{
 if(array_key_exists(Yii::app()->session['cart'][$model->product_id.'-'.$productvariations1]['variations'], Yii::app()->session['cart'])) {  
 $title = 'The product is already added in cart';
 ?>

<a href="javascript:void(0);" title="<?php echo   $title;  ?>"  class="sc-button light" style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:15px;border-radius:8px; padding: 2px 18px 2px; float:left;"  onclick="addtocart('<?php echo $model->product_id; ?>');">Add to cart<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/add_to_cart.png" style="float:right; margin-left:5px;"></a>

<?php } ?> 

 <?php }else { ?>

<a href="javascript:void(0);"  class="sc-button light" style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:15px;border-radius:8px; padding: 2px 18px 2px; float:left;"  onclick="addtocart('<?php echo $model->product_id; ?>');">Add to cart<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/add_to_cart.png" style="float:right; margin-left:5px;"></a>
<?php }  ?>


<?php if(isset(Yii::app()->user->id)){ ?>

<?php if($favourite=='No') { 
 $title1 = 'Add to favorite';

?>
<div id="addtofavouriteenable">
<a href="javascript:void(0);" class="sc-button light" title="<?php $title1; ?>"  onclick="addtofavourite('<?php echo $model->product_id; ?>');"  style="background-color: #444444; color: #fff;  font-style:bold; font-size:15px; margin-left:5px; border-radius:8px; padding: 2px 18px 2px;">Add to Favorite<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/heart-red.png"  style="float:right; margin-left:5px;"   ></a><br></div>
<?php }else{?>
<div id="addtofavouritedisable">
<a class="sc-button light" title="Added to Favorite"  style="background-color: #CB202D ; color: #fff;  font-style:bold; font-size:15px; margin-left:5px; border-radius:8px; padding: 2px 18px 2px; poacity:0.50">Add to Favorite<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/heart-red.png"  style="float:right; margin-left:5px;" title="Added to Favorite"  ></a></div>
<?php } ?>&nbsp;
<?php }else{ ?>

<div id="addtofavouriteenable">
<a href="<?php echo CController::CreateUrl('/login?fav=fav'); ?>" class="sc-button light" title="Add to favorite"    style="background-color: #444444; color: #fff;  font-style:bold; font-size:15px; margin-left:5px; border-radius:8px; padding: 2px 12px 2px;">Add to Favorite<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/heart-red.png"  style="float:right; margin-left:5px;"   ></a><br></div>

<?php } }   ?>&nbsp;

<p><strong>Product Code  :</strong> <?php echo $model->product_code; ?><br>
<strong>Phone Order  :</strong> <?php echo $model->phone_number; ?><br>
<strong>Payment via : </strong>  <?php echo $model->payment_options;; ?><br>
<strong>Delivery time : </strong><?php echo $model->delivery_time_1."&nbsp;".$model->delivery_time_1option; ?> (India); <?php echo $model->delivery_time_2."&nbsp;".$model->delivery_time_2option; ?> (International)<br>
<!--<strong>Location : </strong><?php // echo $model->location; ?><br>-->
<!--<strong>Note : </strong>Shipping Charges extra Rs.&nbsp;<span id="shipping_amount" style="font-weight:bold;"><?php //echo $model->product_shipping_price; ?></span>--> </p>



<!-- AddThis Button BEGIN -->
<!--<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-523c184172cc4d8d"></script>-->
<!-- AddThis Button END -->
<!--</article>--><!---post---->


<script type="text/javascript">var addthis_config = { "data_track_addressbar":true } </script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-523c184172cc4d8d"></script>
<div id="current_listsong" class="addthis_toolbox addthis_default_style addthis_32x32_style"  addthis:url="<?php  echo curPageURL(); ?>" addthis:title="<?php echo $model->product_name; ?>">
<a id="fb_share" rel="nofollow" class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
</div>


<?php
if(Yii::app()->controller->action->id =='storeold')
{ ?>

<script>
/*
$(function(){
 $('head').append('<meta property="og:title" content="<?php echo $model->product_name; ?>"  />');
$('head').append('<meta   property="og:image"  content="<?php echo Yii::app()->getBaseUrl(true).'/uploads/store/details_page/'.$model->product_image;?>?2345645" />');
$('head').append('<meta  property="og:url" content="<?php  echo curPageURL(); ?>" />');

$('head').append('<meta  property="og:description"  content="test description for url"/>');
$('head').append('<meta  property="og:updated_time"  content="<?php  echo time(); ?>" />');
});*/
//document.getElementsByTagName('head')[0].appendChild('<meta name="og:title" content="<?php echo $model->product_name; ?>" property="og:title" />');
///document.getElementsByTagName('head')[0].appendChild('<meta name="og:image"  content="<?php echo Yii::app()->getBaseUrl(true).'/uploads/store/details_page/'.$model->product_image;?>" property="og:image" />')
//document.getElementsByTagName('head')[0].appendChild('<meta name="og:url" content="<?php  echo curPageURL(); ?>" property="og:url" />')
//document.getElementsByTagName('head')[0].appendChild('<meta name="og:description" content="test description for url" property="og:description" />')

</script>
<?php } ?>
<div>
<div class="tab-font">
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />
              <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Details">
       
	       <?php  echo $model->product_overview;?>
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

<div class="sidebar">
<div id="newCart" class="">
<div id="fixedCart" class="order-system">
<div class="order-head">
<h2>Recent Products</h2>
</div>
<div id="vmCartModule" class="orderpad">
<?php for($i=0;$i<count($recentproducts);$i++) { 

if($recentproducts[$i]->product_price=='0.00')
{
$criteria1 = new CDbCriteria;
$criteria1->condition='product_id=:product_id';
$criteria1->params=array(':product_id'=>$recentproducts[$i]->product_id);
$productvariations1 = Productvariations::model()->findAll($criteria1);
$price = $productvariations1[0]->product_price;
}
else
{
$price= $recentproducts[$i]->product_price; 
}

if($recentproducts[$i]->product_have_variations=='1'){ 
	$options2 = $recentproducts[$i]->variations;
	
	$option_price = '';
	$option_shipping_price = '';
	
	if(count($options2)){
	$option12 = $options2[0];
	$option_price12 = helpers::to_currency($option12->product_price);
	
	$pure_amount12 =  floor($option12->product_price);
	$pure_shipping_amount12 =  floor($option12->product_shipping_price);
					
	}
	}else{
	$option_price12 = helpers::to_currency($recentproducts[$i]->product_price);
	
	
	$pure_amount12 =  floor($recentproducts[$i]->product_price);
	$pure_shipping_amount12 =  floor($recentproducts[$i]->product_shipping_price);	
	}
?>
<div class="prod-sec">
<div class="prod-img"><img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/listpage/'.$recentproducts[$i]->product_image;?>" > </div>
<div class="prod-details">
<div class="prod-head"><a href="<?php echo CHtml::normalizeUrl(array("detail/storeold/id/".helpers::simple_encrypt($recentproducts[$i]->product_id))); ?>"><?php echo $recentproducts[$i]->product_name; ?></a></div>
<div class="prod-price">Rs. <?php echo $price; ?></div>
<?php  if( (Yii::app()->user->isGuest) || (isset($Usermodel) && ($Usermodel['role']=='2'))){ ?>
<div class="prod-cart"><a href="javascript:void(0);" onclick="addtocart1('<?php echo $recentproducts[$i]->product_id; ?>','<?php echo $pure_amount12 ?>','<?php echo $pure_shipping_amount12; ?>');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/add-to-cart2_red.gif"></a></div>
<?php } ?>

</div>

<div class="rule" style="margin:0"></div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<div id="order">
<?php
 //$total = Yii::app()->session['delivery_amount'] + Yii::app()->session['sub_total'];
?>
<!--<div id="fpi_feedback"><div id="fpi_content"><div id="fpi_header_message"><strong>Your Order</strong></div><div class="order-place"><p>There are <span id="no_of_items"><?php // echo (Yii::app()->session['item_count']!='')?Yii::app()->session['item_count']:'no'; ?></span> items in your order.</p><div style="margin:0" class="rule"></div><div class="sub"><p>Subtotal</p><p>Delivery</p></div><div class="price"><p id="price">$ <?php //echo (Yii::app()->session['sub_total']!='')?Yii::app()->session['sub_total']:'0.00'; ?></p><p id="delivery">$ <?php //echo (Yii::app()->session['delivery_amount']!='')?Yii::app()->session['delivery_amount']:'0.00'; ?></p></div><div style="margin:0" class="rule"></div><div class="tot">Total</div><div id="total" class="amt"> $ <?php //echo ($total!='')?$total:'0.00'; ?>	</div><div style="margin:0" class="rule"></div><a href="" class="sc-button light " style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:14px; margin-left:60px; border-radius:3px;  padding: 0 9px 4px; margin-top:10px;">Proceed to checkout</a><div class="min-ord">The minimum order for Rudraksha is $ <span id="outside"><?php //echo (Yii::app()->session['sub_total']!='')?Yii::app()->session['sub_total']:'0.00'; ?></span> excluding delivery</div></div></div></div>-->
</div>

</div>

<div id="primary">


<?php $reviewscount = Reviews::model()->get_review_all('product',$model->product_id); 




if(isset($reviewscount) && $reviewscount!='')
{
   $count1 =  count($reviewscount);
}
else
{
  $count1 =  "0";
}


?>
</div>

<div class="rule"></div>
	<div class="closeable">
	
		<div class="open-button comments-opened" style="display:block;">Hide Reviews</div>
<h3>Reviews (<?php echo $count1; ?>)</h3>
<div id="comments">




<ol class="commentlist">
						<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">

				  <div class="reviewlistdiv"></div>
</li></ol>


<?php
/*		 if(Yii::app()->user->isGuest || helpers::isnormaluser()){*/
			 $reviews = new Reviews;
			 $reviews->review_itemtype = 'product';
			 $reviews->review_itemid = $model->product_id;
			 $this->renderPartial('reviews', array('reviews'=>$reviews)); 
		 /*}*/
?>
			



</div> 			
</div>


</div>

<br>
  <!-- /#main -->
  
  
</div>


<script type="text/javascript">
jQuery(function(){
      jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/product/id/'.$model->product_id); ?>');

  
});
</script>





<style>
.pager
{
 float:right;
}

@media only screen and (min-width: 768px) and (max-width: 1600px) {

.sidebar
{
width: 30%; 
}
}

@media only screen  and (max-width: 480px) {

.sidebar
{
width: 100%;
}
}


@media only screen and (min-width: 481px) and (max-width: 720px)  {

.sidebar
{
width: 100%;
}
}


.tab-font {
   float: left;
    width: 70%;
	margin-top:1px;
}
.sidebar {
    float: left;
    position: relative;
   /* width: 30%;*/
}
.order-head {
    background-color: #CB202D;
    height: 40px;
    line-height: 40px;
}
.order-head h2 {
    color: #ffffff;    
    font-size: 18px;
    font-weight: bold;
    margin: 0;
    padding: 8px 0 0 15px;
	text-align:center;
}
.order-system {
    background-color: #F6F6F6;
    margin: 36px 0 0 15px;
    min-height: 250px;
    
}
.prod-head {
    color: #CB202D;
    margin-left: 10px;
    margin-top: 10px;
   
}
.prod-img {
    float: left;
    width: 40%;
}
.prod-details {
float:left;
width:60%;
}
.prod-img > img {
/*    height: 70px;
    margin-left: 10px;*/
    margin-top: 10px;
    
}

.prod-price {
   margin-left: 10px;
    color:#333333;
	font-weight:bold;
}


/*.prod-cart  img {
    height: 23px;
    margin-left: 10px;
    width: 85px;
}*/

.prod-cart  img {
    height: 24px;
    margin-left: 10px;
    width: 100px;
}
#fpi_title h2 {
color:#ffffff; }
#fpi_title {
margin-left:0; }
#fpi_feedback { width:360px; }

.order-place > p {
    color: #DDDDDD;
    font-size: 13px;
    margin-bottom: 0;
   
}
#fpi_content #fpi_header_message { margin:0; }
.sub { float:left; width:70%; }
.price { float:right; }
.sub > p {
    font-size: 13px;
    margin: 0;
}
.price > p {
    font-size: 13px;
    margin: 0;
	font-weight:bold;
	text-align:right;
}
.tot { float:left; width:50%; color:#CB202D; font-weight:bold; }
.amt { float:left; width:50%; color:#CB202D; font-weight:bold; text-align:right; }
#fpi_content { padding: 12px 10px 10px 12px; }
.min-ord {
    color: #fff;
    font-size: 13px;
    margin-top: 5px;
    text-align: center;
}
.sc-button.light > img { height:24px; width:24px; }
.cart { padding: 1px 19px 4px; }

#fpi_content {
    background-color: #000000;
    height: 320px !important;
    left: 60px;
    margin-left: 10px;
    opacity: 0.8;
    padding: 10px 20px;
    position: absolute;
    top: 0;
    width: 250px !important;
}

.review_hide
{
display:none !important;
}


#fpi_title {
    background-color: #cd2122;
    cursor: pointer;
    left: 0;
    margin-left: -14px !important;
    position: absolute;
    top: 36px !important;
}


</style>

<script>
function selectvariations(id)
{
$('#variations').val(id);
     $.ajax({
              url :'<?php echo $this->createUrl('list/selectvariations'); ?>',
              type : "post",
              data : "id="+id,
              success:function(data)
              {
			     var data = data.split("&&"); 
			  // $('#name_product').html(data[0]);
			    $('#rs_product').html(data[1]);
			    $('#pure_amount').val(parseInt(data[1]));
			    $('#pure_shipping_amount').val(parseInt(data[2]));
			   //$('#shipping_amount').html(data[2]);
			  } 
     });
}



function addtobooknow(product_id,type)
{
			var amount = $('#pure_amount').val();
			var shipping_amount = $('#pure_shipping_amount').val();
			
					$.ajax({
					url :'<?php echo Yii::app()->request->baseUrl; ?>'+'/index.php/front/profile/addbooknow',
					type : "post",
					data : 'product_id='+product_id+'&amount='+amount+'&shipping_amount='+shipping_amount+'&type='+type+'&variations='+$('#variations').val(),
					success:function(data)
					{
					 window.location.href = '<?php echo Yii::app()->request->baseUrl; ?>'+'/front/profile/booknow';
					} 
					});
	
}

function addtocart(product_id)
{
    var amount = $('#pure_amount').val();
	var shipping_amount = $('#pure_shipping_amount').val();
	
    $.ajax({
              url :'<?php echo Yii::app()->request->baseUrl; ?>'+'/index.php/front/profile/addcart',
              type : "post",
               data : 'product_id='+product_id+'&amount='+amount+'&shipping_amount='+shipping_amount+'&variations='+$('#variations').val(),
              success:function(data)
              {
			  
			    data  = data.split('##');
			     if(data[0]=='1')
				 {
				 $('#flashmessage1').hide();
				 $('#flashmessage').show();
				  setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 }
				 else
				 {
				  $('#flashmessage').hide();
				 $('#flashmessage1').show();
				  setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 }
				 checkboxdetail();
				$('#cart_count').html("Cart ("+data[1]+")");
				
				$('html, body').animate({scrollTop:$('#menu-main-menu').position().top}, 'slow'); 
			  } 
         });
}

function addtocart1(product_id,amount,shipping_amount)
{
  var  variations = product_id+'-'+'1';
     $.ajax({
              url :'<?php echo Yii::app()->request->baseUrl; ?>'+'/index.php/front/profile/addcart',
              type : "post",
              data : 'product_id='+product_id+'&amount='+amount+'&shipping_amount='+shipping_amount+'&variations='+variations,
              success:function(data)
              {
			    data  = data.split('##');
			      if(data[0]=='1')
				 {
				 $('#flashmessage1').hide();
				 $('#flashmessage').show();
				  setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 }
				 else
				 {
				  $('#flashmessage').hide();
				  $('#flashmessage1').show();
				  setTimeout( "jQuery('#flashmessage,#flashmessage1').hide();",10000 );
				 }
				checkboxdetail(); 
				$('#cart_count').html("Cart ("+data[1]+")");
				$('html, body').animate({scrollTop:$('#menu-main-menu').position().top}, 'slow'); 
			  } 
         });
}

function addtofavourite(product_id)
{
     $.ajax({
              url :' <?php echo $this->createUrl('profile/detailsmakefavourite'); ?>',
              type : "post",
              data : 'product_id='+product_id,
              success:function(data)
              {
			   $('#addtofavouriteenable').html(data);
			  }
         });
}


function checkboxdetail()
{
 $.ajax({
              url :' <?php echo $this->createUrl('profile/detailscheckoutbox'); ?>',
              success:function(data)
              {
			   var object =$.parseJSON(data);
			  $('#no_of_items').html(object.count);
			  $('#price').html(object.sub_total);
			  $('#delivery').html(object.delivery_amount);
			  $('#total').html(object.total);
			  $('#total_amount').html(object.total);
			  }
         });
}

$(document).ready(function () {
checkboxdetail();
});

$(document).ready(function () {
$("body").on('click','#proceedcheck',function() {
window.location.href ='<?php echo Yii::app()->request->baseUrl.'/cart'; ?>';
});
});
</script>

<?php  if( (Yii::app()->user->isGuest) || (isset($Usermodel) && ($Usermodel['role']=='2'))){ ?>

 <link href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/jquery.feedBackBox.css" rel="stylesheet" type="text/css">
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/jquery.feedBackBox2.js"></script>
    <script type="text/javascript">
		  var j = jQuery.noConflict();
        j(document).ready(function () {
            j('#order').feedBackBox();
        });
		
		
    </script>
	
	<?php } ?>
	
<!--[if IE 9]><html class="no-js oldie ie9 ie" lang="en-US">
<style>
 #your-email
 {
 padding:10px 10px 20px !important;
 width:185px;
 }
 #fpi_title
 {
  margin-left:22px !important;
 }
 </style>
 
<![endif]-->

<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>
