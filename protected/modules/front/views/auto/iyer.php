<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css' type='text/css' />
<?php
if(isset($_REQUEST['vt']))
$urladditional = '/vt/'.$_REQUEST['vt'];
else
$urladditional = '';

if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';

$this->breadcrumbs=array(
	'Iyers',
);

$this->menu=array(
);
?>
<div id="maincontent">
<div class="" style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/auto/iyernew'); ?>">Iyer </a></h3>
</div>
</div>

<div class="wrapper">
   <h3 class="epooja">Iyer</h3>
 </div> 
 
 
<?php if(Yii::app()->user->hasFlash('booked')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('booked'); ?>
</div>
<?php endif; ?>

  <?php
            $categories =Iyercategories::model()->findAll();
           $categoriesvalues = array();
		   $states = States::model()->getall();
		   

		   $statesvalues = array();

		   $languages = Languages::model()->getall();

		   $languagesvalues = array();

		   $whoursvalues = array('0'=>0,'1'=>0,'2'=>0,'3'=>0);
		   
		   $rv=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);



			$amounts = array('0_500'=>'0 - 500 Rs','500_1000'=>'500 - 1000 Rs','1000_1500'=>'1000 - 1500 Rs','1500_15000000'=>'Above 1500 Rs');

		    $amountsvalues = array('0_500'=>0,'500_1000'=>0,'1000_1500'=>0,'1500_15000000'=>0);

			$exparr = array('0_1'=>'Below 1 year', '1_2'=>'1-2 years ', '2_5'=>'2-5 years ', '5_1000'=>'Above 5 years');

			$exparrvalues = array('0_1'=>0, '1_2'=>0, '2_5'=>0, '5_1000'=>0);



		   if(isset($dataProall->rawData) && count($dataProall->rawData)){

		      foreach($dataProall->rawData as $items){

			    $items->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$items->user_id));
				


			    $iyercategories = explode(',',$items->iyermoredetails->iyer_categories);
    

				foreach($categories as  $category){
				

					if(in_array($category->id,$iyercategories)){

						 if(isset( $categoriesvalues[$category->id]) )

						 $categoriesvalues[$category->id] = (int)$categoriesvalues[$category->id]+1;

						 else

						 $categoriesvalues[$category->id] = 1;

					}

				}
				
				
					if($items->iyermoredetails->iyer_experience_type=='Month(s)')
					{
						$year = $items->iyermoredetails->iyer_experience/12;
						
						$year = round($year,1);
										
						if((float)$year>=0 && (float)$year<1)
						
						$exparrvalues['0_1'] = $exparrvalues['0_1']+1;
						
						else if((float)$year>=1 && (float)$year<2)
						
						$exparrvalues['1_2'] = $exparrvalues['1_2']+1;
						
						else if((float)$year>=2 && (float)$year<5)
						
						$exparrvalues['2_5'] = $exparrvalues['2_5']+1;
						
						else if((float)$year>=5)
						
						$exparrvalues['5_1000'] = $exparrvalues['5_1000']+1;
						
						$items->iyermoredetails->monthsinyears = $year;  
						
						$items->iyermoredetails->save();
						
					}
					else
					{ 					
						if((float)$items->iyermoredetails->iyer_experience>=0 && (float)$items->iyermoredetails->iyer_experience<1)
						
						$exparrvalues['0_1'] = $exparrvalues['0_1']+1;
						
						else if((float)$items->iyermoredetails->iyer_experience>=1 && (float)$items->iyermoredetails->iyer_experience<2)
						
						$exparrvalues['1_2'] = $exparrvalues['1_2']+1;
						
						else if((float)$items->iyermoredetails->iyer_experience>=2 && (float)$items->iyermoredetails->iyer_experience<5)
						
						$exparrvalues['2_5'] = $exparrvalues['2_5']+1;
						
						else if((float)$items->iyermoredetails->iyer_experience>=5)
						
						$exparrvalues['5_1000'] = $exparrvalues['5_1000']+1;
				  }
				  
				  
				  

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
				 
				 

						$review = $items->iyermoredetails->review_average;
						
						if($review==1)
						$rv[1]=$rv[1]+1;
						if($review==2)
						$rv[2]=$rv[2]+1;
						if($review==3)
						$rv[3]=$rv[3]+1;
						if($review==4)
						$rv[4]=$rv[4]+1;
						if($review==5)
						$rv[5]=$rv[5]+1;
			  }

		   }
		   
		   

        
  ?>
  <div id="subcats-holder">
    <div class="wrapper ">
			  
				  <form class="wp-user-form" action="" id="category" method="get" style=" margin-top:25px;">
				  
<div class="sc-column one-half">

						<input type="text" style="padding:1%; width:60%;" placeholder="Search Keyword..." name="title" id="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:10px; width:20%; font-size:14px; margin-top:2px;" onclick="filterlist1('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
						</span>
						
</div>


<style>
.nav li
{
border:1px solid #f5f5f5;
}
</style>
 
 

<div class="wrapper">
<div class="tabbable" style="float:right;">
<ul class="nav nav-tabs" >
<li class="active" style=""><a href="#pane1"  onclick="$('#tab').val('pane1');" data-toggle="tab"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
<li ><a href="#pane2" data-toggle="tab"  onclick="$('#tab').val('pane2');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
</ul>
</div>
</div>

		 


<br>
	

    <div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
		           
    <ul class="sc-list " style="">
	<li>
	<h6 style="background-color:#EBEBEB;padding: 10px;border-radius:1px;margin-top:-10px;"><a href="#" class="item-title"><strong>Date</strong></a></h6>
	<div class="onecolumn" style=" margin-left:5px;" id="date-column">
	<div class="wrapper">
	<div class="sc-column one-half" style="margin-bottom:20px;">
	<input type="text" style="padding:1%; width:15%;" placeholder="from" id="fromdate"  name="fromdate" class="language-filters filteritem" <?php if(isset($_REQUEST['fromdate']) ){ ?>  value="<?php echo $_REQUEST['fromdate']; ?>" <?php } ?> ><span style="margin-right: 10px;" class="connector">&nbsp;&nbsp;-</span>
	<input type="text" style="padding:1%; width:15%;" placeholder="to" id="todate" name="todate" class="language-filters filteritem" <?php if(isset($_REQUEST['todate']) ){ ?>  value="<?php echo $_REQUEST['todate']; ?>" <?php } ?>>
	</div>
	</div>
	</div>                       
	</li>
	  
		  
<li>
       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Categories</strong></h6>
 <div class="onecolumn">

<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >
	<?php foreach( $categories as  $category){ 
			if(isset($categoriesvalues[$category->id]))
			{
	?>
			<label class="<?php echo (isset( $categoriesvalues[$category->id])?'':'filterhidden'); ?>">
			<input type="checkbox"  class="language-filters filteritem category-filter" value="<?php echo $category->id; ?>" id="lang-filters-29" name="categories[]" onchange="filterlist()" <?php if(isset($_REQUEST['categories']) && in_array($category->id,$_REQUEST['categories'])){ ?> checked="checked" <?php } ?> style="cursor:pointer;">
			<span class="flag flag-gb"></span>
			<span class="font-sixe"><?php echo $category->category_name; ?></span>
			<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo $categoriesvalues[$category->id]; ?>)</span>
			</label><br>
			<?php }  }?>
			
		<?php foreach( $categories as  $category){ 
		  if(!array_key_exists($category->id,$categoriesvalues))
		   {
		   $firstr_not1 = 'disabled="disabled"';
	?>
			<label class="<?php echo (isset( $categoriesvalues[$category->id])?'':'filterhidden'); ?>">
			<input type="checkbox"  <?php echo $firstr_not1; ?> class="language-filters filteritem category-filter" value="<?php echo $category->id; ?>" id="lang-filters-29" name="categories" onchange="filterlist()" <?php if(isset($_REQUEST['categories']) && in_array($category->id,array($_REQUEST['categories']))){ ?> checked="checked" <?php } ?> >
			<span class="flag flag-gb"></span>
			<span class="font-sixe"><?php echo $category->category_name; ?></span>
			<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(0)</span>
			</label><br>
			<?php }  }?>
			
			
			
			
		</div>
</div>        
</li>

<div style="clear:both;"></div>

<li>

<h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;

border-top-right-radius:5px;

border-bottom-right-radius:0px;

border-bottom-left-radius:0px;"><strong>Experience</strong></h6>
<div class="onecolumn">
		<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >
		<?php foreach( $exparr as $expkey=>$exp){ 
		if($exparrvalues[$expkey]=='0')
		$disbled = 'disabled="disabled"'; 
		else
		$disbled = ''; 
		?>
		<label class="<?php echo (isset( $exparrvalues[$expkey])?'':'filterhidden'); ?>">
		<input type="checkbox" <?php echo $disbled; ?>  class="experience-filter filteritem states-filter" value="<?php echo $expkey; ?>" id="lang-filters-29" name="experience[]" <?php if(isset($_REQUEST['experience']) && in_array($expkey,$_REQUEST['experience'])){ ?> checked="checked" <?php } ?> onchange="filterlist()" >
		<span class="flag flag-gb"></span>
		<span class="font-sixe"><?php echo $exp; ?></span>
		<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo (isset( $exparrvalues[$expkey])?$exparrvalues[$expkey]:'0'); ?>)</span>
		</label><br>
		<?php } ?>
		</div>
</li>
<div style="clear:both;"></div>

<li>
<h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Destinations</strong></h6>
<div class="onecolumn">
	<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >
	<?php foreach( $states as  $state){ 
	if(isset($statesvalues[$state->id]))
	{
	?>
	<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
	<input type="checkbox" class="language-filters filteritem states-filter" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist()" >
	<span class="flag flag-gb"></span>
	<span class="font-sixe"><?php echo $state->state_name; ?></span>
	<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</span>
	</label><br>
	<?php }  } ?>

	<?php foreach( $states as  $state){ 
	  if(!array_key_exists($state->id,$statesvalues))
	 {
	$disbled1 = 'disabled="disabled"'; 
	?>
	<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
	<input type="checkbox"  <?php echo $disbled1; ?>class="language-filters filteritem states-filter" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist()" >
	<span class="flag flag-gb"></span>
	<span class="font-sixe"><?php echo $state->state_name; ?></span>
	<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</span>
	</label><br>
	<?php } }?>
	
	</div>
	</div>
</li>

<div style="clear:both;"></div>

<li>
<h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Price</strong></h6>
<div class="onecolumn">
		<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >	
		<?php foreach(  $amounts as   $amountkey=>$amount){ 
		if(isset($amountsvalues[$amountkey]) && $amountsvalues[$amountkey]=='0')
		$disbled2 = 'disabled="disabled"';
		else
		$disbled2 = ''; 
		?>
		<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
		<input type="checkbox" <?php echo $disbled2; ?> class="language-filters filteritem amounts-filter" value="<?php echo  $amountkey; ?>" id="lang-filters-29" name="amounts[]" <?php if(isset($_REQUEST['amounts']) && in_array($amountkey,$_REQUEST['amounts'])){ ?> checked="checked" <?php } ?> onchange="filterlist()" >
		<span class="flag flag-gb"></span>
		<span class="font-sixe"><?php echo $amount; ?></span>
		<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo (isset( $amountsvalues[$amountkey])?$amountsvalues[$amountkey]:'0'); ?>)</span>
		</label><br>
		<?php } ?>
		</div>
		</div>
</li>
<div style="clear:both;"></div>
<li>
 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Ratings</strong></h6>
			<div class="onecolumn">
			<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >
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
			<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(5,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?> <?php echo $ratings5; ?>onchange="filterlist()" class="language-filters left filteritem" value="5"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"><p  id="categories-rating" class="rating-space">&nbsp;&nbsp;(<?php echo $rv[5];?>)</p></span> 
			</label>
			<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
			<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(4,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?> <?php echo $ratings4; ?> onchange="filterlist()" class="language-filters left filteritem" value="4"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"><p  id="categories-rating" class="rating-space">&nbsp;&nbsp;(<?php echo $rv[4];?>)</p></span> 
			</label>
			<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
			<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(3,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  <?php echo $ratings3; ?> onchange="filterlist()" class="language-filters left filteritem" value="3"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"><p  id="categories-rating" class="rating-space">&nbsp;&nbsp;(<?php echo $rv[3];?>)</p></span> 
			</label> 
			<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
			<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(2,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>   <?php echo $ratings2; ?> onchange="filterlist()" class="language-filters left filteritem" value="2"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"><p  id="categories-rating" class="rating-space">&nbsp;&nbsp;(<?php echo $rv[2];?>)</p></span>
			</label>
			<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
			<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(1,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>   <?php echo $ratings1; ?> onchange="filterlist()" class="language-filters left filteritem" value="1"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"><p  id="categories-rating" class="rating-space">&nbsp;&nbsp;(<?php echo $rv[1];?>)</p></span>
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
border-bottom-left-radius:0px;"><strong>Languages</strong></h6>
			<div class="onecolumn">
			<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >
			<?php foreach( $languages as  $language){
			$tmp_value ='';
			if(array_key_exists($language->language_id,$languagesvalues))
			{	
			if(isset($languagesvalues[$language->language_id]))
			$tmp_value = $languagesvalues[$language->language_id];
			 ?>
			<label>
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $language->language_id; ?>" name="language[]"   onchange="filterlist();" <?php if(isset($_REQUEST['language']) && in_array($language->language_id,$_REQUEST['language'])) { ?> checked="checked"  <?php } ?>>
			<span class="flag flag-gb"></span>
			<span class="font-sixe"><?php echo $language->language_name; ?></span>
			<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo ($tmp_value!='')?$tmp_value:'0';  ?>)</span>
			</label>
			<br>
			<?php  } } ?>
			
			<?php foreach( $languages as  $language){
			if(!isset($languagesvalues[$language->language_id]))
			{
			 $dasabled5  = 'disabled="disabled"';
			
			 ?>
			<label>
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $language->language_id; ?>" name="language[]"  <?php echo $dasabled5; ?> onchange="filterlist();" <?php if(isset($_REQUEST['language']) && in_array($language->language_id,$_REQUEST['language'])) { ?> checked="checked"  <?php } ?>>
			<span class="flag flag-gb"></span>
			<span class="font-sixe"><?php echo $language->language_name; ?></span>
			<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php echo '0';  ?>)</span>
			</label>
			<br>
			<?php } } ?>
			
			
			</div>         
			</div>                
</li>
<div style="clear:both;"></div>
<li>			
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Working Hours</strong></h6>
<div class="onecolumn">
	 
		<div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; " >
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
		<input type="checkbox" <?php echo $dasabled6; ?> class="language-filters filteritem" name="working_hours[]" id="working_hours" value="<?php echo $hours; ?>"  onchange="filterlist();"  <?php if(isset($_REQUEST['working_hours']) && in_array($hours,$_REQUEST['working_hours'])){ ?> checked="checked" <?php } ?> >
		<span class="flag flag-gb"></span>
		<span class="font-sixe"><?php echo $hours;  ?></span>
		<span class="language-filter-count filter-count-hidden font-sixe" style="display: inline;">(<?php  echo $whoursvalues[$i]; ?>)</a></span>
		</label>
		<br>
		<?php } ?>
		</div>
		</div>        

</li>
</ul>
</div>

<input type="hidden" name="tab" id="tab" />

</form>

 <?php  $iyer=new User;?>


<div class="tab-content">
    <div id="pane1" class="tab-pane active">
	<div id="right-pane" class="sc-column sc-column-last three-fourth-last">
	<ul class="items items-list-view onecolumn">
  <?php 
  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$iyer->searchByIyer(),
				'emptyText' => "We're sorry, no Iyer found in this category.",
				'itemView'=>'iyer_view',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			));
			
	?>
	</ul>
  </div>
    </div>
    <div id="pane2" class="tab-pane">
   
   
    <div class="sc-column sc-column-last three-fourth-last" id="right-pane" >
	


<?php
echo "<div class='row'>";

$count = 1;

   if ( $count > 0 && $count % 4 == 0 )
   {
      echo "</div><div class='row' style='margin:0'>";
   }
   $count++;
   ?>

<?php 
  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$iyer->searchByIyer(),
				'emptyText' => "We're sorry, no Iyer found in this category.",
				'itemView'=>'iyer_gridview',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			));
			
	?>



   
   <?php


echo "</div>";

?>




	 <ul class="items items-list-view onecolumn">
	 
	 


   <?php
					/*$this->widget('ext.widgets.EColumnListView', array(
					'dataProvider' => $iyer->searchByIyer(),
					'emptyText' => "We're sorry, no Iyer found in this category.",
					'columns' => 3,
					'itemView' => 'iyer_gridview',
					'template'=>'{items}{pager}',
					));*/
   ?>
   </ul>
   </div>
    </div>
  </div>

	  
</div>
</div>


<script type="text/javascript">

function filterlist1(url)
{
var title =  $('#title').val();
if((title=='') || (title=='Search Keyword...'))
{
$("#title").css("background-color","#fbd9d9");
$("#title").css("border","2px solid red");
return false;
}
else
{
$("#category").submit();
}

}


function filterlist(url)
{
$("#category").submit()
}

</script>


</div>
<style>

.list-view-loading {
    background-position: bottom left  !important;
}

.list-view .pager {
    margin: 45px 0 0;
    text-align: right;
}

.items {
    margin-bottom: 0px !important;
}
</style>

<!--<style>

label {
    display: inline-block;
    margin-bottom: 5px;
    max-width: 100%;
    padding-top: 3px;
}

.rating-space {
    color: #c1c1c1;
    text-indent: 20px;
}

input[type="radio"], input[type="checkbox"] {
    line-height: normal;
    margin: 0 0 0;
}


ul.yiiPager a:link, ul.yiiPager a:visited {
    color: #040404 !important;

}


.ui-widget {
    font-family:13px arial,sans-serif !important;
    font-size: 1.1em;
}
.actiove 
{
 background: none repeat scroll 0 0 #555 !important;
}
.mainpage p, .textwidget p, .entry-content p {
    margin-bottom: 5px;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus 
{
background-color:#f5f5f5 !important;
}

.nav-tabs > li > a {
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
    line-height: 0.423;
    margin-right: 0px;
}
.pager .previous > a, .pager .previous > span {
    float: none;
}
.pager li > a, .pager li > span
{
 border-radius:2px;
}

.pager .next > a, .pager .next > span {
    float: none;
}
ul.yiiPager a:link, ul.yiiPager a:visited {
    color: #040404 !important;

}
.pager
{
width:156%;
}

.store-cart
{
margin-top:0px !important;
}

</style>-->


<script>
		jQuery('#title').autocomplete({
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
	  changeMonth : true,
      changeYear : true,
	  dateFormat: 'yy-mm-dd',
	  onSelect: function(selectedDate) {
            $('#todate').datepicker('option', 'minDate', selectedDate);
      }	
	 });
    
    jQuery("#todate").datepicker({
	  changeMonth : true,
      changeYear : true,
	  dateFormat: 'yy-mm-dd',	
	  onSelect: function(date)
	  {
	  $('#fromdate').datepicker('option', 'maxDate', date);
	    filterlist();
	  }
	  
	  
    });   
  }); 		
 </script>
 <script>
<?php if(isset($_REQUEST['tab'])) {?>
$(document).ready(function(){
activaTab('<?php echo $_REQUEST['tab']; ?>');
$('#tab').val('<?php echo $_REQUEST['tab']; ?>');
});
function activaTab(tab){
$('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
<?php } ?>
</script>	

<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus
{
background-color:#eee !important;
}

@media only screen and (max-width: 768px)
{
.font-sixe
{
font-size:13px !important;
}
}



@media only screen and (max-width: 480px)
{
.font-sixe
{
font-size:13px !important;
}
}

.flash-success
{
    background-color: #fcefd4;
    border: 1px solid #fae1c6;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	background-color: #caeecf;
    border-color: #b7e8b6;
    color: #38b44a;
}




</style>
