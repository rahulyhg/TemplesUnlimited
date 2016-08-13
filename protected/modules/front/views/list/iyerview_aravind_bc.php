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
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/list/Iyer'); ?>">Temples </a></h3>
</div>
</div>


<div class="wrapper">
   <h3 class="epooja">Iyers</h3>
 </div> 

  <?php
  $categories =Poojacategories::model()->getall();

           $categoriesvalues = array();

		   $states = States::model()->getall();

		   $statesvalues = array();

		   $languages = Languages::model()->getall();

		   $languagesvalues = array();

		   $whours = array('0_3'=>'0 - 3 hours','3_5'=>'3 - 5 hours','5_7'=>'5 - 7 hours','7_24'=>'Full Day(7+ hours)');

		   $whoursvalues = array('0_3'=>0,'3_5'=>0,'5_7'=>0,'7_24'=>0);



			$amounts = array('0_500'=>'0 - 500 Rs','500_1000'=>'500 - 1000 Rs','1000_1500'=>'1000 - 1500 Rs','1500_15000000'=>'Above 1500 Rs');

		    $amountsvalues = array('0_500'=>0,'500_1000'=>0,'1000_1500'=>0,'1500_15000000'=>0);

			 $exparr = array('0_1'=>'Below 1 year', '1_2'=>'1-2 years ', '2_5'=>'2-5 years ', '5_1000'=>'Above 5 years');

			$exparrvalues = array('0_1'=>0, '1_2'=>0, '2_5'=>0, '5_1000'=>0);



		   if(isset($dataProvider->rawData) && count($dataProvider->rawData)){

		      foreach($dataProvider->rawData as $items){

			    $items->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$items->user_id));









			    $iyercategories = explode(',',$items->iyermoredetails->iyer_categories);



				foreach($categories as  $category){

					if(in_array($category->category_id, $iyercategories)){

						 if(isset( $categoriesvalues[$category->category_id]) )

						 $categoriesvalues[$category->category_id] = (int)$categoriesvalues[$category->category_id]+1;

						 else

						 $categoriesvalues[$category->category_id] = 1;

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

				  $whoursvalues['0_3'] = $whoursvalues['0_3']+1;

				  else if((int)$items->iyermoredetails->iyer_wh>=3 && (int)$items->iyermoredetails->iyer_wh<5)

				  $whoursvalues['3_5'] = $whoursvalues['3_5']+1;

				  else if((int)$items->iyermoredetails->iyer_wh>=5 && (int)$items->iyermoredetails->iyer_wh<7)

				  $whoursvalues['5_7'] = $whoursvalues['5_7']+1;

				  else if((int)$items->iyermoredetails->iyer_wh>=7 && (int)$items->iyermoredetails->iyer_wh<25)

				  $whoursvalues['7_24'] = $whoursvalues['7_24']+1;





				   if((float)$items->iyermoredetails->iyer_amount>=0 && (float)$items->iyermoredetails->iyer_amount<500)

				  $amountsvalues['0_500'] = $amountsvalues['0_500']+1;

				  else if((float)$items->iyermoredetails->iyer_amount>=500 && (float)$items->iyermoredetails->iyer_amount<1000)

				  $amountsvalues['500_1000'] = $amountsvalues['500_1000']+1;

				  else if((float)$items->iyermoredetails->iyer_amount>=1000 && (float)$items->iyermoredetails->iyer_amount<1500)

				  $amountsvalues['1000_1500'] = $amountsvalues['1000_1500']+1;

				  else if((float)$items->iyermoredetails->iyer_amount>=1500)

				  $amountsvalues['1500_15000000'] = $amountsvalues['1500_15000000']+1;



				  if(isset( $languagesvalues[$items->language]) )

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
<?php
/*$this->widget('ext.typeahead.TbTypeAhead',array(
       'name' => 'hello',
     'attribute' => 'keyword',
     'enableHogan' => true,
     'options' => array(
         array(
             'name' => 'countries',
             'valueKey' => 'name',
             'remote' => array(
                 'url' => $this->createUrl('list/templesAutoComplete') . '?term=%QUERY',
             ),

             'engine' => new CJavaScriptExpression('Hogan'),
         )
     ),
    'htmlOptions'=>array(
			'style'=>'padding:2%;height:30px;background-color: transparent; height: 25px; margin-top: -5px; padding-bottom: 2%; padding-left: 2%;padding-right: 2%;position: relative; vertical-align: top;border-radius:5px; width:275px;','placeHolder'=>'Enter Search Temple'
        ),
    'events' => array(
         'selected' => new CJavascriptExpression("function(obj, datum, name) {
             console.log(obj);
             
         }")
        )
));*/


?>
						<input type="text" style="padding:2%; width:60%;" placeholder="Search Keyword..." name="title" id="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:10px; width:20%; font-size:14px; margin-top:2px;" onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
						</span>
						
</div>


	

 
 
 <div id="ait-login-tabs" style="margin-top:8px;">
<div class="wrapper">
<ul class="tabbing" style="float:right; padding-right:10px;">
<li><a href="#ait-dir-login-tab" class="login"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
<li class="active"><a href="#ait-dir-register-tab" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
</ul>
</div>


</div>
	
	




					 
</form>

<br>
	
	
	
      <div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
		           
      <ul class="sc-list " style="">
		  
		  
		  
<li>
       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Categories</strong></a></h6>
 <div class="onecolumn">
          <div class="one-third" style="padding: 9px;">
		

       	 <div class="sc-column one-fourth" style="padding: 13px;">
	<?php foreach( $categories as  $category){ ?>

			<label class="<?php echo (isset( $categoriesvalues[$category->category_id])?'':'filterhidden'); ?>">

			<input type="radio" class="language-filters filteritem category-filter" value="<?php echo $category->category_id; ?>" id="lang-filters-29" name="categories" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->category_id,array($_REQUEST['categories']))){ ?> checked="checked" <?php } ?>>

			<span class="flag flag-gb"></span>

			<span><?php echo $category->category_name; ?></span>

			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $categoriesvalues[$category->category_id])?$categoriesvalues[$category->category_id]:'0'); ?>)</span>

			</label><br>

			<?php } ?>
			
			
			</div>

            
          </div>
          
        </div>        
        <br />        
</li>

<!--<li> 
 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Destinations</strong></a></h6>
 <div class="onecolumn">
          <div class="one-fourth" style="padding:9px;"> 
                  <ul class="style1">
                 <li class="style1"><a href="" id="category-link">Uttarpradesh (3)</a></li>
                  <li class="style1"><a href="" id="category-link">Karnataka (1)</a></li>
                   <li class="style1"><a href="" id="category-link">Delhi (4)</a></li>
                    <li class="style1"><a href="" id="category-link">West Bengal (2)</a></li>
                 </ul> 
          </div>      
 </div>

</li>-->


<div style="clear:both;"></div>

<li>

 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;

border-top-right-radius:5px;

border-bottom-right-radius:0px;

border-bottom-left-radius:0px;"><a href="javascript:void(0);" class="item-title"><strong>Experience</strong></a></h6>

 <div class="onecolumn">

          <div class="one-fourth" style="padding:9px;">



                 <?php foreach( $exparr as $expkey=>$exp){ ?>

			<label class="<?php echo (isset( $exparrvalues[$expkey])?'':'filterhidden'); ?>">

			<input type="checkbox" class="experience-filter filteritem states-filter" value="<?php echo $expkey; ?>" id="lang-filters-29" name="experience[]" <?php if(isset($_REQUEST['experience']) && in_array($expkey,$_REQUEST['experience'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" >

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

          <div class="one-fourth" style="padding:9px;">

                 <?php foreach( $states as  $state){ ?>

			<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">

			<input type="checkbox" class="language-filters filteritem states-filter" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" >

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

<br>

<li>



 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;

border-top-right-radius:5px;

border-bottom-right-radius:0px;

border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Price</strong></a></h6>

 <div class="onecolumn">



	  <div class="sc-column one-fourth" style="padding: 13px;">



	   <?php foreach(  $amounts as    $amountkey=>$amount){ ?>

			<label class="<?php echo (isset( $amountsvalues[$amountkey])?'':'filterhidden'); ?>">

			<input type="checkbox" class="language-filters filteritem amounts-filter" value="<?php echo  $amountkey; ?>" id="lang-filters-29" name="amounts[]" <?php if(isset($_REQUEST['amounts']) && in_array($amountkey,$_REQUEST['amounts'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urladditional)); ?>')" >

			<span class="flag flag-gb"></span>

			<span><?php echo $amount; ?></span>

			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $amountsvalues[$amountkey])?$amountsvalues[$amountkey]:'0'); ?>)</span>

			</label><br>

			<?php } ?>





</div>



         <!-- <div class="one-third" style="padding: 9px;">



        <ul class="style1">

<li class="style1"><a href="" id="category-link">Private Tour (1)</a></li>

<li class="style1"><a href="" id="category-link">Wheelchair Accessible (2)</a></li>

<li class="style1"><a href="" id="category-link">Skip the Line(4)</a></li>

<li class="style1"><a href="" id="category-link">Hotel Pick-up Possible (3)</a></li>

</ul>



          </div>-->



        </div>



</li>

<li>
 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title"><strong>Ratings</strong></a></h6>
 <div class="onecolumn" style="margin-left: 15px;">
	 
	 <div class="sc-column one-fourth" style="">
	
         <label class="">
<span class="flag flag-gb"></span>
<input type="checkbox" class="language-filters left filteritem" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"> </span> <p  id="categories-rating" 
class="rating-space" style="">  (2) </p>
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(1)</p> 
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(1)</p> 
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(0)</p>
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(1)</p>
</a>
</label>
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
			
			
			
			$dataProvider1->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider1,
				'itemView'=>'iyer_view',
				'template'=>'{items}{pager}',
				/*'template'=>'{items}',*/
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
		</ul>
		
		

	  </div>

    </div>

	
	

	  <div id="ait-dir-register-tab" style="display:none;">

     <div style="margin-bottom:40px;" class=" itemclass">

	<div class="sc-column one-fourth">

	<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/image/img1.jpg">

	<h5 align="center">MR.Akil Kumar.A</h5>

	<h5 align="center"><strong>Rs. 7,100</strong></h5>

	<p><strong>Location:</strong> Madurai<br /><strong>Phone:</strong>52532532532<br /><strong>Languages:</strong>Tamil,English</p>

	<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt(65))); ?>" class="sc-button aligncenter left store-cart" style="background-color: #CB202D; border-radius:10px; margin-left:32px;" > <span class="border"><span class="wrap"><span class="title" style="color: #ffffff; text-align:center" >View Details</span></span></span></a>&nbsp;&nbsp;

	</div>



	<div class="sc-column one-fourth"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/image/img4.jpg">

	<h5 align="center">MS.Anjana</h5>

	<h5 align="center"><strong>Rs. 6,000</strong></h5>

	<p><strong>Location:</strong> Chennai<br /><strong>Phone:</strong>65654654654<br /><strong>Languages:</strong>Tamil,Telungu</p>

	<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt(65))); ?>" class="sc-button aligncenter left store-cart" style="background-color: #CB202D; border-radius:10px; margin-left:32px;"><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">View Details</span></span></span></a>&nbsp;&nbsp;</div>

	<div class="sc-column sc-column-last one-fourth-last"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/image/img3.jpg">

	<h5 align="center">MS.Anuratha.R</h5>

	<h5 align="center"><strong>Rs. 3,0000</strong></h5>

	<p><strong>Location:</strong>Kovai<br /><strong>Phone:</strong>65654654654<br /><strong>Languages:</strong>Tamil,Malayalam</p>

	<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt(65))); ?>" class="sc-button aligncenter left store-cart" style="background-color: #CB202D; border-radius:10px;margin-left:32px; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">View Details</span></span></span></a>&nbsp;</div>

	</div>





	<div class="sc-column sc-column-last one-half-last right">

<div id="pagin1" class="pagin right" style="width:50%">

<div class="pagination">

    <ul>

    <li><a href="#">&laquo;</a></li>

    <li><a href="#">1</a></li>

    <li><a href="#">2</a></li>

    <li><a href="#">3</a></li>

    <li><a href="#">4</a></li>

	<li><a href="#">..</a></li>

    <li><a href="#">&raquo;</a></li>

    </ul>

    </div>

	</div>



</div>





	  </div>

	  
	  
</div>
</div>





<script type="text/javascript">
function filterlist(url){

	$.post(url,  $('.filteritem').serialize()  , function(data){
	$('#maincontent').html(data);
	 });
}

$(function(){
	$('.yiiPager li a').click(function(e){
	    e.preventDefault();
		filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>/page/'+$(this).html());
	   
	});
});
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

</style>

<script>
				jQuery(document).ready(function($) {
					var tabRegister = $('#ait-dir-register-tab'),
						tabLogin =  $('#ait-dir-login-tab'),
						linkLogin = $('#ait-login-tabs .login'),
						linkRegister = $('#ait-login-tabs .register');
					linkLogin.click(function(event) {
						linkRegister.parent().removeClass('active');
						tabRegister.hide();
						linkLogin.parent().addClass('active');
						tabLogin.show();
						event.preventDefault();
					});
					linkRegister.click(function(event) {
						linkLogin.parent().removeClass('active');
						tabLogin.hide();
						linkRegister.parent().addClass('active');
						tabRegister.show();
						event.preventDefault();
					});
					// init and change
					var select = tabRegister.find('select[name=directory-role]'),
						buttonSubmit = tabRegister.find('input[name=user-submit]'),
						freeTitle = 'Sign up',
						buyTitle = 'Sign Up';
					if(select.find('option:selected').hasClass('free')){
						buttonSubmit.val(freeTitle);
					} else {
						buttonSubmit.val(buyTitle);
					}
					select.change(function(event) {
						if(select.find('option:selected').hasClass('free')){
							buttonSubmit.val(freeTitle);
						} else {
							buttonSubmit.val(buyTitle);
						}
					});
				});
				</script>
				


<script>
$('#title').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : '<?php echo $this->createUrl('list/iyerauto'); ?>',
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
 </script>	
