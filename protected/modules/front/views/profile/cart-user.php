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
		
		            if($products->product_have_variations=='1'){ 
					$options = $products->variations;
					
					$option_price = '';
					$option_shipping_price = '';
					
					if(count($options)){
					$option = $options[0];
					$option_price = $option->product_price;
					$option_shipping_price =  $option->product_shipping_price;
					}
					}else{
					$option_price = $products->product_price;
					$option_shipping_price = $products->product_shipping_price;
					}
					
		
		array_push($total_array,$option_price);
		
		array_push($total_array,$option_shipping_price);
		}
		

		$total_amount__array = array_sum($total_array);
		
		

?>
<form novalidate="novalidate" class="wpcf7-form" method="post" action="<?php echo Yii::app()->createUrl('front/profile/placeorder'); ?>">
        
 <h3 align="center">Items in your cart</h3>
  <div class="alignleft"><h3 style="color:#2a2a2a">Order total :<span id="total">&nbsp;<?php echo helpers::to_currency($total_amount__array).".00"; ?></span></h3></div>
  
  <div class="alignright"> <a style="background-color: #eeeeee; color: #2a2a2a; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button alignleft light profile-font right" href="<?php echo CHtml::normalizeUrl(array("list/products")); ?>">Shop More</a>
  
  <?php if(count($dataProvider)>0){ ?>  
  
  	  <input type="submit" name="submit" id="submit" value="Place Order" class="sc-button alignleft light profile-font"  style="background-color: #CB202D; color: #fff; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:5px !important;text-decoration: none; transition: color 1s ease 0s;"  /> 
	  
	  <?php } else { ?>
		<a  style="background-color: #CB202D; color: #fff; width: 130px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" class="sc-button alignleft light profile-font right" href="javascript:void(0);">Place Order</a></div>
	<?php } ?>
			
   </div>


          <div style="clear:both;"></div>
   
     <div class="rule"></div>
     
<div style="border:1px solid #dbdbdb;padding: 5px; padding-bottom:30px;">
<?php 

           $ids_string = '';
		    if(count($dataProvider)>0)
			{
			for($i=0;$i<count($dataProvider);$i++)
			{
			$products = Storeproducts::model()->findByPK($dataProvider[$i]->product_id); 
			$productimage = Storeproducts::model()->getinfo($dataProvider[$i]->product_id);
			
		//	echo  $amount_price = $products->product_price;
			
			
					if($products->product_have_variations=='1'){ 
					$options = $products->variations;
					
					$option_price = '';
					$option_shipping_price = '';
					
					if(count($options)){
					$option = $options[0];
					$option_price = helpers::to_currency($option->product_price);
					$option_shipping_price =  helpers::to_currency($option->product_shipping_price);
					
					$pure_amount =  floor($option->product_price);
					$pure_shipping_amount =  floor($option->product_shipping_price);
					}
					}else{
					$option_price = helpers::to_currency($products->product_price);
					$option_shipping_price =  helpers::to_currency($products->product_shipping_price);
					
					$pure_amount =  floor($products->product_price);
					
					$pure_shipping_amount =  floor($products->product_shipping_price);
					}
			?>
			<div class="sc-page">
			<div class="item clearfix payment">
			<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removecart/id/".helpers::simple_encrypt($dataProvider[$i]->cart_id))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
			<div class="image">
			<a href="<?php echo CHtml::normalizeUrl(array("/front/detail/storeold/id/".helpers::simple_encrypt($dataProvider[$i]->product_id))); ?>" class="greyscale">
			<img src="<?php echo Yii::app()->request->baseUrl.'/uploads/store/'.$productimage->product_image; ?>"  alt="Product image" class="attachment-thumbnail wp-post-image" width="150" height="150" />
			</a></div><div class="text">
			<div class="title"><h3><a href="<?php echo CHtml::normalizeUrl(array("/front/detail/storeold/id/".helpers::simple_encrypt($dataProvider[$i]->product_id))); ?>"><?php echo $products->product_name; ?></a></h3>
				</div>
			<div class="sc-column one-fourth">
			<div class="left"> 
			<div class="left"><strong>&nbsp;</strong>&nbsp;</div>
			<div class="right"></div>
			</div>	
			<div class="right"></div>		
			</div>
			<div class="sc-column sc-column-last one-third-last right cart-price">
			<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $dataProvider[$i]->product_id;  ?>,<?php echo $pure_amount; ?>)" class="cart-quant" placeholder="1" value="1" id="quantity_<?php echo $dataProvider[$i]->product_id;  ?>" type="text" name="quantity_<?php echo $dataProvider[$i]->product_id;  ?>">
			
			
			
			<!--<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $dataProvider[$i]->product_id;  ?>,<?php echo $pure_amount; ?>)" class="cart-quant" placeholder="1" value="1" id="quantity_<?php echo $dataProvider[$i]->product_id;  ?>" type="text" name="quantity_<?php echo $dataProvider[$i]->product_id;  ?>">-->
			
			
			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $dataProvider[$i]->product_id;  ?>"><?php echo $option_price; ?></span></strong></p></div>
			<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($option_shipping_price!='Rs 0.00')?$option_shipping_price:'Free'; ?></strong></div>	
			</div>
			</div></div>
			</div>
			
	
			<div class="rule"></div>
			
			
			<input type="hidden" name="amount_shipping_values_<?php echo $dataProvider[$i]->product_id;  ?>" id="amount_shipping_values_<?php echo $dataProvider[$i]->product_id;  ?>" value="<?php echo $pure_shipping_amount; ?>" />
	
			
		<input type="hidden" name="amount_values_<?php echo $dataProvider[$i]->product_id;  ?>" id="amount_values_<?php echo $dataProvider[$i]->product_id;  ?>"  value="<?php echo $pure_amount; ?>"/>
			<?php   $ids_string .=$dataProvider[$i]->product_id.',';} }else{ ?> <p style="text-align:center; font-size:13px; padding:10px; font-weight:bold;">Your cart is empty</p> <?php } ?>
			
			<div style="margin-bottom:20px;">
			
		

	</div>		
			
 
  
  
  			
<div style="clear:both;"></div>
</div>


<input type="hidden" name="ids_for_count" id="ids_for_count" value="<?php echo $ids_string; ?>" />

<input type="hidden" name="total_amount_cart" id="total_amount_cart" value="<?php echo $total_amount__array; ?>" />
  
  

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

$('#amount_'+product_id).html("Rs "+total);

$('#amount_values_'+product_id).val(parseFloat(total));

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
              if (charCode == 46 || charCode == 48)
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
			
