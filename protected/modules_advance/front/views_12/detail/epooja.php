<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'E-Pooja - '.$model->pooja_name,
);

$this->menu=array(
);

$data = $model;
  $poojaimage = Images::model()->get_image('pooja',$data->pooja_id);
   $poojaimage = ( $poojaimage && count( $poojaimage))?$poojaimage->image_path:'images/index.jpeg';
  $productdesc = $data->pooja_description; 
  $paymentoptions = '';
  if(trim( $data->payment_options) != ''){
  $paymentoptions = implode('; ',unserialize($data->payment_options));
  }
  
  $optionsarray = array();
    if($data->pooja_have_options=='1'){
           $options = $data->poojaoptions;
		   $option_price = '';
		    $option_shipping_price = '';
			
		   if(count($options)){
		   $option = $options[0];
			 $option_price =number_format($option->option_price, 2, '.', ',');
			 $option_shipping_price = number_format($option->option_shipping_price, 2, '.', ',');
			   foreach($options as $poojaoption){
			      $optionsarray[trim($poojaoption->option_price).'_'.trim($poojaoption->option_shipping_price)] = $poojaoption->option_desc;
			   }
		   }
}else{
 $option_price =number_format($data->pooja_price, 2, '.', ',');
  $option_shipping_price =number_format($data->pooja_shipping_price, 2, '.', ',');
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
</style>
<div class="">
<div class="wrapper" style="padding-bottom:25px; padding-top:35px;">
<h3 class="left" style="font-size:30px; text-align:left; font-weight:bold;"><a href="<?php echo CHtml::normalizeUrl(array("detail/pooja/id/".helpers::simple_encrypt($data->pooja_id))); ?>"><?php echo  $data->pooja_name; ?></a></h3>
<a href="<?php echo CHtml::normalizeUrl(array("list/epooja")); ?>" class="sc-button light right" style="background-color: #BFBFBF; color: #fff; font-size:13px; margin-left:5px; border-radius:3px;">Back</a>
</div>
</div>
<div class="wrapper">
<div id="primary">
<div class="entry-content">
		
<div class="sc-column one-half" style="text-align:center">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $poojaimage; ?>" alt="Item thumbnail">
</div>

<div class="item-grid-view sc-column sc-column-last one-half-last">

<h2 class="section-title" style="font-size:25px; text-align:left; margin-top:0px;">
<?php echo Yii::app()->params['currency_symbol']; ?><span class="pooja_price"><?php echo $option_price; ?></span>
</h2>
<div class="sc-column-half" style="margin-bottom:20px; margin-top:-30px;">

<?php
if(count($optionsarray)){
  echo CHtml::dropDownList('pooja_price_options','',$optionsarray,array('style'=>'width:50%; padding:2%','class'=>'left','onchange'=>'selectpoojaoptionprice(this.value)')); 
 }
 ?>

</div>
		<?php 
		$cartmodel = new Cart;
		$cartmodel->itemid = $data->pooja_id;
		$cartmodel->itemtype = 'pooja';
		$cartmodel->itemname = $data->pooja_name;
		$cartmodel->itemcount = 1;
		$cartmodel->itemprice = $option_price;
		$cartmodel->itemshippingprice = $option_shipping_price;
		
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
<?php	echo $form->hiddenField($cartmodel,'itemid',array('required'=>true)); ?>
<?php	echo $form->hiddenField($cartmodel,'itemtype',array('required'=>true)); ?>
<?php	echo $form->hiddenField($cartmodel,'itemname',array('required'=>true)); ?>
<?php	echo $form->hiddenField($cartmodel,'itemprice',array('required'=>true)); ?>
<?php	echo $form->hiddenField($cartmodel,'itemshippingprice',array('required'=>true)); ?>
<?php	echo $form->hiddenField($cartmodel,'itemcount',array('required'=>true)); ?><strong></strong>


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
<br>
<p><strong>Phone Order  :</strong> Call toll-free at <?php echo $model->phone_number; ?><br>
<strong>Payment via : </strong> <?php echo $paymentoptions; ?><br>
<strong>Delivery time : </strong> <?php echo $model->delivery_time_1.' '.$model->delivery_time_1option; ?> (India);<?php echo $model->delivery_time_2.' '.$model->delivery_time_2option; ?> (International)<br>
<strong>Location : </strong> <?php echo $model->pooja_address.', '.$model->poojacity->name.', '.$model->poojastate->state_name; ?><br><br>
<?php if((float)$option_shipping_price>0){ ?>
<span class="pooja_shipping_price_cont"><strong>Note : </strong>Shipping Charges extra <?php echo Yii::app()->params['currency_symbol']; ?> <span class="pooja_shipping_price"><?php echo $option_shipping_price; ?></span></span>
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
                <?php echo $model->pooja_overview; ?>
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
<div class=" section-best-places wrapper" style="margin-bottom:20px;">
<div class="best-places-wrap">
          <ul class="items items-grid-view clearfix onecolumn">
		    <?php 
			
			$relateds = Pooja::model()->getrelatedproducts($model->pooja_id);
			       
				   if(count( $relateds)){
				 
			         foreach( $relateds as  $related){ 
					 
					     $poojaimage = Images::model()->get_image('pooja',$related->pooja_id);
						   $poojaimage = ( $poojaimage && count( $poojaimage))?$poojaimage->image_path:'images/index.jpeg';
						  $productdesc = $related->pooja_description; 
						  
						  if($related->pooja_have_options=='1'){
								   $options = $related->poojaoptions;
								   $option_price = '';
									$option_shipping_price = '';
								   if(count($options)){
								   $option = $options[0];
									 $option_price = helpers::to_currency($option->option_price).'<br/>';
								   }
						}else{
						 $option_price = helpers::to_currency($related->pooja_price);
						} 
					 ?>
					 
					  <li class="item clearfix sc-column one-fourth administrator">
              <div class="item-thumbnail"> <a href="<?php echo CHtml::normalizeUrl(array("detail/pooja/id/".helpers::simple_encrypt($related->pooja_id))); ?>"><img alt="Item thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $poojaimage; ?>"   class="thumbnailimg"></a> </div>
              <h3 class="item-title producttitle"><a href="<?php echo CHtml::normalizeUrl(array("detail/pooja/id/".helpers::simple_encrypt($related->pooja_id))); ?>"><?php echo  helpers::show_minimize($related->pooja_name,45); ?></a></h3>
              <div class="item-address-wrapper">
                <!--<div class="item-address-pin"></div>-->
                <p class="productdesc"> <?php echo helpers::show_desc($productdesc ); ?></p>
                
                <h5 class="item-title"><?php  if($related->pooja_have_options=='1'){ ?><i>from</i>&nbsp;<?php } ?><?php echo $option_price; ?></h5>
              </div>
              
              <div class="item-rating rating-grey">
				  
                <div class="item-stars clearfix"> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> </div>
              </div>
       </li>
<?php			 }
					} 
			?>
		  
		  
           
            <div class="clearfix"></div>
          </ul>
        </div>
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
function selectpoojaoptionprice(pricevalue){
	var pricevaluearr = pricevalue.split('_');
	$('.pooja_price').html(number_format(pricevaluearr[0], 2, '.', ','));
	$('.pooja_shipping_price').html(number_format(pricevaluearr[1], 2, '.', ','));
	$('#Cart_itemprice').val(pricevaluearr[0]);
	$('#Cart_itemshippingprice').val(pricevaluearr[1]);
}
</script>