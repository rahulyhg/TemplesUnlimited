<?php
$criteria = new CDbCriteria;
$criteria->condition='pooja_id=:pooja_id';
$criteria->params=array(':pooja_id'=>$data->pooja_id);
$Poojaoptions = Poojaoptions::model()->findAll($criteria);

$reviews = new Reviews;
$type = 'pooja';
$id= $data->pooja_id;

$reviews = Reviews::model()->get_review_all($type,$id);


$avg_reviews =array();
for($i=0;$i<count($reviews);$i++)
{
array_push($avg_reviews,$reviews[$i]['review_rate']);
}

$avg = array_sum($avg_reviews)/count($reviews);
			 

if($index%3==0){
 echo "<div style='clear:both'></div> </div><div class='row' style='margin:0;'>";
}

if($data->pooja_price!='')
{
$amount = $data->pooja_price;
}
else
{
$amount = (isset($Poojaoptions[0]->option_price)?$Poojaoptions[0]->option_price:'');
}


?>
 <div class="col-md-4" style="padding:0">


          <ul class="items items-grid-view clearfix onecolumn" style="margin-top:30px;">
            <li class="item clearfix sc-column one-third administrator">
              <div class="item-thumbnail" style="width:320px; height:230px;vertical-align:middle;display:table-cell;text-align:center; background:#FFFFFF;"> <a href="<?php echo CHtml::normalizeUrl(array("detail/poojaold/id/".helpers::simple_encrypt($data->pooja_id))); ?>"><img src="<?php echo Yii::app()->request->baseUrl.'/uploads/pooja/main_image/'.$data->pooja_image; ?>" alt="Item thumbnail"  ></a> </div>
              <h3 class="item-title"><a href="<?php echo CHtml::normalizeUrl(array("detail/poojaold/id/".helpers::simple_encrypt($data->pooja_id))); ?>"><?php  echo $data->pooja_name;?></a></h3>
              <div class="item-address-wrapper">
                <p><?php   echo substr_replace(strip_tags($data->pooja_overview),'...',80);  ?></p>
              </div>
               <h5 class="item-title">Charges: Rs.&nbsp;<?php  echo $amount; ?></h5>
              <div class="item-rating rating-grey">
                <div class="item-stars clearfix">
						<span class="star <?php if($avg>=1){  ?>active<?php } ?>"></span> 
						<span class="star <?php if($avg>=2){  ?>active<?php } ?>"></span> 
						<span class="star <?php if($avg>=3){  ?>active<?php } ?>"></span> 
						<span class="star <?php if($avg>=4){  ?>active<?php } ?>"></span>
						<span class="star <?php if($avg>=5){  ?>active<?php } ?> last"></span> </div>
              </div>
            </li>

            <div class="clearfix"></div>
          </ul>
		</div>  
		  


<style>

@media only screen and (min-width: 768px) and (max-width: 1600px) {
.item-thumbnail img
{
margin-top:3px;
}

.item-title
{
height:50px;
padding-top:5px;
}
.item-address-wrapper p
{
height:60px;
padding-top:10px;
}
}

@media only screen  and (max-width: 480px) {



table, th, td {
	width:700px;
}
</style>  
