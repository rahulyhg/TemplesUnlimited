<?php
class DefaultController extends Controller
{

   public $layout = '/layouts/main';	  
	  

  public function actionIndex()
	{  
		$this->render('index');
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
				              $this->redirect(array('/front/profile/user'));
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
	$this->redirect(array('/front/profile/user')); 
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
											$subject = 'Forgot Password';
											$message = 'Hi '.$userdetails->first_name.' '.$userdetails->last_name.', <br/><br/> Please follow the below link to reset your password <br/><br/> <a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'front/default/reset?id='.$ec.'">'.Yii::app()->params['SITE_BASE_URL'].'front/default/reset?id='.$ec.'</a> <br/><br/>Thanks & Regards<br/>Temples Unlimited Team';
											
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
	    $this->redirect(array('/front/profile/user')); 
	 }
	
	}
	
	function actionReset(){
	if(Yii::app()->user->isGuest)// check whether he is already logged in
	{
			 if(isset($_REQUEST['id'])){
			  $model = new Profile;
			  $model->setScenario('reset');
			  $success = 0;
			  $invaliduser = 0;
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
								if( $model->validate()){
								  $userdetails->password =  User::model()->hashPassword($model->password);
								  $userdetails->password_reset_id = '';
								  $userdetails->update();
								 $success = 1;
								 $array = array("reset" => "success",'msg'=>'Password changed successfully.');
														//Yii::app()->user->setFlash("success", "Password changed successfully.");
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
				
				
				
				
					  $this->render('reset',array(
							'model'=>$model,
							'invaliduser'=>$invaliduser,
							'success'=>$success,
						));
			  }		
	  
	   }else{
	       $this->redirect(array('/front/profile/user')); 
	   }
	
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
		$this->redirect(array('/front'));
		
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
	
}