<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>

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
<br />
<br />
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