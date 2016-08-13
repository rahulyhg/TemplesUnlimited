<link rel='stylesheet'   href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap_custom.css' type='text/css' media='all' />
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
<p><b><?php echo $model->gender.'. '.$model->first_name.' '.$model->last_name; ?></b>,
                                            <p><table>
											<tr>
											<b>We've sent you a confirmation email!</b>
											</tr>
											<br />
											<tr>
											Click the link in the email to verify your email address and complete registration.
											</tr>
											<br />
											<tr>
											TIP: If you haven't receive an email from TemplesUnlimited within a few minutes, check your spam or junk folder.
											</tr>
											</table></p>
</div>



<div style="clear:both;"></div>
          </div>
</div>
