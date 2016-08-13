
<?php  $events =Events::model()->getall(); ?>

<div class="wrapper news" style="margin-top:30px;">
<div class="ait-tabs" id="ait-tabs-641"><ul></ul><br />
<div class="ait-tab tab-content" data-ait-tab-title="News"> 
<form class="wp-user-form" action="" method="post" style="margin:10px; padding-bottom:50px">
<div class="right">
						<select name="directory-role" style="padding:5%;" class="filteritem" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						<option class="free" value="directory_2">Today</option>
						<option class="free" value="directory_3">Yesterday</option>
						<option class="free" value="directory_4">This Week</option>
						<option class="free" value="directory_5">Last Week</option>
						<option class="free" value="directory_5">This Month</option>
						</select>
						</span>						
</div>
						
</form>

<div class="latest-posts">

<?php for($i=0;$i<count($news);$i++) {

$Profile=Profile::model()->findByPk($news[$i]->posted_by);

$date = explode(' ',$news[$i]->news_updated);

$date_simple = explode('-',$date[0]);

$month = date('M', strtotime($date[0]));

$simple_date =  $month.'&nbsp;&nbsp;'.$date_simple[2].','.$date_simple[0];
?>

				<div class="sc-page">
				<div class="item clearfix">
				<div class="image">
				<a class="greyscale" href="">
				<img  alt="" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->baseUrl ."". $news[$i]->news_image; ?>"></a>
				</div>
				<div class="text">
				<div class="title">
				<h3><a href=""><?php echo $news[$i]->news_title;  ?></a></h3>
				<p style="font-size:12px;">
                 All India | Posted by <?php echo $Profile->first_name.'&nbsp;'.$Profile->last_name; ?> | Updated: <?php echo $simple_date; ?> <?php echo $date[1]; ?> IST
                 </p>
				</div>
				<p><?php echo substr_replace($news[$i]->news_content ,'....' ,200); ?></p>
                <a href="" class="right">Read more &raquo;</a>

				</div><!-- /.text -->
				</div></div>
				
				<?php } ?>
				
				
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
<span class="right">
						<input type="text" style="padding:1%; width:40%;" placeholder="Date" id="date">	
						<select name="directory-role" style="padding:1%;" id="drop_box" onChange="show_div()">
						<!--<option class="free" value="directory_1">Recently Added</option>-->
						<option class="free">View Events </option>
						<option class="free" value="directory_2">Today</option>
						<option class="free" value="directory_3">By Week</option>
						<option class="free" value="directory_4">By Month</option>
						
						</select>					
</div>
</span></form>


<div class="latest-posts">

<?php for($i=0;$i<count($events);$i++) { ?>
				
				<div class="sc-page">
				<div class="item clearfix">
				<div class="image" style="height: 205px;">
				<a class="greyscale" href="">
				<img width="150" height="150" alt="" class="attachment-thumbnail wp-post-image" src="<?php echo Yii::app()->baseUrl ."". $events[$i]->event_image; ?>"></a>
				</div>
				
				<div class="text">
				<div class="title">
				<h3><a href="view.html"><?php echo $events[$i]->event_name; ?></a></h3>
				<p style="font-size:12px;">
All India | Posted by Devesh Kumar | Updated: June 06, 2014 22:50 IST
<br> 
Sun, Aug 3rd, 2014 - Sat, Aug 9th, 2014 | 01:00 am - 09:00 pm
</p>
				</div>
				
				<p class=""> <?php echo substr_replace($events[$i]->event_content,'....' ,150); ?>         <a href="">Read More >></a>
</p>
				</div><!-- /.text -->
				<div class="rule"></div>
				</div>
				</div>
				
				<?php } ?>
				
				
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