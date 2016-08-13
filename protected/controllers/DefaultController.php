<?php
class DefaultController extends Controller
{

   public $layout = '//layouts/column2';	  
	  

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
		$model->currentPassword = $model->currentPassword;
		
		if($model->validate())
		{
                $admin = User::model()->findByAttributes( array( 'user_id'=>Yii::app()->user->id ) );
                $admin->password = User::model()->hashPassword($model->newPassword);
                $admin->save(false);
		Yii::app()->user->setFlash('success', 'Password has been updated');
		$this->refresh(array('default/update'));
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
	public function actionLogin()
	{
    $model = new AdminLoginForm;
	if(empty($_SESSION['_admin__id']))// check whether he is already logged in
	
	{
			
			 
	
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
	
			// collect user input data
			if(isset($_POST['AdminLoginForm']))
			{
				 $model->attributes=$_POST['AdminLoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					 $this->redirect(array('/admin'));
			}
			
	}
	
	else
	{
	$this->redirect(array('/admin')); 
	}



		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
		$this->redirect(array('/admin/default/login'));
		
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
	
}
