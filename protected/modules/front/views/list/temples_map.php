<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples',
);

$this->menu=array(
);
?>
<?php           $categories =Categories::model()->getall(); 
				$categoriesvalues = array();
				$states = States::model()->getall(); 
				$statesvalues = array();
				$categoriesvalues = array();
				
				if(isset($dataProvider1->rawData) && count($dataProvider1->rawData)){
				foreach($dataProvider1->rawData as $items){
				if(isset( $categoriesvalues[$items->category_id]) )
				$categoriesvalues[$items->category_id] = (int)$categoriesvalues[$items->category_id]+1;
				else
				$categoriesvalues[$items->category_id] = 1;
				
				if(isset( $statesvalues[$items->state_id]) )
				$statesvalues[$items->state_id] = (int)$statesvalues[$items->state_id]+1;
				else
				$statesvalues[$items->state_id] = 1;
				}
				}


?>
<div id="maincontent">

<div class="" style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/front/list/temples'); ?>">Temples </a></h3>
</div>
</div>


<div class="wrapper">
   <h3 class="epooja">Temples</h3>
 </div> 

 
  
  <div id="subcats-holder">
    <div class="wrapper ">

		
			      <form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:25px;">

							
<div class="sc-column one-half">

						<input type="text" style="padding:2%; width:60%;" placeholder="Search Keyword..." name="title" id="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:10px; width:20%; font-size:14px; margin-top:2px;background-color: #cb202d; " onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
						</span>
						
</div>


	

 
 
 <div id="ait-login-tabs" style="margin-top:8px;">
<div class="wrapper">
<ul class="tabbing" style="float:right; padding-right:10px;">
<li><a href="<?php echo CController::CreateUrl('list/temples'); ?>" class="login"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
<li  class="active" ><a href="#ait-dir-register-tab" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/map_view.png" title="Map View"></a></li>
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

		

       	 <div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:15px; " >
		<?php foreach( $categories as  $category){ 
		
		
		if(isset($categoriesvalues[$category->id]))
			$values_check='';
			else
			$values_check ='disabled="disabled"';
?>		 
			<label class="<?php echo (isset( $categoriesvalues[$category->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $category->id; ?>" id="lang-filters-29" name="categories[]" <?php  echo $values_check; ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->id,$_REQUEST['categories'])){ ?> checked="checked" <?php } ?>>
			<span class="flag flag-gb"></span>
			<span><a href="" id="category-link"><?php echo $category->category_name; ?></a></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset( $categoriesvalues[$category->id])?$categoriesvalues[$category->id]:'0'); ?>)</a></span>
			</label><br>
			<?php } ?>
			
			
			</div>


          
        </div>        
        <br />        
</li>



<div style="clear:both;"></div>


<li>			
 

       
 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Location</strong></a></h6>
 <div class="onecolumn">
	 
	  <div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; " >
	 <?php foreach( $states as  $state){ 
	 
	       if(isset($statesvalues[$state->id]))
			$values_state='';
			else
			$values_state ='disabled="disabled"';
			
			?>		 
			<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $state->id; ?>" id="lang-filters-29" <?php echo $values_state; ?> name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
			<span class="flag flag-gb"></span>
			<span><a href="" id="category-link"><?php echo $state->state_name; ?></a></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</a></span>
			</label><br>
			<?php } ?>


</div>

          
        </div>        

</li>	


<br>

<div style="clear:both;"></div>
<br>

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


    <div id="ait-dir-register-tab" class="tab-pane">
   
   <div style="height:auto;overflow:hidden;z-index:-999; margin-bottom:30px;">
<div id="googleMap" style="width: 900px; height:800px" ></div>
</div>
    </div>
	  
</div>
</div>


<script>

$(document).ready(function() {
	setTimeout(initialize, 5);
 });

		
function initialize() {
  var myLatlng = new google.maps.LatLng(9.9194,78.1194);
  var mapOptions = {
    zoom: 7,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
  

  
  <?php  for($i=0;$i<count($mapdetails);$i++) { ?>
 
              var marker<?php echo $i; ?> = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo $mapdetails[$i]->latitude; ?>, <?php echo $mapdetails[$i]->logtitute; ?>),
                map: map,
				title:'<?php echo $mapdetails[$i]->temple_name ?>',
              });
			  
			    marker<?php echo $i; ?>.setMap(map); 
				
				var test = '<?php echo $i;  ?>';
			  
				var infowindow = new google.maps.InfoWindow({
				content:test,
				});

				google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() 
				{
	infowindow.setContent("<span style='font-weight: bold;cursor:pointer; '><a href='<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($mapdetails[$i]->id))); ?>' style='color:#cb202d;'>"+this.title+"</a></span>");
				infowindow.open(map,marker<?php echo $i; ?>);
				});	 
		  
	<?php } ?>	

}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
function filterlist(url){

	$.post(url,  $('.filteritem').serialize()  , function(data){
	
	$('#ait-dir-register-tab').html(data);
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
    font-size: 1.1em;
}
.active
{
background:#f5f5f5;
}
.ie9 .dir-searchsubmit
{
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#cb202d', endColorstr='#cb202d');
}

</style>



<script>
$('#title').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : '<?php echo $this->createUrl('list/templesauto'); ?>',
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
