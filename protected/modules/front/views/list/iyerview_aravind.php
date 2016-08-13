<?php
if(isset($_REQUEST['vt']))
$urladditional = '/vt/'.$_REQUEST['vt'];
else
$urladditional = '';

if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>
<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Iyers',
);

$this->menu=array(
);
?>

<div id="maincontent">
<div class="" style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/list/Iyer'); ?>">Iyer </a></h3>
</div>
</div>

<div class="wrapper">
   <h3 class="epooja">Iyer</h3>
 </div> 

  <?php
           $categories =Iyercategories::model()->findAll();
           $categoriesvalues = array();
		   $states = States::model()->getall();
		   $criteria = new CDbCriteria();
			
			$criteria->select = 'sum(review_rate) AS review_rate,review_itemid,count(review_rate) AS review_count';
		   
		    $criteria->group = 'review_itemid';
		   
		    $criteria->condition = "review_itemtype ='iyer'";
           
		    $reviews= Reviews::model()->findAll($criteria);

 
			  $rv=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);
				   
				   for($i=0;$i<count($reviews);$i++)
				   {
				      $avg = $reviews[$i]->review_rate  /$reviews[$i]->review_count ;
					  
					  $avg = round($avg);
			
					    if($avg==1)
                        $rv[1]=$rv[1]+1;
						if($avg==2)
						$rv[2]=$rv[2]+1;
						if($avg==3)
						$rv[3]=$rv[3]+1;
						if($avg==4)
						$rv[4]=$rv[4]+1;
						if($avg==5)
						$rv[5]=$rv[5]+1;
				   }
				   
				

		   $statesvalues = array();

		   $languages = Languages::model()->getall();

		   $languagesvalues = array();


		   $whoursvalues = array('0'=>0,'1'=>0,'2'=>0,'3'=>0);



			$amounts = array('0_500'=>'0 - 500 Rs','500_1000'=>'500 - 1000 Rs','1000_1500'=>'1000 - 1500 Rs','1500_15000000'=>'Above 1500 Rs');

		        $amountsvalues = array('0_500'=>0,'500_1000'=>0,'1000_1500'=>0,'1500_15000000'=>0);

			$exparr = array('0_1'=>'Below 1 year', '1_2'=>'1-2 years ', '2_5'=>'2-5 years ', '5_1000'=>'Above 5 years');

			$exparrvalues = array('0_1'=>0, '1_2'=>0, '2_5'=>0, '5_1000'=>0);



		   if(isset($dataProall->rawData) && count($dataProall->rawData)){

		      foreach($dataProall->rawData as $items){

			    $items->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$items->user_id));

			    $iyercategories = explode(',',$items->iyermoredetails->iyer_categories);
                             

				foreach($categories as  $category){

					if(in_array($category->id, $iyercategories)){

						 if(isset( $categoriesvalues[$category->id]) )

						 $categoriesvalues[$category->id] = (int)$categoriesvalues[$category->id]+1;

						 else

						 $categoriesvalues[$category->id] = 1;

					}

				}

				 if((float)$items->iyermoredetails->iyer_experience>=0 && (float)$items->iyermoredetails->iyer_experience<1)

				  $exparrvalues['0_1'] = $exparrvalues['0_1']+1;

				  else if((float)$items->iyermoredetails->iyer_experience>=1 && (float)$items->iyermoredetails->iyer_experience<2)

				  $exparrvalues['1_2'] = $exparrvalues['1_2']+1;

				  else if((float)$items->iyermoredetails->iyer_experience>=2 && (float)$items->iyermoredetails->iyer_experience<5)

				  $exparrvalues['2_5'] = $exparrvalues['2_5']+1;

				  else if((float)$items->iyermoredetails->iyer_experience>=5)

				  $exparrvalues['5_1000'] = $exparrvalues['5_1000']+1;
				  
				  
				  

				 if((int)$items->iyermoredetails->iyer_wh>=0 && (int)$items->iyermoredetails->iyer_wh<3)

				  $whoursvalues['0'] = $whoursvalues['0']+1;

				  else if((int)$items->iyermoredetails->iyer_wh>=3 && (int)$items->iyermoredetails->iyer_wh<5)

				  $whoursvalues['1'] = $whoursvalues['1']+1;

				  else if((int)$items->iyermoredetails->iyer_wh>=5 && (int)$items->iyermoredetails->iyer_wh<7)

				  $whoursvalues['2'] = $whoursvalues['2']+1;

				  else if((int)$items->iyermoredetails->iyer_wh>=7 && (int)$items->iyermoredetails->iyer_wh<25)

				  $whoursvalues['3'] = $whoursvalues['3']+1;





				   if((float)$items->iyermoredetails->iyer_amount>=0 && (float)$items->iyermoredetails->iyer_amount<500)

				  $amountsvalues['0_500'] = $amountsvalues['0_500']+1;

				  else if((float)$items->iyermoredetails->iyer_amount>=500 && (float)$items->iyermoredetails->iyer_amount<1000)

				  $amountsvalues['500_1000'] = $amountsvalues['500_1000']+1;

				  else if((float)$items->iyermoredetails->iyer_amount>=1000 && (float)$items->iyermoredetails->iyer_amount<1500)

				  $amountsvalues['1000_1500'] = $amountsvalues['1000_1500']+1;

				  else if((float)$items->iyermoredetails->iyer_amount>=1500)

				  $amountsvalues['1500_15000000'] = $amountsvalues['1500_15000000']+1;
				  
	



				  if(isset($languagesvalues[$items->language]) )

				 $languagesvalues[$items->language] = (int)$languagesvalues[$items->language]+1;

				 else

				 $languagesvalues[$items->language] = 1;


				 if(isset( $statesvalues[$items->iyermoredetails->iyer_state]) )

				 $statesvalues[$items->iyermoredetails->iyer_state] = (int)$statesvalues[$items->iyermoredetails->iyer_state]+1;

				 else

				 $statesvalues[$items->iyermoredetails->iyer_state] = 1;
			  }

		   }
  ?>
               
  
  <div id="subcats-holder">
    <div class="wrapper ">

		
			      <form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:25px;">

							
<div class="sc-column one-half">

						<input type="text" style="padding:2%; width:60%;" placeholder="Search Keyword..." name="title" id="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:10px; width:20%; font-size:14px; margin-top:2px;" onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
						</span>
						
</div>


	

 
 
 <div id="ait-login-tabs" style="margin-top:8px;">
<div class="wrapper">
<ul class="tabbing" style="float:right; padding-right:10px;">
<li class="active"><a href="javascript:void(0);" class="login"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
<li ><a href="<?php echo CController::CreateUrl('/front/list/iyer_list'); ?>" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
</ul>
</div>


</div>
	
	




					 
</form>

<br>
	
	
	
      <div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
		           
      <ul class="sc-list " style="">
	  
	  
		<li>
 <h6 style="background-color:#EBEBEB;padding: 10px;border-radius:1px;margin-top:-10px;"><a href="#" class="item-title"><strong>Date</strong></a></h6>
 <div class="onecolumn" style="" id="date-column">
	 
		    <div class="wrapper">
							
<div class="sc-column one-half"  style=" margin-bottom:30px; margin-top:15px;">


<input type="text" style="padding:1%; width:13%;" placeholder="from" id="fromdate" name="fromdate" class="filteritem" >
<span style="margin-right: 15px;" class="connector">-</span>
<input type="text" style="padding:1%; width:13%;" placeholder="to" id="todate" name="todate" class="filteritem">
						

</div>

</div>

          </div>                       
       
</li>
	  
		  
<li>
       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Categories</strong></a></h6>
 <div class="onecolumn">
          <div class="one-third">
		

       	 <div class="one-fourth" style="padding: 10px; overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; ">
	<?php foreach( $categories as  $category){ 
	
	
			if(isset($categoriesvalues[$category->id]))
			$firstr_not1='';
			else
			$firstr_not1 ='disabled="disabled"';
	
	?>

			<label class="<?php echo (isset( $categoriesvalues[$category->id])?'':'filterhidden'); ?>">

			<input type="checkbox" <?php echo $firstr_not1; ?> class="language-filters filteritem category-filter" value="<?php echo $category->id; ?>" id="lang-filters-29" name="categories" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->id,array($_REQUEST['categories']))){ ?> checked="checked" <?php } ?>>

			<span class="flag flag-gb"></span>

			<span><?php echo $category->category_name; ?></span>

			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset($categoriesvalues[$category->id])?$categoriesvalues[$category->id]:'0'); ?>)</span>

			</label><br>

			<?php } ?>
			
			
			</div>

            
          </div>
          
        </div>        
        <br />        
</li>




<div style="clear:both;"></div>

<li>

 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;

border-top-right-radius:5px;

border-bottom-right-radius:0px;

border-bottom-left-radius:0px;"><a href="javascript:void(0);" class="item-title"><strong>Experience</strong></a></h6>

 <div class="onecolumn">

          <div class="one-fourth" style="padding:10px;overflow-y:auto; max-height:160px;  overflow-x:auto; max-width:200px;">



                 <?php foreach( $exparr as $expkey=>$exp){ 
				 
				 if($exparrvalues[$expkey]=='0')
				   $disbled = 'disabled="disabled"'; 
				   else
				    $disbled = ''; 
				?>

			<label class="<?php echo (isset( $exparrvalues[$expkey])?'':'filterhidden'); ?>">

			<input type="checkbox" <?php echo $disbled; ?>  class="experience-filter filteritem states-filter" value="<?php echo $expkey; ?>" id="lang-filters-29" name="experience[]" <?php if(isset($_REQUEST['experience']) && in_array($expkey,$_REQUEST['experience'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" >

			<span class="flag flag-gb"></span>

			<span><?php echo $exp; ?></span>

			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $exparrvalues[$expkey])?$exparrvalues[$expkey]:'0'); ?>)</span>

			</label><br>

			<?php } ?>





          </div>

 </div>



</li>
<li>

 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;

border-top-right-radius:5px;

border-bottom-right-radius:0px;

border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Destinations</strong></a></h6>

 <div class="onecolumn">

          <div class="one-fourth" style="padding:10px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px;">

                 <?php foreach( $states as  $state){ 
						if(isset($statesvalues[$state->id]))
						$disbled1 = '';
						else
						$disbled1 = 'disabled="disabled"'; 
					?>

			<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">

			<input type="checkbox"  <?php echo $disbled1; ?>class="language-filters filteritem states-filter" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" >

			<span class="flag flag-gb"></span>

			<span><?php echo $state->state_name; ?></span>

			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</span>

			</label><br>

			<?php } ?>





          </div>

 </div>



</li>



<div style="clear:both;"></div>

<br>

<li>



 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;

border-top-right-radius:5px;

border-bottom-right-radius:0px;

border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Price</strong></a></h6>





	  <div class=""  style="padding:10px;overflow-y:auto; max-height:160px;overflow-x:auto; max-width:200px;">



	   <?php foreach(  $amounts as   $amountkey=>$amount){ 
	   
	                    if(isset($amountsvalues[$amountkey]) && $amountsvalues[$amountkey]=='0')
						$disbled2 = 'disabled="disabled"';
						else
						$disbled2 = ''; 
						?>

			<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">

			<input type="checkbox" <?php echo $disbled2; ?> class="language-filters filteritem amounts-filter" value="<?php echo  $amountkey; ?>" id="lang-filters-29" name="amounts[]" <?php if(isset($_REQUEST['amounts']) && in_array($amountkey,$_REQUEST['amounts'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" >

			<span class="flag flag-gb"></span>

			<span><?php echo $amount; ?></span>

			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $amountsvalues[$amountkey])?$amountsvalues[$amountkey]:'0'); ?>)</span>

			</label><br>

			<?php } ?>

</div>
     
</li>

<li>
 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Ratings</strong></a></h6>
 <div class="onecolumn" style="margin-left: 10px;">
	 
	 <div class="sc-column one-fourth">
	 
	 <?php 
			if($rv[5]=='0')
			$ratings5 = 'disabled="disabled"';
			else
			$ratings5 = ''; 
			
			if($rv[4]=='0')
			$ratings4 = 'disabled="disabled"';
			else
			$ratings4 = '';
			
			if($rv[3]=='0')
			$ratings3 = 'disabled="disabled"';
			else
			$ratings3 = '';
			
			if($rv[2]=='0')
			$ratings2 = 'disabled="disabled"';
			else
			$ratings2 = '';

			if($rv[1]=='0')
			$ratings1 = 'disabled="disabled"';
			else
			$ratings1 = '';
	 ?>
	
         <label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(5,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?> <?php echo $ratings5; ?>onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" class="language-filters left filteritem" value="5"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"> </span> <p  id="categories-rating" class="rating-space">  (<?php echo $rv[5];?>) </p>
         </label>
         <label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(4,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?> <?php echo $ratings4; ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" class="language-filters left filteritem" value="4"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[4];?>)</p> 
         </label>
         <label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(3,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  <?php echo $ratings3; ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" class="language-filters left filteritem" value="3"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[3];?>)</p> 
         </label> 
<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
    <input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(2,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>   <?php echo $ratings2; ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" class="language-filters left filteritem" value="2"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[2];?>)</p>
</label>
               <label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
    <input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(1,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>   <?php echo $ratings1; ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" class="language-filters left filteritem" value="1"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[1];?>)</p>
               </label>
</label>
</div>
</div>                       
</li>

<div style="clear:both;"></div>

			<li>
			<h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
			border-top-right-radius:5px;
			border-bottom-right-radius:0px;
			border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Languages</strong></a></h6>
			
			<div class="onecolumn">
			<div class="one-fourth" style="padding: 10px;overflow-y:auto; max-height:160px;overflow-x:auto; max-width:200px;">
			
			<?php foreach( $languages as  $language){
			
			$tmp_value ='';
			
			if(array_key_exists($language->language_id,$languagesvalues))
			{
			   $dasabled5 = '';
			}
			else
			{
			 $dasabled5  = 'disabled="disabled"';
			}
			
			if(isset($languagesvalues[$language->language_id]))
			$tmp_value = $languagesvalues[$language->language_id];
			
			 ?>
			<label>
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $language->language_id; ?>" name="language[]"  <?php echo $dasabled5; ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>');" <?php if(isset($_REQUEST['language']) && in_array($language->language_id,$_REQUEST['language'])) ?> >
			<span class="flag flag-gb"></span>
			<span><a href="" id="category-link"><?php echo $language->language_name; ?></a></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">( <?php echo $tmp_value;  ?> )</a></span>
			</label>
			<br>
			<?php } ?>
			</div>         
			</div>                
			<br />
			</li>
			
			<div style="clear:both;"></div>
			
			
			<li>			

       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Working Hours</strong></a></h6>
 <div class="onecolumn">
	 
	  <div class="one-fourth" style="padding: 10px;">
	  
	 	<?php for($i=0;$i<count($whoursvalues);$i++){ 
		
				if($i=='0')
				$hours ='0-3 hours';
				else if($i=='1')
				$hours ='3-5 hours';
				else if($i=='2')
				$hours ='5-7 hours';
				else
				$hours ='7-24 hours';
				
				 if($whoursvalues[$i]=='0')
				 $dasabled6  = 'disabled="disabled"';
				 else
				 $dasabled6  = '';
				
		 ?>
	  <label class="">
<input type="checkbox" <?php echo $dasabled6; ?> class="language-filters filteritem" name="working_hours" id="working_hours" value="<?php echo $hours; ?>" id="lang-filters-29" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>');"  <?php if(isset($_REQUEST['working_hours']) && in_array($i,$_REQUEST['working_hours'])) ?> >
<span class="flag flag-gb"></span>
<span><a href="" id="category-link"><?php echo $hours;  ?></a></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php  echo $whoursvalues[$i]; ?>)</a></span>
</label>
<br>
<?php } ?>

</div>
</div>        

</li>


<br>
</ul>
</div>




    <div id="ait-dir-login-tab" class="tab-pane active">
	
 <div class="sc-column sc-column-last three-fourth-last" id="right-pane" >
	 <ul class="items items-list-view onecolumn">
	 

			<?php
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'emptyText' => "We're sorry, no Iyer found in this category.",
				'itemView'=>'iyer_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
		</ul>
		
		

	  </div>

    </div>


	  
</div>
</div>





<script type="text/javascript">
function filterlist(url){

	$.post(url,  $('.filteritem').serialize()  , function(data){
	$('#ait-dir-login-tab').html(data);
	 });
}
</script>


</div>

<style>


ul.yiiPager a:link, ul.yiiPager a:visited {
    color: #040404 !important;

}
.mainpage img, .textwidget img, .entry-content img, .advertising-box img
{
    max-width: 10000% !important;
}

.ui-widget {
    font-family:13px arial,sans-serif !important;
    font-size: 1.1em;
}
.active {
    background: none repeat scroll 0 0 #f5f5f5;
}
.mainpage p, .textwidget p, .entry-content p {
    margin-bottom: 5px;
}
</style>


<script>
		$('#title').autocomplete({
		source: function( request, response ) {
		$.ajax({
		url : '<?php echo $this->createUrl('auto/iyermain'); ?>',
		dataType: "json",
		data: {
		name_startsWith: request.term,
		},
		success: function( data ) {
		response( $.map( data, function( item ) {
		return {
		label: item,
		value: item
		}
		}));
		}
		});
		},
		autoFocus: true,
		minLength: 0      	
		});

  $(function() {
    jQuery("#fromdate").datepicker({
      showOn: "button",
      buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/image/calendar.gif",
      buttonImageOnly: true,
	  changeMonth : true,
      changeYear : true,
	  buttonText: "From date",
	  dateFormat: 'yy-mm-dd',	
	  onSelect: function(date)
	  {
	    filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>');
	  }
    });
    
    jQuery("#todate").datepicker({
      showOn: "button",
      buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/image/calendar.gif",
      buttonImageOnly: true,
	  changeMonth : true,
      changeYear : true,
	  buttonText: "To date",
	  dateFormat: 'yy-mm-dd',	
	  onSelect: function(date)
	  {
	    filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>');
	  }
    });   
  });
  
	  		
 </script>	

