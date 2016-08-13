<?php 
    $data->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$data->user_id));
    $guide_image=  $data->user_image;
 ?>
	
                <li>
                    <div class="sc-column one-fifth">

	<?php echo helpers::view_thumb150( $guide_image,array('height'=>'150px','width'=>'150px','style'=>'padding-left:12px')); ?>

	<h5><?php echo helpers::show_minimize($data->gender.'. '.$data->first_name.' '.$data->last_name,14); ?></h5>

	<h5><strong><?php echo  helpers::to_currency($data->guidemoredetails->guide_amount); ?></strong></h5>

	<p><strong>Location:</strong><?php echo  helpers::show_minimize($data->guidemoredetails->guidecity->name,5); ?>,<?php echo  helpers::show_minimize($data->guidemoredetails->guidestate->state_name,5); ?><br /><strong>Phone:</strong><?php echo   helpers::show_minimize($data->guidemoredetails->guide_phone,10); ?><br /><strong>Languages:</strong><?php echo  $data->languagename->language_name; ?></p>

	<a href="<?php echo CHtml::normalizeUrl(array("detail/guide/id/".helpers::simple_encrypt(65))); ?>" class="sc-button aligncenter left store-cart" style="background-color: #CB202D; border-radius:10px;" > <span class="border"><span class="wrap"><span class="title" style="color: #ffffff; text-align:center" >View Details</span></span></span></a>&nbsp;&nbsp;

	</div>
                </li>
                <style>
                    .itemclass .sc-column p {
    padding: 0px !important;
}
                    </style>
