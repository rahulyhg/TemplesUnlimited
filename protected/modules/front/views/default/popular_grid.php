<!--<div class="sc-column one-fourth items"  style=" width:200px;">
<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>" class="state"><?php echo  $data->State->state_name; ?></a><br>

<?php $string = strlen($data->temple_name); 			
if($string>20){?>

<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>"   data-toggle="tooltip" data-placement="left" title="<?php  echo $data->temple_name; ?>" class="temple"><?php  echo substr($data->temple_name,0,8).'...'.substr($data->temple_name,-8); ?></a><br>
<?php }else { ?>
<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>"   data-toggle="tooltip" data-placement="left" title="<?php  echo $data->temple_name; ?>" class="temple"><?php  echo $data->temple_name; ?></a><br>

<?php } ?>
<!-- <a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($data->id))); ?>" class="temple"> <?php //echo  $data->city->name; ?></a><br>-->
<!-- </div> -->
<style>
.items
{
max-width:350px;
}
</style> 

<!--<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>-->

<div class="sc-column one-fourth items" >
<a href="#" class="state"><?php echo  $data->State->state_name; ?></a><br>

<?php 					
				$criteria = new CDbCriteria();
				
				 $criteria->select='temple_name,id';
				
				$condition = 'featured_listing ='.$data->featured_listing.'';
				
				$condition .= '  and state_id ="'.$data->state_id.'"';
				
				if(isset(Yii::app()->session['city']))
				$condition .= ' and city_id ="'.$data->city_id.'"';
				
				
			
				
				$criteria->condition =  $condition;
				
				$criteria->order = "id DESC";
				
				$criteria->limit = '2';
				
				$popular = Temples::model()->findAll($criteria); 
		
				
				
	if(count($popular)>0)
	{
	for($i=0;$i<count($popular);$i++)
	{
			$string = strlen($popular[$i]->temple_name); 			
			if($string>20){?>
			<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($popular[$i]->id))); ?>"   data-toggle="tooltip" data-placement="left" title="<?php echo $popular[$i]->temple_name; ?>" class="temple"><?php  echo substr($popular[$i]->temple_name,0,10).'...'.substr($popular[$i]->temple_name,-8); ?></a><br>
			
			<?php } else { ?>
			
			<a href="<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($popular[$i]->id))); ?>"   data-toggle="tooltip" data-placement="left" title="<?php  echo $popular[$i]->temple_name; ?>" class="temple"><?php  echo $popular[$i]->temple_name; ?></a><br>
    <?php } }  } ?>

</div>

<style>
@media (min-width: 768px) and (max-width: 979px) {
.mainpage
{
font-size:16px;
}
}


@media only screen and (min-width: 768px) {
.mainpage
{
font-size:15px;
}
}

@media (max-width: 480px) {
.mainpage
{
font-size:11px;
}
}

</style>

