<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/script.js'></script>
<?php

if($model->pooja_have_options=='1')
{
$criteria = new CDbCriteria;
$criteria->condition='pooja_id=:pooja_id';
$criteria->params=array(':pooja_id'=>$model->pooja_id);
$Poojaoptions = Poojaoptions::model()->findAll($criteria);

$options ='';

for($i=0;$i<count($Poojaoptions);$i++)
$options .='<option value='.$Poojaoptions[$i]->pooja_option_id.'>'.$Poojaoptions[$i]->option_desc.'</option>';


$pure_amount = $Poojaoptions[0]->option_price;

$pure_shipping_amount = $Poojaoptions[0]->option_shipping_price;
}
else
{
	$pure_amount = $model->pooja_price;
	$pure_shipping_amount = $model->pooja_shipping_price;
	$Poojaoptions ='0';
}


?>
<div id="main" class="mainpage onecolumn">
<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/epooja'); ?>">&nbsp;E-pooja </a><span style="color:#c1c1c1;">  &nbsp;>>&nbsp; </span><?php echo $model->pooja_name; ?></h3>
</div>
</div>

<div class="">
<div class="wrapper" style="padding-bottom:25px; padding-top:05px;">
<h3 class="left" style="font-size:30px; text-align:left; font-weight:bold;"><?php echo $model->pooja_name; ?></h3>
</div>
</div>

<div class="wrapper">
<div id="primary">
<div class="entry-content">
		
<div class="sc-column one-half" style="">

<img src="<?php echo Yii::app()->request->baseUrl.'/uploads/pooja/details_page/'.$model->pooja_image;?>"  alt="Item thumbnail"></div>

<div class="item-grid-view sc-column sc-column-last one-half-last">

<h2  style="font-size:25px; text-align:left; ">
Rs. <span class="pooja_price"><?php echo $pure_amount; ?></span>
</h2>

<?php if(count($Poojaoptions)>1) { ?>
<div style="margin-bottom:30px; ">

<select name="Poojaoptions" id="Poojaoptions"  class="left" style="width:50%; padding:2%" onchange="Poojaoptions_select(this.value);">
<?php echo $options; ?>
</select>
</div>
<br />
<br />
<?php } ?>


<input type="hidden" name="pure_amount" id="pure_amount" value="<?php echo $pure_amount; ?>" />

<input type="hidden" name="pure_shipping_amount" id="pure_shipping_amount" value="<?php echo $pure_shipping_amount; ?>" />


<?php 

if(isset($Poojaoptions[0]->pooja_option_id))
{
 $poojavariations1  = $Poojaoptions[0]->pooja_option_id;
}
else
{
   $poojavariations1  = '1';
}

if(isset(Yii::app()->user->id))
{
$Usermodel = User::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));

$user =  $Usermodel->role;
}

?>


<input type="hidden" name="variations" id="variations" value="<?php echo $model->pooja_id.'-'.$poojavariations1; ?>" />

<?php if(Yii::app()->user->isGuest){   ?>

<a  onclick="addtobooknow('<?php echo $model->pooja_id; ?>','pooja');" class="sc-button light" style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:18px;  border-radius:3px; margin-top:3px; cursor:pointer;"><strong>Book Now</strong></a>

<?php } else if($Usermodel->role=='2') { ?>
<a  onclick="addtobooknow('<?php echo $model->pooja_id; ?>','pooja');" class="sc-button light" style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:18px;  border-radius:3px; margin-top:3px; cursor:pointer;"><strong>Book Now</strong></a>
<?php  }else {}?>

<br />
<br />


<script>
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
</script>
<?php  $datas = unserialize($model->payment_options); 

$options ='';

for($i=0;$i<count($datas);$i++)
{
 $options .=  $datas[$i].",";
}
?>
<p>
<strong>Pooja Code :</strong> <?php echo $model->pooja_code; ?><br>
<strong>Phone Order  :</strong> <?php echo $model->phone_number; ?><br>
<strong>Payment via : </strong> <?php echo $options; ?><br>
<strong>Delivery time : </strong><?php echo $model->delivery_time_1."&nbsp;".$model->delivery_time_1option; ?> (India); <?php echo $model->delivery_time_2."&nbsp;".$model->delivery_time_2option; ?>  (International)<br>
<!--<strong>Location : </strong><?php //echo $model->poojacity->name; //echo 	$model->pooja_city; ?><br><br>-->
<!--<strong>Note : </strong>Shipping Charges extra Rs. <?php //echo $model->pooja_shipping_price; ?></p>-->



<script type="text/javascript">var addthis_config = { "data_track_addressbar":true } </script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-523c184172cc4d8d"></script>
<div id="current_listsong" class="addthis_toolbox addthis_default_style addthis_32x32_style"  addthis:url="<?php  echo curPageURL(); ?>" addthis:title="<?php echo $model->pooja_name; ?>">
<a id="fb_share" rel="nofollow" class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>


</div>

	</div>
</div>
<div class="tab-font">
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />
              <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Details">
                
              
                <div class="sc-column">
					
					<?php echo $model->pooja_overview?>

              </div>
            </div>
            
          </div>

<div id="primary">

<?php $reviewscount = Reviews::model()->get_review_all('pooja',$model->pooja_id);



if(isset($reviewscount) && $reviewscount!='')
{
   $count1 =  count($reviewscount);
}
else
{
  $count1 =  "0";
}


?>


<div class="rule"></div>
<div class="closeable">
<h3>Reviews (<?php echo  $count1; ?>)</h3>
<div class="open-button comments-opened" style="display: block;">Hide Reviews</div>
<div id="comments">
<ol class="commentlist" style="display: block;">
<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">
<div class="reviewlistdiv"></div>
</li>
</ol>

<?php
		  /*if(Yii::app()->user->isGuest || helpers::isnormaluser()){*/
			 $reviews = new Reviews;
			 $reviews->review_itemtype = 'pooja';
			 $reviews->review_itemid = $model->pooja_id;
			 $this->renderPartial('reviews', array('reviews'=>$reviews)); 
		 /*}*/
?>	

</div>
</div> 			
</div>

<div class="rule"></div>

<?php 
$criteria = new CDbCriteria;
$criteria->limit ='3';
$criteria->order= 'pooja_id ASC';
$criteria->condition='pooja_id<>:pooja_id';
$criteria->params=array(':pooja_id'=>$model->pooja_id);
$Pooja = Pooja::model()->findAll($criteria);
?>
<h3 class="section-title" style="font-size:25px; text-align:left">Related Pooja</h3>

<div style="margin-bottom:20px;" class=" section-best-places wrapper">

<div class="best-places-wrap">
          <ul class="items items-grid-view clearfix onecolumn" style="width:100%;">
		  
		  <?php  for($i=0;$i<count($Pooja);$i++) {
		  
		  
		    $reviews = new Reviews;
			 $type = 'pooja';
			 $id= $Pooja[$i]->pooja_id;
			 
			 $reviews = Reviews::model()->get_review_all($type,$id);
			 
			
			$avg_reviews =array();
			for($j=0;$j<count($reviews);$j++)
			{
			array_push($avg_reviews,$reviews[$j]['review_rate']);
			}
			
			 $avg = array_sum($avg_reviews)/count($reviews);
		  


if($Pooja[$i]->pooja_have_options=='1')
{
$criteria = new CDbCriteria;
$criteria->condition='pooja_id=:pooja_id';
$criteria->params=array(':pooja_id'=>$Pooja[$i]->pooja_id);
$Poojaoptions = Poojaoptions::model()->findAll($criteria);

$options ='';

for($k=0;$k<count($Poojaoptions);$k++)
$options .='<option value='.$Poojaoptions[$k]->pooja_option_id.'>'.$Poojaoptions[$k]->option_desc.'</option>';


$pure_amount = $Poojaoptions[0]->option_price;

$pure_shipping_amount = $Poojaoptions[0]->option_shipping_price;
}
else
{
$pure_amount = $Pooja[$i]->pooja_price;
$pure_shipping_amount = $Pooja[$i]->pooja_shipping_price;
$Poojaoptions ='0';
}
?>
            <li class="item clearfix sc-column one-third administrator" style="float:left; margin-left:5px !important;  ">
              <div class="item-thumbnail"  style="width:320px; height:230px;vertical-align:middle;display:table-cell;text-align:center; background:#FFFFFF;" ><a href="<?php echo CHtml::normalizeUrl(array("detail/poojaold/id/".helpers::simple_encrypt($Pooja[$i]->pooja_id))); ?>"><img  src="<?php echo Yii::app()->request->baseUrl.'/uploads/pooja/main_image/'.$Pooja[$i]->pooja_image; ?>"   alt="Item thumbnail" style="border-radius:2px;"></a> </div>
              <h3 class="item-title"><a href="<?php echo CHtml::normalizeUrl(array("detail/poojaold/id/".helpers::simple_encrypt($Pooja[$i]->pooja_id))); ?>"><?php echo $Pooja[$i]->pooja_name; ?></a></h3>
              <div class="item-address-wrapper">
                <!--<div class="item-address-pin"></div>-->
				
				<p><?php echo substr_replace(strip_tags($Pooja[$i]->pooja_description),'...',80);   ?> </p>
                
                <h5 class="item-title">Charges: Rs.  <?php echo $pure_amount;; ?></h5>
              </div>
              
              <div class="item-rating rating-grey">
				  
								<div class="item-stars clearfix"> 
								<span class="star <?php if($avg>=1){  ?>active<?php } ?>"></span> 
								<span class="star <?php if($avg>=2){  ?>active<?php } ?>"></span> 
								<span class="star <?php if($avg>=3){  ?>active<?php } ?>"></span> 
								<span class="star <?php if($avg>=4){  ?>active<?php } ?>"></span>
								<span class="star <?php if($avg>=5){  ?>active<?php } ?> last"></span>
								<span>
								</span>
								</div>
            </li>

			<?php } ?>

          </ul>
        </div>
</div>






</div>



  <!-- /#main -->

</div>
</div>

<script type="text/javascript">
jQuery(function(){
      jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/pooja/id/'.$model->pooja_id); ?>');

  
});
</script>

<style>
.pager
{
 float:right;
}
.section-best-places .items-grid-view .item.sc-column, .section-recent-places .items-grid-view .item.sc-column {
    margin: 0 9px 9px 0;
    width: 310px;
}

@media only screen and (min-width: 768px) and (max-width: 1600px) {
.item-thumbnail img
{
margin-top:3px;
}
}
.review_hide
{
display:none !important;
}
</style>
<script type="text/javascript">
function Poojaoptions_select(id)
{

var pooja_id = '<?php echo $model->pooja_id; ?>';
$.ajax({
url :'<?php echo $this->createUrl('list/poojaoptions'); ?>',
type : "post",
data : "id="+id,
success:function(data)
{
var data =  data.split('###');
$('.pooja_price').html(data[0]);
$('#pure_amount').val(data[0]);
$('#pure_shipping_amount').val(data[1]);
var  variations = pooja_id+"-"+data[2];
$('#variations').val(variations);
} 
});
}


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

function selectpoojaoptionprice(pricevalue){
	var pricevaluearr = pricevalue.split('_');
	jQuery('.pooja_price').html(number_format(pricevaluearr[0], 2, '.', ','));
	jQuery('.pooja_shipping_price').html(number_format(pricevaluearr[1], 2, '.', ','));
	jQuery('#Cart_itemprice').val(pricevaluearr[0]);
	jQuery('#Cart_itemshippingprice').val(pricevaluearr[1]);
}

function number_format(number, decimals, dec_point, thousands_sep) {
   
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>
<?php
function curPageURL() {
 /*$pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;*/
}
?>
