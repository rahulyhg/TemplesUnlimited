<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Forgot Password';
$this->breadcrumbs=array(
	'Forgot Password',
);
?>
<link rel='stylesheet' id='jquery-ui-css-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/new_style_red.css' type='text/css' media='all' />
<br/>

<br/>
<br/>


	<aside class="widget widget_directory login-main login-main1" id="ait-directory-widget-2" style="margin-left:auto; margin-right:auto;">

<div>
<div id="user_form1">
<h3 class="section-title" style="margin:0px 0px 20px 0px;">Newsletter Subscription</h3>	
		
	<div class="not-logged">

		<div id="ait-login-tabs">


<?php if(isset($_REQUEST['email'])){

  $check = Newsletter::model()->findByAttributes(array('emailid'=>$_REQUEST['email']));
  
  if(count($check)>0)
  {
     
 if($check->status=='0')
{
		$check->status = '1';
		$check->update();

		$subject =  'Newsletter Subscription is Confirmed';		
					$from = helpers::configs()->company_email;
	$message =	   "<html>
					<head>
					<title>Newsletter Subscription is Confirmed</title>
					</head>
					<body>
					<table cellpadding='0' cellspacing='0' width='800px'>
					<tr>
					<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#105191;'>Your subscription to our list has been confirmed.</td>
					</tr>
					<br/>
					<br/>

					 If at any time you wish to stop receiving our emails,you can unsubscribe by  <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/default/unsubscribe?email=".$_REQUEST['email'].">click here.</a><br/><br/>Best regards,<br/><br/>The TemplesUnlimited Team.
					<br/>
					</table>
					</body>
					</html>
					";
		            User::model()->mailsend($_REQUEST['email'],$from,$subject,$message);
		?>
 <div class="flashmessage success" id="flashmessage" >
	<p>Thank You! Your subscription has been confirmed.</p>
</div>
<?php } else { ?>

 <div class="flashmessage success" id="flashmessage" >
	<p>You have already confirmed your Newsletter Subscription</p>
</div>
<?php } }  } ?>



</div>
			</div></div>
			
<!-- #page -->
<!---------location-------->

	
	

			
			
			</div>
			
			</aside>

<style>
.required
{
display:none;
}
</style>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>

<script type="text/javascript">
function submitformvalues()
{ 
 var email = $('#Newsletter_emailid').val();
  $.ajax({
              url : '<?php echo CController::CreateUrl('/front/default/checkemailunsubscripe'); ?>',
              type : "post",
              data : "email="+email,
              success:function(data)
              {
                  $('#User_language_em_').html(data);
			  } 
         });
		  return false;
}
    </script>
