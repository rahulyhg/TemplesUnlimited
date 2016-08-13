<div class="wrapper">


<div class="" style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/calender'); ?>">Events Calendar</a></h3>
</div>
</div>


<div style="margin-top:30px;" class="wrapper news">
			
<div id="ait-tabs-641" class="ait-tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
<li class="ui-state-default ui-corner-top" role="tab" tabindex="0" aria-controls="tab-641-1" aria-labelledby="ui-id-1" aria-selected="false">
<a href="<?php echo CController::CreateUrl('/news'); ?>" class="tab-link ui-tabs-anchor" role="presentation" tabindex="-1" >News</a></li>
<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="-1" aria-controls="ui-tabs-1" aria-labelledby="ui-id-2" aria-selected="true">
<a href="#" class="tab-link ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2" id="ui-id-1" style="border-radius: 5px 5px 0 0; color: #cb202d;">Events</a></li></ul>

<div data-ait-tab-title="News" class="ait-tab tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" id="tab-641-1" aria-labelledby="ui-id-1" role="tabpanel" aria-expanded="true" aria-hidden="false"> 

		<div>		
		
		<ul style="float:right; padding-right:10px;" class="tabbing">
		<li><a class="login" href="<?php echo CController::CreateUrl('/events'); ?>"><img title="List View" src="<?php echo Yii::app()->request->baseUrl;  ?>/image/list1.png"></a></li>
		<li class="active"><a class="register" href="<?php echo CController::CreateUrl('/front/list/calender'); ?>"><img title="Calender View" src="<?php echo Yii::app()->request->baseUrl;  ?>/image/calendar.png" height="15"  width="15"></a></li>
		</ul>
		</div>
		
		
 <div>
 <div id='calendar' style="margin-top:80px;"></div>
 </div>
			
		
</div>





<div class="clearing"></div> 
<div id="ui-tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" aria-live="polite" aria-labelledby="ui-id-2" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true"></div>
<div data-ait-tab-title="Events" class="ait-tab tab-content" id="tab-641-2"> 

 </div>

</div>

</div>

<div id="eventContent" title="Event Details" style=" display:none;">
    <div id="eventInfo"></div>
    <p><strong><a id="eventLink" target="_blank">Read More</a></strong></p>
</div>


<script>


	$(document).ready(function() {
	 $("body").on('click','.fc-button', function (e) {
                    $('.popover').hide();
                });
	
		jQuery('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			eventLimit: true,
			
			eventRender: function (event, element) {
                element.popover({
                title: event.title,
                placement:'auto',
                html:true,
                trigger : 'click',
	            content: event.description,
                container:'body',
				 isVisible : false				
            });
                $(window).on('click', function (e) {
                    if (!element.is(e.target) && element.has(e.target).length === 0 && $('.popover').has(e.target).length === 0)
                        element.popover('hide');
                });
              },
			

			events: "<?php echo $this->createUrl('auto/events'); ?>",
			

		});
		
	});
	
	
	
	
	

</script>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<link href='<?php echo Yii::app()->request->baseUrl;  ?>/css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo Yii::app()->request->baseUrl;  ?>/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo Yii::app()->request->baseUrl;  ?>/js/moment.min.js'></script>
<script src='<?php echo Yii::app()->request->baseUrl;  ?>/js/fullcalendar.min.js'></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl;  ?>/js/datetimepicker.js"></script>
<script type="text/javascript"    src="<?php echo Yii::app()->request->baseUrl;  ?>/js/bootstrap.min.js"></script>
	



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
.fc-unthemed .fc-today {
    background: none repeat scroll 0 0 #f6f6f6;
}
.fc-unthemed th, .fc-unthemed td, .fc-unthemed hr, .fc-unthemed thead, .fc-unthemed tbody, .fc-unthemed .fc-row, .fc-unthemed .fc-popover {
    border-color: #000000;
}
.active
{
background:#eaeaea;
}
.fc-title
{
cursor:pointer;
}

</style>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>



