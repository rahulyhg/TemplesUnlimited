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
<th width="2%" align="left" class=""><strong>Activity Name</strong></th>
<th width="2%" align="left" class=""><strong>Booked Date</strong></th>
<th width="2%" align="left" class=""><strong>Net Payment </strong></th>

</tr>


<?php
for($i=0;$i<count($dataProvider);$i++)
{
    $date = explode('-',$dataProvider[$i]->book_date);
 if($dataProvider[$i]->type=='iyer')
  {
    $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
    
    $amount_type = $detailsmodel->iyer_amount_option;
    $activity =  Iyerpoojas::model()->findByPK($dataProvider[$i]->activity_id);
    $name = $activity->pooja_name;
    if($dataProvider[$i]->option=='1')
    $amount =   $activity->amount_with_items; 
    else
    $amount =   $activity->amount_without_items; 
   }
  else 
   {
   $detailsmodel = Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
    
   $amount_type = $detailsmodel->guide_amount_option;
    
    $activity =  Guidetemple::model()->findByPK($dataProvider[$i]->activity_id);
    $name = $activity->activity_title;
    $amount =   $activity->amount; 
   }
?>
<tr height="40px" class="profile-box-odd"> 
<th width="2%" align="left" class="order-left"><?php echo $dataProvider[$i]->id;  ?></th>
<th width="2%" align="left" class=""><?php echo $name;  ?></th>
<th width="2%" align="left" class=""> <?php echo $date[2].'-'.$date[1].'-'.$date[0];  ?></th>
<th width="2%" align="left" class=""><?php echo $amount_type.' '.$amount;  ?></th>
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
