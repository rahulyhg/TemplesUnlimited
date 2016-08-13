<?php
class DefaultController extends Controller
{

   public $layout = '/layouts/main';	  
	  

  public function actionIndex()
		{ 
                                  $this->pageTitle = 'Temples Unlimited -  Home ';
  
				date_default_timezone_set('Asia/Kolkata'); 
				
				/*  featured_listing ='1' starts here*/
				
				$criteria = new CDbCriteria();
				
				$criteria->select='state_id,featured_listing,city_id';
				
				$condition = 'featured_listing ="1"';
				
				if(isset($_REQUEST['city']))
				{
				$city = Cities::model()->findByAttributes(array('name'=>$_REQUEST['city']));
				
				 if(count($city)=='0')
				 {
				  echo "We're sorry, no results found for your search.";
				  die;
				 }
				 else
				 {
				  $condition .= ' and city_id ='.$city->id.'';
				 }
				
				Yii::app()->session['city'] =$city->id;
				}
				else
				{
				unset(Yii::app()->session['city']);
				}
				
				if(isset($_REQUEST['all']))
				$condition .= '';
				
				$criteria->condition =  $condition;
				
				$criteria->order = "id DESC";
				
				$criteria->group = "state_id";
				
				$criteria->limit = '9';
				
				$popular = Temples::model()->findAll($criteria); 
				
				
				$dataProvider_pop = new CArrayDataProvider($popular);
				
				/*  featured_listing ='1' ends here*/
				
				/*  featured_listing ='2' starts here*/
				
				$criteria1 = new CDbCriteria();
				
				$criteria1->select='state_id,featured_listing,city_id';
				
				$condition1 = 'featured_listing ="2"';
				
				if(isset($_REQUEST['city']))
				{
				$city = Cities::model()->findByAttributes(array('name'=>$_REQUEST['city']));
				
				$condition1 .= 'and city_id ='.$city->id.'';
				
				Yii::app()->session['city'] =$city->id;
				}
				else
				{
				unset(Yii::app()->session['city']);
				}
				
				if(isset($_REQUEST['all']))
				$condition .= '';
				
				$criteria1->condition =  $condition1;
				
				$criteria1->limit = 9;
				
				$criteria1->order = "id DESC";
				
				$criteria1->group = "state_id";
				
				$popular_india = Temples::model()->findAll($criteria1); 
				
				$dataProvider_pop_india = new CArrayDataProvider($popular_india);
				
				
				/*  featured_listing ='2' ends here*/
				
				/*  featured_listing ='3' starts here*/
				
				$criteria2 = new CDbCriteria();
				
				$criteria2->select='state_id,featured_listing,city_id';
				
				$condition2 = 'featured_listing ="3"';
				
				
				if(isset($_REQUEST['city']))
				{
				$city = Cities::model()->findByAttributes(array('name'=>$_REQUEST['city']));
				
				$condition2 .= ' and city_id ='.$city->id.'';
				
				Yii::app()->session['city'] =$city->id;
				}
				else
				{
				unset(Yii::app()->session['city']);
				}
				
				if(isset($_REQUEST['all']))
				$condition .= '';
				
				$criteria2->condition =  $condition2;
				
				$criteria2->limit = 9;
				
				$criteria2->order = "id DESC";
				
				$criteria2->group = "state_id";
				
				$merriage_prms = Temples::model()->findAll($criteria2); 
				
				$dataProvider_merriage_prms = new CArrayDataProvider($merriage_prms);
				
				/*  featured_listing ='3' ends here*/
				
				/*  featured_listing ='4' starts here*/
				
				
				$criteria3 = new CDbCriteria();
				
				$criteria2->select='state_id,featured_listing,city_id';
				
				$condition3 = ' featured_listing ="4"';
				
				if(isset($_REQUEST['city']))
				{
				$city = Cities::model()->findByAttributes(array('name'=>$_REQUEST['city']));
				
				$condition3 .= ' and city_id ='.$city->id.'';
				
				Yii::app()->session['city'] =$city->id;
				}
				else
				{
				unset(Yii::app()->session['city']);
				}
				
				if(isset($_REQUEST['all']))
				$condition .= '';
				
				$criteria3->condition =  $condition3;
				
				$criteria3->limit = 9;
				
				$criteria3->order = "id DESC";
				
				$criteria2->group = "state_id";
				
				$child_birth = Temples::model()->findAll($criteria3); 
				
				$dataProvider_child_birth = new CArrayDataProvider($child_birth);
				
				/*  featured_listing ='4' ends here*/
				
				if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_index_featured', array(
				'dataProvider_pop' => $dataProvider_pop,
				'dataProvider_pop_india'=>$dataProvider_pop_india,
				'dataProvider_merriage_prms'=>$dataProvider_merriage_prms,
				'dataProvider_child_birth'=>$dataProvider_child_birth,
				));
				} else{
				$this->render('index', array(
				'dataProvider_pop' => $dataProvider_pop,
				'dataProvider_pop_india'=>$dataProvider_pop_india,
				'dataProvider_merriage_prms'=>$dataProvider_merriage_prms,
				'dataProvider_child_birth'=>$dataProvider_child_birth,
				));
				}
		  }
	  
	public function actionCreate()
	{
	 if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
		$model = new AdminUsers;  
		$model->setScenario('create');		
		if(isset($_POST['AdminUsers']))
		{
		    $model->attributes=$_POST['AdminUsers'];
			if($model->validate())
			{
				$model->created = date('Y-m-d H:i:s');
				$model->save();  
				Yii::app()->user->setFlash('success', 'New admin Created Successfully');
				$this->redirect(array('/admin/default/admins'));
			}
		}
		$this->render('createadmin',array('model'=>$model));
	  }	
    }
	
	/**
	 * Manages all models.
	 */
	public function actionAdmins()
	{
	  if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
			$model=new AdminUsers('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['AdminUsers']))
				$model->attributes=$_GET['AdminUsers'];
	
			$this->render('admins',array(
				'model'=>$model,
			));
		}
	}
	
	/**
	 * Manages all models.
	 */
	public function actiondeleteadmin($id)
	{
	
       if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
		$model=AdminUsers::model()->findByPK($id);
		$model->delete();
		$this->redirect(array('/admin/default/admins'));
		}
	}
	
	public function actionTerm()
	{

 $this->pageTitle = 'Temples Unlimited -  Terms & Policies ';

	 $this->render('term');
	}
	
	
	public function actionHowitworks()
	{
 $this->pageTitle = 'Temples Unlimited -  How it works ';

	 $this->render('how_its_work');
	}
	
	public function actionAbout()
	{

        $this->pageTitle = 'Temples Unlimited -  About Us ';

        $this->render('about');
	} 

	
	public function actionContact()
	{

        $this->pageTitle = 'Temples Unlimited -  Contact Us ';

	$model=new Contact;
	
	    if(isset($_POST['Contact']))
		{
		$model->attributes=$_POST['Contact'];
		
		
		$this->performAjaxValidation($model);  
		
		if($model->validate())
		{
	    $message =	"<html>
					<head>
					<title>USER FEEDBACK FORM</title>
					</head>
					<body>
					<table cellpadding='0' cellspacing='0' width='800px'>
					<tr>
					<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#339999; margin-top:-20px;'><strong>USER FEEDBACK FORM<strong></td>
					</tr>
					
					<tr>
					<td colspan='3' height='7px'></td>
					</tr>
					<tr>
					<td align='left'>Admin</td>
					</tr>
					<tr>
					<td colspan='3' height='7px'></td>
					</tr>
					<p>&nbsp;</p>
					
					<p style='font-weight: bold;'>&nbsp;&nbsp;Name    :&nbsp;&nbsp;".$_POST['Contact']['name']."</p>
					<p style='font-weight: bold;'>&nbsp;&nbsp;Email   :&nbsp;&nbsp;".$_POST['Contact']['email']."</p>
					<p style='font-weight: bold;'>&nbsp;&nbsp;Subject :&nbsp;&nbsp;".$_POST['Contact']['subject']."</p>
					<p style='font-weight: bold;'>&nbsp;&nbsp;Message :&nbsp;&nbsp;".$_POST['Contact']['message']."</p>
					<p>&nbsp;</p>
					
					</table>
					</body>
					</html>
					";
					
    		$subject = $_POST['Contact']['subject'];
			$to = helpers::configs()->company_email;
			User::model()->mailsend($to,$_POST['Contact']['email'],$subject,$message);
			
		   Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
            
				$model->name =  $_POST['Contact']['name'];
				$model->email =  $_POST['Contact']['email'];
				$model->subject =  $_POST['Contact']['subject'];
				$model->message	 =  $_POST['Contact']['message'];
				
			if($model->save())
				$this->redirect(array('default/contact'));
		 }
		}
	
	 $this->render('contact',array(
			'model'=>$model,
		));  
	}
	
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='temples-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	  
	public function actionUpdate()
	{

		$model = new ChangePasswordForm;   // this is the model file name declaration
		if(isset($_POST['ajax']) && $_POST['ajax']==='changePassword-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		
		
		if(isset($_POST['ChangePasswordForm']))
		{
		
		$model->attributes=$_POST['ChangePasswordForm'];
		
		if($model->validate() && $model->changePassword())
		{
		Yii::app()->user->setFlash('success', 'Password has been updated');
		$this->refresh();
		//$this->redirect(array('/admin/default/update'));
		}
		}
		$this->render('update',array('model'=>$model));
    }
  
  
     public function actionConfig()
	 {
		$model = Config::model()->findByPK('1');   // this is the model file name declaration
		$previouslogo = $model->company_logo;
		if(isset($_POST['Config']))
		{
		
		     $attrs = $_POST['Config'];
		    
			$dir = 'uploads/config/';
			if (!file_exists($dir) and !is_dir($dir)) {
				mkdir($dir);         
			} 
			 $model->company_logo =  CUploadedFile::getInstance($model,'company_logo');
			 $namearea = $dir.time();
			 
			 if($model->company_logo){
							$model->company_logo->saveAs($namearea.$model->company_logo);
							$attrs['company_logo'] = $namearea.$model->company_logo;
			 }else{
			 $attrs['company_logo'] = $previouslogo;
			 }
			
			$model->setAttributes($attrs);
			if($model->validate() && $model->update())
			{
				Yii::app()->user->setFlash('success', 'Configuration has been updated');
				$this->refresh();
				//$this->redirect(array('/admin/default/update'));
			}
		}
		$this->render('config',array('model'=>$model));
     }

	/**
	 * Displays the login page
	 */
	public function actionLogin($type='email')
	{
	
	$this->pageTitle = ' Login and Registration';
	$model = new LoginForm;	
	if(Yii::app()->user->isGuest)// check whether he is already logged in
	{
	
	  	if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");
			$model=new LoginForm;
			if (Yii::app()->request->isAjaxRequest){ 
					if (isset($_POST['LoginForm'])) {  
					$model->attributes=$_POST['LoginForm'];
					
						if ($model->validate() && $model->login()){
							$array = array("login" => "success");
							Yii::app()->user->setFlash("success", "Successfully logged in.");
							$json = json_encode($array);
							echo $json;
							Yii::app()->end();
						}else{
							echo CActiveForm::validate($model);
							Yii::app()->end();
						}
					} //POST
			}else{
				   if(isset( Yii::app()->session['social']) && count(Yii::app()->session['social'])){
					 $socialdetails =  json_decode(json_encode(Yii::app()->session['social']),true);
					 if(isset($socialdetails['exists']) && $socialdetails['exists']){
							$loginform = new LoginForm;
							$loginform->username = $socialdetails['email'];
							$loginform->logintype = 'social';
							$loginform->password =$socialdetails['identifier'];
							$initialokay = $loginform->makelogin();
							if($initialokay){
							  Yii::app()->user->setFlash("success", "Successfully logged in.");
				              $this->redirect(array('/user'));
							}else
								 Yii::app()->user->setFlash('error','Sorry! Specified login details not found, please register first.');
					 }else{
					 
						  Yii::app()->user->setFlash('error','Sorry! Specified login details not found, please register first.');
					 }
					
				}
		   }
			
			 //$this->layout = '/layouts/login';
			 
	
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
	
			// collect user input data
			if(isset($_POST['LoginForm']))
			{
   			    $model->attributes=$_POST['AdminLoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					 $this->redirect(array('/front'));
			}
			
	}else
	{
	if(!Yii::app()->session['email_verified'])
	$this->redirect(array('/user')); 
	}

		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	
	

	
	
	function actionForgot(){
	if(Yii::app()->user->isGuest)// check whether he is already logged in
	{
	  $model = new Profile;
	  $model->setScenario('forgot');
	  $send = 0;
	  $invaliduser = 0;
	  if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
		throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");
	if (Yii::app()->request->isAjaxRequest){ 
					  if(isset($_POST['Profile'])){
						$model->email = $_POST['Profile']['email'];
									if( $model->validate()){
										$userdetails = User::model()->find('email=:email',array(':email'=>$model->email));
										if(isset($userdetails) && count($userdetails)){
											$ec =   helpers::simple_encrypt($model->email.'TIMESECSPLIT'.strtotime('+1 hour')); 
											$userdetails->password_reset_id = $ec;
											$userdetails->update();
											$subject = 'Reset your TemplesUnlimited password';
											
					$message = $userdetails->first_name.' '.$userdetails->last_name.', <br/><br/> Forgot your TemplesUnlimited password?<br/><br/> TemplesUnlimited received a request to reset the password for your account. To reset your password, click on the link below or copy and paste the URL into your browser:<a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'/front/default/reset?id='.$ec.'">'.Yii::app()->params['SITE_BASE_URL'].'/front/default/reset?id='.$ec.'</a> <br/><br/>If you are getting a lot of password reset emails you did not request, you can change your account settings to require personal information to start a password reset.<br><br> Best regards,<br/>The TemplesUnlimited Team.';
											
											  $from = helpers::configs()->company_email;
											  User::model()->mailsend($userdetails->email,$from,$subject,$message);
												$array = array("forgot" => "success",'msg'=>'Mail sent to your email address successfully.');
												//Yii::app()->user->setFlash("success", "Mail sent to your email address successfully.");
												$json = json_encode($array);
												echo $json;
												Yii::app()->end();
										}		
									}else{
											echo CActiveForm::validate($model);
											Yii::app()->end();
										}	
					  }else{
								echo CActiveForm::validate($model);
								Yii::app()->end();
							}
	   } 
	    
		$this->render('forgot',array(
			'model'=>$model,
			'invaliduser'=>$invaliduser,
			'send'=>$send,
		));
	  
	  }else{
	    $this->redirect(array('/user')); 
	 }
	
	}
	
	function actionReset(){

	if(Yii::app()->user->isGuest)// check whether he is already logged in
	{
	         
			  
			 
			  if(isset($_REQUEST['id'])){
			  
			   $userdetails1 = User::model()->find('password_reset_id=:password_reset_id',array(':password_reset_id'=>$_REQUEST['id']));
			   
			 
			  
			  
			  $model = new Profile;
			  $model->setScenario('reset');
			  $success = 0;
			  $invaliduser = 0;
			  
			  if(count($userdetails1)>0)
			  {
			  $et  =   helpers::simple_decrypt($_REQUEST['id']); 
			  $details_arr = explode('TIMESECSPLIT',$et);

			 if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");
			if (Yii::app()->request->isAjaxRequest){ 
						 $resettime = (int)$details_arr[1];
						 $userdetails = User::model()->find('password_reset_id=:password_reset_id',array(':password_reset_id'=>$_REQUEST['id']));
							 if(isset($_POST['Profile'])){ 
								$model->password = $_POST['Profile']['password'];
								$model->email = $details_arr[0];
								$model->conpassword = $_POST['Profile']['conpassword'];
								if($model->validate()){
								  $userdetails->password =  User::model()->hashPassword($model->password);
								  $userdetails->password_reset_id = '';
								  $userdetails->password_reset_date = date('Y-m-d');
								  $userdetails->update();
								 $success = 1;
								 $array = array("reset" => "success",'msg'=>'Password changed successfully.');
								  Yii::app()->user->setFlash("success", "Password changed successfully.");
									$json = json_encode($array);
									echo $json;
									Yii::app()->end();
								}else{
								        
										echo CActiveForm::validate($model);
										Yii::app()->end();
									}
							}else{
										echo CActiveForm::validate($model);
										Yii::app()->end();
									}	
						
			}
			}
			else
			{
			   Yii::app()->user->setFlash('deactive','There was a problem with your request.<br>We are sorry, we had a problem with your request.');
			   
			   $this->render('reset',array(
							'model'=>$model,
							'invaliduser'=>'',
							'success'=>'',
						));
			   die;
			}
				
				
				
				
					  $this->render('reset',array(
							'model'=>$model,
							'invaliduser'=>$invaliduser,
							'success'=>$success,
						));
			  }		
	  
	   }else{
	   
	       $this->redirect(array('/user')); 
	   }
	
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		if(isset($_POST['email'])  && $_POST['email']!='')
			{
			    Yii::app()->user->logout();
				$user = User::model()->findByPk($_POST['user_id']);
				$connection = yii::app()->db;
				$sql = "UPDATE user SET email = '".$_POST['email']."' WHERE user_id='".$_POST['user_id']."' ";
				$command=$connection->createCommand($sql);
				$command->execute();
				$from = helpers::configs()->company_email;
				$userdetails = User::model()->findByPk($_POST['user_id']);
				$to = $_POST['email'];
				$subject = 'Confirm your TemplesUnlimited account';
				$encryptedusername = User::model()->simple_encrypt($userdetails->email);
				$message = 'Welcome to TemplesUnlimited,'.$userdetails->first_name.' '.$userdetails->last_name.'!<br><br>To complete your registration, please confirm your email address by clicking the link below or copying and pasting it into your browse: <a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'/front/user/verifiedemail/id/'.$_POST['user_id'].'">'.Yii::app()->params['SITE_BASE_URL'].'front/user/verifiedemail/id/'.$_POST['user_id'].'</a>.<br><br> Once your account is confirmed, type your username, password and hit "login". Thats it!.<br><br>If you find any difficulties or having queries, contact us at <a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'/front/default/contact">'.Yii::app()->params['SITE_BASE_URL'].'/front/default/contact</a>.<br><br>Best Regards<br><span class="il">The TemplesUnlimited Team.</span>';
				User::model()->mailsend($to,$from,$subject,$message);
				Yii::app()->session['social'] = array();
				unset( Yii::app()->session['social']);
				if( $userdetails->role == '2'){
				$loginform = new LoginForm;
				$loginform->username = $userdetails->email;
				$loginform->password = $userdetails->password;
				$initialokay = $loginform->makelogin();
				Yii::app()->session->open();
				Yii::app()->user->setFlash("success", "<table>
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
				</table>");
				$this->redirect(array('/login'));
				} 
				Yii::app()->user->logout();
				$this->render('regsuccess',array(
				'model'=>$user,
				));	
			}
		else
			{
				Yii::app()->user->logout();
				$this->redirect(array('/front'));
			}
		
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionReportings()
	{
		$model=new Reporting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reporting']))
			$model->attributes=$_GET['Reporting'];

		$this->render('reportings',array(
			'model'=>$model,
		));
		
	}
	
	public function actionTransactions()
	{
		$model=new Transaction('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transaction']))
			$model->attributes=$_GET['Transaction'];

		$this->render('transactions',array(
			'model'=>$model,
		));
		
	}
	
	public function actionDeletetransaction($id)
	{
       if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
	       Common::model()->deletetransaction($id);
	      $this->redirect(array('/admin/default/transactions'));
		}
	}
	
	public function actionDeletetransactionall()
	{
       if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
	       Common::model()->deletetransactionall();
	      $this->redirect(array('/admin/default/transactions'));
		}
	}
	
	public function actionDeletereport($id)
	{
       if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
	       Common::model()->deletereport($id);
	      $this->redirect(array('/admin/default/reportings'));
		}
	}
	
	public function actionDeletereportall()
	{
       if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
	       Common::model()->deletereportall();
	      $this->redirect(array('/admin/default/reportings'));
		}
	}
	
	function actionNotfound(){
	
	 $this->render('notfound',array(
		));
	  
	}
	
	function actionSend_newsletter(){
	$model = new Newsletter;
	if(isset($_POST['Newsletter'])){
	$model->attributes = $_POST['Newsletter'];
	if($model->validate()){
		  if(Newsletter::model()->send_news_letters($_POST['Newsletter'])){
			  Yii::app()->user->setFlash('success', 'Newsletter Sent Successfully');
			  $this->refresh();
		  }
	  }
	}
	
	
	 $this->render('send_newsletter',array(
	 'model'=>$model,
		));
	  
	}
	
	function actionResendverifylink(){
	           $model = new User;
	           if(isset($_POST['User']['username'])){
					$from = helpers::configs()->company_email;
					$userdetails = User::model()->find('username=:username',array(':username'=>$_POST['User']['username']));
					if(count($userdetails) && isset($userdetails->username)){ 
							$to = $userdetails->email;
							$subject = 'Lexgo email verification';
							$encryptedusername = User::model()->simple_encrypt($userdetails->username);
							$message = 'Hi '.$userdetails->username.',<br><br>Please go to: <a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'home/verify?id='.$encryptedusername.'">'.Yii::app()->params['SITE_BASE_URL'].'home/verify?id='.$encryptedusername.'</a> to verify your email and login to <span class="il">Lexgo</span>.<br><br><br>Best Regards<br><span class="il">Lexgo</span>';
						   User::model()->mailsend($to,$from,$subject,$message);
						   Yii::app()->user->setFlash('success', 'Email verification link sent Successfully');
				   }else{
				        Yii::app()->user->setFlash('error', 'Invalid username, please provide valid username');
				   }
			   }
			   
			    $this->render('send_verifylink',array(
				 'model'=>$model,
				));
		}
		
		

	
		
		
		function actionRaahukaalam()
			{
			
			date_default_timezone_set('Asia/Kolkata'); 
			
			
			if(isset($_POST['date']))
			{
			$date =  $_POST['date'];
			$timestamp = strtotime($date);
			$days_dis = date('l', $timestamp);
			}
			else
			{
			$date =  date('Y-m-d');
			$days_dis ='Today';
			}
			
			$date = $date;
			$sun_info = date_sun_info(strtotime($date), 13.0839, 80.2700);
			$sun_rise = date("H:i:s", $sun_info['sunrise']);
			$sun_set = date("H:i:s", $sun_info['sunset']);
			$start_date = new DateTime($sun_rise);
			$since_start = $start_date->diff(new DateTime($sun_set));
			$hour = $since_start->h;
			$mins = $since_start->i;
			$secs = $since_start->s;
			
			$total_mins = ($hour*60) + $mins + ($secs/60);		
			$avg_times = $total_mins/8;	
			$avg_times = round($avg_times, 2); 	
			$avg_times = explode('.',$avg_times);
	
			$avg_times = $avg_times[0] * 60  + $avg_times[1];
			
			$avg_times =  gmdate("H:i:s", $avg_times); 
			
			$raagu_kaalam = array();
			
			$test = $sun_rise ;
			
			for($i=1;$i<9;$i++)
			{
			$test =  $this->sum_the_time($test,$avg_times);
			$raagu_kaalam[$i] = $test ;
			}
			$raagu_kaalam[0] = $sun_rise ;
			ksort($raagu_kaalam);
			
			$timestamp = strtotime($date);
			
			$day = date('l', $timestamp);
			
			if($day =='Monday')
			{
			$raahukaalam =  $raagu_kaalam['1'].'&nbsp;-&nbsp;'.$raagu_kaalam['2']; 
			}
			else if($day =='Tuesday')
			{
			$raahukaalam =  $raagu_kaalam['6'].'&nbsp;-&nbsp;'.$raagu_kaalam['7']; 
			}
			else if($day =='Wednesday')
			{
			$raahukaalam =  $raagu_kaalam['4'].'&nbsp;-&nbsp;'.$raagu_kaalam['5']; 
			}
			else if($day =='Thursday')
			{
			$raahukaalam =  $raagu_kaalam['5'].'&nbsp;-&nbsp;'.$raagu_kaalam['6']; 
			}
			else if($day =='Friday')
			{
			$raahukaalam =  $raagu_kaalam['3'].'&nbsp;-&nbsp;'.$raagu_kaalam['4']; 
			}
			else if($day =='Saturday')
			{
			$raahukaalam =  $raagu_kaalam['2'].'&nbsp;-&nbsp;'.$raagu_kaalam['3']; 
			}
			else
			{
			$raahukaalam =  $raagu_kaalam['7'].'&nbsp;-&nbsp;'.$raagu_kaalam['8']; 
			}
			
			$month = date('F', strtotime($date));
			
			$date = explode('-',$date);
			
			$avg_times = explode(':',$avg_times);
			
			$avg_times = $avg_times[0]." hour ".$avg_times[1]." mins ".$avg_times[2]." secs";
			
			echo '<div align="center" ><h2>'.$days_dis.' <span><strong>'.$month.' '.$date[2].', '.$date[0].'</strong></span></h2><p style="font-size:14px;">Local Timings for Chennai, India</p></div><br><div align="center"><h2 style="background:#FFF; border:1px solid #fff; padding:5px;border-radius:5px;margin-top:-10px; text-align:center; width:57%;"><span><strong>'.$raahukaalam.'</strong></span></h2></div><p style="font-size:14px; margin-top:20px; text-align:center;">Duration : '.$avg_times.'</p>';
			} 
			
			function sum_the_time($time1, $time2) 
			{
				$times = array($time1, $time2);
				$seconds = 0;
				foreach ($times as $time)
				{
				list($hour,$minute,$second) = explode(':', $time);
				$seconds += $hour*3600;
				$seconds += $minute*60;
				$seconds += $second;
				}
				$hours = floor($seconds/3600);
				$seconds -= $hours*3600;
				$minutes  = floor($seconds/60);
				$seconds -= $minutes*60;
				// return "{$hours}:{$minutes}:{$seconds}";
				return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
			}
			
			function actionCityauto()
				{
				
				$q = $_GET['name_startsWith'];
				
				$rows = array();
				
				$sql = 'SELECT  `name` FROM cities WHERE `name` LIKE "%' . $q . '%"';
				$rows = Yii::app()->db->createCommand($sql)->queryAll();
				
				$data =array();
				
				for($i=0;$i<count($rows);$i++)
				{
				array_push($data,$rows[$i]['name']);	
				}		
				echo json_encode($data);
				}	
			
		
		  
		
		 /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	
				public function actionNsajax()
					{
					$emailid = $_POST['email'];
					
					$check = Newsletter::model()->findByAttributes(array('emailid'=>$emailid));
					
					
					if(count($check) == '0'){
					

					$subject =  'Newsletter Subscription Confirmation';		
					
					$from = helpers::configs()->company_email;
							

	$message =	   "<html>
					<head>
					<title>Confirm your email address</title>
					</head>
					<body>
					<table cellpadding='0' cellspacing='0' width='800px'>
					<tr>
					<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000000;'><strong>Confirm your email address<strong></td>
					</tr>

					<br/>
					<br/>

					TemplesUnlimited received a request to subscribe newsletter.To confirm this <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/default/newsletter?email=".$_POST['email'].">click here.</a><br/><br/>If you received this email by mistake, simply delete it.You won't be subscribed if you don't click the confirmation link above.<br/><br/>Best regards,<br/><br/>The TemplesUnlimited Team.

					<br/>

					</table>
					</body>
					</html>
					";
					
		            User::model()->mailsend($emailid,$from,$subject,$message);
					
					$date = date('Y-m-d H:i:s');
					$model = new Newsletter;
					$model->emailid = $_REQUEST['email'];
					$model->date = $date;
					$model->save(false);
		

					echo "Please confirm your email id. A confirmation email has been sent to your inbox.Please check your Spam folder too."; 
					
					}
					else
					{
					 echo "Emailid Already Registered";
					}
					}
					
					function actionNewsletter()
					{
					  $this->render('newsletter');
					}
					
					function actionUnsubscribe()
					{
					  $model=new Newsletter;

					  $this->render('unsubscribe',array('model'=>$model));
					}
					
					function actionCheckemailunsubscripe()
					{
					  $emailid = $_POST['email'];
					  
					  
					  $check = Newsletter::model()->findByAttributes(array('emailid'=>$emailid));
					  if(count($check) > '0')
					  {
                      $check->delete();
					  $subject =  'Termination of subscription for newsletter';		
					
					$from = helpers::configs()->company_email;
							

	$message =	   "<html>
					<head>
					<title>Termination of subscription for newsletter</title>
					</head>
					<body>
					<table cellpadding='0' cellspacing='0' width='800px'>
					<tr>
					<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000000;'><strong>You have been unsubscribed from our list<strong></td>
					</tr>
				    <p>&nbsp;</p>
					
					<br/>
					<br/>

					<br/><br/> We're sorry to see you go.<br/><br/>You will not receive any further messages from this newsletter.<br/><br/>Best regards,<br/><br/>The TemplesUnlimited Team.

					<br/>

					</table>
					</body>
					</html>
					";
					
		            User::model()->mailsend($emailid,$from,$subject,$message);
					
					
				echo "You have successfully unsubscribed from the newsletter subscription.";
					  }
					  else
					  {
					    echo "Our records show that  &nbsp; ".$emailid." &nbsp;has already been unsubscribed from this email list.";
					  }
					}
					
	
	
}
