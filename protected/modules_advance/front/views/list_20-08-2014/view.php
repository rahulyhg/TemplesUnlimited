<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples',
);

$this->menu=array(
);
?>
<?php $categories =Categories::model()->getall(); 
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
<div class="wrapper">
   <h3 class="epooja">Temples</h3>
 </div> 

             
               
               
  
  <div id="subcats-holder">
    <div class="wrapper">

		
			      <form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:25px;">
					    <div class="wrapper">
							
<div class="sc-column one-half">
	
						<!--<select name="directory-role" style="padding:2%; width:30%">
						<option class="free" value="directory_1">Dharshan</option>
						<option class="free" value="directory_2">Pooja</option>
						<option class="free" value="directory_3">Prasad</option>
						<option class="free" value="directory_4">Products</option>
						</select>-->


						<input type="text" style="padding:2%; width:35%;" placeholder="Search Keyword..." name="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:5px; width:20%; font-size:14px;" onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						</span>
						
</div>

<!--<div class="sc-column one-half right" style="float:right;margin-top:12px;">-->
<div style="float: right;margin-top: 16px;width: 24%;"  id="pagin">
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
</form>

<br>
	
	
	
      <div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
		           
      <ul class="sc-list " style="">
		  
		  
		 


<!--<li>
 <h6 style="background-color:#EBEBEB;padding: 10px;border-radius:1px;margin-top:-10px;"><a href="#" class="item-title"><strong>Date</strong></a></h6>
 <div class="onecolumn" style="" id="date-column">
	 
	<form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:15px;">
					    <div class="wrapper">
							
<div class="sc-column one-half">
	

						<input type="text" style="padding:1%; width:13%;" placeholder="from" id="fromdate"><span style="margin-right: 15px;" class="connector">-</span>
						<input type="text" style="padding:1%; width:13%;" placeholder="to" id="todate">
						

</div>

</div></form>

          </div>                       
       
</li>-->

		  
		  
<li>
       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Categories</strong></a></h6>
 <div class="onecolumn">
          <div class="one-third" style="padding: 9px;">
		

       	 <div class="sc-column one-fourth" style="padding: 13px;">
		<?php foreach( $categories as  $category){ ?>		 
			<label class="<?php echo (isset( $categoriesvalues[$category->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $category->id; ?>" id="lang-filters-29" name="categories[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->id,$_REQUEST['categories'])){ ?> checked="checked" <?php } ?>>
			<span class="flag flag-gb"></span>
			<span><a href="" id="category-link"><?php echo $category->category_name; ?></a></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset( $categoriesvalues[$category->id])?$categoriesvalues[$category->id]:'0'); ?>)</a></span>
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
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Location</strong></a></h6>
 <div class="onecolumn">
	 
	  <div class="sc-column one-fourth" style="padding: 13px;">
	 <?php foreach( $states as  $state){ ?>		 
			<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $state->id; ?>" id="lang-filters-29" name="states[]" <?php if(isset($_REQUEST['states']) && in_array($state->id,$_REQUEST['states'])){ ?> checked="checked" <?php } ?> onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
			<span class="flag flag-gb"></span>
			<span><a href="" id="category-link"><?php echo $state->state_name; ?></a></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</a></span>
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
 <a href="" id="category-link">
<input type="checkbox" class="language-filters left filteritem" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"> </span> <p  id="categories-rating" 
class="rating-space" style="">  (2) </p>
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(1)</p> 
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(1)</p> 
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(0)</p>
<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(1)</p>
<!--<input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" style="margin-right:12px;"><span>Not yet rated</span><span  id="categories-rating">(1)</span><br>-->
     
            <!--   <div class="ait-tab tab-content" data-ait-tab-title="Ratings">
               
                <div class="item-stars clearfix"><input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" > &nbsp;<span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span> <span>
                  <p> (2) </p>
                  </span> </div>
                <div class="item-stars clearfix"><input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" > <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                <div class="item-stars clearfix"><input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" > <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                <div class="item-stars clearfix"> <input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" ><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                <div class="item-stars clearfix"> <input type="checkbox" class="language-filters left" value="29" id="lang-filters-29" ><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span> <span>
                  <p> (0) </p>
                  </span> </div>
                  </div>-->
         
</a>

</label>
</div>

          </div>                       
       
</li>



<br>
</ul>

 
     </div> <!--------1st column---->

     
     <div class="sc-column sc-column-last three-fourth-last" id="right-pane">
	 <ul class="items items-list-view onecolumn">
			<?php
			
			$dataProvider->pagination->pageSize=1;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
		</ul>
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