<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product - '.$model->product_name,
);

$this->menu=array(
);

  $data = $model;
  $productimage = Storeproducts::model()->get_image($data->product_id);
  $productdesc = strip_tags($data->product_overview);
    $optionsarray = array();
  if($model->product_have_variations=='1'){ 
           $options = $model->variations;
		
		   $option_price = '';
		    $option_shipping_price = '';
		   if(count($options)){
		      $option = $options[0];
			 $option_price =number_format($option->product_price, 2, '.', ',');
			 $option_shipping_price = number_format($option->product_shipping_price, 2, '.', ',');
			   foreach($options as $productoption){
			      $optionsarray[trim($productoption->product_price).'_'.trim($productoption->product_shipping_price)] = $productoption->product_variation_title;
			   }
			   
		   }
}else{
 $option_price = helpers::to_currency($model->product_price);
  $option_shipping_price = helpers::to_currency($model->product_shipping_price);
}

  
  
?>
<style type="text/css">
.tab-font{ clear:both; }
#primary {
    width: 100%;
}

.sc-column.one-half, .sc-column.one-half-last {
    width: 47%;
}

.thumbnailimg {
    display: table;
    height: 200px !important;
    margin-bottom: 20px;
    margin-left: auto;
    margin-right: auto;
	width:100%;
}
.list-view .items{ display:table; }

.list-view .items .one-fourth {
    margin-right: 26px;
}
.producttitle {
    height: 40px;
}

.productdesc {
    height: 90px;
}

#Cart_itemcount {
    padding: 10px;
}
</style>
<div class="">
<div class="wrapper" style="padding-bottom:25px; padding-top:35px;">
<h3 class="left" style="font-size:30px; text-align:left; font-weight:bold;"><a href="<?php echo CHtml::normalizeUrl(array("detail/product/id/".helpers::simple_encrypt($data->product_id))); ?>"><?php echo  $data->product_name; ?></a></h3>

<?php if(isset($_REQUEST['test'])) {?>
<a href="<?php echo CHtml::normalizeUrl(array("profile/favourites")); ?>" class="sc-button light right" style="background-color: #BFBFBF; color: #fff; font-size:13px; margin-left:5px; border-radius:3px;">Back</a>
<?php } else { ?>
<a href="<?php echo CHtml::normalizeUrl(array("list/products")); ?>" class="sc-button light right" style="background-color: #BFBFBF; color: #fff; font-size:13px; margin-left:5px; border-radius:3px;">Back</a>
<?php } ?>
</div>
</div>
<div class="wrapper">
<div id="primary">
<div class="entry-content">
		
<div class="sc-column one-half" style="text-align:center">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $productimage; ?>" alt="Item thumbnail">
</div>

<div class="item-grid-view sc-column sc-column-last one-half-last">

<h2 class="section-title" style="font-size:25px; text-align:left; margin-top:0px;">
<span class="product_price"><?php echo $option_price; ?></span>
</h2>
<div class="sc-column-half" style="margin-bottom:20px; margin-top:-30px;">

<?php
if(count($optionsarray)){
  echo CHtml::dropDownList('pooja_price_options','',$optionsarray,array('style'=>'width:50%; padding:2%','class'=>'left','onchange'=>'selectproductoptionprice(this.value)')); 
 }
 ?>

</div>
		<?php 
		if(helpers::isnormaluser()){
		$cartmodel = new Cart;
		//$cartmodel->itemid = $data->product_id;
		//$cartmodel->itemtype = 'product';
		//$cartmodel->itemname = $data->product_name;
		//$cartmodel->itemcount = 1;
		//$cartmodel->itemprice = $option_price;
		//$cartmodel->itemshippingprice = $option_shipping_price;
		
		$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart_form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
                'validateOnSubmit'=>true,
                'validateOnChange'=>true,
                'validateOnType'=>false,
        ),
    'action'=>CController::CreateUrl('//front/cart/add'),
	'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>
<?php	//echo $form->hiddenField($cartmodel,'itemid',array('required'=>true)); ?>
<?php	//echo $form->hiddenField($cartmodel,'itemtype',array('required'=>true)); ?>
<?php	//echo $form->hiddenField($cartmodel,'itemname',array('required'=>true)); ?>
<?php	//echo $form->hiddenField($cartmodel,'itemprice',array('required'=>true)); ?>
<?php	//echo $form->hiddenField($cartmodel,'itemshippingprice',array('required'=>true)); ?>
<?php  $qtyarr = array(); for($i=1; $i<=50; $i++){ $qtyarr[$i]  = $i; }
	echo $form->dropDownList($cartmodel,'itemcount',$qtyarr,array('required'=>true)); ?>

<strong></strong>


<?php echo CHtml::ajaxSubmitButton(
                                'Book Now',
    array('//front/cart/add'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#cart-submit").attr("disabled",true);
											 $("#cart_form .errorMessage").html("");
            }',
                                        'complete' => 'function(){ 
                                             $("#cart_form").each(function(){ }); //this.reset();
                                             $("#cart-submit").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
											 if (data.indexOf("{")==0) {
											   jQuery.each(obj, function(key, value) { jQuery("#"+key+"_em_").show().html(value.toString()); });
											 }
                                            // View login errors!
         // alert(data);
                                             if(obj.cart == "success"){
                                         alert("Added to cart successfully...");
                                      }
          else{
                                              
                                             }
 
                                        }' 
    ),
                         array("id"=>"cart-submit","class" => "button-primary sc-button light",'style'=>'background-color: #CB202D; color: #fff;  font-style:bold; font-size:18px; margin-left:5px; border-radius:3px')      
                ); ?>

		  <?php $this->endWidget(); ?>

   <br>
<?php } ?>
<br>
<p><strong>Phone Order  :</strong> Call toll-free at <?php echo $model->phone_number; ?><br>
<strong>Payment via : </strong> <?php echo $model->payment_options; ?><br>
<strong>Delivery time : </strong> <?php echo $model->delivery_time_1.' '.$model->delivery_time_1option; ?> (India);<?php echo $model->delivery_time_2.' '.$model->delivery_time_2option; ?> (International)<br><br>

<?php if((float)$option_shipping_price>0){ ?>
<span class="pooja_shipping_price_cont"><strong>Note : </strong>Shipping Charges extra <?php echo Yii::app()->params['currency_symbol']; ?> <span class="product_shipping_price"><?php echo $option_shipping_price; ?></span></span>
<?php } ?>
</p>

<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-523c184172cc4d8d"></script>
<!-- AddThis Button END -->


</div>

	</div>
</div>
<div class="tab-font">
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />
              <div class="ait-tab tab-content items-grid-view" data-ait-tab-title="Details">
                <?php echo $model->product_overview; ?>
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

<div id="primary">


<div class="rule"></div>
	<div class="closeable">
		<div class="open-button comments-opened" style="display: block;">Hide Reviews</div>

<div id="comments">


		<h2 id="comments-title">
<span>Reviews(1)</span>		</h2>


<ol class="commentlist" style="display: block;">
						<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">

				<article class="comment" id="comment-9">
					
					<div class="comment-content clearfix">
						<div class="comment-avatar left"><img width="68" height="68" class="avatar avatar-68 photo" src="http://1.gravatar.com/avatar/f0781076fe847372a8f0239c42ecd347?s=68&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D68&amp;r=G" alt=""></div>
							<p>Brand new comment</p>

					</div>

					<div class="comment-meta clearfix">
					
						
						<p> Exceeded all expectations. Fantastic guide!!! Cannot speak highly enough. Best decisionExceeded all expectations. Fantastic guide!!! Cannot speak highly enough. Best decision</p>
						<span class="right">
3 &nbsp;<a href="#"><img src="image/thumb.png" width="20px" onMouseOver="this.src='image/hup.png'" onMouseOut="this.src='image/thumb.png'" border="0" alt=""/></a>&nbsp;
0 &nbsp;<a href="#"><img  src="image/unlike.png" width="20px;" onMouseOver="this.src='image/hdown.png'" onMouseOut="this.src='image/unlike.png'" border="0" alt=""/></a>
</span>
						<!--<div class="meta-controls reply right"><a class='comment-reply-link' href='/businessfinder/wp1/contact/?replytocom=9#respond' onclick='return addComment.moveForm("comment-9", "9", "respond", "4177")'>Reply</a></div>-->
						<div class="meta-controls edit right"></div>
					</div>

				</article>
</li></ol>


<div id="respond" class="comment-respond">								
				<h3 id="reply-title" class="comment-reply-title">Leave a Review <small><a rel="nofollow" id="cancel-comment-reply-link" href="" style="display:none;">Cancel reply</a></small></h3>
									<form action="" method="post" id="commentform" class="comment-form">
								
						<div class="" id="ait-rating-system" style="width:30%; float:left">
						<div class="rating-send-form" style="border:none;background:none;box-shadow:none;">		
					<div class="">
					<div style="margin-bottom:-20px; margin-right:10px; margin-top:5px;" class="left"><p><strong> Ratings : </strong></p></div>								
									<div data-rated-value="0" data-rating-id="1" class="rating clearfix" style="margin-top: 9px;">
											
						<div class="stars clearfix">
																	<div style="background: url(&quot;wp-content/themes/businessfinder/design/img/star-white-default.png&quot;) no-repeat scroll 0px 0px transparent;" data-star-id="1" class="star"></div>
																	<div style="background: url(&quot;wp-content/themes/businessfinder/design/img/star-white-default.png&quot;) no-repeat scroll 0px 0px transparent;" data-star-id="2" class="star"></div>
																	<div style="background: url(&quot;wp-content/themes/businessfinder/design/img/star-white-default.png&quot;) no-repeat scroll 0px 0px transparent;" data-star-id="3" class="star"></div>
																	<div style="background: url(&quot;wp-content/themes/businessfinder/design/img/star-white-default.png&quot;) no-repeat scroll 0px 0px transparent;" data-star-id="4" class="star"></div>
																	<div style="background: url(&quot;wp-content/themes/businessfinder/design/img/star-white-default.png&quot;) no-repeat scroll 0px 0px transparent;" data-star-id="5" class="star"></div>
												  </div>
							</div>
													
				</div><!-- .rating-inputs -->
			
				
		</div>	<!-- .rating-send-form -->	
</div>

				<div style="clear:both;"></div>		
																										
<p class="comment-form-url"><label for="url">Your Review Title here..<span class="required">*</span></label> <input type="text" size="30" value="" name="url" id="url"></p>
												<p class="comment-form-comment"><label for="comment">Write Your Review here..<span class="required">*</span></label> <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea></p>						<p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; </code></p>						<p class="form-submit">
							<input type="submit" value="Post Review" id="submit" name="submit">
							<input type="hidden" id="comment_post_ID" value="4177" name="comment_post_ID">
<input type="hidden" value="0" id="comment_parent" name="comment_parent">
						</p>
											</form>
							</div><!-- #respond -->
			
</div><!-- #comments -->


</div> 			<!-- /.closeable -->


</div>

<div class="rule"></div>

<h3 style="font-size:25px; text-align:left" class="section-title">Related Products</h3>
<div class="wrapper onecolumn itemclass" style="margin-bottom:40px;">
	
           		
		    <?php 
			
			$relateds = Storeproducts::model()->getrelatedproducts($model->product_id);
			       
				   if(count( $relateds)){
				 
			         foreach( $relateds as  $related){ 
					 
					     $productimage =   Storeproducts::model()->get_image($related->product_id);
						  $productdesc = strip_tags($related->product_overview); 
						  
						  if($related->product_have_variations=='1'){
								   $options = $related->variations;
								   $option_price = '';
									$option_shipping_price = '';
								   if(count($options)){
								   $option = $options[0];
									 $option_price = helpers::to_currency($option->product_price).'<br/>';
								   }
						}else{
						 $option_price = helpers::to_currency($related->product_price);
						} 
					 ?>
					 
					 <div class="sc-column one-fourth">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $productimage; ?>"   class="thumbnailimg"  alt="" />
	<h5 align="center" class="producttitle"><?php echo  helpers::show_minimize($related->product_name,45); ?></h5>
	<h5 align="center"><strong><?php  if($related->product_have_variations=='1'){ ?><i>from</i>&nbsp;<?php } ?><?php echo $option_price; ?></strong></h5>
	<p class="productdesc"><?php echo helpers::show_desc($productdesc ); ?></p>
	<a style="background-color: #CB202D; border-radius:10px;" class="sc-button aligncenter left store-cart" href="<?php echo CHtml::normalizeUrl(array("detail/product/id/".helpers::simple_encrypt($related->product_id))); ?>"><span class="border"><span class="wrap"><span style="color: #ffffff;" class="title">View Details</span></span></span></a>&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/addcarts.gif" class="before-cart-button">&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/grey1.png" >
	</div>
					 
<?php			 }
					} 
			?>
		  
		  
           

</div>




</div>
</div>
<script type="text/javascript">
function number_format(number, decimals, dec_point, thousands_sep) {
    // http://kevin.vanzonneveld.net
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +   improved by: davook
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Jay Klehr
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *    example 10: number_format('1.20', 2);
    // *    returns 10: '1.20'
    // *    example 11: number_format('1.20', 4);
    // *    returns 11: '1.2000'
    // *    example 12: number_format('1.2000', 3);
    // *    returns 12: '1.200'
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
function selectproductoptionprice(pricevalue){
	var pricevaluearr = pricevalue.split('_');
	$('.product_price').html(number_format(pricevaluearr[0], 2, '.', ','));
	$('.product_shipping_price').html(number_format(pricevaluearr[1], 2, '.', ','));
	$('#Cart_itemprice').val(pricevaluearr[0]);
	$('#Cart_itemshippingprice').val(pricevaluearr[1]);
}
</script>