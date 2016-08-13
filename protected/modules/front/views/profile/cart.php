<div class="wrapper" style=" margin-bottom:10%;"> 
<!-----one-third------->

<?php if(Yii::app()->user->isGuest){   ?>
 
<?php $this->renderPartial('nonprofile'); ?>	

<?php }else {  ?> 
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	

<?php } ?>


<div class="sc-column sc-column-last three-fourth-last"  >
<div class="" style="margin-bottom:10%;">
<h3>My Cart</h3>
<div class="rule"></div>
<br>

<?php if(Yii::app()->user->hasFlash('itemdelete')){ ?>
<div class="flashmessage success flashmessage-review">
<button class="close" data-dismiss="alert">X</button>
<p><?php echo Yii::app()->user->getFlash('itemdelete'); ?></p>
</div>
<?php } ?>
				
<?php if(Yii::app()->user->hasFlash('success')){ ?>
<div class="flashmessage success flashmessage-review">
<button class="close" data-dismiss="alert">X</button>
<p><?php echo Yii::app()->user->getFlash('success'); ?></p>
</div>
<?php } ?>			

<?php


			if(isset(Yii::app()->session['cart']))
			{
			$new_string =0;
			
			foreach(Yii::app()->session['cart'] as $key=>$cart)
			if(isset($cart['cart_type']) &&  $cart['cart_type']!='') { $new_string =1; };
			
			$totalamount =  array();
			foreach(Yii::app()->session['cart'] as $key=>$cart)
			{
			if(isset($cart['cart_type']) &&  $cart['cart_type']!='') {  
			$totalamount[] =  $cart['amount']; 
			$totalamount[] =  $cart['shipping_amount'];
			}
			else
			{
			if ($new_string==1) continue;
			$totalamount[] =  $cart['amount']; 
			$totalamount[] =  $cart['shipping_amount'];
			} 
			}
			$sum_amount = array_sum($totalamount);
			}
	
?>

<form novalidate="novalidate" class="wpcf7-form" method="post" id="cartpage" action="<?php echo Yii::app()->createUrl('front/profile/placeorder'); ?>">

	<h3 align="center">Items in your cart</h3>
	<?php if(isset(Yii::app()->session['cart']))
	{?>
	<div class="alignleft"><h3 style="color:#2a2a2a">Order total : <span id="total"><?php echo helpers::to_currency($sum_amount).".00"; ?></span></h3></div> <?php } else { ?>
	
	<div class="alignleft"><h3 style="color:#2a2a2a">Order total : <?php echo helpers::to_currency(0).".00"; ?></span></h3></div>
	
	<?php } ?>
	<div class="alignright"> <a style="background-color: #eeeeee; color: #2a2a2a; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button alignleft light profile-font right" href="<?php echo CHtml::normalizeUrl(array("list/products")); ?>">Shop More</a>  
    
	<?php
	if(count(Yii::app()->session['cart'])>0)
	{  ?>  
	<a  style="background-color: #CB202D; color: #fff; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px;cursor: pointer;" class="sc-button alignleft light profile-font right"  onclick="$('#cartpage').submit();">Place Order</a></div>
	<?php } else { ?>
		<a  style="background-color: #CB202D; color: #fff; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px;cursor: none;" class="sc-button alignleft light profile-font right" >Place Order</a></div>
	<?php } ?>
	
	
	<div style="clear:both;"></div>
	
	<div class="rule"></div>
	
	<div style="border:1px solid #dbdbdb;padding: 5px;">
	
	<?php 
   
	if(isset(Yii::app()->session['cart']) && count(Yii::app()->session['cart'])>0)
    {
	$ids_string = '';
	
	foreach(Yii::app()->session['cart'] as $key=>$cart)
	{
	
	if(isset($cart['cart_type']) &&  $cart['cart_type']!='') { 

	if($cart['type']=='product')
	{
	$products = Storeproducts::model ()->findByPK($cart['product_id']); 
	$productimage = Storeproducts::model()->getinfo($cart['product_id']);
	
	?>
	<input type="hidden" name="type" id="type" value="product" />
	
	<div class="sc-page">
	<div class="item clearfix payment">
	<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removesession/id/".helpers::simple_encrypt($cart['variations']))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
	<div class="image">
	<a href="<?php echo CHtml::normalizeUrl(array("/front/detail/storeold/id/".helpers::simple_encrypt($cart['product_id']))); ?>" ><img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/listpage/'.$productimage->product_image; ?>"  alt="Product image" class="attachment-thumbnail wp-post-image" /></a></div><div class="text">
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
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,'<?php echo $cart['variations'];  ?>',<?php echo $cart['amount']; ?>)" class="cart-quant" placeholder="1"  value="1" id="quantity_<?php echo $cart['variations'];  ?>" type="text" name="quantity_<?php echo $cart['variations'];  ?>">
			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['variations'];  ?>"><?php echo helpers::to_currency($cart['amount']).".00"; ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></strong></div>	
	</div>
	</div></div>
	</div>
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['variations'];  ?>" id="amount_shipping_values_<?php echo $cart['variations'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
	<input type="hidden" name="amount_values_<?php echo  $cart['variations'];  ?>" id="amount_values_<?php echo  $cart['variations'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
	<?php $ids_string .= $cart['variations'].',';  $ids_string1 =$cart['product_id'].',';  
	
	}
	else if($cart['type']=='pooja')
	{
	$products = Pooja::model ()->findByPK($cart['product_id']); 
	$productimage = Pooja::model()->getinfo($cart['product_id']);	
	?>
	<input type="hidden" name="type" id="type" value="pooja" />
	<div class="sc-page">
	<div class="item clearfix payment">
	<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removesession/id/".helpers::simple_encrypt($cart['variations']))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
	<div class="image">
	<a href="<?php echo CHtml::normalizeUrl(array("/front/detail/poojaold/id/".helpers::simple_encrypt($cart['product_id']))); ?>" ><img src="<?php echo Yii::app()->request->baseUrl.'/uploads/pooja/listpage/'.$productimage->pooja_image; ?>"  alt="Product image" class="attachment-thumbnail wp-post-image" /></a></div><div class="text">
	<div class="title"><h3><a href="<?php echo CHtml::normalizeUrl(array("/front/detail/poojaold/id/".helpers::simple_encrypt($cart['product_id']))); ?>"><?php echo $products->pooja_name; ?></a></h3>
	</div>
	<div class="sc-column one-fourth">
	<div class="left"> 
	<div class="left"><strong>&nbsp;</strong>&nbsp;</div>
	<div class="right"></div>
	</div>	
	<div class="right"></div>		
	</div>
	<div class="sc-column sc-column-last one-third-last right cart-price">
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,'<?php echo $cart['variations'];  ?>',<?php echo $cart['amount']; ?>)" class="cart-quant" placeholder="1"  value="1" id="quantity_<?php echo $cart['variations'];  ?>" type="text" name="quantity_<?php echo $cart['variations'];  ?>">
			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['variations'];  ?>"><?php echo helpers::to_currency($cart['amount']); ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></strong></div>	
	</div>
	</div></div>
	</div>
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['variations'];  ?>" id="amount_shipping_values_<?php echo $cart['variations'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
	<input type="hidden" name="amount_values_<?php echo  $cart['variations'];  ?>" id="amount_values_<?php echo  $cart['variations'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
	<?php $ids_string .= $cart['variations'].',';  $ids_string1 =$cart['product_id'].',';  
	}
	else
	{
	 
	}
	

	}else{
	
	if ($new_string==1) continue;
	
	$products = Storeproducts::model ()->findByPK($cart['product_id']); 
	$productimage = Storeproducts::model()->getinfo($cart['product_id']);
	?>
	<div class="sc-page">
	<div class="item clearfix payment">
	<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removesession/id/".helpers::simple_encrypt($cart['variations']))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
	<div class="image">
	<a href="<?php echo CHtml::normalizeUrl(array("/front/detail/storeold/id/".helpers::simple_encrypt($cart['product_id']))); ?>" ><img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/listpage/'.$productimage->product_image; ?>"  alt="Product image" class="attachment-thumbnail wp-post-image" /></a></div><div class="text">
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
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,'<?php echo $cart['variations'];  ?>',<?php echo $cart['amount']; ?>)" class="cart-quant" placeholder="1"  value="1" id="quantity_<?php echo $cart['variations'];  ?>" type="text" name="quantity_<?php echo $cart['variations'];  ?>">
			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['variations'];  ?>"><?php echo helpers::to_currency($cart['amount']).".00"; ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></strong></div>	
	</div>
	</div></div>
	</div>
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['variations'];  ?>" id="amount_shipping_values_<?php echo $cart['variations'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
	<input type="hidden" name="amount_values_<?php echo  $cart['variations'];  ?>" id="amount_values_<?php echo  $cart['variations'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
	<?php $ids_string .= $cart['variations'].',';  $ids_string1 =$cart['product_id'].',';  
	
	 }
	
	
	
	
	 } }else{   ?> <p style="text-align:center; font-size:13px; padding:10px; font-weight:bold;"><b>Your cart is empty.</b></p> <?php } ?>
	
	
	

   <input type="hidden" name="total_amount_cart" id="total_amount_cart" value="<?php echo (isset($sum_amount))?$sum_amount:'0'; ?>" />
	
	<?php 
		if(isset(Yii::app()->session['cart']))
		{
		if(count(Yii::app()->session['cart'])>0)
		{
		?>
	<input type="hidden" name="ids_for_count" id="ids_for_count" value="<?php echo $ids_string; ?>" />
	 <?php } }else  $ids_string ='';  ?>
	</div>
</form>



</div>

</div>

<div style="clear:both;"></div>
</div>





<script>
function chage_amount(quantity,product_id,product_price)
{
if(quantity =='0')
{
  quantity  ='1' ;
 $('#quantity_'+product_id).val(quantity);
}
if(quantity!='')
{
var amount = parseFloat(product_price);
var total = parseFloat(quantity*amount);

total = total.toFixed(2);  

$('#amount_'+product_id).html("Rs "+total);

$('#amount_values_'+product_id).val(parseFloat(total));




<?php 
if(isset(Yii::app()->session['cart']))
{
if(count(Yii::app()->session['cart'])>0)
{
?>

var ids_values = '<?php echo $ids_string; ?>';

var ids_values = ids_values.split(',');

ids_values = $.grep(ids_values,function(n){ return(n) });

var sum_total = [];

for(i=0;i<ids_values.length;i++)
{
var temp_total =    $('#amount_values_'+ids_values[i]).val();
 
var temp_shipping_total =    $('#amount_shipping_values_'+ids_values[i]).val();  

sum_total.push(temp_total);

sum_total.push(temp_shipping_total);
}

var total_sum= 0;

for (i=0;i<sum_total.length;i++)
{
total_sum += parseFloat(sum_total[i]);
}
total_sum = total_sum.toFixed(2); 


$('#total').html("&nbsp;Rs "+total_sum);
$('#total_amount_cart').val(parseFloat(total_sum));
<?php } }?>

}
}

</script>


<script type="text/javascript">

 function isNumberKey(e) {           
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }

            if (charCode == 46)
                return false;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
}

</script>

<style>
.payment {
    background: none repeat scroll 0 0 #f4f4f4 !important;
    margin-bottom: 20px;
    padding: 0;
}
</style>
			
