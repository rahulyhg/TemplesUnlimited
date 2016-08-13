<?php 
    $data->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
    $iyer_image=  $data->user_image;

 ?>
	
                <li >
                    <div class="sc-column one-fifth" style="width:200px;">
<div style="margin-left:5px;">
	<?php echo helpers::view_thumb150( $iyer_image,array('height'=>'150px','width'=>'180px','style'=>'padding-left:5px')); ?>
	
	<div style="margin-top:10px;">

	<h5><?php echo helpers::show_minimize($data->gender.'. '.$data->first_name.' '.$data->last_name,23); ?></h5>

	<h5 style="text-align:center;"><strong><?php echo  $data->iyermoredetails->iyer_amount_option."  ".$data->iyermoredetails->iyer_amount; ?></strong></h5>

	<p><strong>Experience : </strong><?php echo $data->iyermoredetails->iyer_experience; ?>,<?php echo  $data->iyermoredetails->iyer_experience_type; ?><br /><strong>Working Hours : </strong><?php echo  abs($data->iyermoredetails->iyer_wh)." Hours"; ?><br /><strong>Languages : </strong><?php echo  $data->languagename->language_name; ?></p>

	<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($data->user_id))); ?>" class="sc-button aligncenter left store-cart" style="background-color: #CB202D; border-radius:10px;" > <span class="border"><span class="wrap"><span class="title" style="color: #ffffff; text-align:center" >View Details</span></span></span></a>&nbsp;&nbsp;
	</div>
	</div>

	</div>
                </li>

<style>
.items .sc-column:hover
{
box-shadow: 2px 2px 2px 2px  #888888 !important;
}
onecolumn .sc-column.three-fourth, .onecolumn .sc-column.three-fourth-last {
    width: 475px;
}

</style>				