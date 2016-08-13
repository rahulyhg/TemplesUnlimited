<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/html2canvas.js'></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<?php if(Yii::app()->user->isGuest){   ?>
 
<?php $this->renderPartial('nonprofile'); ?>	

<?php }else {  ?> 
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	

<?php } ?>


<div class="wrapper" style=" margin-bottom:10%;" id="testdiv" >

<div class="sc-column sc-column-last three-fourth-last" >

<h3>Place Order</h3> 

<style>
.rule 
{
border-bottom: 1px solid #000 !important;
}
</style>

<div class="rule"></div>

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
	
	  $count = 1; 
	 }
	 else
	 {
	     if ($new_string==1) continue;
	    $count  = count(Yii::app()->session['cart']);
	 } 
	}
	$sum_amount = array_sum($totalamount);
	}

?>

<?php
if(isset(Yii::app()->user->id))
{
?>
<p><strong>Your item(s) will be delivered to this address</strong></p>


<?php
$model=Profile::model()->findByPk(Yii::app()->user->id);

$user_details = Userdetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));


$address = $user_details->address;


if(count($user_details)>0)
{
       if($user_details->country!='0' && $user_details->state!='0' && $user_details->city!='0') 
	{
	$residenace = $user_details->usercity->name.'-'.$user_details->pincode.',<br>'.$user_details->userstate->state_name.',<br>'.$user_details->usercountry->country.'.';  
	}
	if($user_details->country!='0' && $user_details->state!='0' && $user_details->city=='0') 
	{
	$residenace =  $user_details->userstate->state_name.',<br>'.$user_details->usercountry->country.',<br>';
	}
	if($user_details->country!='0' && $user_details->state=='0' && $user_details->city=='0') 
	{
	$residenace = $user_details->usercountry->country.',<br>';
	}
}
	
if($user_details->delivery_address=='')
{	
if(isset($residenace))
{
$addresss =  $address.',<br> '.$residenace;
}
else
$addresss =  $address;
}
else
{
  $addresss =  $user_details->delivery_address;
}

?>


<style>
.rule 
{
border-bottom: 1px solid #000 !important;
}
.form-control
{
height:45px;
}
</style>

<p><Strong><?php echo $model->first_name."  ".$model->last_name; ?></Strong></p>
  
<p style="width:50%;" id="address_show"><?php echo $addresss; ?></p> 

<a href="javascript:void(0);" onclick="$('#address_div').show();">Change delivery address</a>

<br />

<div id="address_div">
<br />
	<form class="form-horizontal" role="form" >
	<div class="form-group">
	<label class="control-label col-sm-2" for="email">Address:</label>
	<div class="col-sm-5">
	<textarea name="delivery_address"  id="delivery_address" style="margin-top:10px;max-width:290px; min-width:290px;width:290px; height:100px;" ><?php echo $user_details->address; ?></textarea>
	</div>
	</div>
	
	<div class="form-group">
	<label class="control-label col-sm-2" for="pwd">City:</label>
	<div class="col-sm-5">          
	<input type="text" class="form-control" value="<?php echo isset($user_details->usercity->name)?$user_details->usercity->name:''; ?>" id="city" placeholder="Enter City">
	</div>
	</div>
	
	<div class="form-group">
	<label class="control-label col-sm-2" for="pwd">State:</label>
	<div class="col-sm-5">          
            <input type="text" class="form-control" value="<?php echo isset($user_details->userstate->state_name)?$user_details->userstate->state_name:''; ?>" id="state" placeholder="Enter State">
	</div>
	</div>
	
	<div class="form-group">
	<label class="control-label col-sm-2" for="pwd">Country:</label>
	<div class="col-sm-5">          
	<input type="text" class="form-control"  value="<?php echo isset($user_details->usercountry->country)?$user_details->usercountry->country:'';  ?>"  id="country" placeholder="Enter Country">
	</div>
	</div>
	
	<div class="form-group">
	<label class="control-label col-sm-2" for="pwd">Pincode:</label>
	<div class="col-sm-5">          
	<input type="text" class="form-control" id="pincode" placeholder="Enter Pincode" value="<?php echo $user_details->pincode; ?>" onkeypress="return onlyNos(event,this);">
	</div>
	</div>
	
	<div class="form-group">        
	<div class="col-sm-offset-2 col-sm-5">
	<button type="button" class="sc-button alignleft light profile-font"  style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px;border-radius:5px !important; border:2px solid #CB202D;" onclick="return updateaddress();" >Save</button>
	
	<button type="button" class="sc-button alignleft light profile-font "  onclick="$('#address_div').hide();"  style="background-color: #828282; color: #fff;font-style:bold; font-size:13px;border-radius:5px !important; border:2px solid #828282;"  >Cancel</button>
		
	</div>
	</div>
	</form>
 <!--<div> 
  
Enter delivery address :<br />
<textarea name="delivery_address" id="delivery_address" style="margin-top:10px;max-width:300px; min-width:300px;width:300px; height:100px;" ></textarea>

<br />

<br />
<input type="button" name="submit" id="submit" value="Save" class="sc-button alignleft light profile-font"  style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:5px !important;text-decoration: none; transition: color 1s ease 0s;"  onclick="updateaddress();"  /> 
<br />
<br />
</div>-->
</div>

<br />
<div class="rule"></div>
<?php } ?>





<p><strong>Your Order Details - <?php  echo  $count; ?> item(s)</strong></p>

<div class="">

<?php

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

<form novalidate="novalidate" class="wpcf7-form" method="post" id="cartpage" action="<?php echo Yii::app()->createUrl('front/profile/placeorderlast'); ?>">


	
	<div style="clear:both;"></div>
	
	<div class="rule"></div>
	
	<div style="border:1px solid #dbdbdb;padding: 5px;">
	
	<?php 
	$ids_string = '';

	if(isset(Yii::app()->session['cart1']))
    {
	foreach(Yii::app()->session['cart1']['products'] as $key=>$cart)
	{
	if($cart['type']=='product')
	{
	$products = Storeproducts::model()->findByPK($cart['product_id']); 
	$productimage = Storeproducts::model()->getinfo($cart['product_id']);		
	?>
	<div class="sc-page">
	<div class="item clearfix payment">
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
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $cart['product_id'];  ?>,<?php echo $cart['amount']; ?>)" class="cart-quant" value="<?php echo ($cart['quantity']!='')?$cart['quantity']:'1';  ?>" disabled="disabled" id="quantity_<?php echo $cart['product_id'];  ?>" type="text" name="quantity_<?php echo $cart['product_id'];  ?>">
			

			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['product_id'];  ?>"><?php echo helpers::to_currency($cart['amount']).".00"; ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></strong></div>	
	</div>
	
	</div></div>
	
	</div>
	
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['product_id'];  ?>" id="amount_shipping_values_<?php echo $cart['product_id'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
	
			
		<input type="hidden" name="amount_values_<?php echo  $cart['product_id'];  ?>" id="amount_values_<?php echo  $cart['product_id'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
		
			<div class="rule"></div>
	
	<?php $ids_string .=$cart['product_id'].',';  }
	
	else if($cart['type']=='pooja')
	{
	$products = Pooja::model ()->findByPK($cart['product_id']); 
	$productimage = Pooja::model()->getinfo($cart['product_id']);		
	?>
	<div class="sc-page">
	<div class="item clearfix payment">
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
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $cart['product_id'];  ?>,<?php echo $cart['amount']; ?>)" class="cart-quant" value="<?php echo ($cart['quantity']!='')?$cart['quantity']:'1';  ?>" disabled="disabled" id="quantity_<?php echo $cart['product_id'];  ?>" type="text" name="quantity_<?php echo $cart['product_id'];  ?>">
			

			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['product_id'];  ?>"><?php echo helpers::to_currency($cart['amount']).".00"; ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></strong></div>	
	</div>
	
	</div></div>
	
	</div>
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['product_id'];  ?>" id="amount_shipping_values_<?php echo $cart['product_id'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
		<input type="hidden" name="amount_values_<?php echo  $cart['product_id'];  ?>" id="amount_values_<?php echo  $cart['product_id'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
		
			<div class="rule"></div>
	
	<?php $ids_string .=$cart['product_id'].',';  
	 
  } else {
    $products = Storeproducts::model()->findByPK($cart['product_id']); 
	$productimage = Storeproducts::model()->getinfo($cart['product_id']);		
	?>
	<div class="sc-page">
	<div class="item clearfix payment">
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
	<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  onkeyup="chage_amount(this.value,<?php echo $cart['product_id'];  ?>,<?php echo $cart['amount']; ?>)" class="cart-quant" value="<?php echo ($cart['quantity']!='')?$cart['quantity']:'1';  ?>" disabled="disabled" id="quantity_<?php echo $cart['product_id'];  ?>" type="text" name="quantity_<?php echo $cart['product_id'];  ?>">
			

			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $cart['product_id'];  ?>"><?php echo helpers::to_currency($cart['amount']).".00"; ?></span></strong></p></div>
	<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($cart['shipping_amount']!='0')?helpers::to_currency($cart['shipping_amount']):'Free'; ?></strong></div>	
	</div>
	
	</div></div>
	
	</div>
	
	
	<input type="hidden" name="amount_shipping_values_<?php echo $cart['product_id'];  ?>" id="amount_shipping_values_<?php echo $cart['product_id'];  ?>" value="<?php echo  $cart['shipping_amount']; ?>" />
	
			
		<input type="hidden" name="amount_values_<?php echo  $cart['product_id'];  ?>" id="amount_values_<?php echo  $cart['product_id'];  ?>"  value="<?php echo $cart['amount'] ?>"/>
		
			<div class="rule"></div>
	
	<?php $ids_string .=$cart['product_id'].',';  
  
  
  
  
  
 } } } else{ ?> <p style="text-align:center; font-size:12px; padding:10px;">No products found</p> <?php } ?>
	
	
	<input type="hidden" name="ids_for_count" id="ids_for_count" value="<?php echo $ids_string; ?>" />

<input type="hidden" name="total_amount_cart" id="total_amount_cart" />

				<div class="sc-column sc-column-last one-third-last right cart-price">
					<div class="left"> <strong>Grand Total :</strong> </div>
					<div class="right"><strong>&nbsp;<?php echo helpers::to_currency($sum_amount.".00"); ?></strong></div>
					</div>
					
					<br />	
					<br />
					<br />

<?php if(Yii::app()->user->isGuest){   ?>
 
					<a style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:3px; margin-top:20px;cursor:pointer;" class="sc-button alignright profile-font right"onclick="$('#cartpage').submit();" id="share1">Continue &nbsp;-></a>	

<?php }else {  ?> 
					<a style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:3px; margin-top:20px; cursor:pointer;" class="sc-button alignright profile-font right" onclick="return updateaddressuser();" >Proceed to Pay</a>	

<?php } ?>

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

</div>
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
		var address  =  $('#delivery_address').val();
		var city  =  $('#city').val();
		var state  =  $('#state').val();
		var country  =  $('#country').val();
		var pincode  =  $('#pincode').val();
		
		var error = 0;
		if(address=='')
		{
	        error ='1';
		$("#delivery_address").css("background-color","#fbd9d9");
		$("#delivery_address").css("border","2px solid red"); 
		}
		else
		{
		$("#delivery_address").css("background-color","#fff");
		$("#delivery_address").css("border","2px solid #ccc");
		}
		 if(city=='')
		{
		error = 1;
		$("#city").css("background-color","#fbd9d9");
		$("#city").css("border","2px solid red"); 
		}
		else
		{
		$("#city").css("background-color","#fff");
		$("#city").css("border","2px solid #ccc");
		}
		 if(state=='')
		{
		error ='1';
		$("#state").css("background-color","#fbd9d9");
		$("#state").css("border","2px solid red"); 
		}
		else
		{
		$("#state").css("background-color","#fff");
		$("#state").css("border","2px solid #ccc");
		}
		 if(country=='')
		{
		error ='1';
		$("#country").css("background-color","#fbd9d9");
		$("#country").css("border","2px solid red"); 
		}
		else
		{
		$("#country").css("background-color","#fff");
		$("#country").css("border","2px solid #ccc");
		}
		 if(pincode=='')
		{
		error ='1';
		$("#pincode").css("background-color","#fbd9d9");
		$("#pincode").css("border","2px solid red"); 
		}
		else
		{
		$("#pincode").css("background-color","#fff");
		$("#pincode").css("border","2px solid #ccc");
		}
		
		if(error=='1')
		{
		 return false;
		}
else		
	{	
  $.ajax({
              url :'<?php echo $this->createUrl('profile/addressupdate'); ?>',
              type : "post",
              data : "address="+address+"&city="+city+"&state="+state+"&country="+country+"&pincode="+pincode,
              success:function(data)
              {
			    $('#address_show').html(data);
				$('#address_div').hide();
			  } 
     });
	 }
}


function updateaddressuser()
{
   		var address  =  $('#delivery_address').val();
		var city  =  $('#city').val();
		var state  =  $('#state').val();
		var country  =  $('#country').val();
		var pincode  =  $('#pincode').val();
		
		var error = 0;
		if(address=='')
		{
	        error ='1';
		$("#delivery_address").css("background-color","#fbd9d9");
		$("#delivery_address").css("border","2px solid red"); 
		}
		else
		{
		$("#delivery_address").css("background-color","#fff");
		$("#delivery_address").css("border","2px solid #ccc");
		}
		 if(city=='')
		{
		error = 1;
		$("#city").css("background-color","#fbd9d9");
		$("#city").css("border","2px solid red"); 
		}
		else
		{
		$("#city").css("background-color","#fff");
		$("#city").css("border","2px solid #ccc");
		}
		 if(state=='')
		{
		error ='1';
		$("#state").css("background-color","#fbd9d9");
		$("#state").css("border","2px solid red"); 
		}
		else
		{
		$("#state").css("background-color","#fff");
		$("#state").css("border","2px solid #ccc");
		}
		 if(country=='')
		{
		error ='1';
		$("#country").css("background-color","#fbd9d9");
		$("#country").css("border","2px solid red"); 
		}
		else
		{
		$("#country").css("background-color","#fff");
		$("#country").css("border","2px solid #ccc");
		}
		 if(pincode=='')
		{
		error ='1';
		$("#pincode").css("background-color","#fbd9d9");
		$("#pincode").css("border","2px solid red"); 
		}
		else
		{
		$("#pincode").css("background-color","#fff");
		$("#pincode").css("border","2px solid #ccc");
		}
		
		if(error=='1')
		{
                    $('html, body').animate({scrollTop:$('#country').position().top}, 'slow'); 
		 return false;
		}
        else		
	   {	
            $('#cartpage').submit();
	   } 
}



function onlyNos(e, t)
 {
try 
{
if (window.event) 
{
var charCode = window.event.keyCode;
}
else if (e) 
{
var charCode = e.which;
}
else { return true; }
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
return true;
}
catch (err) {
alert(err.Description);
}
}
</script>

<?php if($user_details->address=='' && $user_details->country=='0' && $user_details->state=='0' && $user_details->city=='0' && $user_details->delivery_address=='') {?>
<script>
   // $("#address_div").css("display","block");
</script>
<?php } else { ?>
<script>
  //  $("#address_div").css("display","none");
</script>
<?php } ?>

<style>
.wpcf7 input, .wpcf7 textarea {
    background: none repeat scroll 0 0 #ffffff;
    border: 2px solid #e8e8e8;
    color: #666666;
    display: block;
    font-family: "Arial",sans-serif;
    font-size: 12px;
    height: 40px;
    margin: 0;
}
</style>
