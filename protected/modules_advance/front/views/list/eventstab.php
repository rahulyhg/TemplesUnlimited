<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>
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
	 $dataProvider->pagination->pageSize=5;
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'emptyText' => "We're sorry, no events found for your search. Try refining your search above to get more results.",
		'itemView'=>'_events_view',
		'template'=>'{items}{pager}',
		'ajaxUpdate'=>true,
		'ajaxUrl'=>array($this->getRoute().$urlextra),
	)); ?>
</div>
 </div>
 
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