<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>

<?php
/* @var $this NewsletterController */
/* @var $model Newsletter */

$this->breadcrumbs=array(
	'Newsletter Subscribers'=>array('manage'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Newsletter Subscribers', 'url'=>array('admin')),
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#newsletter-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


		
<?php if(Yii::app()->user->hasFlash('queries')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('queries'); ?>
</div>
<?php endif; ?>

<h1>Manage Newsletter Subscribers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<a class="btn btn-success btn-large" style="cursor:pointer; color:#FFFFFF !important; float:right;" data-toggle="modal" data-target="#largeModal">Send Newsletter</a>-->
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'newsletter-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'emailid',
		'date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<style>
.update{
    display: none;
}
</style>
		
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel" >Send Newsletter</h4>
</div>
<div class="modal-body">
<div class="form" style="width:85%; margin-left:5%;">
<form method="post" action="<?php echo CHtml::normalizeUrl(array("Newsletter/sendmail")); ?>" id="qurey-form"  class="wpcf7-form">
<div class="row">
<label class="required" for="Contact_name">Subject <span class="required">*</span></label>
<input type="text" maxlength="250" id="subject" name="subject" placeholder="Enter Subject" value="" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test" />
</div>
<div class="row">
<label class="required" for="Contact_name">Message <span class="required">*</span></label>
<textarea name="message" id="message"></textarea>

</div>
<div style="float: right;" class="row">
<input type="submit" value="Send" name="send" id="submit"  class="btn btn-success btn-large"/>
</div>
</form>
</div>
</div>
</div>
</div>
</div>



<style type="text/css">
.error
{
color:#FF0000;
font-weight: normal;
}
.pp_content{ display:table; }
a.pp_close{ position:relative; float:right; }

.pager{ float:right; }
.activitiesplans li {
    
    border-bottom: 1px solid #CCCCCC;
    border-image: none;
    border-left: 0 none;
    border-top: 1px solid #CCCCCC;
    padding: 10px;
	margin-bottom: 20px;
}
.activitiesplans li .leftside{ float:left;  max-width: 70%; }
.activitiesplans li .rightside{ float:right; }
.activitiesplans p{ margin-bottom:0px; }
.activitiesplans li .leftside .title{ font-weight:bold; }

#content {
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px !important;
    width: 1000px;
}

.ui-widget{
    font-family:"ralewayregular" !important;
}
.input_test
{
background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;
}
.submit_test
{
 background: none repeat scroll 0 0 #333333;
    border: medium none;
    color: #ffffff;
    cursor: pointer;
    display: inline;
    float: right;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    margin: 0;
    width: auto;padding: 10px 8px;
}
.text_area
{
    background: none repeat scroll 0 0 #ffffff;
	border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:95%;
	margin-left:14px;
}
.flash-success
{
    background-color: #fcefd4;
    border: 1px solid #fae1c6;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	background-color: #caeecf;
    border-color: #b7e8b6;
    color: #38b44a;
}
#page .ui-icon {
    display: block !important;
}
#fancybox-img
{
 max-height:800px !important;
 max-width:1200px !important;
}
.modal.fade.in {
   left: 26% !important;
width: 90% !important;
    }
 .modal{
    background: none !important;
    border: none !important;
 }
    .modal-lg {
    width: 1200px !important;
}
div.form {
    padding: 5px !important;
}  
</style>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery('#qurey-form').validate({
rules : {
subject :{required:true},
message : {required: true},
},
messages : {
subject : 'Enter subject',
message : 'Enter message',
}
});
</script>
<script type="text/javascript">
$('#submit').click(function() {
     tinymce.triggerSave();
});

</script>	
