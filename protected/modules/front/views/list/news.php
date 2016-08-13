<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

<div class="wrapper news" style="margin-top:30px;">
<div class="ait-tabs" id="ait-tabs-641"><ul></ul><br />
<div class="ait-tab tab-content" data-ait-tab-title="News"> 
<form class="wp-user-form" action="" method="post" style="margin:10px; padding-bottom:50px">
<div class="right">
<select  style="padding:5%;" class="filteritem" name="categories" id="categories" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
<option class="free" value="all">All</option>
<option class="free" value="today">Today</option>
<option class="free" value="yester">Yesterday</option>
<option class="free" value="week">This Week</option>
<option class="free" value="lweek">Last Week</option>
<option class="free" value="month">This Month</option>

</select>

</span>

</div>

</form>



<div class="latest-posts"  id="maincontent124">
<?php
	 $dataProvider->pagination->pageSize=5;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_news_view',
		'emptyText' => "We're sorry, no news found for your search. Try refining your search above to get more results.",
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
		'id'=>'ajaxListView',
	)); ?>
</div>



<div class="clearing"></div> </div><br />
<div class="ait-tab tab-content" data-ait-tab-title="Events"> 
<form class="wp-user-form" action="" method="post" style="margin:10px; padding-bottom:50px">
<div>
<span class="left"><span class="left" id="day" class="pagination" style="display:none;">
<ul class="pager">
  <a href="#">&laquo;&nbsp;Previous Day</a>&nbsp;|&nbsp;<a href="#">Next Day&nbsp;&raquo;</a>
</ul>
</span>
<span id="month" class="pagination" style="display:none;">
<ul class="pager">
  <a href="#">&laquo;&nbsp;Previous Week</a>&nbsp;|&nbsp;<a href="#">Next Week&nbsp;&raquo;</a>
</ul>
</span>
<span id="year" class="pagination" style="display:none;">
<ul class="pager">
  <a href="#">&laquo;&nbsp;Previous Month</a>&nbsp;|&nbsp;<a href="#">Next Month&nbsp;&raquo;</a>
</ul>
</span></span>
<span class="right" style="width:330px;">
	<input type="text" class="filteritem1234"  style="float:left; width:130px;" placeholder="Date" id="date" name="events_date" onchange="filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						<select name="events_value" style=" margin-left:20px;" id="drop_box" class="filteritem123"  onchange="filterlist1('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">				
						<option class="free" value="all">All</option>
						<option class="free" value="today">Today</option>
						<option class="free" value="tomorrow">Tomorrow</option>
						<option class="free" value="week">This Week</option>
						<option class="free" value="weekend">This Weekend</option>
						<option class="free" value="month">This Month</option>
						
						
						</select>
						</span>					
</div>
</span></form>

<div class="latest-posts" id="maincontent">
<?php
	 $dataProvider1->pagination->pageSize=5;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider1,
		'emptyText' => "We're sorry, no events found for your search. Try refining your search above to get more results.",
		'itemView'=>'_events_view',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
	)); ?>
</div>
 </div><br />
<br />
</div>
<script type="text/javascript">
		(function($){
			$(function(){
				var $tabs = $("#ait-tabs-641" ),
					$tabsList = $tabs.find("> ul"),
					$tabDivs = $tabs.find(".ait-tab.tab-content"),
					tabsCount = $tabDivs.length;

				$tabs.find("> p, > br").remove();

				var tabId = 0;
				$tabDivs.each(function(){
					tabId++;
					var tabName = "tab-641-"+tabId;
					var sharp = "#";
					$(this).attr("id",tabName);
					var tabTitle = $(this).data("ait-tab-title");
					$('<li><a class="tab-link" href="'+sharp+tabName+'">'+tabTitle+'</a></li>').appendTo($tabsList);
				});
				$tabs.tabs();
				if(typeof Cufon !== "undefined")
					Cufon.refresh();
			});
		})(jQuery);
	</script>
</div>
</script>

<style>
.sc-page .item .image img  { border: 3px solid #BABABA; width:200px; height:150px; }
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
</style>

<script>
function filterlist(url)
{
$.post(url, $('.filteritem').serialize(), function(data)
{
$('#maincontent124').html(data);
});
}

function filterlist1(url)
{
$.post(url, $('.filteritem123').serialize(), function(data)
{
$('#maincontent').html(data);
});
}



function filterlist2(url)
{
$.post(url, $('.filteritem1234').serialize(), function(data)
{
$('#maincontent').html(data);
});

}
</script>

 <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/datetimepicker.js"></script>
	  <script type="text/javascript"
     src="<?php echo Yii::app()->request->baseUrl;  ?>/js/bootstrap.min.js"></script>
	
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script>
/*  $(function() {
	$("#date").datepicker({
      showOn: "button",
      buttonImage: "<?php echo Yii::app()->request->baseUrl;  ?>/image/calendar.gif",
      buttonImageOnly: true,
	  dateFormat: 'yy-mm-dd',
	  onSelect: function()
	 {
	 filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>');
	 }

    });
  });*/
  
  if('<?php echo Yii::app()->session['categories']; ?>'!='')
  {
  $('#categories').val('<?php echo Yii::app()->session['categories']; ?>');
  }
  
  if('<?php echo Yii::app()->session['events_value']; ?>'!='')
  {
  $('#drop_box').val('<?php echo Yii::app()->session['events_value']; ?>');
  }

  </script>
 <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;  ?>/calender/public/javascript/zebra_datepicker.js"></script>
  
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;  ?>/calender/public/css/default.css" type="text/css">
  
  
  <script>
$('#date').Zebra_DatePicker({
  direction: true,    
  
  onSelect:function()
	 {
	 filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>');
	 }
}); 
 </script>
 
 <style>
 .Zebra_DatePicker_Icon
{
/*margin-left:20px !important; 
margin-top:-5px !important;*/
}
.Zebra_DatePicker
{
margin-top:321px !important;
margin-left:-100px !important;
/*position:static !important;*/
}
 </style>
