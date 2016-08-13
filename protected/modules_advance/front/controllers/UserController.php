<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '/layouts/main';	  

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	 public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','dynamiccities','guideimageupload','uploadvideo','uploadguidelicense','uploadiyerimage','dynamiccitiesiyer','create','update','option_form','getsubcategories','guideactivities','guideactivitypersonform', 'guideactivitygroupform', 'guideactivityform','guidedetails','Regsuccess','iyerdetails','verifiedemail'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
		
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($type='email')
	{
	
		$model=new User;
		$guide = new Guide;
		
		$model->setScenario('common');
		$model->registertype = $type;
		
		
		/*$normalregister = new User; 
		if(isset( Yii::app()->session['social']) && count( Yii::app()->session['social']) && $_REQUEST['type'] == 'social'){
			$socialdetails = json_decode(json_encode(Yii::app()->session['social']),true);
			$model->first_name = $socialdetails['firstName'];
			$model->last_name = $socialdetails['lastName'];
			$model->gender = $socialdetails['gender'];
			$model->email = $socialdetails['email'];
			$model->social_identifier = $socialdetails['identifier'];
			$model->social_provider = $socialdetails['provider'];
			$model->language = $socialdetails['language'];
			
			if(isset($_POST['User']))
		    {
			    $_POST['User']['social_identifier'] = $socialdetails['identifier'];
				$_POST['User']['email'] = $socialdetails['email'];
				$_POST['User']['social_provider'] = $socialdetails['provider'];
				$_POST['User']['password'] = $socialdetails['email'].'test';
			}
			
		}*/
		
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
		
		
			$model->attributes=$_POST['User'];
			$model->created_on = date('Y-m-d H:i:s');
			if(isset($_POST['User']['social_identifier']) &&  trim($_POST['User']['social_identifier']) != '')
			$model->setScenario('social');
			else
			$model->setScenario('normal');
			
		/*	if($model->validate()){*/
	
			     if($model->save()){ 	
				  $model->password = User::model()->hashPassword($model->password);
				  $model->update();
				  
		   if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");
			if (Yii::app()->request->isAjaxRequest){ 
					
					  if($model->role == '3')
					    $url =  CController::CreateUrl('//front/user/guidedetails/id/'.$model->user_id);
					  else if($model->role == '4')
					    $url =  CController::CreateUrl('//front/user/iyerdetails/id/'.$model->user_id);
					 else if($model->role == '2')	
					   $url =  CController::CreateUrl('//front/user/regsuccess/id/'.$model->user_id);
						 $array = array("login" => "success",'url'=> $url);
						$json = json_encode($array);
						echo $json;
						Yii::app()->end();
						
					
			}else{
					 if($model->role == '3')
					 $this->redirect(array('guidedetails','id'=>$model->user_id));
					 else if($model->role == '4')
					 $this->redirect(array('iyerdetails','id'=>$model->user_id));
					 else if($model->role == '2'){
							  $this->redirect(array('regsuccess','id'=>$model->user_id));
				   }
				   
				}   
				}else{
				      if (Yii::app()->request->isAjaxRequest){ 
							echo CActiveForm::validate($model);
							Yii::app()->end();
						}
			}
		}
        
		 if (Yii::app()->request->isAjaxRequest){ 
							echo CActiveForm::validate($model);
							Yii::app()->end();
		     }else{
					 $this->render('create',array(
					'model'=>$model,
					'guide'=>$guide,
				   ));
		  }

		
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionGuidedetails($id)
	{
	
		$model=User::model()->findByPk($id);
		$guide = new Guide;
		$alreadyregistered = Guide::model()->exists_guide($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(!$alreadyregistered ){
	
			if(isset($_POST['Guide']))
			{
				$guide->attributes=$_POST['Guide'];
				if( isset($_POST['Guide']['guide_have_certificate']) && $_POST['Guide']['guide_have_certificate'] == '1')
				$guide->setScenario('license');
				
				$guide->user_id = $id;
				$time1 = strtotime($guide->guide_wh1);
				$time2 = strtotime($guide->guide_wh2);
				$time3 = 	number_format((($time2 - $time1) / 3600), 1, '.', ' ');
				$guide->guide_wh = $time3;
				if($guide->validate()){
				/*$uploadedFile=CUploadedFile::getInstance($model,'guide_video');
				if(!empty($uploadedFile))  // check if uploaded file is set or not
				{
						$uploadedFilename = str_replace(array(' ','&','?','<','>',':'),'',$uploadedFile->name);
						$fileName = time().$uploadedFilename;  
						$uploadedFile->saveAs( Yii::getPathOfAlias('webroot').'/uploads/guide/videos/'.$fileName);  
						$guide->guide_video = 'uploads/guide/videos/'.$fileName;
				}*/
				
				if($guide->guide_experiencetype == '1'){
				  $guide->guide_experience = number_format((float)($guide->guide_experience / 12 ), 1, '.', '');
				}
				
				$guide->guide_services = implode(',',$guide->guide_services);
				//$guide->guide_categories = implode(',',$guide->guide_categories);
				$guide->guide_sec_languages = implode(',',$guide->guide_sec_languages);
				$guide->secondary_locations = implode(',',$guide->secondary_locations);
				
				$guide->guide_categories = implode(',',$guide->guide_categories);
			
			
				if($guide->save()){
					/*if(isset($_POST['Images']) && isset($_POST['Images']['image_path']) && $_POST['Images']['image_path'] != '')
					$opjaoptionslists = array_filter(explode('SPLITIMAGESHERE',$_POST['Images']['image_path']));
					if(isset( $opjaoptionslists )){
					$imagescount = 0;
						foreach($opjaoptionslists as  $opjaoptionslist){
						if(trim($opjaoptionslist) != ''){ $imagescount++;
	
							if($imagescount == 1){
								   $user = User::model()->findByPk($guide->user_id);
								   $user->user_image =  $opjaoptionslist;
								   $user->update();
							}
							
							 $images = new Images;
							 $images->item_type = 'guide';
							$images->item_id = $id;
							$images->image_path = $opjaoptionslist;
							$images->created_at = date('Y-m-d H:i:s');
							$images->save();
							}
						}
					}*/
					
					 if(isset($guide->guide_image) && trim($guide->guide_image) != ''){
						   $user = User::model()->findByPk($guide->user_id);
						   $user->user_image = $guide->guide_image;
						   $user->update();
				   }
					
					$this->redirect(array('guideactivities','id'=>$guide->guide_id));
					}
				}
			}
	
			$this->render('guidedetails',array(
				'model'=>$model,
				'guide'=>$guide,
			));
		 }	
	}
	
	
	public function actionIyerdetails($id)
	{
	
		$model=User::model()->findByPk($id);
		$iyer = new Iyer;
		$iyer->iyer_image = $model->user_image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
       $alreadyregistered = Iyer::model()->iyerexists($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(!$alreadyregistered ){
		if(isset($_POST['Iyer']))
		{
		
	
			$iyer->attributes=$_POST['Iyer'];
			
			
			
			
		
			$iyer->user_id = $model->user_id;
			
			$time1 = strtotime($iyer->iyer_wh1);
			$time2 = strtotime($iyer->iyer_wh2);
			$time3 = 	number_format((($time2 - $time1) / 3600), 1, '.', ' ');
			$iyer->iyer_wh = $time3;
			if(	$iyer->validate()){
			
			
			
			
			$iyer->iyer_categories = implode(',',$iyer->iyer_categories);
			$iyer->iyer_sec_languages = implode(',',$iyer->iyer_sec_languages);
		
			if($iyer->iyer_experiencetype == '1'){
			 $iyer->iyer_experience = number_format((float)($iyer->iyer_experience / 12 ), 1, '.', '');
		   }
			
		
			   if($iyer->save()){
			   
			   if(isset($iyer->iyer_image) && trim($iyer->iyer_image) != ''){
					   $user = User::model()->findByPk($iyer->user_id);
					   $user->user_image = $iyer->iyer_image;
					   $user->update();
				       /* $images = new Images;
					    $images->item_type = 'iyer';
						$images->item_id = $id;
						$images->image_path = $iyer->iyer_image;
						$images->created_at = date('Y-m-d H:i:s');
						$images->save();*/
			   }
			   
				$this->redirect(array('iyeractivities','id'=>$iyer->user_id));
				}
			}
		}

		$this->render('iyerdetails',array(
			'model'=>$model,
			'iyer'=>$iyer,
		));
	  }
	}
	
	
	
	public function actionGuideactivities($id)
	{
		$model=new Guideactivities;
		$guide= Guide::model()->findByPk($id);
	
        Yii::app()->session['guide'] = $guide;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Guideactivities']) && count($_POST['Guideactivities']))
		{
		
		       $validactivity = 0;
			   $Guideactivities   = $_POST['Guideactivities'];
			  
			   foreach( $Guideactivities as  $Guideactivity){
					$model=new Guideactivities;
					$model->attributes = $Guideactivity;
					$model->user_id = $guide->user_id;
					if($model->validate()){
						  $model->activity_start_timings = serialize($model->activity_start_timings);
						  $model->activity_plans = serialize($model->activity_plans);
						  $model->activity_language = implode(',',$model->activity_language);
						  $model->created = date('Y-m-d H:i:s');
						  $model->save();
						  $validactivity++;
					}
			   }
			   
			
		   
		   if($validactivity>0){
					$this->redirect(array('regsuccess','id'=>$guide->user_id));
			}
			
		}

		$this->render('createactivities',array(
			'model'=>$model,
			'guide'=>$guide,
			'id'=>$id,
			
		));
	}
	
	public function actionIyeractivities($id)
	{
		$model=new Iyeractivities;
		$iyer= Iyer::model()->find('user_id="'.$id.'"');
	
        Yii::app()->session['iyer'] = $iyer;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $errors = array();
		if(isset($_POST['Iyeractivities']) && count($_POST['Iyeractivities']))
		{
		
		       $validactivity = 0;
			   $Iyeractivities   = $_POST['Iyeractivities'];
			  
			   foreach( $Iyeractivities as  $key=>$Iyeractivity){
					$model=new Iyeractivities;
					$model->attributes = $Iyeractivity;
					$model->user_id = $iyer->user_id;
					if($model->validate()){
						  $validactivity++;
					}else{
					   $errors[$key] = $model->getErrors();
					}
			   }
			   
			  
			
		   
		   if($validactivity>0 && count($_POST['Iyeractivities']) == $validactivity ){
		   
		          foreach( $Iyeractivities as  $Iyeractivity){
					$model=new Iyeractivities;
					$model->attributes = $Iyeractivity;
					$model->user_id = $iyer->user_id;
					if($model->validate()){
						  $model->created = date('Y-m-d H:i:s');
						  $model->save();
						  $validactivity++;
					}
			   }
			        
					$this->Updateiyerprice($iyer->user_id);
					$this->redirect(array('regsuccess','id'=>$iyer->user_id));
			}
			
		}

		$this->render('iyeractivities',array(
			'model'=>$model,
			'iyer'=>$iyer,
			'id'=>$id,
			'errors'=>$errors,
			
		));
	}
	
	
	function Updateiyerprice($id){
	   Iyeractivities::model()->updatelowestprice($id);
	}
	
	
	function actionRegsuccess($id){
	                        $user = User::model()->findByPk($id);
				//$user->registration_completed = '1';
				//$user->update();
				$from = helpers::configs()->company_email;
			        $userdetails = User::model()->findByPk($id);
				$to = $userdetails->email;
			        $subject = 'Registration Complete';
				$encryptedusername = User::model()->simple_encrypt($userdetails->email);
				$message = 'Hi '.$userdetails->first_name.' '.$userdetails->last_name.',<br><br>Please go to: <a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'front/user/verifiedemail/id/'.$id.'">'.Yii::app()->params['SITE_BASE_URL'].'front/user/verifiedemail/id/'.$id.'</a> to verify your email and login to <span class="il">Temples</span>.<br><br><br>Best Regards<br><span class="il">Temples</span>';

                           User::model()->mailsend($to,$from,$subject,$message);


//mail("$to","$subject",$message);







			Yii::app()->session['social'] = array();
			 unset( Yii::app()->session['social']);
			   if( $userdetails->role == '2'){
			      $loginform = new LoginForm;
				  $loginform->username = $userdetails->email;
				  $loginform->password = $userdetails->password;
				  $initialokay = $loginform->makelogin();
  Yii::app()->user->setFlash("success", "A confirmation email sent to your mail.click on the confirmation  link in the email to activate your account");
				  Yii::app()->session['email_verified'] = 'email_verified';
				  $this->redirect(array('/front/default/login'));
				 } 
				
				 $this->render('regsuccess',array(
					'model'=>$user,
				));	
	}


      public function actionVerifiedemail($id)
	{

                unset(Yii::app()->session['email_verified']);
	  	 $data=User::model()->findByPk($id);
		 $data->email_validated = '1';
		 $data->registration_completed = '1';
		 $data->update();
		 
		
		 Yii::app()->user->setFlash("success", "Your account has been activated.");
		 $this->redirect(array('/front/default/login'));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$poojaoptions = new Poojaoptions;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pooja']))
		{
			$_POST['Pooja']['pooja_image'] = $model->pooja_image;
			$model->attributes=$_POST['Pooja'];
			
				$rnd = time();  
			$uploadedFile=CUploadedFile::getInstance($model,'pooja_image');
			if(!empty($uploadedFile))  // check if uploaded file is set or not
            {
					$uploadedFilename = str_replace(array(' ','&','?','<','>',':'),'',$uploadedFile->name);
					$fileName = time().$uploadedFilename;  
					$uploadedFile->saveAs( Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);  
					$model->pooja_image = 'uploads/pooja/'.$fileName;
			}
			$model->updated_on = date('Y-m-d H:i:s');
			
		 if(isset($_POST['Pooja']['pooja_have_options']) && $_POST['Pooja']['pooja_have_options'] != '0' && isset($_POST['Poojaoptions']) && count( $_POST['Poojaoptions'])){
			   $opjaoptionslists = $_POST['Poojaoptions'];
				
				$model->setScenario('have_options');
			}else{
			    $model->setScenario('no_have_options');
			}
			
		if($model->validate()){
			if($model->save()){
				Poojaoptions::model()->deleteAll('pooja_id = ?' , array($model->pooja_id));
				if(isset( $opjaoptionslists )){
					foreach($opjaoptionslists as  $opjaoptionslist){
						 $poojaoptions = new Poojaoptions;
						 $poojaoptions->pooja_id = $model->pooja_id;
						$poojaoptions->option_desc = $opjaoptionslist['option_desc'];
						$poojaoptions->option_price = $opjaoptionslist['option_price'];
						$poojaoptions->option_shipping_price = $opjaoptionslist['option_shipping_price'];
						$poojaoptions->save();
					}
				}
				$this->redirect(array('view','id'=>$model->pooja_id));
			  }
			}	
		}

		$this->render('update',array(
			'model'=>$model,
			'poojaoptions'=>$poojaoptions,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Temples');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pooja('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pooja']))
			$model->attributes=$_GET['Pooja'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Temples the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pooja::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Temples $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='temples-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	
	public function actionOption_form($key)
	{
		$model = new Pooja;
		$poojaoptions = new Poojaoptions;
		echo  $this->renderPartial('options_form', array(
			'model'=>$model,
		    'poojaoptions'=>$poojaoptions,
			'key'=>$key,
		),true);		 die;
	}	
	
	
	public function actionGetsubcategories($id)
	{
	
		$subcategory = Poojacategories::model()->getall_subcategory($id);
		$details = Poojacategories::model()->findByPK($id);
		$detailsarr['category_id'] = $details->category_id;
		$detailsarr['category_name'] = $details->category_name;
		$detailsarr['parent_id'] = $details->parent_id;
		$detailsarr['category_image'] = $details->category_image;
		$subcategoryarrs = array();
		foreach($subcategory as $subcategoryobj){
		$subcategoryarr = array();
		if(isset($subcategoryobj->category_id) && $subcategoryobj->category_id != '' && $subcategoryobj->category_id != '0'){
			$subcategoryarr['category_id'] = $subcategoryobj->category_id;
			$subcategoryarr['category_name'] = $subcategoryobj->category_name;
			$subcategoryarr['parent_id'] = $subcategoryobj->parent_id;
			$subcategoryarr['category_image'] = $subcategoryobj->category_image;
			$subcategoryarrs[] = $subcategoryarr;
		}
		}
		$subcategoryarrs = array_filter($subcategoryarrs);
		$have_subcategory = false;
		if($subcategoryarrs && count($subcategoryarrs)){
		 $have_subcategory = true;
		}
		
		$array = array('have_subcategory'=>$have_subcategory,'subcategories'=>$subcategoryarrs,'details'=>$detailsarr);
		
		echo json_encode($array); die;
	}
	
	
	function actionGuideactivityform($key,$id){
	
	    $model = new Guideactivities;
		echo  $this->renderPartial('_activiesform', array(
			'model'=>$model,
			'key'=>$key,
			'id'=>$id,
		),true);		 die;
	}
	
	function actionGuideactivitygroupform($key,$g){
	
	    $model = new Guideactivities;
		echo  $this->renderPartial('_activiesgroupform', array(
			'model'=>$model,
			'key'=>$key,
			'g'=>$g,
		),true);		 die;
	}
	
	function actionGuideactivitypersonform($key,$p){
	
	    $model = new Guideactivities;
		echo  $this->renderPartial('_activiespersonform', array(
			'model'=>$model,
			'key'=>$key,
			'p'=>$p,
		),true);		 die;
	}
	
	public function actionDynamiccities()
	{
		$data=Cities::model()->findAll('state_id=:state_id', 
					  array(':state_id'=>(int) $_POST['Guide']['guide_state']));
	 
		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
	}
	
	public function actionDynamiccitiesiyer()
	{
		$data=Cities::model()->findAll('state_id=:state_id', 
					  array(':state_id'=>(int) $_POST['Iyer']['iyer_state']));
	 
		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
	}
	
	public function actionGuideimageupload($name)
	{
			
			if (isset($_FILES[$name])) {
			   $new_url_ini = 'uploads/guide/images/';
           $tmp_name =  $_FILES[$name]['tmp_name'];
		   $_FILES[$name]['name'] = time().'_'.str_replace(array(' ','&','?','<','>',':'),'',$_FILES[$name]['name']);
           $filename = $_FILES[$name]['name'];
           $new_url = $new_url_ini.$filename;
			// Upload file
			
			
		
		 if(isset($_FILES[$name]["type"])  && in_array($_FILES[$name]["type"],array('image/jpeg', 'image/gif','image/jpg','image/png','image/bmp', 'application/pdf','application/msword')) ){	 //&& $_FILES[$name]["size"] <= 1048576
			if(move_uploaded_file($tmp_name, $new_url)){
			 echo 'success#####uploaded#####'.$new_url.'#####uploaded#####'.$new_url;
			}
			else
			echo 'error#####uploaded#####error to upload';
		 }else{	
		 echo 'error#####uploaded#####Please upload Valid file';
		 }
		}else
		 echo 'error#####uploaded#####Please select files';
		 die;
	}
	
	
	public function actionUserpicture($name)
	{
		if (isset($_FILES[$name])) {
           $new_url = 'uploads/users/';
			// Upload file
			$this->imageupload($name,$new_url);
		}
	}
	
	public function actionUploadguidelicense($name)
	{
		if (isset($_FILES[$name])) {
           $new_url = 'uploads/guide/license/';
			// Upload file
			$this->imageupload($name,$new_url);
		}
	}
	
	public function actionUploadiyerimage($name)
	{
		if (isset($_FILES[$name])) {
           $new_url = 'uploads/iyer/images/';
			// Upload file
			$this->imageupload($name,$new_url);
		}
	}
	
	
	
	
	
	public function imageupload($name, $new_url_ini)
	{
		
		if (isset($_FILES[$name])) {
           $tmp_name =  $_FILES[$name]['tmp_name'];
		   $_FILES[$name]['name'] = time().'_'.str_replace(array(' ','&','?','<','>',':'),'',$_FILES[$name]['name']);
           $filename = $_FILES[$name]['name'];
           $new_url = $new_url_ini.$filename;
			// Upload file
			
			
		
		 if(isset($_FILES[$name]["type"])  ){	 //&& $_FILES[$name]["size"] <= 1048576  && in_array($_FILES[$name]["type"],array('image/jpeg', 'image/gif','image/jpg','image/png','image/bmp', 'application/pdf','application/msword'))
			if(move_uploaded_file($tmp_name, $new_url)){
			 echo 'success#####uploaded#####'.helpers::view_image($new_url,array('height'=>'100px','width'=>'100px')).'#####uploaded#####'.$new_url;
			}
			else
			echo 'error#####uploaded#####error to upload';
		 }else{	
		 echo 'error#####uploaded#####Please upload Valid file';
		 }
		}else
		 echo 'error#####uploaded#####Please select files';
		 die;
	}
	
	public function actionUploadvideo($name)
	{
		
		
		if (isset($_FILES[$name])) {
           $tmp_name =  $_FILES[$name]['tmp_name'];
		   $_FILES[$name]['name'] = time().'_'.str_replace(array(' ','&','?','<','>',':'),'',$_FILES[$name]['name']);
           $filename = $_FILES[$name]['name'];
           $new_url = 'uploads/guide/videos/'.$filename;
			// Upload file
			
			
		
		 if(isset($_FILES[$name]["type"])  && in_array($_FILES[$name]["type"],array('video/mp4', 'video/3gp','video/avi','video/flv','video/x-flv'))){	
			if(move_uploaded_file($tmp_name, $new_url)){
			 echo 'success#####uploaded#####'.helpers::render_image($new_url).'#####uploaded#####'.$new_url;
			}
			else
			echo 'error#####uploaded#####error to upload';
		 }else{	
		 echo 'error#####uploaded#####Please upload Valid file (MP4,AVI,FLV,3GP)';
		 }
		}else
		 echo 'error#####uploaded#####Please select files';
		 die;
	}
	
	
	
	
}
?>