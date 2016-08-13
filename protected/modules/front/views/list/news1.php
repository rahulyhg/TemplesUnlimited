<title>Temples Unlimited | News & Events</title>
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
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/news'); ?>">News </a></h3>
</div>
</div>


		
<div style="margin-top:30px;" class="wrapper news">
<div id="ait-tabs-641" class="ait-tabs ui-tabs ui-widget ui-widget-content ui-corner-all"><ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist"><li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tab-641-1" aria-labelledby="ui-id-1" aria-selected="true"><a href="#tab-641-1" class="tab-link ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">News</a></li><li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="ui-tabs-1" aria-labelledby="ui-id-2" aria-selected="false"><a href="<?php echo CController::CreateUrl('/events'); ?>" class="tab-link ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">Events</a></li></ul>
<div data-ait-tab-title="News" class="ait-tab tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" id="tab-641-1" aria-labelledby="ui-id-1" role="tabpanel" aria-expanded="true" aria-hidden="false"> 
<form style="margin:10px; padding-bottom:50px" method="post" action="" class="wp-user-form">
<div class="right">
<select onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')" id="categories" name="categories" class="filteritem123" style="padding:5%; width:120px; height:35px;">
<option value="all" class="free">All</option>
<option value="today" class="free">Today</option>
<option value="yester" class="free">Yesterday</option>
<option value="week" class="free">This Week</option>
<option value="lweek" class="free">Last Week</option>
<option value="month" class="free">This Month</option>

</select>



</div>

</form>



<div id="maincontent124" class="latest-posts" style="margin-top:15px;">
<?php
	 $dataProvider->pagination->pageSize=10;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_news_view',
		'emptyText' => "We're sorry, no news found for your search. Try refining your search above to get more results.",
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
		'id'=>'ajaxListView',
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



<div class="clearing"></div> </div>


</div>

</div>


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
.filteritem123
{
font-family:"ralewayregular" !important;
}
.empty
{
font-family:"ralewayregular" !important;
}
ul.yiiPager a:link, ul.yiiPager a:visited 
{
    color: #040404 !important;

}
.ui-widget {
    font-family:"ralewayregular" !important;
    font-size: 1.1em;
}

ul.yiiPager .selected a
{
color:#CB202D !important;
font-weight:bold !important;
}
</style>

<script>
function filterlist(url)
{
$.post(url, $('.filteritem123').serialize(), function(data)
{
$('#maincontent124').html(data);
});
}

if('<?php echo Yii::app()->session['categories']; ?>'!='')
{
$('#categories').val('<?php echo Yii::app()->session['categories']; ?>');
}
</script>

<script src="/kalidas/temples/js/datetimepicker.js" type="text/javascript"></script>
<script src="/kalidas/temples/js/bootstrap.min.js" type="text/javascript"></script>

<script src="/kalidas/temples/calender/public/javascript/zebra_datepicker.js" type="text/javascript"></script>

<link type="text/css" href="/kalidas/temples/calender/public/css/default.css" rel="stylesheet">
</div>

