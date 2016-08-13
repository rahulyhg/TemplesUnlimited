<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css' type='text/css' />

<?php
 $categories =Poojacategories::model()->getall(); 
 
 $options ='<option value="all">All</option>';

 for($i=0;$i<count($categories);$i++)
 {
  $options .='<option value='.$categories[$i]->category_id.'>'.$categories[$i]->category_name.'</option>';
 }
?>

<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/epooja'); ?>">&nbsp;E-pooja</a></h3>
</div>
</div>

<div class="wrapper">
   <h3 class="epooja">E-pooja and Services</h3>
 </div> 
 
 
<div id="subcats-holder">
    <div class="wrapper ">
<div class="wrapper">

<form class="wp-user-form filteritem12345" action="" method="get" style="width:95%; margin-bottom:30px; margin-top:25px; padding-left:10px;"  id="filter_from">
<div class="sc-column one-half">
						<select  style="padding:3%; width:30%;" name="epooja_category" id="epooja_category" class="filteritem123"  onchange="filterlist1('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						<?php echo $options; ?>
						</select>


						<input type="text" style="padding:2%; width:35%;margin-left:10px;" placeholder="Search Keyword..." name="title" id="title" class="filteritem12345 onlytext" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="submit" value="Search" class="dir-searchsubmit" style="margin-left:5px; width:20%; font-size:14px;" onclick="return filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						</span>
						
</div>

<input type="hidden" name="tab" id="tab" />
						
</form>


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


@media only screen  and (max-width: 768px) {

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

<!--[if IE 9]><html class="no-js oldie ie9 ie" lang="en-US">
<style>
 .onlytext
 {
height:29px !important;
 }

 </style>
 
<![endif]-->	


<div class="tabbable" style="float:right; margin-top:10px; margin-right:15px;">
<ul class="nav nav-tabs"  id="myTab">
<li class="active"><a href="#pane1" data-toggle="tab" onclick="$('#tab').val('pane1');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
<li><a href="#pane2" data-toggle="tab" onclick="$('#tab').val('pane2');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png" title="List View"></a></li>
</ul>
</div>
</div>
<br />

 <?php  $pooja=new Pooja;?>
 
 
 <div class="tab-content" style=" margin-bottom:30px">
    <div id="pane1" class="tab-pane active">
	
	<div style="margin-bottom:20px;" class=" section-best-places wrapper">
<div class="best-places-wrap">



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
				'dataProvider'=>$pooja->searchByAttr(),
				'emptyText' => "We're sorry, no pooja's found for your category. Try refining your category above to get more results..",
				'itemView'=>'pooja_grid',		
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
                'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			));
			
	?>



   
   <?php


echo "</div>";

?>
 </div>
</div>

	
    </div>
    <div id="pane2" class="tab-pane">

    <?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$pooja->searchByAttr(),
				'emptyText' => "We're sorry, no pooja's found for your category. Try refining your category above to get more results.",
				'itemView'=>'_pooja_list',
				'beforeAjaxUpdate' => 'function(id) { $(\'.loader\').show(); }',
				'afterAjaxUpdate' => 'function(id) { $(\'.loader\').hide(); }',
				'template'=>'{items}{pager}',
			));
			?>
	
			
    </div>

  </div>
	  
</div>
</div>

<script>
function filterlist1(url)
{
$('#title').val('');
$( "#filter_from" ).submit()
}

function filterlist2(url)
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
$('#epooja_category').val('');
$( "#filter_from" ).submit()
return true;
}
}

<?php if(isset($_REQUEST['epooja_category'])) { ?>
var  epooja_category = '<?php echo $_REQUEST['epooja_category']; ?>';

if(epooja_category!='')
{
  $('#epooja_category').val(epooja_category);
}

<?php } ?>
</script>


<script>
$('#title').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : '<?php echo $this->createUrl('list/epoojaauto'); ?>',
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
    margin: 11px 16px 0;
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



<!--<style>
.items .item {
    background: none repeat scroll 0 0 #f4f4f4;
}
.ie9 .dir-searchsubmit
{
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#cb202d', endColorstr='#cb202d');
}
.tab-pane
{
margin-bottom:50px;
}
.items
{
max-width:700px;
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

.nav li
{
border:1px solid #f5f5f5;
}


.items .item {
    background: none repeat scroll 0 0 #f4f4f4;
    margin-bottom: 20px;
    padding: 0;
}


.sc-page .item .image img {
    border: 1px solid #eeeeee;
    display: block;
    height: auto;
    padding: 3px;
    width: auto;
}
</style>-->


