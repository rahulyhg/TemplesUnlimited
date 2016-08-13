<style type="text/css">
.errorMessage{ color:#FF0000; }
</style>
<div class="span9">
      <ul class="breadcrumb">
      <li><i class="icon-user"></i>&nbsp;Create Admin</li>
      </ul>
      <div class="row-fluid">
        <div class="span12">
          <div class="main-heading light_blue-theme" id="notification"> <i class="icon-white icon-list-alt"></i>&nbsp;New Admin
            
            <div style="clear:both;"></div>
          </div>
          <div class="main-content">
	<?php
	$this->pageTitle=Yii::app()->name . ' - Create Admin';
	$this->breadcrumbs=array(
		'Config',
	);
	?>

	<?php if(Yii::app()->user->hasFlash('success')){ ?>
		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>	

    <?php $this->renderPartial('_form',array('model'=>$model)); ?>

		
			<div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>