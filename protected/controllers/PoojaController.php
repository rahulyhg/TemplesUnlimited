<?php

class PoojaController extends Controller
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
		 $model=new Pooja;
		
		  $model->setScenario('create');
		
		  $poojaoptions = new Poojaoptions;
		
         $productimagesarr = array();
   
		if(isset($_POST['Pooja']))
		{
			$model->attributes=$_POST['Pooja'];
			
			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'pooja_image');
			
			$fileName = "{$rnd}-{$uploadedFile}";  
			
			$model->pooja_image = $fileName; 
			
			
		   if(isset($_POST['Pooja']['pooja_have_options']) && $_POST['Pooja']['pooja_have_options'] == '1')
		   {
		   $opjaoptionslists = $_POST['Poojaoptions'];
		   $model->setScenario('have_options');
		   }
		  

			$this->performAjaxValidation($model);
			
			if($model->validate())
			{	 
			  if(!empty($uploadedFile))
			  {
			  $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			   $thumb->resize(300, 219);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/pooja/main_image/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			   $thumb->resize(480, 300);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/pooja/details_page/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			   $thumb->adaptiveResize(100, 100);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/pooja/listpage/'.$fileName);
			  }
			$model->created_on = date('Y-m-d H:i:s');
			 if(isset($model->payment_options) && count($model->payment_options) && is_array($model->payment_options))
		    $model->payment_options = serialize(	$model->payment_options);
					
			if($model->validate()){
			if($model->save()){
				
				if(isset( $opjaoptionslists ) && count( $opjaoptionslists)){
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
			 if(isset($model->payment_options) && !empty($model->payment_options))
        $model->payment_options  = unserialize( $model->payment_options );
		}
		}

		$this->render('create',array(
			'model'=>$model,
			'poojaoptions'=>$poojaoptions,
			'productimagesarr'=>$productimagesarr,
		));
	}
	
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		$model->setScenario('update');
		
		$poojaoptions = new Poojaoptions;

		 $poojaimagesalready = Images::model()->get_image_all('pooja',$id);

		
        $productimagesarr = array();

		if(isset($_POST['Pooja']))
		{
			$model->attributes=$_POST['Pooja'];
			
			
		   if(isset($_POST['Pooja']['pooja_have_options']) && $_POST['Pooja']['pooja_have_options'] == '1')
		   {
		   $opjaoptionslists = $_POST['Poojaoptions'];
		   $model->setScenario('have_options');
		   }
		  
		  
			
			$this->performAjaxValidation($model);
			
			if($model->validate())
			{
			$rnd = time();  

			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'pooja_image');
			
			
                          $fileName = "{$rnd}-{$uploadedFile}";  

			  if(!empty($uploadedFile))
			  {
			  $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			   $thumb->resize(300, 219);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/pooja/main_image/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			   $thumb->resize(480, 300);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/pooja/details_page/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);
			   $thumb->adaptiveResize(100, 100);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/pooja/listpage/'.$fileName);
			   
			   
			   $model->pooja_image = $fileName;  
			  }

			$model->created_on = date('Y-m-d H:i:s');
			 if(isset($model->payment_options) && count($model->payment_options) && is_array($model->payment_options))
		    $model->payment_options = serialize(	$model->payment_options);
			
			
			if(isset( $opjaoptionslists ) && count( $opjaoptionslists))
			{
                  $model->pooja_price = '';
				  $model->pooja_shipping_price = ''; 		
 			}
		
			
			if($model->validate()){
			if($model->save()){
				
				if(isset( $opjaoptionslists ) && count($opjaoptionslists)){
				
				 Poojaoptions::model()->deleteAll("pooja_id='".$model->pooja_id."'");
				 $model->pooja_have_options ='1';
				 $model->save();
				
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
			 if(isset($model->payment_options) && !empty($model->payment_options))
			 $model->payment_options  = unserialize( $model->payment_options );
		
		
		 }
		}
		
		if($model->payment_options && trim($model->payment_options) != ''){
		$model->payment_options = unserialize($model->payment_options);
		}

		$this->render('update',array(
			'model'=>$model,
			'poojaoptions'=>$poojaoptions,
			'productimagesarr'=>$productimagesarr,
			'poojaimagesalready'=>$poojaimagesalready,
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
	
	
	public function actionPimageupload()
	{
	$targetid = 'Pooja_pooja_image';
		if (isset($_FILES[$targetid])) {
           $tmp_name =  $_FILES[$targetid]['tmp_name'];
		   $_FILES[$targetid]['name'] = time().'_'.str_replace(array(' ','&','?','<','>',':'),'',$_FILES[$targetid]['name']);
           $filename = $_FILES[$targetid]['name'];
           $new_url = 'uploads/pooja/'.$filename;
			// Upload file
			
			
			
		
		 if(isset($_FILES[$targetid]["type"])  && in_array($_FILES[$targetid]["type"],array('image/jpeg', 'image/gif','image/jpg','image/png','image/bmp', 'application/pdf')) && $_FILES[$targetid]["size"] <= 1048576){	
			if(move_uploaded_file($tmp_name, $new_url)){
			$picpath = Yii::getPathOfAlias('webroot').'/'.$new_url;
			$picthumbpath =  Yii::getPathOfAlias('webroot').'/uploads/pooja/thumb/'.$filename;
			User::model()->createthumnail($picpath,$picthumbpath,'220','200');
			 echo 'success#####uploaded#####'.$new_url;
			}
			else
			echo 'error#####uploaded#####error to upload';
		 }else{	
		 echo 'error#####uploaded#####Please upload Valid file (PNG,JPEG,JPG,GIF)';
		 }
		}else
		 echo 'error#####uploaded#####Please select files';
		 die;
	}
	
	/**
	 * Delete Uploaded image for add new quote.
	 * If creation is successful, the browser will be return message.
	 */
	public function actionDeletepimage()
	{
	     $sessionimagesarr = array();
	     if($_POST['type']=='1'){
		  @unlink(Yii::getPathOfAlias('webroot').'/'.$_POST['path']);
		  $thumbpath = str_replace(basename($_POST['path']), 'thumb/'.basename($_POST['path']),$_POST['path']);
		  @unlink(Yii::getPathOfAlias('webroot').'/'. $thumbpath);
		 }else{
		 $images = Images::model()->findByPK($_POST['path']);
		  @unlink( Yii::getPathOfAlias('webroot').'/'.$images->image_path );
		  $thumbpath = str_replace(basename($images->image_path), 'thumb/'.basename($images->image_path),$images->image_path);
		  @unlink(Yii::getPathOfAlias('webroot').'/'. $thumbpath);
		  $images->delete();
		 }
	    
		 echo 'Deleted';
		 die;
	}
	
}
?>
