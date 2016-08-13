/css/bootstrap_custom.css' type='text/css' media='all' />
<?php
/* @var $this TemplesController */
/* @var $model Temples */

$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Registration Completed',
);

$this->menu=array(
	//array('label'=>'Manage Pooja', 'url'=>array('admin')),
);
?>

<div class="sc-column sc-column-last" >

<div class="messageBox">
<p><b><?php echo $model->gender.'. '.$model->first_name.' '.$model->last_name; ?></b>,<br/><br/>Your registration completed successfully and confirmation message sent to your email. After admin approved your account it will get valid.</p>
</div>



<div style="clear:both;"></div>
          </div>
</div>