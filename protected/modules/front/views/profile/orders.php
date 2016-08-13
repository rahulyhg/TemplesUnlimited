<div class="wrapper"> 
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	

<div class="sc-column sc-column-last three-fourth-last" >


<div class="">


<h3>My Orders</h3>

<div class="rule"></div>
<br>

<?php if(count($dataProvider)>0) { ?>

<table class="style1 alignleft order-tab" width="100%">
<thead>
<tr height="40px" class="profile-box-even"> 
<th width="2%" align="left" class="order-left"><strong>Order No.</strong></th>
<th width="2%" align="left" class=""><strong>Net Payment (Rs.)</strong></th>
<th width="2%" align="left" class=""><strong>Actions</strong></th>
</tr>


<?php


for($i=0;$i<count($dataProvider);$i++)
{
?>

<tr height="40px" class="profile-box-odd"> 
<th width="2%" align="left" class="order-left"><?php echo $dataProvider[$i]->id;  ?></th>
<th width="2%" align="left" class="">Rs. <?php echo $dataProvider[$i]->total_amount;  ?></th>
<th width="2%" align="left" class=""><a href="<?php echo CHtml::normalizeUrl(array("profile/orderdetails/id/".helpers::simple_encrypt($dataProvider[$i]->id))); ?>">See Order Details</a></th>
</tr>


<?php }  ?>
</thead>

</table>

<?php }else { ?>

<div style="border:1px solid #dbdbdb;padding: 10px;">

<p style="text-align:center; font-size:12px; padding:10px;">No order found</p>

</div>

<?php } ?>
        
<div style="clear:both;"></div>

</div>

</div>
