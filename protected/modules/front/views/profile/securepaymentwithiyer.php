<div class="wrapper" style=" margin-bottom:10%;" >
<link rel="stylesheet"   href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet"   href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
<?php 
$this->renderPartial('profileleft', array('model'=>$model));

$booked_table = BookedTable::model()->findByPk(Yii::app()->session['securepaymentwithiyer']);





if($booked_table->type=='iyer')
{
$amount_from_activity = Iyerpoojas::model()->findByPK($booked_table->activity_id);
if($amount_from_activity->discount=='Yes')
{
if($booked_table->option=='1')
{
      $temp =  $amount_from_activity->amount_with_items * ($activities[$i]->discount_percentage / 100);
     $cuttent_amount = $amount_from_activity->amount_with_items - $temp;
}
else
{
     $temp =  $amount_from_activity->amount_without_items * ($activities[$i]->discount_percentage / 100); 
     $cuttent_amount = $amount_from_activity->amount_without_items - $temp;
}
}
else
{
if($booked_table->option=='1')
$cuttent_amount = $amount_from_activity->amount_with_items;
else
$cuttent_amount = $amount_from_activity->amount_without_items;
}
}
else
	{
	$amount_from_activity = Guidetemple::model()->findByPK($booked_table->activity_id);
	if($amount_from_activity->discount=='Yes')
	{
	$temp =  $amount_from_activity->amount * ($activities[$i]->discount_percentage / 100);
	$cuttent_amount = $amount_from_activity->amount - $temp;
	}
	else
	$cuttent_amount = $amount_from_activity->amount_with_items;
   }
?>

<div class="sc-column sc-column-last three-fourth-last" >
        <div class="">
          <h3>My Cart - Place Order</h3>
          <div class="rule"></div>
          <br>
          <h4 align="center"> Total purchase amount is <?php echo helpers::to_currency($cuttent_amount); ?></h4>
          <br>
          <div class="sc-accordion ui-accordion ui-widget ui-helper-reset" id="ait-accordion-195" role="tablist">
            <div class="ac-title ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all" role="tab" id="ui-accordion-ait-accordion-195-header-0" aria-controls="ui-accordion-ait-accordion-195-panel-0" aria-selected="false" tabindex="-1"> <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><a href="#">Debit Card</a></div>
            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: block; height: 120px;" id="ui-accordion-ait-accordion-195-panel-0" aria-labelledby="ui-accordion-ait-accordion-195-header-0" role="tabpanel" aria-expanded="false" aria-hidden="true">
              <p style="font-size:20px; margin-bottom:0px;">Select Debit Card Type/Bank</p>
              <hr style="border:0.5px thin #999999">
              <div style="padding-left:30px; padding-top:30px; padding-bottom:30px;">
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_visamastercard_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <select>
                    <option>Mastero ATM/Debit Cards</option>
                    <option>SBI</option>
                    <option>BOI</option>
                    <option>Other Banks</option>
                  </select>
                </div>
                <form>
                  <div class="sc-column" style="margin-top:50px;">
                    <h4>Enter Debit Card Details</h4>
                    <p>Your card details will be safe and secure and will not be shared with the seller(s).</p>
                    <div>
                      <div class="sc-column one-third" style="margin-top:20px">
                        <label>Debit card number</label>
                        <input type="text" value="" name="txtCName1" id="txtCName1">
                      </div>
                      <div class="sc-column sc-column-last one-third-last" style="margin-top:20px">
                        <label class="lb" for="ipt0-err2">Valid till</label>
                        <input type="text" class="" maxlength="2" size="8" value="" name="txtMnth1"  placeholder="MM">
                        <input type="text" class="" maxlength="4" size="11" value="" placeholder="YYYY">
                      </div>
                    </div>
                    <div class="sc-column-last">
                      <div class="sc-column one-third" style="margin-top:20px">
                        <label>Card holder name<span>(as it appears on card)</span></label>
                        <input type="text" name="txtCHName1" value="">
                      </div>
                      <div class="sc-column sc-column-last one-third-last" style="margin-top:20px">
                        <label class="lb" for="txtVNo1">CVV<span>(3-digit card verification number)</span></label>
                        <input type="password" value="" size="5">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            <div class="sc-column one-half">
				<p style="margin-top:30px">
				You will be redirected to your bank's web site to complete your payment.
				</p>
			</div>
			<div class="right" style="padding-top:30px;">
			<a href="" class="sc-button alignleft light right" style="background-color: #CB202D; color: #fff; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px">Pay Now</a>
			</div>
            
            </div>
            <div class="ac-title ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-accordion-header-active ui-state-active ui-corner-top" role="tab" id="ui-accordion-ait-accordion-195-header-1" aria-controls="ui-accordion-ait-accordion-195-panel-1" aria-selected="true" tabindex="0"> <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span><a href="#">NetBanking</a></div>
            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" style="display: none; height: 120px;" id="ui-accordion-ait-accordion-195-panel-1" aria-labelledby="ui-accordion-ait-accordion-195-header-1" role="tabpanel" aria-expanded="true" aria-hidden="false"> 
			
			
			<p style="font-size:20px; margin-bottom:0px;">Select Your Prefered bank</p>
			<p>Please make sure that you have an Internet banking user ID and password for the bank you choose.</p>
              <hr style="border:0.5px thin #999999">
			  <div style="padding:30px;">
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_visamastercard_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                </div>
			  <div style="padding:30px;">
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_visamastercard_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                </div>
			  <div style="padding:30px;">
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_visamastercard_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                </div>
			  <div class="sc-column" style="padding:30px;">
			  <select>
                    <option>Other Bank</option>
                    <option>SBI</option>
                    <option>BOI</option>
                    <option>Other Banks</option>
                  </select>
			  </div>
			  <div class="sc-column one-half">
				<p style="margin-top:30px">
				You will be redirected to your bank's web site to complete your payment.
				</p>
			</div>
			<div class="right" style="padding-top:30px;">
			<a href="" class="sc-button alignleft light right" style="background-color: #CB202D; color: #fff; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px">Pay Now</a>
			</div>
            
              </div>
            <div class="ac-title ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-accordion-ait-accordion-195-header-2" aria-controls="ui-accordion-ait-accordion-195-panel-2" aria-selected="false" tabindex="-1"> <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><a href="#">Credit Card</a></div>
            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none; height: 120px;" id="ui-accordion-ait-accordion-195-panel-2" aria-labelledby="ui-accordion-ait-accordion-195-header-2" role="tabpanel" aria-expanded="false" aria-hidden="true">
			
			<p style="font-size:20px; margin-bottom:0px;">Select Your Credit Card Type/Bank</p>
              <hr style="border:0.5px thin #999999">
			  <div style="padding:30px;">
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_visamastercard_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                <div class="sc-column sc-column-last one-fourth-last">
                  <input type="radio" name="debit" style="margin-right:10px;">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/payment/BankLogos_rupay_v2.png"> </div>
                </div>
			<div class="sc-column one-half">
				<p style="margin-top:30px">
				You will be redirected to your bank's web site to complete your payment.
				</p>
			</div>
			<div class="right" style="padding-top:30px;">
			<a href="" class="sc-button alignleft light right" style="background-color: #CB202D; color: #fff; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px">Pay Now</a>
			</div>
            
			 </div>
            <div class="ac-title ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-accordion-ait-accordion-195-header-3" aria-controls="ui-accordion-ait-accordion-195-panel-3" aria-selected="false" tabindex="-1"> <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><a href="#">Cash On Delivery</a></div>
            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none; height: 120px;" id="ui-accordion-ait-accordion-195-panel-3" aria-labelledby="ui-accordion-ait-accordion-195-header-3" role="tabpanel" aria-expanded="false" aria-hidden="true"> 
				<p style="font-size:20px; margin-bottom:0px;">You have Selected Cash on delivery </p>
			<p>You have to pay amount Rs.20,000 to shipping agent at the time of delivery</p>
              <hr style="border:0.5px thin #999999">
			  <div style="padding:30px;">
				  <h5>Delivery Address</h5>
				<p>
					Name<br>
					address<br>
					Street<br>
					Pincode<br>
				</p>
				<div class="sc-column">
				<label>Primary Contact :</label>
				<input type="text" value=""></div>
				 </div>
				 
			<div class="right" style="padding-top:30px;">
			<a href="" class="sc-button alignleft light right" style="background-color: #CB202D; color: #fff; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px">Order Now</a>
			</div>
            
          </div>
        
        </div>
        <!--<a href="" class="sc-button alignright light" style="background-color: #FF3355; border-color: #FF3355; width: 28%; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">Save Profile</span></span></span></a>-->
      </div>
    </div>
	</div>
	
	  <script type="text/javascript" language="javascript">
		$(function() {
			jQuery( "#ait-accordion-195 > br" ).remove();
			jQuery( "#ait-accordion-195 > p" ).remove();
			
			jQuery( "#ait-accordion-195" ).accordion();
		});
		</script>
<?php
if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
{
  $book =   BookedTable::model()->find('id=:id',array(':id'=>Yii::app()->session['securepaymentwithiyer']));
  $book->status  = 'in-progress';
  $book->update(false); 
}


?>		
