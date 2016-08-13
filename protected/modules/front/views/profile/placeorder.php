<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/html2canvas.js'></script>
<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Profile - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);


?>
<link rel="stylesheet"   href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet"   href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>

<div class="sc-column sc-column-last three-fourth-last"  id="testdiv" >



<div class="" >

<h3>My Cart - Place Order</h3>

<div class="">
	
<div class="rule"></div>
<p><strong>Your item(s) will be delivered to this address</strong></p>
<div class="rule"></div>

<?php
$model=Profile::model()->findByPk(Yii::app()->user->id);

$user_details = Userdetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

$dataProvider = MyCart::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id),array('condition' => 'order_id = 0'));


$address = $user_details->address;


if(count($user_details)>0)
{
   if($user_details->country!='0' && $user_details->state!='0' && $user_details->city!='0') 
	{
	$residenace = $user_details->usercity->name.', '.$user_details->userstate->state_name.', '.$user_details->usercountry->country.'.';  
	}
	if($user_details->country!='0' && $user_details->state!='0' && $user_details->city=='0') 
	{
	$residenace =  $user_details->userstate->state_name.', '.$user_details->usercountry->country.'.';
	}
	if($user_details->country!='0' && $user_details->state=='0' && $user_details->city=='0') 
	{
	$residenace = $user_details->usercountry->country.'.';
	}
}
	
	
if(isset($residenace))
{
$addresss =  $address.' '.$residenace;
}
else
$addresss =  $address;

	


?>

<style>
.rule 
{
border-bottom: 1px solid #000 !important;
}
</style>

<p><Strong><?php echo $model->first_name."  ".$model->last_name; ?></Strong></p>
  
<p style="width:250px;" id="address_show"><?php echo ($dataProvider[0]->address!='')?$dataProvider[0]->address:$addresss; ?></p> 

<a href="javascript:void(0);" onclick="$('#address_div').show();">Change delivery address</a>

<br />

<div id="address_div" style="display:none;">
<br />
Enter delivery address :<br />
<textarea name="delivery_address" id="delivery_address" style="margin-top:10px;max-width:300px; min-width:300px;width:300px; height:100px;" ></textarea>

<br />

<br />
<input type="button" name="submit" id="submit" value="Save" class="sc-button alignleft light profile-font"  style="background-color: #CB202D; color: #fff;font-style:bold; font-size:13px; margin-left:5px; border-radius:5px !important;text-decoration: none; transition: color 1s ease 0s;"  onclick="updateaddress();"  /> 
<br />
<br />
</div>


<div class="rule"></div>
<p><strong>Your Order Details - <?php echo count($dataProvider); ?> item(s)</strong></p>
<div class="sc-column sc-column-last three-fourth-last">
<div class="">

<form novalidate="novalidate" class="wpcf7-form" method="post" action="<?php echo Yii::app()->createUrl('front/profile/placeorder'); ?>">

     <div class="rule"></div>
     
<div style="padding: 5px; padding-bottom:30px;">
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
			<div class="sc-page">
			<div class="item clearfix payment">
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
			<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"  class="cart-quant" placeholder="<?php echo  $dataProvider[$i]->quantity; ?>" disabled="disabled" value="<?php echo  ($dataProvider[$i]->quantity!='0')?$dataProvider[$i]->quantity:'1'; ?>" id="quantity_<?php echo $dataProvider[$i]->product_id;  ?>" type="text" name="quantity_<?php echo $dataProvider[$i]->product_id;  ?>">
			

			
			</div><div class="right"><p class="right"><strong><span id="amount_<?php echo $dataProvider[$i]->product_id;  ?>"><?php echo  helpers::to_currency($dataProvider[$i]->amount); ?></span></strong></p></div>
			<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong><?php echo ($dataProvider[$i]->shipping_amount!='0.00')?$dataProvider[$i]->shipping_amount:'Free'; ?></strong></div>	
			</div>
			</div></div>
			</div>
			
	
			<div class="rule"></div>

			<?php } }else{ ?> <p style="text-align:center; font-size:12px; padding:10px;">No products found</p> <?php } ?>
			
			<div style="margin-bottom:20px;">
					
					<div class="sc-column sc-column-last one-third-last right cart-price">
					<div class="left"> <strong>Grand Total :</strong> </div>
					<div class="right">
					<strong><span id="total">&nbsp;<?php echo helpers::to_currency($dataProvider[0]->temp_total_amount); ?></span></strong></div>
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
