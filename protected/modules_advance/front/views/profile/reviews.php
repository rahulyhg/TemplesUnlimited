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
<?php  }	?>
</div>

        <div style="clear:both;"></div>

<!--<a href="" class="sc-button alignright light" style="background-color: #FF3355; border-color: #FF3355; width: 28%; "><span class="border"><span class="wrap"><span class="title" style="color: #ffffff;">Save Profile</span></span></span></a>-->


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