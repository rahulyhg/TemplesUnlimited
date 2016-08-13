<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css' type='text/css' />
<?php
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';

$categories =Storecategories::model()->getall(); 

$options ='<option value="">All</option>';

for($i=0;$i<count($categories);$i++)
{
$options .='<option value='.$categories[$i]->category_id.'>'.$categories[$i]->category_name.'</option>';
}


?>

<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/products'); ?>">&nbsp;Store</a></h3>
</div>
</div>






<div id="main" class="mainpage onecolumn">

   <div class="wrapper" style="margin-bottom:20px">
   
    <div class="flashmessage success" id="flashmessage" style="display:none;" >
	<p id="msg_display">Item added to cart successfully.</p>
</div>

    <div class="flashmessage success" id="flashmessage1" style="display:none;" >
	<p id="msg_display">Product already added in your cart.</p>
</div>


 <div class="flashmessage success" id="login" style="display:none;" >
	<p id="msg_display">Please login  for select your favorite.</p>
</div>


   <h3 class="epooja">Store</h3>
   
   <form class="wp-user-form filteritem12345" action="" method="get" style="width:95%; margin-bottom:30px; margin-top:25px; padding-left:10px;">
<div class="sc-column one-half">
						<select  style="padding:3%; width:30%;font-family:'ralewayregular' !important;" name="categories" id="categories" class="filteritem123"  onchange="changecategoris(this.value);">
						<?php echo $options; ?>
						</select>


						<input type="text" style="padding:2%; width:35%;margin-left:10px;" placeholder="Search Keyword..." name="title" id="title" class="filteritem onlytext" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="submit" value="Search" class="dir-searchsubmit" style="margin-left:5px; width:20%; font-size:14px;" onclick="return filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						</span>
						
</div>
		
<input type="hidden" name="tab" id="tab" />						
</form>
	

<div class="tabbable" style="float:right; margin-top:10px; margin-right:10px;">
<ul class="nav nav-tabs"  id="myTab">
<li class="active"><a href="#pane1" data-toggle="tab" onclick="$('#tab').val('pane1');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
<li><a href="#pane2" data-toggle="tab" onclick="$('#tab').val('pane2');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
</ul>
</div>

<!--[if IE 9]><html class="no-js oldie ie9 ie" lang="en-US">
<style>
 .onlytext
 {
height:29px !important;
 }

#directory-search .dir-searchsubmit {
    font-size: 18px;
    height: 48px;
    margin: 0;
}

 </style>
 
<![endif]-->

<style>

@media only screen and (min-width: 768px) and (max-width: 1600px) {

.filteritem123
{
width: 32%; 
}
}

@media only screen  and (max-width: 480px) {

#directory-search {
    margin-left: 1px !important;
    width: 275% !important;
}

}


@media only screen  and (max-width: 720px) {

.filteritem123
{
width: 25% !important;
}
#directory-search {
    margin-left: 0px !important;
}
.filteritem
{
 width:25% !important;
}
}
#directory-search .dir-searchsubmit {
    font-size: 18px;
    height: 45px;
    margin: 0;
}
</style>

   </div>
   
   <?php  $product=new Storeproducts;?> 
   
   <div class="wrapper maintest"  style="height: auto; margin-bottom: 30px;">
   <div class="tab-content" >
    <div id="pane1" class="tab-pane active">
	
	<?php

$count = 1;

   if ( $count > 0 && $count % 5 == 0 )
   {
      echo "</div><div class='row' style='margin:0'>";
   }
   $count++;
   ?>

<?php 
  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$product->searchByAttr(),
				'emptyText' => "We're sorry, no product's found for your category. Try refining your category above to get more results...",
				'itemView'=>'products_grid',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			));
			
	?>

	
    </div>
    <div id="pane2" class="tab-pane">
	
	<div class="latest-posts wrapper">
	
	
	 <?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$product->searchByAttr(),
				'emptyText' => "We're sorry, no product's found for your category. Try refining your category above to get more results...",
				'itemView'=>'_product_list_view',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
				
			));
			?>

				</div>

    </div>

  </div>
  </div>

	</div>	
  </div>
  
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
.items
{
margin-bottom: 0px;
}
#directory-search .dir-searchsubmit {
    font-size: 18px;
    height: 45px !important;
    margin: 0;
}
</style>
<script>
function filterlist2(url)
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
$('#categories').val('');
$( ".filteritem12345" ).submit()
}

}

function changecategoris(category_id)
{
$('#title').val('');
$( ".filteritem12345" ).submit()
}

$('#title').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : '<?php echo $this->createUrl('list/produciauto'); ?>',
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
			  
<?php if(isset($_REQUEST['categories'])) { ?>
var  categories = '<?php echo $_REQUEST['categories']; ?>';

if(categories!='')
{
$('#categories').val(categories);
}

<?php } ?>			  	

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
.list-view .pager {
    margin: 25px 44px 0;
    text-align: right;
}

.list-view-loading {
    background-position: bottom left  !important;
}
.items {
    margin-bottom: 40px;
    margin-left: 20px;
}
</style>
  
