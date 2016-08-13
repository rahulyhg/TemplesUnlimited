<?php class HybridauthController extends Controller{
 
    public $defaultAction='authenticate';
    public $debugMode=true;
 
    // important! all providers will access this action, is the route of 'base_url' in config
    public function actionEndpoint(){ 
        Yii::app()->hybridAuth->endPoint(); 
    }
 
    public function actionAuthenticate($provider='Facebook'){
        if(!Yii::app()->user->isGuest || !Yii::app()->hybridAuth->isAllowedProvider($provider))
            $this->redirect(Yii::app()->homeUrl);
 
        if($this->debugMode)
            Yii::app()->hybridAuth->showError=true;
 
        if(Yii::app()->hybridAuth->isAdapterUserConnected($provider)){
            $socialUser = Yii::app()->hybridAuth->getAdapterUserProfile($provider);
			$socialUser->provider = $provider;
			
            if(isset($socialUser)){
                // find user from db model with social user info
				
			  $userdeatils = User::model()->find('email=:email and social_provider=:social_provider',array(':email'=>$socialUser->email,':social_provider'=>$provider));
			  if(count($userdeatils)  && !empty($userdeatils) && isset($userdeatils->user_id)){
			     $socialUser->exists = true;
			  }
                 
			   Yii::app()->session['social'] = $socialUser;
			   if(count($userdeatils)  && !empty($userdeatils) && isset($userdeatils->user_id)){
			   	$this->redirect(array('/front/default/login/type/social'));
				}else{ 
			
                    // if not exist register new user with social user info.
                    $model = new Profile;
					$model->setScenario('social');
                    $model->social_provider = $provider;
                    $model->social_identifier = $socialUser->identifier;
                   // $model->user_image = $socialUser->photoURL;
                    $model->email = $socialUser->email;
					$model->role = 2;
					$model->language = 1;
					$model->role = 2;
					$model->language = 1;
					$model->gender = 'Mr';
					if(isset($socialUser->firstName))
					$model->first_name = $socialUser->firstName;		
					if(isset($socialUser->first_name))
					$model->first_name = $socialUser->first_name;	
					
					if(isset($socialUser->lastName))
					$model->last_name = $socialUser->lastName;		
					if(isset($socialUser->last_name))
					$model->last_name = $socialUser->last_name;	
								
					$model->created_on = date('Y-m-d H:i:s');
                //    $model->social_info1 = hash('');
                 //   $model->social_info2 = hash('');
                 //   ......
                    if($model->save()){
                       $user=$model; 
							$this->redirect(array('/front/user/regsuccess','id'=>$model->user_id));
                    }else{ 
                          $this->redirect(array('/front/default/login/type/social'));
                    }
                }
 
                if($user){
                    $identity = new UserIdentity($user->social_info1, $user->social_info2);
                    $identity->authenticate('social');
                    switch ($identity->errorCode) {
                     // ...... 
                      case UserIdentity::ERROR_NONE:
                           Yii::app()->user->login($identity);
                           $this->redirect(Yii::app()->request->urlReferer);
                           break;
                      //...... 
                    }
                }
            }
        }
        $this->redirect(Yii::app()->homeUrl);
    }
	
	 public function actionAuthenticate1($provider='Facebook'){ 
        if(!Yii::app()->user->isGuest || !Yii::app()->hybridAuth->isAllowedProvider($provider))
            $this->redirect(Yii::app()->homeUrl);
 
        if($this->debugMode)
            Yii::app()->hybridAuth->showError=true;
 
        if(Yii::app()->hybridAuth->isAdapterUserConnected($provider)){
            $socialUser = Yii::app()->hybridAuth->getAdapterUserProfile($provider);
			$socialUser->provider = $provider;
            if(isset($socialUser)){
                // find user from db model with social user info
				
			  $userdeatils = User::model()->find('email=:email',array(':email'=>$socialUser->email));
			  if(count($userdeatils) && isset($userdeatils->user_id)){
			     $socialUser->exists = true;
			  }
               
			    Yii::app()->session['social'] = $socialUser;
			   	$this->redirect(array('/front/user/create','type'=>'social'));
                /*if(empty($user)){ 
                    // if not exist register new user with social user info.
                    $model = new User('register');
                    $model->social_provider = $provider;
                    $model->social_identifier = $socialUser->identifier;
                    $model->user_image = $socialUser->photoURL;
                    $model->email = $socialUser->email;
					$model->created_at = date('Y-m-d H:i:s');
                //    $model->social_info1 = hash('');
                 //   $model->social_info2 = hash('');
                 //   ......
                    if($model->save()){
                       $user=$model; 
                    }else{
                       $user=false;
                    }
                }*/
 
                if($user){
                    $identity = new UserIdentity($user->social_info1, $user->social_info2);
                    $identity->authenticate('social');
                    switch ($identity->errorCode) {
                     // ...... 
                      case UserIdentity::ERROR_NONE:
                           Yii::app()->user->login($identity);
                           $this->redirect(Yii::app()->request->urlReferer);
                           break;
                      //...... 
                    }
                }
            }
        }
        $this->redirect(Yii::app()->homeUrl);
    }
 
    public function actionLogout(){
 
        if(Yii::app()->hybridAuth->getConnectedProviders()){
            Yii::app()->hybridAuth->logoutAllProviders();
        }
 
        Yii::app()->user->logout();    
    }
 
} ?>