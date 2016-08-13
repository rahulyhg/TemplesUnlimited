<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name . ' - My Reviews';
$this->breadcrumbs=array(
	'My Reviews - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">


<div class="">


<h3>Reviews(<?php if($reviews){ echo count($reviews); }else{ echo '0'; } ?>)</h3>


<div class="rule"></div>
<br>

	<?php if( Yii::app()->user->hasFlash('success')){ ?>
	 <div class="flashmessage success">
	    <button class="close" data-dismiss="alert">X</button>
	    <p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
	</div><br>
	<?php } ?>



<div id="wpcf7-f7713-o1" class="wpcf7"> 

<div style="border: 1px solid #f2f2f2;padding: 16px;">

<?php

 if(helpers::isiyer() || helpers::isguide())
 {
 if(count($reviews) && !empty($reviews)){ 
  $dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'reviewview',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			));
}else{ ?>
<p style="text-align:center">No reviews found</p>
<?php  } } else {	
 if(count($reviews) && !empty($reviews)){ 
            $dataProvider->pagination->pageSize=10;
            $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'reviewview_user',
            'template'=>'{items}{pager}',
            'ajaxUpdate'=>true,
            'ajaxUrl'=>array($this->getRoute()),
));
}else{ ?>
<p style="text-align:center">No reviews found</p>

<?php } } ?>
</div>

        <div style="clear:both;"></div>

</div>	

</div>
<!---------two-third--------->
<script type="text/javascript">
function removephoto(idval){
    jQuery('.myphoto'+idval).css('opacity','0.1');
	jQuery.get('<?php echo CController::CreateUrl('//front/profile/removephoto'); ?>/id/'+idval, function(data){
	    jQuery('.myphoto'+idval).remove();
	});
}
</script>
</div>

<script>
$(document).ready(function() {
var showChar = 350;
var ellipsestext = "...";
var moretext = "More...";
var lesstext = "Less...";
$('.more').each(function() {
var content = $(this).html();

if(content.length > showChar) {

var c = content.substr(0, showChar);
var h = content.substr(showChar-1, content.length - showChar);

var html = c + '<span class="moreellipses">' + ellipsestext+ ' </span><span class="morecontent"><span>' + h + '</span>  <a href="" class="morelink">' + moretext + '</a></span>';

$(this).html(html);
}

});

$(".morelink").click(function(){
if($(this).hasClass("less")) {
$(this).removeClass("less");
$(this).html(moretext);
} else {
$(this).addClass("less");
$(this).html(lesstext);
}
$(this).parent().prev().toggle();
$(this).prev().toggle();
return false;
});
});
</script>

<style>
a.morelink {
text-decoration:none;
outline: none;
}
.morecontent span {
display: none;
}
.wpcf7.alignright > input {
    width: 310px;
}
.wpcf7-form span.required {
    color: #FF0000;
    font-size: 14px;
    font-weight: bold;
}
.left{ clear:both; }
.pp_content{ display:table; }
ul.yiiPager a:link {
    color: #404040 !important;
}
ul.yiiPager a:link, ul.yiiPager a:visited {
    border: 1px solid #9aafe5;
    color: #404040;
    padding: 4px 12px;
    text-decoration: none;
}
</style>
