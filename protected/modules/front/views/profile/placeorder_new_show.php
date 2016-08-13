<div class="rule"></div>
<p><strong>Your Order Details - <?php  echo count(Yii::app()->session['cart']); ?> item(s)</strong></p>
<div class="sc-column sc-column-last three-fourth-last">
<div class="">

<?php


	if(isset(Yii::app()->session['cart']))
	{
	$totalamount =  array();
	foreach(Yii::app()->session['cart'] as $key=>$cart)
	{
	 $totalamount[] =  $cart['amount']; 
	 $totalamount[] =  $cart['shipping_amount']; 
	}
	}
	$sum_amount = array_sum($totalamount);
?>

<form novalidate="novalidate" class="wpcf7-form" method="post" id="cartpage" action="<?php echo Yii::app()->createUrl('front/profile/placeorder'); ?>">


	
	<div style="clear:both;"></div>
	
	<div class="rule"></div>
	
	<div style="border:0px solid #dbdbdb;padding: 5px;">
	
	<?php 


	if(isset(Yii::app()->session['cart']))
    {
	$ids_string = '';
	foreach(Yii::app()->session['cart'] as $key=>$cart)
	{
	$products = Storeproducts::model()->findByPK($cart['product_id']); 
	$productimage = Storeproducts::model()->getinfo($cart['product_id']);		
	?>
	<div class="sc-page">
	<div class="item clearfix payment">
	<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removesession/id/".helpers::simple_encrypt($cart['product_id']))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
	<div class="image">
	<a href="<?php echo CHtml::normalizeUrl(array("/front/detail/storeold/id/".helpers::simple_encrypt($cart['product_id']))); ?>" ><img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/listpage/'.$productimage->product_image; ?>"  alt="Product image" class="attachment-thumbnail wp-post-image" width="150" height="150" /></a></div><div class="text">
	<div class="title"><h3><a href="<?php echo CHtml::normalizeUrl(array("/front/detail/storeold/id/".helpers::simple_encrypt($cart['product_id']))); ?>"><?php echo $products->product_name; ?></a></h3>
	
	</div>
	<div class="sc-column one-fourth">
	
	<div class="left"> 
	<div class="left"><strong>&nbsp;</strong>&nbsp;</div>
	<div class="right"></div>
	</div>	
	<div class="right"></div>		
	
	</div>
	
	<div class="sc-column sc-column-last one-third-last right cart-price">
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $cart['product_id'];  ?>,<?php echo $cart['amount']; ?>)" class="cart-quant" value=" <?php echo $_POST['quantity_'.$cart['product_id']] ?>" placeholder="1" value="1" disabled="disabled" id="quantity_<?php echo $cart['product_id'];  ?>" type="text" name="quantity_<?php echo $cart['product_id'];  ?>">
			

			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['product_id'];  ?>"><?php echo helpers::to_currency($_POST['amount_values_'.$cart['product_id']]).".00"; ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($_POST['amount_shipping_values_'.$cart['product_id']]!='0')?helpers::to_currency($_POST['amount_shipping_values_'.$cart['product_id']]):'Free'; ?></strong></div>	
	</div>
	
	</div></div>
	
	</div>
	
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['product_id'];  ?>" id="amount_shipping_values_<?php echo $cart['product_id'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
	
			
		<input type="hidden" name="amount_values_<?php echo  $cart['product_id'];  ?>" id="amount_values_<?php echo  $cart['product_id'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
		
			<div class="rule"></div>
	
	<?php $ids_string .=$cart['product_id'].',';  } }else{ ?> <p style="text-align:center; font-size:12px; padding:10px;">No products found</p> <?php } ?>
	
	
	<input type="hidden" name="ids_for_count" id="ids_for_count" value="<?php echo $ids_string; ?>" />

<input type="hidden" name="total_amount_cart" id="total_amount_cart" />


<div style="margin-bottom:20px;">
					
					<div class="sc-column sc-column-last one-third-last right cart-price">
					<div class="left"> <strong>Grand Total :</strong> </div>
					<div class="right">
					<strong><span id="total">&nbsp;<?php echo helpers::to_currency( $_POST['total_amount_cart']); ?></span></strong></div>
					</div>
					
					<br />	
					<br />
					<br />
					<a style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button alignright light profile-font right" href="<?php echo CHtml::normalizeUrl(array("/front/profile/securepayment"));  ?>" onclick="imagecheckwith();" id="share1">Proceed to Pay</a>	
					
					</div>
					
	
	</div>
</form>

</div>
<div style="clear:both;"></div>

</div>

    <div class="right"></div> 
<div class="clearing"></div><br>

</div>
        

 </div>


</div>
</div>
<div id="canvas" style="display:none;"></div>


<script language="javascript">

$(document).ready(function() {
 html2canvas([document.getElementById('testdiv')], {
 
onrendered: function (canvas) {
document.getElementById('canvas').appendChild(canvas);

var data = canvas.toDataURL("image/png");

var newsrc = "<?php echo Yii::app()->request->baseUrl; ?>/uploads/image.png"; 


 $.ajax({
type:"POST",
url : '<?php echo CController::CreateUrl('/front/profile/imagesave'); ?>',
data:{
imgBase64:data
},


});

}
});
});
</script>

<script>
function updateaddress()
{

 var address  =  $('#delivery_address').val()
  $.ajax({
              url :'<?php echo $this->createUrl('profile/addressupdate'); ?>',
              type : "post",
              data : "address="+address,
              success:function(data)
              {
			    $('#address_show').html(data);
				$('#address_div').hide();
			  } 
     });
}

</script>
