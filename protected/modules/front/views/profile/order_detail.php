<?php
?>
<div class="wrapper"> 
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	

<div class="sc-column sc-column-last three-fourth-last" >

<div class="">

<h3>My Orders Details</h3>

<?php

 $mycart = MyCart::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id,'order_id' =>'454354'.$order->id));
 
 $shipping_total = array();
 $order_total = array();
 
 foreach ($mycart  as $mycart1)
 {
   array_push($shipping_total, $mycart1->shipping_amount);
   array_push($order_total, $mycart1->amount);
 }
 
  $shipping_amount = array_sum($shipping_total);
  $order_total_amount =  array_sum($order_total);
?> 

<div class="rule"></div>
<br>


<div style="border:1px solid #d3d3d3;height: 153px;padding:13px;" > 

<div class="sc-column one-fourth order-shipping">
   <h3>Shipping Details</h3>  
  <p>Shipping Total:<?php echo  helpers::to_currency($shipping_amount); ?></p>
</div>

<div class="sc-column one-fourth order-shipping">
<h3>Your Order Total</h3>  
 
 <p class="left">Order total : </p>
 <p class="right"><strong><?php echo helpers::to_currency($order_total_amount).'.00'; ?></strong></p>
   <div style="clear:both;"></div>
 <p class="left">Shipping : </p>
 <p class="right"><strong><?php echo  helpers::to_currency($shipping_amount).'.00'; ?></strong></p>
  <div style="clear:both;"></div>
 <hr>
 <p class="left">Grand Total : </p>

 <p class="right"><strong>Rs.<?php echo $order->total_amount; ?></strong></p>
	</div>

</div>

<div style="clear:both;"></div>
<br>
<table class="style1 alignleft order-tab" width="100%">
	<thead>
<tr height="40px" class="profile-box-even"> 
<th width="2%" align="left" class="order-left"><strong>Item No.</strong></th>
<th width="2%" align="left" class=""><strong>Item Name</strong></th>
<th width="2%" align="left" class=""><strong>Item Amount</strong></th>
</tr>

<?php foreach($mycart as $cart) {


 $procuct = Storeproducts::model()->findByPK($cart->product_id);



?>

<tr height="40px" class="profile-box-odd"> 
<th width="2%" align="left" class="order-left"><?php echo $procuct->product_code; ?></th>
<th width="2%" align="left" class=""><?php echo $procuct->product_name; ?></th>
<th width="2%" align="left" class=""> <?php echo  helpers::to_currency($cart->amount); ?></th>
</tr>

<?php } ?>
</thead>

</table>
 <div style="clear:both;"></div>
 




</div>





</div>
