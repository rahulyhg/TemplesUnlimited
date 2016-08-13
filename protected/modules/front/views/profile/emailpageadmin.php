<?php
if(isset(Yii::app()->session['nonsite']))
{
$nonsite = Yii::app()->session['nonsite'];

$name = ($nonsite['name']!='')?$nonsite['name']:'';

$localaddress = ($nonsite['address']!='')?$nonsite['address']:'';

$city = ($nonsite['city']!='')?$nonsite['city']:'';	

$state = ($nonsite['state']!='')?$nonsite['state']:'';

$country = ($nonsite['country']!='')?$nonsite['country']:'';

$postal_code = ($nonsite['postal_code']!='')?$nonsite['postal_code']:'';

$address =  $localaddress.',<br>'.$city.'-'.$postal_code.',<br>'.$state.',<br>'.$country;

}
else
{
$model=Profile::model()->findByPk(Yii::app()->user->id);
$user_details = Userdetails::model()->findByAttributes(array('user_id'=>$model->user_id));
$name =  $model->first_name."  ".$model->last_name; 

$resitance = $user_details->usercity->name.',<br/>'.$user_details->userstate->state_name.',<br/> '.$user_details->usercountry->country.'.';  

if($user_details->delivery_address=='')
$address =  $user_details->address.',<br>'.$resitance;
else
$address =  $user_details->delivery_address;

$phone =  $user_details->phone; 

}

$FromName = helpers::configs()->company_name;	



if(isset(Yii::app()->session['cart1']))
{
	if(isset(Yii::app()->session['cart1']))
	{
	$totalamount =  array();
	foreach(Yii::app()->session['cart1']['products'] as $key=>$cart1)
	{
	$totalamount[] =  $cart1['amount']; 
	$totalamount[] =  $cart1['shipping_amount']; 
	}
	$sum_amount = array_sum($totalamount);
	}
?>
<div class="sc-column sc-column-last three-fourth-last">
<p>
<p>Hi&nbsp; Admin &nbsp;<?php echo $FromName.','; ?></p>
<p>You have received new order from <?php echo $name; ?></p>
<p>Please find below the order summary.</p>
<!--<strong>Your Order Details - <?php //echo count(Yii::app()->session['cart']); ?> item(s)</strong></p>-->
<div class="rule" style="border-bottom: 1px solid #000 !important; display: inline-block; height: 6px; margin: 0 0 20px; width: 100%;">
&nbsp;</div>
<div>
<?php 
if(isset(Yii::app()->session['cart1']))
{
foreach(Yii::app()->session['cart1']['products'] as $key=>$cart)
{
$products = Storeproducts::model()->findByPK($cart['product_id']); 
$productimage = Storeproducts::model()->getinfo($cart['product_id']);	
?>
<div style=" float:left; width:100%; height:auto;">
<div class="sc-page" style="float:left; width:100%;">
<div class="item clearfix payment">
<div class="image" style="float:left;">
<img alt="Product image" class="attachment-thumbnail wp-post-image"  src="<?php echo Yii::app()->getBaseUrl(true).'/uploads/store/'.$productimage->product_image; ?>"  width="100" height="100" /></div>
<div class="text">
<div class="title">
<h3>
<a href="javascript:void(0)" style="font-size: 21px; margin: 0 0 12px; line-height: 1.3; color: #cb202d;"><?php echo $products->product_name; ?></a></h3>
</div>
<div class="sc-column one-fourth">
<div class="left" style="float:left;">
<div class="left" style="float:left;">
<strong>&nbsp;</strong></div>
</div>
</div>
<div class="sc-column sc-column-last one-third-last right cart-price" style="float:right;">
<div class="left" style="float:left;">
Qty :<input class="cart-quant" disabled="disabled" value="<?php echo $cart['quantity'];  ?>" id="quantity_4" name="quantity_4" style="padding:1%; width:20%;margin-top: -22px;" type="text"  />
<div style="float:right;"><?php echo helpers::to_currency($cart['amount']).".00"; ?></div></div>
<br /><br />
<div class="left" style="float: left; width: 100%;">
Shipping Charges :
<div style="float:right;"><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></div></div>
</div>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div style="height:10px; border-bottom:1px solid;"></div>
<div style="clear:both;"></div>
<?php }  }?>
<div class="sc-column sc-column-last one-third-last right cart-price" style="float:right;">
<div class="left" style="float:left;"> <strong>Grand Total :</strong> </div>
<div class="right" style="float:right;">
<strong><span id="total">&nbsp;<?php echo helpers::to_currency($sum_amount.".00"); ?></span></strong></div>
</div>
</div>
</div>
</div>

<div style="margin-top:30px;">
<p><strong> DELIVERY ADDRESS</strong></p>
<p> <?php echo $name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$phone; ?> </p>
<p><?php echo $address; ?></p> 
</div>

<?php
}
else if(isset(Yii::app()->session['cart2']))
{
if(isset(Yii::app()->session['cart2']))
{
$totalamount =  array();
foreach(Yii::app()->session['cart2']['booknow'] as $key=>$cart1)
{
 $totalamount[] =  $cart1['amount']; 
 $totalamount[] =  $cart1['shipping_amount']; 
}
$sum_amount = array_sum($totalamount);
}


?>
<div class="sc-column sc-column-last three-fourth-last">
<p>
<p>Hi&nbsp; Admin&nbsp; <?php echo $FromName.','; ?></p>
<p>You have received new order from <?php echo $name; ?></p>
<p>Please find below the order summary.</p>

<!--<strong>Your Order Details - <?php //echo count(Yii::app()->session['cart']); ?> item(s)</strong></p>-->
<div class="rule" style="border-bottom: 1px solid #000 !important; display: inline-block; height: 6px; margin: 0 0 20px; width: 100%;">
&nbsp;</div>
<div>
<?php 
if(isset(Yii::app()->session['cart2']))
{
foreach(Yii::app()->session['cart2']['booknow'] as $key=>$cart)
{
 if($cart['type']=='product')
 {
 
   $products = Storeproducts::model()->findByPK($cart['product_id']); 
   $productimage = Storeproducts::model()->getinfo($cart['product_id']);
   $image = Yii::app()->getBaseUrl(true).'/uploads/store/listpage/'.$productimage->product_image;
   $product_name = $products->product_name;
    
 }
 else if($cart['type']=='pooja')
 {
 	$products = Pooja::model ()->findByPK($cart['product_id']); 
	$productimage = Pooja::model()->getinfo($cart['product_id']);
    $image = Yii::app()->getBaseUrl(true).'/uploads/pooja/listpage/'.$productimage->pooja_image;;
    $product_name = $products->pooja_name;
 }
 else
 {
 
 }
?>
<div style=" float:left; width:100%; height:auto;">
<div class="sc-page" style="float:left; width:100%;">
<div class="item clearfix payment">
<div class="image" style="float:left;">
<img alt="Product image" class="attachment-thumbnail wp-post-image"  src="<?php echo $image; ?>"  width="100" height="100" /></div>
<div class="text">
<div class="title">
<h3>
<a href="javascript:void(0)" style="font-size: 21px; margin: 0 0 12px; line-height: 1.3; color: #cb202d;"><?php  echo $product_name;  ?></a></h3>
</div>
<div class="sc-column one-fourth">
<div class="left" style="float:left;">
<div class="left" style="float:left;">
<strong>&nbsp;</strong></div>
</div>
</div>
<div class="sc-column sc-column-last one-third-last right cart-price" style="float:right;">
<div class="left" style="float:left;">
Qty :<input class="cart-quant" disabled="disabled" value="<?php echo $cart['quantity'];  ?>" id="quantity_4" name="quantity_4" style="padding:1%; width:20%;margin-top: -22px;" type="text"  />
<div style="float:right;"><?php echo helpers::to_currency($cart['amount']).".00"; ?></div></div>
<br /><br />
<div class="left" style="float: left; width: 100%;">
Shipping Charges :
<div style="float:right;"><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></div></div>
</div>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div style="height:10px; border-bottom:1px solid;"></div>
<div style="clear:both;"></div>
<?php }  }?>
<div class="sc-column sc-column-last one-third-last right cart-price" style="float:right;">
<div class="left" style="float:left;"> <strong>Grand Total :</strong> </div>
<div class="right" style="float:right;">
<strong><span id="total">&nbsp;<?php echo helpers::to_currency($sum_amount.".00"); ?></span></strong></div>
</div>
</div>
</div>
</div>

<div  style="margin-top:30px;">
<p><strong> DELIVERY ADDRESS</strong></p>
<p> <?php echo $name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$phone; ?> </p>
<p><?php echo $address; ?></p>
</div>
<?php
}

else {/*

$model=Profile::model()->findByPk(Yii::app()->user->id);

$user_details = Userdetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

$dataProvider = MyCart::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id),array('condition' => 'order_id = 0'));


	if($user_details->city!='0')
	$city_fieldval =  $detailsmodel->usercity->name;
	else
	$city_fieldval ='';
	
	if($user_details->state!='0')
	$state_fieldval = $detailsmodel->userstate->state_name;
	else
	$state_fieldval ='';
	
	if($user_details->country!='0')
	$country_fieldval =  $detailsmodel->usercountry->country;
	else
	$country_fieldval ='';
			
?>

<div class="sc-column sc-column-last three-fourth-last">
<h3 style="font-size: 21px; margin: 0 0 12px; line-height: 1.3; color: #cb202d;">
My Cart - Place Order</h3>
<div class="rule" style="border-bottom: 1px solid #000 !important; display: inline-block; height: 6px; margin: 0 0 20px; width: 100%;">
&nbsp;</div>
<p>

<p><Strong><?php echo $model->first_name."  ".$model->last_name; ?></Strong></p>


<p style="width:250px;" id="address_show"><?php echo ($dataProvider[0]->address!='')?$dataProvider[0]->address:$user_details->address.'<br/>'.$city_fieldval.','.$state_fieldval.','.$country_fieldval; ?></p> 

<strong>Your Order Details - <?php echo count($dataProvider); ?> item(s)</strong></p>
<div class="rule" style="border-bottom: 1px solid #000 !important; display: inline-block; height: 6px; margin: 0 0 20px; width: 100%;">
&nbsp;</div>
<div>



<?php 

$ids_string = '';

if(count($dataProvider)>0)
{
for($i=0;$i<count($dataProvider);$i++)
{
$products = Storeproducts::model()->findByPK($dataProvider[$i]->product_id); 
$productimage = Storeproducts::model()->getinfo($dataProvider[$i]->product_id);


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

<div style="float:left; width:100%; height:auto;">
<div class="sc-page" style="float:left; width:100%;">
<div class="item clearfix payment">
<div class="image" style="float:left;">
<img alt="Product image" class="attachment-thumbnail wp-post-image" height="150" src="<?php echo Yii::app()->getBaseUrl(true).'/uploads/store/'.$productimage->product_image; ?>" width="150" /></div>
<div class="text">
<div class="title">
<h3>
<a href="javascript:void(0)" style="font-size: 21px; margin: 0 0 12px; line-height: 1.3; color: #cb202d;"><?php echo $products->product_name; ?></a></h3>
</div>
<div class="sc-column one-fourth">
<div class="left" style="float:left;">
<div class="left" style="float:left;">
<strong>&nbsp;</strong></div>
</div>
</div>
<div class="sc-column sc-column-last one-third-last right cart-price" style="float:right;">
<div class="left" style="float:left;">
Qty :<input class="cart-quant" disabled="disabled" value="<?php echo  $dataProvider[$i]->quantity; ?>" id="quantity_4" name="quantity_4" style="padding:1%; width:20%;margin-top: -22px;" type="text"  />

<div style="float:right;"><?php  echo  helpers::to_currency($dataProvider[$i]->amount); ?></div></div>

<br /><br />

<div class="left" style="float: left; width: 100%;">
Shipping Charges :

<div style="float:right;"><?php echo ($dataProvider[$i]->shipping_amount!='0.00')?$dataProvider[$i]->shipping_amount:'Free'; ?></div></div>



</div>
</div>
</div>
</div>

<div style="clear:both;"></div>
<div style="height:10px; border-bottom:1px solid;"></div>
<div style="clear:both;"></div>


<?php }  }?>


<div class="sc-column sc-column-last one-third-last right cart-price" style="float:right;">
<div class="left" style="float:left;"> <strong>Grand Total :</strong> </div>
<div class="right" style="float:right;">
<strong><span id="total">&nbsp;<?php echo helpers::to_currency($dataProvider[0]->temp_total_amount); ?></span></strong></div>
</div>


</div>



</div>
</div>

<?php */} ?>
