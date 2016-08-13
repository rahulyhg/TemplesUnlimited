<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'Temples',
);

$this->menu=array(
);
?>
<?php 
				$categories =Categories::model()->getall(); 
				$categoriesvalues = array();
				$states = States::model()->getall(); 
				$statesvalues = array();
				$categoriesvalues = array();
				
				
				 $rv=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0);
					
				
				
				
				
				if(isset($dataProvider1->rawData) && count($dataProvider1->rawData)){
				foreach($dataProvider1->rawData as $items){
				
				
				$reviewscount = Reviews::model()->get_average('temple',$items->id);


					if($reviewscount==1)
					$rv[1]=$rv[1]+1;
					if($reviewscount==2)
					$rv[2]=$rv[2]+1;
					if($reviewscount==3)
					$rv[3]=$rv[3]+1;
					if($reviewscount==4)
					$rv[4]=$rv[4]+1;
					if($reviewscount==5)
					$rv[5]=$rv[5]+1;
				
				
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
				<input type="text" style="padding:2%; width:60%;" placeholder="Search Keyword..." name="title" id="title" class="filteritembutton" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:10px; width:20%; font-size:14px; margin-top:2px;background-color: #cb202d; " onclick="filterlistbutton('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
						</span>
						
</div>

<div id="ait-login-tabs" style="margin-top:8px;">
<div class="wrapper">
<ul class="tabbing" style="float:right; padding-right:10px;">
<li class="active"><a href="javascript:void(0);" class="login"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
<li ><a href="#ait-dir-register-tab" onclick="filterlist1();" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/map_view.png" title="Map View"></a></li>
</ul>
</div>


</div>
				 
</form>

<style>

@media only screen and (min-width: 720px) and (max-width: 720px) 
{
.onecolumn .sc-column.three-fourth, .onecolumn .sc-column.three-fourth-last {
    width: 485px;
}

.onecolumn .sc-column.one-half, .onecolumn .sc-column.one-half-last {
    width: 480px;
}

.onecolumn .sc-column.one-fourth, .onecolumn .sc-column.one-fourth-last {
    width: 175px;
}


#directory-search {
    margin-left: 0px !important;
    margin-top: -10px !important;
    width: 230% !important;
}
</style>

<br>
	
	
	
<div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
<ul class="sc-list " style="">
<li>
<h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Categories</strong></h6>
 <div class="onecolumn">
       	 <div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; margin-bottom:15px; " >
		<?php foreach($categories as  $category){ 
		
		if(isset($categoriesvalues[$category->id]))
		{
?>		 
			<label class="<?php echo (isset($categoriesvalues[$category->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $category->id; ?>"  style="cursor:pointer" id="lang-filters-29" name="categories[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->id,$_REQUEST['categories'])){ ?> checked="checked" <?php } ?>>
			<span class="flag flag-gb"></span>
			<span><?php echo $category->category_name; ?></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset($categoriesvalues[$category->id])?$categoriesvalues[$category->id]:'0'); ?>)</a></span>
			</label><br>
			<?php } }  ?>
			
			
			<?php foreach($categories as  $category){ 

		   if(!array_key_exists($category->id,$categoriesvalues))
		   {
			$values_check ='disabled="disabled"';		
?>		 
			<label class="<?php echo (isset($categoriesvalues[$category->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" value="<?php echo $category->id; ?>" style="cursor:pointer" id="lang-filters-29" name="categories[]" <?php  echo $values_check; ?> >
			<span class="flag flag-gb"></span>
			<span><?php echo $category->category_name; ?></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(0)</a></span>
			</label><br>
			<?php  } }  ?>
			</div>
        </div>        
        <br />        
</li>
<div style="clear:both;"></div>

<li>			     
 <h6 style="background-color:#EBEBEB;padding: 10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><strong>Location</strong></h6>
 <div class="onecolumn">
	 
	  <div class="sc-column one-fourth" style="padding: 9px;overflow-y:auto; max-height:160px; overflow-x:auto; max-width:200px; " >
	 <?php foreach( $states as  $state){ 
	 
	 
	 if(isset($statesvalues[$state->id]))
	 {

			?>		 
			<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
			<input type="checkbox" class="language-filters filteritem" style="cursor:pointer" value="<?php echo $state->id; ?>" id="lang-filters-29"  name="states[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" >
			<span class="flag flag-gb"></span>
			<span><?php echo $state->state_name; ?></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</a></span>
			</label><br>
			<?php } }?>
			
			
			 <?php foreach( $states as  $state){ 
				if(!array_key_exists($state->id,$statesvalues))
				{
				$values_state ='disabled="disabled"';
				
				?>		 
				<label class="<?php echo (isset( $statesvalues[$state->id])?'':'filterhidden'); ?>">
				<input type="checkbox" class="language-filters filteritem" value="<?php echo $state->id; ?>" style="cursor:pointer" id="lang-filters-29" <?php echo $values_state; ?> name="states[]" >
				<span class="flag flag-gb"></span>
				<span><?php echo $state->state_name; ?></span>
				<span class="language-filter-count filter-count-hidden" style="display: inline;"><a href="" id="category-link">(<?php echo (isset( $statesvalues[$state->id])?$statesvalues[$state->id]:'0'); ?>)</a></span>
				</label><br>
				<?php } }?>
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
border-bottom-left-radius:0px;"><strong>Ratings</strong></h6>
 <div class="onecolumn" style="margin-left: 15px;">
<div class="sc-column one-fourth" style="">
<span class="flag flag-gb"></span>
<input type="checkbox"  class="language-filters left filteritem" <?php if($rv[5]==0) { ?> disabled="disabled"  <?php } ?> value="5" id="lang-filters-29" style="margin-right:12px;" name="ratings[]"  onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"> </span> <p  id="categories-rating" class="rating-space" style="">  (<?php echo $rv[5]; ?>) </p>
<input type="checkbox" class="language-filters left filteritem" <?php if($rv[4]==0) { ?> disabled="disabled"  <?php } ?> value="4" id="lang-filters-29" style="margin-right:12px;" name="ratings[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[4]; ?>) </p> 
<input type="checkbox" class="language-filters left filteritem" <?php if($rv[3]==0) { ?> disabled="disabled"  <?php } ?> value="3" id="lang-filters-29" style="margin-right:12px;" name="ratings[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')"><span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[3]; ?>)</p> 
<input type="checkbox" class="language-filters left filteritem" <?php if($rv[2]==0) { ?> disabled="disabled"  <?php } ?> value="2" id="lang-filters-29" style="margin-right:12px;" name="ratings[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')"><span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">((<?php echo $rv[2]; ?>)</p>
<input type="checkbox" class="language-filters left filteritem" <?php if($rv[1]==0) { ?> disabled="disabled"  <?php } ?> value="1" id="lang-filters-29" style="margin-right:12px;" name="ratings[]" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')"><span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span><p  id="categories-rating" class="rating-space">(<?php echo $rv[1]; ?>)</p>
</a>
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
				'emptyText' => "We're sorry, no temple's found for your search. Try refining your search above to get more results.",
				'itemView'=>'_view',
				'template'=>'{items}{pager}',
				/*'template'=>'{items}',*/
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			)); ?>
		</ul>
	  </div>
    </div>

	
	
    <div id="ait-dir-register-tab" class="tab-pane">
    </div>
	  
</div>
</div>







<script type="text/javascript">

function filterlistbutton(url)
	{
	var title =  $('#title').val();
	if((title=='') ||  (title=='Search Keyword...'))
	{
	$("#title").css("background-color","#fbd9d9");
	$("#title").css("border","2px solid red");
	return false;
	}
	else
	{
	$.post(url,  $('.filteritembutton').serialize()  , function(data){
	$('#ait-dir-login-tab').html(data);
	filterlist1();
	}); 
	}
}


function filterlist(url)
	{
	$.post(url,  $('.filteritem').serialize()  , function(data){
	$('#ait-dir-login-tab').html(data);
	filterlist1();
	}); 
}

function filterlist1(url)
{


 $.ajax({
              url : '<?php echo CController::CreateUrl('/front/list/templesmap'); ?>',
              type : "post",
              data : $(".filteritem").serialize(),
			  beforeSend:function(data)
              {
			    $('#ait-dir-register-tab').html('<center><div style=" height:720px; width:100%; vertical-align:middle;display:table-cell;text-align:center;"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/ajax-loader.gif" /><br/>Loading....</div></center>');
			  },
              success:function(data)
              {
			    $('#ait-dir-register-tab').html(data);
			  }			  
         });
}
</script>




</div>

<style>

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

