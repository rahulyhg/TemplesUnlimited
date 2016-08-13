<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples',
);

$this->menu=array(
);
?>
<style type="text/css">
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

.filtersmanagesectionpart .pull-right{
margin-left:10px;
}

.filtersmanagesection {
    clear: both;
    display: table;
}


.thumbnailimg {
    display: table;
    height: 150px !important;
    margin-bottom: 20px;
    margin-left: auto;
    margin-right: auto;
}
.list-view .items{ display:table; }

.list-view .items .one-fourth {
     margin-bottom: 20px;
    margin-right: 26px;
}
.producttitle {
    height: 40px;
}

.productdesc {
    height: 90px;
}


</style>

<?php 


//validAfterDatepicker
           
		     if(isset($_REQUEST['categories']) && trim($_REQUEST['categories']) != '')
			  $categories =Storecategories::model()->getall_subcategory($_REQUEST['categories']);
			  else
			  $categories =Storecategories::model()->getall(); 
              $categoriesvalues = array();
		
		   if(isset($dataProvider1->rawData) && count($dataProvider1->rawData)){
		      foreach($dataProvider1->rawData as $items){
			 
			     if(isset( $categoriesvalues[$items->store_category_id]) )
				 $categoriesvalues[$items->store_category_id] = (int)$categoriesvalues[$items->store_category_id]+1;
				 else
				 $categoriesvalues[$items->store_category_id] = 1;				 
			  }
		   }


?>
<div id="maincontent">
<div class="wrapper">
   <h3 class="epooja">Store</h3>
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


						<input type="text" style="padding:2%; width:35%;" placeholder="Search Keyword..." name="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>" id="title">
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

			<?php 
			if(count($categories)){
			foreach( $categories as  $category){ ?>		 
			<label class="<?php echo (isset( $categoriesvalues[$category->category_id])?'':'filterhidden'); ?>">
			<input type="radio" class="language-filters filteritem category-filter" value="<?php echo $category->category_id; ?>" id="lang-filters-29" name="categories" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->category_id,array($_REQUEST['categories']))){ ?> checked="checked" <?php } ?>>
			<span class="flag flag-gb"></span>
			<span><?php echo $category->category_name; ?></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $categoriesvalues[$category->category_id])?$categoriesvalues[$category->category_id]:'0'); ?>)</span>
			</label><br>
			<?php } }else{ ?>
			   Categories not available
		<?php	}?>
				 
          </div>
        </div>        
        <br />        
</li>
<br>
</ul>
</div> <!--------1st column---->

     
     <div class="sc-column sc-column-last three-fourth-last" id="right-pane">
	 <div class="filtersmanagesection">
	   <?php if(isset($_REQUEST['title']) && trim($_REQUEST['title']) != ''){ ?>
	      <div class="filtersmanagesectionpart">
		  <span class="pull-left">Title</span> <span class="pull-right"><a href="javascript:void(0);" onclick="removesomefilter('#title');"><img alt="Remove" src="<?php echo Yii::app()->request->baseUrl; ?>/images/remove.png"></a></span>
		  </div>
	   <?php } ?>
	   
	   
	
	   
	    <?php if(isset($_REQUEST['categories']) && trim($_REQUEST['categories']) != ''){ ?>
	      <div class="filtersmanagesectionpart">
		  <?php  $category =Storecategories::model()->find('category_id="'.$_REQUEST['categories'].'"'); ?>
		  <span class="pull-left">Category: <?php echo $category->category_name; ?></span> <span class="pull-right"><a href="javascript:void(0);" onclick="removesomefilter('.category-filter');"><img alt="Remove" src="<?php echo Yii::app()->request->baseUrl; ?>/images/remove.png"></a></span>
		  </div>
	   <?php } ?>
	 
	 </div>
	<div class=" itemclass" style="margin-bottom:40px;">
			<?php
			
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'products_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
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

function removesomefilter(identify){
 $(identify).val('');
 $(identify).attr('checked',false);
 filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>');
}

$(function(){
	$('.yiiPager li a').click(function(e){
	    e.preventDefault();
		filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>/page/'+$(this).html());
	   
	});
});

 

</script>
</div>