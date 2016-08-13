<?php
$this->widget('CTabView', array(
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'News',
			'url'=>CController::CreateUrl('//front/list/news'),
        ),
        'tab2'=>array(
            'title'=>'Events',
			'view'=>'eventstab',
            'data'=>array('dataProvider'=>$dataProvider,'pages'=>$pages),
        ),
    ),
	'activeTab'=>'tab2',
));
?>

<style>
.wrapper
{
margin-top:20px;
margin-bottom:20px;

}
.yiiTab div.view
{
border:1px solid #818181 !important;  
border-radius:5px !important;
}

.yiiTab ul.tabs {
    border-bottom: 0px solid #818181;
    font-family: "ralewayextrabold";
    margin: 0;
    padding: 2px 0;
}
.active
{
border:1px solid  #818181 !important;
}
</style>
<script>
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
margin-top:350px !important;
margin-left:-100px !important;

}
 </style>
