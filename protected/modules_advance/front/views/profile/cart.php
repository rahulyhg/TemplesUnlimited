<div class="wrapper"> 
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	

<div class="sc-column sc-column-last three-fourth-last">
<div class="">
<h3>My Cart</h3>
<div class="rule"></div>
<br>

<?php
$total_array =array();
		for($i=0;$i<count($dataProvider);$i++)
		{
		$products = Storeproducts::model()->findByPK($dataProvider[$i]->product_id); 
		array_push($total_array,$products->product_price);
		}
		
		

?>
<form novalidate="novalidate" class="wpcf7-form" method="post" action="<?php echo Yii::app()->createUrl('front//profile/placeorder'); ?>">
        
 <h3 align="center">Items in your cart</h3>
  <div class="alignleft"><h3 style="color:#2a2a2a">Order total : Rs. <span id="total"><?php echo array_sum($total_array); ?></span></h3></div>
  <div class="alignright"> <a style="background-color: #eeeeee; color: #2a2a2a; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button alignleft light profile-font right" href="<?php echo CHtml::normalizeUrl(array("list/products")); ?>">Shop More</a>   
  <input type="submit" name="submit" id="submit" value="Place Order" class="sc-button alignleft light profile-font right"  style="background-color: #CB202D; color: #fff; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:5px !important;text-decoration: none; transition: color 1s ease 0s;" />  
   </div>
  <input type="hidden" name="total_amount_cart" id="total_amount_cart" value="<?php echo array_sum($total_array); ?>" />

          <div style="clear:both;"></div>
   
     <div class="rule"></div>
     
<div style="border:1px solid #dbdbdb;padding: 5px;">
<?php 

         $ids_string = '';
			for($i=0;$i<count($dataProvider);$i++)
			{
			$products = Storeproducts::model()->findByPK($dataProvider[$i]->product_id); 
			$productimage = Storeproducts::model()->get_image($dataProvider[$i]->product_id);
			?>
			<div class="sc-page">
			<div class="item clearfix payment">
			<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removecart/id/".helpers::simple_encrypt($dataProvider[$i]->cart_id))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
			<div class="image">
			<a href="" class="greyscale">
			<?php echo helpers::view_thumb($productimage,array('alt'=>'Item thumbnail')); ?>
			</a></div><div class="text">
			<div class="title"><h3><a href=""><?php echo $products->product_name; ?></a></h3>
				</div>
			<div class="sc-column one-fourth">
			<div class="left"> 
			<div class="left"><strong>&nbsp;</strong>&nbsp;</div>
			<div class="right"></div>
			</div>	
			<div class="right"></div>		
			</div>
			<div class="sc-column sc-column-last one-third-last right cart-price">
			<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $dataProvider[$i]->product_id;  ?>,<?php echo $products->product_price; ?>)" class="cart-quant" placeholder="1" value="1" id="quantity_<?php echo $dataProvider[$i]->product_id;  ?>" type="text" name="quantity_<?php echo $dataProvider[$i]->product_id;  ?>"></div><div class="right"><p class="right"><strong>Rs. <span id="amount_<?php echo $dataProvider[$i]->product_id;  ?>"><?php echo $products->product_price; ?></span></strong></p></div>
			<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong>Free</strong></div>	
			</div>
			</div></div>
			</div>
			<div class="rule"></div>
		<input type="hidden" name="amount_values_<?php echo $dataProvider[$i]->product_id;  ?>" id="amount_values_<?php echo $dataProvider[$i]->product_id;  ?>"  value="<?php echo $products->product_price; ?>"/>
			<?php   $ids_string .=$dataProvider[$i]->product_id.',';}  ?>
<div style="clear:both;"></div>
</div>
<input type="hidden" name="ids_for_count" id="ids_for_count" value="<?php echo $ids_string; ?>" />

</form>
</div>
</div>
<div style="clear:both;"></div>
</div>


<script>
function chage_amount(quantity,product_id,product_price)
{
if(quantity!='')
{
var amount = parseFloat(product_price);
var total = parseFloat(quantity*amount);

total = total.toFixed(2);    
$('#amount_'+product_id).html(parseFloat(total));

$('#amount_values_'+product_id).val(parseFloat(total));

var ids_values = '<?php echo $ids_string; ?>';

var ids_values = ids_values.split(',');

ids_values = $.grep(ids_values,function(n){ return(n) });

var sum_total = [];
for(i=0;i<ids_values.length;i++)
{
var temp_total = $('#amount_'+ids_values[i]).html();  
  
sum_total.push(temp_total);  
}

var total_sum= 0;
for (i=0;i<sum_total.length;i++)
{
total_sum += parseFloat(sum_total[i]);
}
total_sum = total_sum.toFixed(2); 
$('#total').html(parseFloat(total_sum));
$('#total_amount_cart').val(parseFloat(total_sum));
}
}
</script>


<script type="text/javascript">
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode != 46 && charCode > 31 
&& (charCode < 48 || charCode > 57))
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
			