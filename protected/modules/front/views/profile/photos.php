<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name . ' - My photos';
$this->breadcrumbs=array(
	'My photos - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);

?>
<style type="text/css">
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
</style>
<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">



<div class="">


<h3>My Photos</h3>


<div class="rule"></div>
<br>

	<?php if( Yii::app()->user->hasFlash('success')){ ?>
	 <div class="flashmessage success">
	    <button class="close" data-dismiss="alert">X</button>
	    <p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
	</div><br>
	<?php } ?>


<?php 

$imagemodel = new Images;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'upload_image_form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
                'validateOnSubmit'=>true,
                'validateOnChange'=>false,
                'validateOnType'=>false,
        ),
    'action'=>CController::CreateUrl('//front/profile/photos'),
	'htmlOptions'=>array('class'=>'wpcf7-form', 'enctype' => 'multipart/form-data',),
	)); ?>
		
		
		
		   
		   	<div class="left">
				 <?php echo $form->labelEx($imagemodel,'image_caption',array('class'=>'alignleft password-label ')); ?>
				<div class="wpcf7 alignright"><?php echo $form->textField($imagemodel,'image_caption',array('maxlength'=>'250')); ?>
				<?php echo $form->error($imagemodel,'image_caption'); ?>
			   </div>
			</div>
		
		    <div class="left">
				 <?php echo $form->labelEx($imagemodel,'Image',array('class'=>'alignleft password-label')); ?>
				<div class="wpcf7 alignright"><?php echo $form->fileField($imagemodel,'image_path',array('required'=>true)); ?>
				<?php echo $form->error($imagemodel,'image_path'); ?>
				</div>
			</div>
			
			
			<?php 
     	    $imagemodel->item_type =   $type;
			$imagemodel->item_id=   $model->user_id;
			echo $form->hiddenField($imagemodel,'item_type',array('required'=>true)); 
			echo $form->hiddenField($imagemodel,'item_id',array('required'=>true));?>
			
			<br>
<br>
			<div class="left">
			<label class="alignleft password-label ">&nbsp;</label>
			<div class="wpcf7 alignright">
				<?php echo CHtml::SubmitButton('Upload',array("id"=>"wp-submit","class" => "sc-button alignright light profile-font",'style'=>'background-color: #CB202D; color: #fff; width: 150px; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px','onclick'=>'javascript:return checktype();') ); ?>
				</div>
			</div>

		  <?php $this->endWidget(); ?>
<div class="rule"></div>
<br>
<div style="border:1px solid #dbdbdb;padding: 5px;" class="photolistdiv">



<?php 
if(count($images) && !empty($images)){ 
  $this->renderPartial('photoview', array('model'=>$model,'dataProvider'=>$dataProvider,'images'=>$images));
}else {	?>

<p style="text-align:center; font-size:12px; padding:10px;">No photos found</p>
<?php } ?>
	

</div>


        
        <div style="clear:both;"></div>
 

<!--<a href="" class="sc-button alignright light" style="background-color: #FF3355; border-color: #FF3355; width: 28%; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">Save Profile</span></span></span></a>-->



<script>
function checktype()
{
var errorcountimage = 0;
var file = $('#Images_image_path').val();
var exts = ['jpeg','jpg','png','gif','PNG','JPG','JPEG','GIF'];


// first check if file field has any value
if ( file ) {

var get_ext = file.split('.');
// reverse name to check extension
get_ext = get_ext.reverse();
if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 )
{
return true;
}
else
{
alert( 'File format not allowed!' );
errorcountimage++;
return false;
}
}

if(errorcountimage == 0){
return true;
}
}
</script>







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

function makeusprimaryphoto(idval){
    jQuery('.myphoto'+idval).css('opacity','0.1');
	jQuery.get('<?php echo CController::CreateUrl('//front/profile/makeusprimaryphoto'); ?>/id/'+idval, function(data){
	if(data=='primary')
	{
	<?php  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
	 window.location.href= '<?php echo $actual_link; ?>';
	}
	});
}
</script>


