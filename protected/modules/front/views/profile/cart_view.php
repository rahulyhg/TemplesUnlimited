<?php 
		 $products = Storeproducts::model()->findByPK($data->product_id); 
		
		 $productimage = Storeproducts::model()->get_image($data->product_id);
		?>
		<div class="sc-page">
		<div class="item clearfix payment">
		<div class="title right"><a href="<?php echo CHtml::normalizeUrl(array("profile/removefavourite/id/".helpers::simple_encrypt($data->product_id))); ?>" ><img class="right" src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif"></a></div>
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
		<div class="left" style="width: 120px;">Qty :<input style="padding:1%; width:20%;margin-top: -22px;" onkeypress="return isNumberKey(event)"   onBlur="chage_amount(this.value,<?php echo $data->product_id;  ?>)" class="cart-quant" placeholder="1" id="fromdate_<?php echo $data->product_id;  ?>" type="text"></div><div class="right"><p class="right"><strong>Rs. <span id="amount_<?php echo $data->product_id;  ?>"><?php echo $products->product_price; ?></span></strong></p></div>
		<div class="left" style="width:200px">Shipping Charges :</div><div class="right"><strong>Free</strong></div>	
		</div>
		
	    </div></div>
		
		</div>
		
		<script>
		function chage_amount(quantity,product_id)
		{
		if(quantity!='')
		{
		var amount = parseFloat($('#amount_'+product_id).html());
		var total = parseFloat(quantity * amount);	    
		$('#amount_'+product_id).html(total);
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
