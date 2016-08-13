<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css' type='text/css' />
<?php 
$this->breadcrumbs=array(
'Guide',
);

$this->menu=array(
);
?>


<?php 
$urladditional = '';
if(isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != ''){ 
$urladditional = '/cid/'.$_REQUEST['cid'];
}

//validAfterDatepicker
$categories = Guidecategories::model()->getall(); 
$categoriesvalues = array();
$states = States::model()->getall(); 

$reviews= Reviews::model()->getall('guide');

$rv=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);



$statesvalues = array();
$servicevalues = array();
$languages = Languages::model()->getall(); 
$languagesvalues = array();
$services = Services::model()->getall(); 
$whours = array('0_3'=>'0 - 3 hours','3_5'=>'3 - 5 hours','5_7'=>'5 - 7 hours','7_24'=>'7 - 24 Hours');
$whoursvalues = array('0'=>0,'1'=>0,'2'=>0,'3'=>0);

$amounts = array('0_500'=>'0 - 500 Rs','500_1000'=>'500 - 1000 Rs','1000_1500'=>'1000 - 1500 Rs','1500_15000000'=>'Above 1500 Rs');
$amountsvalues = array('0_500'=>0,'500_1000'=>0,'1000_1500'=>0,'1500_15000000'=>0);

$exparr = array('0_1'=>'Below 1 year', '1_2'=>'1-2 years ', '2_5'=>'2-5 years ', '5_1000'=>'Above 5 years'); 
$exparrvalues = array('0_1'=>0, '1_2'=>0, '2_5'=>0, '5_1000'=>0); 

if(isset($dataProvider->rawData) && count($dataProvider->rawData)){
foreach($dataProvider->rawData as $items){
$items->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$items->user_id));

/*     if(isset( $categoriesvalues[$items->guidemoredetails->guide_categories]) )
$categoriesvalues[$items->guidemoredetails->guide_categories] = (int)$categoriesvalues[$items->guidemoredetails->guide_categories]+1;
else
$categoriesvalues[$items->guidemoredetails->guide_categories] = 1;*/


$guidecategories = explode(',',$items->guidemoredetails->guide_categories);

$guide_services = explode(',',$items->guidemoredetails->guide_services);


foreach($categories as  $category){
if(in_array($category->category_name,$guidecategories)){
if(isset($categoriesvalues[$category->category_name]) )
$categoriesvalues[$category->category_name] = (int)$categoriesvalues[$category->category_name]+1;
else
$categoriesvalues[$category->category_name] = 1;
}
}

foreach($services as  $service){
if(in_array($service->service_name,$guide_services)){
if(isset($servicevalues[$service->service_name]) )
$servicevalues[$service->service_name] = (int)$servicevalues[$service->service_name]+1;
else
$servicevalues[$service->service_name] = 1;
}
}

if(isset($languagesvalues[$items->language]))
$languagesvalues[$items->language] = (int)$languagesvalues[$items->language]+1;
else
$languagesvalues[$items->language] = 1;


/*if((float)$items->guidemoredetails->guide_experience>=0 && (float)$items->guidemoredetails->guide_experience<1)
$exparrvalues['0_1'] = $exparrvalues['0_1']+1;
else if((float)$items->guidemoredetails->guide_experience>=1 && (float)$items->guidemoredetails->guide_experience<2)
$exparrvalues['1_2'] = $exparrvalues['1_2']+1;
else if((float)$items->guidemoredetails->guide_experience>=2 && (float)$items->guidemoredetails->guide_experience<5)
$exparrvalues['2_5'] = $exparrvalues['2_5']+1;
else if((float)$items->guidemoredetails->guide_experience>=5)
$exparrvalues['5_1000'] = $exparrvalues['5_1000']+1;*/


	if($items->guidemoredetails->guide_experiencetype=='Month(s)')
	{
	$year = $items->guidemoredetails->guide_experience/12;
	
	$year = round($year,1);
	
	if((float)$year>=0 && (float)$year<1)
	
	$exparrvalues['0_1'] = $exparrvalues['0_1']+1;
	
	else if((float)$year>=1 && (float)$year<2)
	
	$exparrvalues['1_2'] = $exparrvalues['1_2']+1;
	
	else if((float)$year>=2 && (float)$year<5)
	
	$exparrvalues['2_5'] = $exparrvalues['2_5']+1;
	
	else if((float)$year>=5)
	
	$exparrvalues['5_1000'] = $exparrvalues['5_1000']+1;
	
	$items->guidemoredetails->monthsinyears = $year;  
	
	$items->guidemoredetails->save();
	}
	else
	{ 					
	if((float)$items->guidemoredetails->guide_experience>=0 && (float)$items->guidemoredetails->guide_experience<1)
	
	$exparrvalues['0_1'] = $exparrvalues['0_1']+1;
	
	else if((float)$items->guidemoredetails->guide_experience>=1 && (float)$items->guidemoredetails->guide_experience<2)
	
	$exparrvalues['1_2'] = $exparrvalues['1_2']+1;
	
	else if((float)$items->guidemoredetails->guide_experience>=2 && (float)$items->guidemoredetails->guide_experience<5)
	
	$exparrvalues['2_5'] = $exparrvalues['2_5']+1;
	
	else if((float)$items->guidemoredetails->guide_experience>=5)
	
	$exparrvalues['5_1000'] = $exparrvalues['5_1000']+1;
	}
				  


if((int)$items->guidemoredetails->guide_wh>=0 && (int)$items->guidemoredetails->guide_wh<3)
$whoursvalues['0'] = $whoursvalues['0']+1;
else if((int)$items->guidemoredetails->guide_wh>=3 && (int)$items->guidemoredetails->guide_wh<5)
$whoursvalues['1'] = $whoursvalues['1']+1;
else if((int)$items->guidemoredetails->guide_wh>=5 && (int)$items->guidemoredetails->guide_wh<7)
$whoursvalues['2'] = $whoursvalues['2']+1;
else if((int)$items->guidemoredetails->guide_wh>=7 && (int)$items->guidemoredetails->guide_wh<25)
$whoursvalues['3'] = $whoursvalues['3']+1;


if((float)$items->guidemoredetails->guide_amount>=0 && (float)$items->guidemoredetails->guide_amount<500)
$amountsvalues['0_500'] = $amountsvalues['0_500']+1;
else if((float)$items->guidemoredetails->guide_amount>=500 && (float)$items->guidemoredetails->guide_amount<1000)
$amountsvalues['500_1000'] = $amountsvalues['500_1000']+1;
else if((float)$items->guidemoredetails->guide_amount>=1000 && (float)$items->guidemoredetails->guide_amount<1500)
$amountsvalues['1000_1500'] = $amountsvalues['1000_1500']+1;
else if((float)$items->guidemoredetails->guide_amount>=1500)
$amountsvalues['1500_15000000'] = $amountsvalues['1500_15000000']+1;


if(isset( $statesvalues[$items->guidemoredetails->guide_state]) )
$statesvalues[$items->guidemoredetails->guide_state] = (int)$statesvalues[$items->guidemoredetails->guide_state]+1;
else
$statesvalues[$items->guidemoredetails->guide_state] = 1;


$reviews = new Reviews;
$type = 'guide';
$id= $items->user_id;
$review = Reviews::model()->get_average($type,$id);

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
<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/list/guide'); ?>">&nbsp;Guides</a></h3>
</div>
</div>




<div id="maincontent" style="margin-bottom:30px;">
<div class="wrapper">
<h3 class="epooja">Guides</h3>
</div> 


<?php if(Yii::app()->user->hasFlash('booked')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('booked'); ?>
</div>
<?php endif; ?>

<div id="subcats-holder">
<div class="wrapper">


<form class="wp-user-form" action="" method="get"  id="category" style=" margin-top:25px;">
<div class="wrapper">

<div class="sc-column one-half" style="padding-bottom:20px;">
<input type="text" style="padding:1%; width:60%;" placeholder="Search Keyword..." name="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>" id="title">
<span class="dir-searchsubmit" id="directory-search">
<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:10px; width:20%; font-size:14px;" onclick="filterlist1('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >

<input type="hidden" name="tab" id="tab" />		


</span>
</div>


<div class="tabbable" style="float:right; margin-top:10px;">
<ul class="nav nav-tabs"  id="myTab">
<li class="active"><a href="#pane1" data-toggle="tab" onclick="$('#tab').val('pane1');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
<li><a href="#pane2" data-toggle="tab" onclick="$('#tab').val('pane2');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
</ul>
</div>
</div>		


</div>
<br>

<div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  

<ul class="sc-list">
<li>
<h6 style="background-color:#EBEBEB;padding: 10px;border-radius:1px;margin-top:-10px;"><a href="#" class="item-title"><strong>Date</strong></a></h6>
<div class="onecolumn"  id="date-column">

<form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:15px;">
<div class="wrapper">

<div class="sc-column one-half">
<input type="text" style="padding:1%; width:15%;" placeholder="from" id="fromdate" name="fromdate" class="filteritem"  value="<?php echo isset($_REQUEST['fromdate'])?$_REQUEST['fromdate']:''; ?>"><span style="margin-right: 5px;" class="connector">&nbsp;&nbsp;-</span>
<input type="text" style="padding:1%; width:15%;" placeholder="to" id="todate" name="todate" class="filteritem"  <?php if(isset($_REQUEST['todate']) ){ ?>  value="<?php echo $_REQUEST['todate']; ?>" <?php } ?>>
</div>
</div>
</div>                       
</li>


<li>
<h6 style="background-color:#EBEBEB;padding: 10px;margin-top:10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Categories</strong></a></h6>
<div class="onecolumn">
<div class="one-third"  style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; ">

<?php 
foreach( $categories as  $category){
if(isset($categoriesvalues[$category->category_name]))
{
?>		 
<label class="<?php echo (isset( $categoriesvalues[$category->category_name])?'':'filterhidden'); ?>">
<input type="checkbox" class="language-filters filteritem category-filter" value="<?php echo $category->category_name; ?>" id="lang-filters-29" name="categories[]" onchange="filterlist()" <?php if(isset($_REQUEST['categories']) && in_array($category->category_name,$_REQUEST['categories'])){ ?> checked="checked" <?php } ?> style="cursor:pointer;">
<span class="flag flag-gb"></span>
<span><?php echo $category->category_name; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $categoriesvalues[$category->category_name])?$categoriesvalues[$category->category_name]:'0'); ?>)</span>
</label>
<?php } } ?>  

<?php foreach( $categories as  $category){ 
if(!array_key_exists($category->category_name,$categoriesvalues))
{
$firstr_not1 = 'disabled="disabled"';?>		 
<label class="<?php echo (isset( $categoriesvalues[$category->category_name])?'':'filterhidden'); ?>">
<input type="checkbox" class="language-filters filteritem category-filter" value="<?php echo $category->category_name; ?>" id="lang-filters-29" name="categories"  <?php echo  $firstr_not1; ?>>
<span class="flag flag-gb"></span>
<span><?php echo $category->category_name; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(0)</span>
</label>
<?php } }  ?>  
</div>
</div>        
<br />        
</li>


<li> 
<h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="javascript:void(0);" class="item-title"><strong>Experience</strong></a></h6>
<div class="onecolumn">
<div class="one-fourth" style="padding:9px;"> 

<?php foreach( $exparr as $expkey=>$exp){

			if($exparrvalues[$expkey]=='0')
			$disbled = 'disabled="disabled"'; 
			else
			$disbled = ''; 
		
 ?>		 
<label class="<?php echo (isset( $exparrvalues[$expkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php echo $disbled; ?> class="experience-filter filteritem states-filter" value="<?php echo $expkey; ?>" id="lang-filters-29" name="experience[]" <?php if(isset($_REQUEST['experience']) && in_array($expkey,$_REQUEST['experience'])){ ?> checked="checked" <?php } ?>  onchange="filterlist()">
<span class="flag flag-gb"></span>
<span><?php echo $exp; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $exparrvalues[$expkey])?$exparrvalues[$expkey]:'0'); ?>)</span>
</label>
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
<div class="one-fourth"  style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; "> 
<?php foreach( $states as  $state){ 

if(isset($statesvalues[$state->id]))
	{
	?>		 
<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
<input type="checkbox" class="language-filters filteritem states-filter" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist()" >
<span class="flag flag-gb"></span>
<span><?php echo $state->state_name; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</span>
</label>
<?php } }  ?>


<?php foreach( $states as  $state){

  if(!array_key_exists($state->id,$statesvalues))
	 {
	$disbled1 = 'disabled="disabled"'; 
	
	 ?>		 
<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
<input type="checkbox" class="language-filters filteritem states-filter" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]"   <?php echo $disbled1; ?> >
<span class="flag flag-gb"></span>
<span><?php echo $state->state_name; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</span>
</label>
<?php } } ?>


</div>      
</div>
</li>

<div style="clear:both;"></div>

<li>			
<h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Price</strong></a></h6>
<div class="onecolumn">
<div class="sc-column one-fourth" style="padding: 13px;">
<?php foreach(  $amounts as    $amountkey=>$amount){ 

if(isset($amountsvalues[$amountkey]) && $amountsvalues[$amountkey]!='0')
{
 $check ="";
}
else
{
 $check = 'disabled="disabled"';
}

?>		 
<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" class="language-filters filteritem amounts-filter" value="<?php echo  $amountkey; ?>" id="lang-filters-29" name="amounts[]" <?php if(isset($_REQUEST['amounts']) && in_array($amountkey,$_REQUEST['amounts'])){ ?> checked="checked" <?php } ?>  <?php echo $check; ?> onchange="filterlist();" >
<span class="flag flag-gb"></span>
<span><?php echo $amount; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $amountsvalues[$amountkey])?$amountsvalues[$amountkey]:'0'); ?>)</span>
</label>
<?php } ?>
</div>   
</div>       
</li>
<br>

<div style="clear:both;"></div>

<li>
<h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Ratings</strong></a></h6>
<div class="onecolumn" style="margin-left: 15px;">


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

<div class="sc-column one-fourth" style="">

<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(5,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  onchange="filterlist();"  <?php echo $ratings5; ?>  class="language-filters left filteritem" value="5"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"> </span> <p  id="categories-rating" class="rating-space">(<?php echo $rv[5];?>) </p>
</label>
<div style="clear:both;"></div>
<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(4,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  onchange="filterlist();" <?php echo $ratings4; ?>  class="language-filters left filteritem" value="4"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[4];?>)</p> 
</label>
<div style="clear:both;"></div>
<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(3,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  onchange="filterlist();" <?php echo $ratings3; ?>  class="language-filters left filteritem" value="3"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[3];?>)</p> 
</label> 
<div style="clear:both;"></div>
<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(2,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  onchange="filterlist();"  <?php echo $ratings2; ?> class="language-filters left filteritem" value="2"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[2];?>)</p>
</label>
<div style="clear:both;"></div>
<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">
<input type="checkbox" <?php if(isset($_REQUEST['ratings']) && in_array(1,$_REQUEST['ratings'])){ ?> checked="checked" <?php } ?>  onchange="filterlist();" <?php echo $ratings1; ?>  class="language-filters left filteritem" value="1"  style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[1];?>)</p>
</label>
</label>
</div>
</div>                    

</li>
<style>
.item-stars p {
margin-top: -5px;
text-indent: 10px;
color: #C1C1C1;
}
label {
    display:block;
    margin-bottom: 5px;
    max-width: 103%;
}

</style> 

<div style="clear:both;"></div>
<li>
<h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Languages</strong></a></h6>

<div class="onecolumn">
<div class="sc-column one-fourth"  style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; ">

	<?php foreach( $languages as  $language){
	
	$tmp_value ='';
	if(array_key_exists($language->language_id,$languagesvalues))
	{	
	if(isset($languagesvalues[$language->language_id]))
	$tmp_value = $languagesvalues[$language->language_id];
	
	?>		 
	<label class="<?php echo (isset( $languagesvalues[$language->language_id])?'':'filterhidden'); ?>">
	<input type="checkbox" class="language-filters filteritem languages-filter" value="<?php echo $language->language_id; ?>" id="lang-filters-29" name="languages[]" onchange="filterlist()" <?php if(isset($_REQUEST['languages']) && in_array($language->language_id,$_REQUEST['languages'])){ ?> checked="checked" <?php } ?> >
	<span class="flag flag-gb"></span>
	<span><?php echo $language->language_name; ?></span>
	<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $languagesvalues[$language->language_id])?$languagesvalues[$language->language_id]:'0'); ?>)</span>
	</label>
	<?php }  } ?>
	
	
	<?php foreach( $languages as  $language){
	
	if(!isset($languagesvalues[$language->language_id]))
	{
	$dasabled5  = 'disabled="disabled"';			
	?>		 
	<label class="<?php echo (isset( $languagesvalues[$language->language_id])?'':'filterhidden'); ?>">
	<input type="checkbox" class="language-filters filteritem languages-filter" value="<?php echo $language->language_id; ?>" id="lang-filters-29" name="languages[]" <?php echo $dasabled5; ?> >
	<span class="flag flag-gb"></span>
	<span><?php echo $language->language_name; ?></span>
	<span class="language-filter-count filter-count-hidden" style="display: inline;">(0)</span>
	</label>
	<?php }  } ?>

</div>         
</div>                
<br />
</li>

<div style="clear:both;"></div>
<br>
<li>			

<h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Services</strong></a></h6>
<div class="onecolumn">

<div class="sc-column one-fourth"  style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:5px; ">

<?php foreach( $services as  $service){

if(isset($servicevalues[$service->service_name]))
{
 ?>		 
<label class="">
<input type="checkbox" class="language-filters filteritem services-filter" value="<?php echo $service->service_name; ?>" id="lang-filters-29" name="services[]"  onchange="filterlist()" <?php if(isset($_REQUEST['services']) && in_array($service->service_name,$_REQUEST['services'])){ ?> checked="checked" <?php } ?>  >
<span class="flag flag-gb"></span>
<span><?php echo $service->service_name; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $servicevalues[$service->service_name])?$servicevalues[$service->service_name]:'0'); ?>)</span>
</label>
<?php } }?>


<?php foreach( $services as  $service){ 
if(!array_key_exists($service->service_name,$servicevalues))
{
$firstr_not1 = 'disabled="disabled"';?>	
		 
<label class="">
<input type="checkbox" class="language-filters filteritem services-filter" value="<?php echo $service->service_id; ?>" id="lang-filters-29" name="services[]" <?php echo $firstr_not1; ?> >
<span class="flag flag-gb"></span>
<span><?php echo $service->service_name; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(0)</span>
</label>
<?php }} ?>

</div>


</div>        

</li>

<div style="clear:both;"></div>
<br>
<li>			


<h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a class="item-title" href="#"><strong>Working Hours</strong></a></h6>
<div class="onecolumn">

<div style="padding: 13px;" class="sc-column one-fourth">

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
<label class="<?php echo (isset( $whoursvalues[$hours])?'':'filterhidden'); ?>">
<input type="checkbox" class="language-filters filteritem whours-filter" value="<?php echo  $hours; ?>" <?php echo $dasabled6; ?> id="lang-filters-29" name="working_hours[]"  <?php if(isset($_REQUEST['working_hours']) && in_array($hours,$_REQUEST['working_hours'])){ ?> checked="checked" <?php } ?> onchange="filterlist();"  >
<span class="flag flag-gb"></span>
<span><?php echo $hours; ?></span>
<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php  echo $whoursvalues[$i]; ?>)</span>
</label>
<?php } ?>
</div>


</div>        
</li>

</form>

<br>
</ul>

</div>

 <?php  $guide=new User;?>
 

<div class="tab-content" >
<div id="pane1" class="tab-pane active">
<div class="sc-column sc-column-last three-fourth-last" id="right-pane">
<ul class="items items-list-view onecolumn">
<?php
  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$guide->searchByGuide(),
				'emptyText' => "We're sorry, no Guide found in this category.",
				'itemView'=>'guide_list',
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
				'dataProvider'=>$guide->searchByGuide(),
				'emptyText' => "We're sorry, no Guide found in this category.",
				'itemView'=>'guide_grid',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			));
echo "</div>";
?>
</div>
</div>

</div>
</div>

</div>
</div>
<script type="text/javascript">
					$('#title').autocomplete({
					source: function( request, response ) {
					$.ajax({
					url : '<?php echo $this->createUrl('auto/guidemain'); ?>',
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
$("#fromdate").datepicker({
changeMonth : true,
changeYear : true,
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#todate" ).datepicker( "option", "minDate", selectedDate );
}
});

$("#todate").datepicker({
changeMonth : true,
changeYear : true,
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
 filterlist();
}
});
});

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

</script>

<style>

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    background-color: #f5f5f5 !important;
}
.nav-tabs > li > a {
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
    line-height: 0.423;
    margin-right: 0;
}
.nav li {
    border: 1px solid #f5f5f5;
}
.list-view .pager {
    margin: 50px 0 0;
    text-align: right;
}
.items
{
margin-bottom: 0px;
}

.pull-left{ float:left; }
.pull-right{ float:right; }

.filtersmanagesectionpart {
background-color: #CCCCCC;
border-radius: 5px;
display: table;
padding: 5px;
float:left; margin-right:10px;
margin-bottom: 10px;
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

.filtersmanagesectionpart .pull-right{
margin-left:10px;
}

.filtersmanagesection {
clear: both;
display: table;
}

.list-view-loading {
    background-position: bottom left  !important;
}
</style>

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
