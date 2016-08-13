<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Pooja - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);
?>
<link rel='stylesheet'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/bootstrap.min.css' type='text/css' media='all' />

<!-----one-third------->
<?php $this->renderPartial('profileleft', array('model'=>$model)); ?>	
<div class="sc-column sc-column-last three-fourth-last profiledetailspart">

<?php if( Yii::app()->user->hasFlash('success')){ ?>
 <div class="flashmessage success">
	<button class="close" data-dismiss="alert">X</button>
	<p><?php echo  Yii::app()->user->getFlash('success'); ?></p>
</div>
<?php } ?>
<?php  $this->renderPartial('pooja_details', array('model'=>$model)); ?>		

</div>
<!---------two-third--------->
<script type="text/javascript">
$(function(){
	
	 
	 
	 
	 
		$('#User_user_image').change(function(){
		var errorcountimage = 0;
		  var file = $(this).val();
		  var fileupload = this.files[0];
		  var exts = ['jpeg','jpg','png','gif'];
		  // first check if file field has any value
		  if ( file ) {
			// split file name at dot
			var get_ext = file.split('.');
			// reverse name to check extension
			get_ext = get_ext.reverse();
			// check file type is valid as given in 'exts' array
			if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
			  //alert( 'Allowed extension!' );
			   if(fileupload.size != 'undefind' && fileupload.size){
			     if(fileupload.size > 2048576){
				   $(this).val('');
				   alert( 'File size exceeds 1MB!' );
				   errorcountimage++;
				 }
			   }
			} else {
			  $(this).val('');
			  alert( 'File format not allowed!' );
			  errorcountimage++;
			}
		  }
		  
		  if(errorcountimage == 0){
		  changeprofileimage('User_user_image','<?php echo Yii::app()->user->id; ?>');
		  }
		});
		
		
		
		
	  });
	  
	  function change_profileimage(){
	    $('#User_user_image').click();
	  }
</script>
