<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name . ' - My Favorite Products';
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


<h3>Favorite Products</h3>

<div class="rule"></div>
<br>

<?php if( Yii::app()->user->hasFlash('success')){ ?>
	 <div class="flashmessage success">
	    <button class="close" data-dismiss="alert">X</button>
	    <p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
	</div><br>
	<?php } ?>        
       
     
<div style="border:1px solid #dbdbdb;padding: 16px;">

<?php 


if(count($products) && !empty($products)){  
$dataProvider = new CArrayDataProvider($products);
$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'favourite_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),

			));

}else{ ?>
<p style="text-align:center; font-size:12px;">No products found</p>
<?php  }	?>

<!-------->
     
   
        
        <div style="clear:both;"></div>
 





</div>





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

