<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
		array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('manage','delete','view','status','gallery'),
				'expression'=>'helpers::isadmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
	public function actionCreate()
	{
		$model=new User;
		$guide = new Guide;
		
		$model->setScenario('common');

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
			if($model->validate()){
			 
			     if($model->save()){
					 if($model->role == '3')
					 $this->redirect(array('guidedetails','id'=>$model->user_id));
					 else if($model->role == '4')
					 $this->redirect(array('iyerdetails','id'=>$model->user_id));
					 else if($model->role == '2'){
							  $this->redirect(array('regsuccesss','id'=>$model->user_id));
				   }
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'guide'=>$guide,
		));
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionGuidedetails($id)
	{
	
		$model=User::model()->findByPk($id);
		$guide = new Guide;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Guide']))
		{
		
	
			$guide->attributes=$_POST['Guide'];
			if( isset($_POST['Guide']['guide_have_certificate']) && $_POST['Guide']['guide_have_certificate'] == '1')
			$guide->setScenario('license');
			
			$guide->user_id = $id;
		
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
			$guide->guide_categories = implode(',',$guide->guide_categories);
			$guide->guide_sec_languages = implode(',',$guide->guide_sec_languages);
			$guide->secondary_locations = implode(',',$guide->secondary_locations);
			
		
			if($guide->save()){
				if(isset($_POST['Images']) && isset($_POST['Images']['image_path']) && $_POST['Images']['image_path'] != '')
				$opjaoptionslists = array_filter(explode('SPLITIMAGESHERE',$_POST['Images']['image_path']));
				if(isset( $opjaoptionslists )){
					foreach($opjaoptionslists as  $opjaoptionslist){
					if(trim($opjaoptionslist) != ''){
						 $images = new Images;
						 $images->item_type = 'guide';
						$images->item_id = $id;
						$images->image_path = $opjaoptionslist;
						$images->created_at = date('Y-m-d H:i:s');
						$images->save();
						}
					}
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
	
	
	public function actionIyerdetails($id)
	{
	
		$model=User::model()->findByPk($id);
		$iyer = new Iyer;
		$iyer->iyer_image = $model->user_image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Iyer']))
		{
		
	
			$iyer->attributes=$_POST['Iyer'];
			$iyer->user_id = $model->user_id;
			if(	$iyer->validate()){
			
			$iyer->iyer_categories = implode(',',$iyer->iyer_categories);
			$iyer->iyer_sec_languages = implode(',',$iyer->iyer_sec_languages);
		
			if($iyer->iyer_experiencetype == '1'){
			 $iyer->iyer_experience = number_format((float)($iyer->iyer_experience / 12 ), 1, '.', '');
		   }
			
		
			   if($iyer->save()){
			    $model->user_image = $iyer->iyer_image;
			    $model->update();
				$this->redirect(array('regsuccess','id'=>$iyer->user_id));
				}
			}
		}

		$this->render('iyerdetails',array(
			'model'=>$model,
			'iyer'=>$iyer,
		));
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
			
		));
	}
	
	function actionRegsuccess($id){
	               $user = User::model()->findByPk($id);
				   $user->registration_completed = '1';
				   $user->update();
	echo 'success';
	die;
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
	    
	
		$model = $this->loadModel($id);
		$role = $model->role;
		if($model->role=='2')
		{
		Reviews::model()->deleteAll("review_itemid='" .$id. "'");
		Reviews::model()->deleteAll("review_by='" .$id. "'");
		Cart::model()->deleteAll("user_id='" .$id. "'");
		}
		else if($model->role=='3')
		{
		 Guide::model()->deleteAll("user_id='" .$id. "'");
		 Guidetemple::model()->deleteAll("user_id='" .$id. "'");
		 Reviews::model()->deleteAll("review_itemid='" .$id. "'");
		 Reviews::model()->deleteAll("review_by='" .$id. "'");
		 Cart::model()->deleteAll("user_id='" .$id. "'");
		 Images::model()->deleteAll("item_id='" .$id. "'");
		}
		else if($model->role=='4')
		{
		 Iyer::model()->deleteAll("user_id='" .$id. "'");
		 Iyerpoojas::model()->deleteAll("user_id='" .$id. "'");
		 Reviews::model()->deleteAll("review_itemid='" .$id. "'");
		 Reviews::model()->deleteAll("review_by='" .$id. "'");
		 Cart::model()->deleteAll("user_id='" .$id. "'");
		 Images::model()->deleteAll("item_id='" .$id. "'");
		}
		else
		{
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/user/manage/role/'.$role));
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
		$model=new User('search');
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
		$model=User::model()->findByPk($id);
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
	
	
	function actionGuideactivityform($key){
	
	    $model = new Guideactivities;
		echo  $this->renderPartial('_activiesform', array(
			'model'=>$model,
			'key'=>$key,
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
	
	public function actionDynamiccitiespooja()
	{
		$data=Cities::model()->findAll('state_id=:state_id', 
					  array(':state_id'=>(int) $_POST['Pooja']['pooja_state']));
	 
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
	
	
	/**
	 * Delete Uploaded image for add new quote.
	 * If creation is successful, the browser will be return message.
	 */
	public function actionDeleteguideimage()
	{
	     $sessionimagesarr = array();
	     if($_POST['type']=='1'){
		  unlink(Yii::getPathOfAlias('webroot').'/'.$_POST['path']);
		 }else{		 
		     $images =  Images::model()->find('item_type=:item_type AND item_id=:item_id',array(':item_type'=>'guide','item_id'=>$id));
			  unlink( Yii::getPathOfAlias('webroot').'/'.$images->image_path );
			  $images->delete();		  
		 }
	    
		 echo 'Deleted';
		 die;
	}
	
	public function actionUserpicture($name, $userid='0')
	{
		if (isset($_FILES[$name])) {			
           $new_url = 'uploads/users/';
			$this->imageupload($name,$new_url,$userid);
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
	
	
	
	
	
	public function imageupload($name, $new_url_ini, $userid = '0')
	{

		if (isset($_FILES[$name])) {
           $tmp_name =  $_FILES[$name]['tmp_name'];
		   $_FILES[$name]['name'] = time().'_'.str_replace(array(' ','&','?','<','>',':'),'',$_FILES[$name]['name']);
           $filename = $_FILES[$name]['name'];
           $new_url = $new_url_ini.$filename;
			// Upload file

		 if(isset($_FILES[$name]["type"])  ){	 //&& $_FILES[$name]["size"] <= 1048576  && in_array($_FILES[$name]["type"],array('image/jpeg', 'image/gif','image/jpg','image/png','image/bmp', 'application/pdf','application/msword'))
			if(move_uploaded_file($tmp_name, $new_url)){
			
			if($name == 'User_user_image' || $name == 'Iyer_iyer_image' || $name == 'Guide_guide_image'){
			   	Yii::app()->setComponents(array('ThumbsGen' => array(
				'class' => 'ext.ThumbsGen.ThumbsGen',
				'scaleResize' => null, //if it is not null $thumbWidth and $thumbHeight will be ommited. for example 'scaleResize'=>0.5 generate image with half dimension
				//one of $thumbWidth or $thumbHeight is optional but not both!
				'thumbWidth' => 84, //the width of created thumbnail on pixel. if height is null the aspect ratio will be reserved
				'thumbHeight' => 84, //the height of created thumbnail on pixel. if width is null the aspect ratio will be reserved
				'postFixThumbName' => '', //the postfix name of thumbnail for example if it set = '_thumb' then  image1.jpg become image1_thumb.jpg
				'recreate' => true, //force to create each thumbnail either exist or not, when is set to false the tumbnails created only in the first time
						  )));
				if($userid  != '0'){
				   $usermodel = User::model()->findByPk($userid);
				   if(count(  $usermodel)){
						   $previmage =$usermodel->user_image;
						   $prevthumimage = str_replace(basename($previmage),'thumb/'.basename($previmage), $previmage);
						   @unlink( $previmage);
						   @unlink( $prevthumimage);
					   $usermodel->user_image =$new_url;
					   $usermodel->update();
				   }
				}		  
				$picpath = Yii::getPathOfAlias('webroot').'/'.$new_url;
				$picthumbpath =  Yii::getPathOfAlias('webroot').'/uploads/users/thumb/'.$filename;
				Yii::app()->ThumbsGen->createthumb($picpath,$picthumbpath);
				if($name != 'Iyer_iyer_image' && $name != 'Guide_guide_image')
				$new_url = 'uploads/users/thumb/'.$filename;
				
				
				$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/users/'.$filename);
				$thumb->resize(650, 450);
				$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/users/resize/'.$filename);
				
				
				$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/users/'.$filename);
				$thumb->adaptiveResize(70, 70);
				$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/users/review/'.$filename);


                                $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/users/'.$filename);
				$thumb->adaptiveResize(210, 160);
				$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/users/userdispaly/'.$filename);

                                $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/users/'.$filename);
				$thumb->adaptiveResize(220, 160);
				$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/users/useriyer/'.$filename);
				
				
				
				$picthumbpath =  Yii::getPathOfAlias('webroot').'/uploads/users/thumb150/'.$filename;
				User::model()->createthumnail($picpath,$picthumbpath,'150','150');
				
			}			  
			
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
	
	
	public function actionStatus($id,$st)
	{
		$data=User::model()->findByPk($id);
		if($st == '1')
	    $data->status = '0';
		else
		 $data->status = '1';
		$data->update();
		
		
		$this->redirect(array('manage','role'=>$data->role));
	}
	
	public function actionVerified($id,$st)
	{
		$data=User::model()->findByPk($id);
		if($st == '0')
	    $data->verified = '1';
		else
		 $data->verified = '0';
		$data->update();
		
		
		$this->redirect(array('manage','role'=>$data->role));
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionManage($role='2')
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
			$model->role = $role;

		$this->render('userslist',array(
			'model'=>$model,
		));
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionGuideactivitiesmanage($id)
	{
		$model=new Guideactivities('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Guideactivities']))
			$model->attributes=$_GET['Guideactivities'];
			$model->user_id = $id;

		$this->render('activities',array(
			'model'=>$model,
		));
	}
	
	
	public function actionActivitystatus($id,$aid,$st)
	{
		$data= Guideactivities::model()->findByPk($aid);
		if($st == '1')
	    $data->status = '0';
		else
		 $data->status = '1';
		$data->update();
		
		
		$this->redirect(array('guideactivitiesmanage','id'=>$id));
	}
	
	
	public function actionDynamictemplesforcities()
	{
		$data = Temples::model()->getallfordropdown($_POST['Guide']['secondary_locations']);
	 
		
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
	}
}
?>
