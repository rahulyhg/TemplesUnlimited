<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

<div class="wrapper">


<div class="" style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/events'); ?>">Events </a></h3>
</div>
</div>



<div style="margin-top:30px;" class="wrapper news">
			
<div id="ait-tabs-641" class="ait-tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
<li class="ui-state-default ui-corner-top" role="tab" tabindex="0" aria-controls="tab-641-1" aria-labelledby="ui-id-1" aria-selected="false">
<a href="<?php echo CController::CreateUrl('/news'); ?>" class="tab-link ui-tabs-anchor" role="presentation" tabindex="-1" >News</a></li>
<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active " role="tab" tabindex="-1" aria-controls="ui-tabs-1" aria-labelledby="ui-id-2" aria-selected="true">
<a href="#"  class="tab-link ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2" id="ui-id-1" style="border-radius: 5px 5px 0 0; color: #cb202d;">Events</a></li></ul>

<div data-ait-tab-title="News" class="ait-tab tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" id="tab-641-1" aria-labelledby="ui-id-1" role="tabpanel" aria-expanded="true" aria-hidden="false"> 



	<div>		
			
			<ul style="float:right; padding-right:10px;" class="tabbing">
					<li class="active"><a class="login" href="<?php echo CController::CreateUrl('/events'); ?>"><img title="List View" src="<?php echo Yii::app()->request->baseUrl;  ?>/image/list1.png"></a></li>
			<li ><a class="register" href="<?php echo CController::CreateUrl('/front/list/calender'); ?>"><img title="Calender View" src="<?php echo Yii::app()->request->baseUrl;  ?>/image/calendar.png" height="15"  width="15"></a></li>
				</ul>
				

</div>
			
			

<div style="margin-top:60px;">

<span style=" float:right; margin-right:7px;">
<select onchange="filterlist1('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" id="events_value" name="events_value" class="filteritem123"  style="height:35px !important; width:120px;  " >

<option class="free" value="all">All</option>
<option class="free" value="today">Today</option>
<option class="free" value="tomorrow">Tomorrow</option>
<option class="free" value="week">This Week</option>
<option class="free" value="weekend">This Weekend</option>
<option class="free" value="month">This Month</option>
</select>
</span>
</div>



<div  class="latest-posts" style="padding-top:60px;" id="maincontent124">


<?php
	 $dataProvider->pagination->pageSize=10;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'emptyText' => "We're sorry, no events found for your search. Try refining your search above to get more results.",
		'itemView'=>'_events_view',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
	)); 
	
	
	  $this->widget('CLinkPager', array(
					'currentPage'=>$pages->getCurrentPage(),
					'itemCount'=>$items_count,
					'pageSize'=>$page_size,
					'header'=>'',
					'htmlOptions'=>array('style'=>'float:right; '),
					));
					
					
					?>
	</div>
</div>


<div class="clearing"></div> 


<div id="ui-tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" aria-live="polite" aria-labelledby="ui-id-2" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true"></div>
<div data-ait-tab-title="Events" class="ait-tab tab-content" id="tab-641-2"> 

 </div>

</div>

</div>

<script>


if('<?php echo Yii::app()->session['events_value']; ?>'!='')
{
$('#events_value').val('<?php echo Yii::app()->session['events_value']; ?>');
}

</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;  ?>/calender/public/javascript/zebra_datepicker.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;  ?>/calender/public/css/default.css" type="text/css">


<script>
function filterlist1(url)
{
$.post(url, $('.filteritem123').serialize(), function(data)
{
$('#maincontent124').html(data);
});
}

function filterlist2(url)
{
$.post(url, $('.filteritem1234').serialize(), function(data)
{
$('#maincontent124').html(data);
});

}
</script>

<style>
.sc-page .item .image img {
    border: 3px solid #bababa;
	display:block;
	padding:3px;
}
.search
{ 
padding:11px 14px 11px 30px;
margin:0px; 
background:url("image/search.png") no-repeat 4px 10px; 
}
.mainpage a, .textwidget a 
{
    color: #cb202d;
    text-decoration: none;
    transition: color 1s ease 0s;
}
.filteritem123,.filteritem1234
{
font-family:"ralewayregular" !important;
}
.empty
{
font-family:"ralewayregular" !important;
}

.tabbing li {
    border: 1px solid #c1c1c1;
    float: left !important;
    padding: 10px 10px 5px;
}
#calendar 
{
		max-width: 900px;
		margin: 0 auto;
}



.mainpage img, .textwidget img, .entry-content img, .advertising-box img {
    box-sizing: border-box;
	max-width:148% !important;
}


#page .ait-tabs .ui-tabs-nav li.ui-state-default a {
    display: block;
    font-family: "ralewayextrabold";
    font-size: 16px !important;
    padding: 2px 8px !important;
    text-decoration: none;
    transition: none 0s ease 0s ;
}

.ui-widget {
    font-family:"ralewayregular" !important;
    font-size: 1.1em;
}

ul.yiiPager a:link, ul.yiiPager a:visited {
    color: #040404 !important;
}
.active
{
background:#eaeaea;
}

ul.yiiPager .selected a
{
color:#CB202D !important;
font-weight:bold !important;
}


</style>
