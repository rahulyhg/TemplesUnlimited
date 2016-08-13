<?php
class StoreproductsController extends Controller
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
		$model=new Storeproducts;
		$productimages = new Storeproductsimages;
		$productvariations = new Productvariations;
		
		$model->setScenario('create');
		
       $productimagesarr = array();
	   
		if(isset($_POST['Storeproducts']))
		{
			$model->attributes=$_POST['Storeproducts'];

			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'product_image');
			
			$fileName = "{$rnd}-{$uploadedFile}";  
			
			$model->product_image = $fileName; 
			
			
		   if(isset($_POST['Storeproducts']['product_have_variations']) && $_POST['Storeproducts']['product_have_variations'] == '1')
		   {
		   $opjaoptionslists = $_POST['Productvariations'];
		   $model->setScenario('have_options');
		   }

			$this->performAjaxValidation($model);
			
			
			if($model->validate())
			{

			$model->created_on = date('Y-m-d H:i:s');
			$variationvalid  = true;

			 if(isset($model->payment_options) && count($model->payment_options) && is_array($model->payment_options))
			 $model->payment_options = implode(',',$model->payment_options);
			
			if($model->validate() && $variationvalid ){

			if($model->save()){
			
			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'product_image');

            $fileName = "{$rnd}-{$uploadedFile}";  
			 
			 
			  if(!empty($uploadedFile))
			  {
			  $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->resize(220, 170);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/main_image/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->resize(480, 300);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/details_page/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->adaptiveResize(100, 100);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/listpage/'.$fileName);
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->resize(95, 60);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/recent_products/'.$fileName);

			   $model->product_image = $fileName;  
			   $model->save();
			
			  }
					
					if(isset($model->payment_options) && !empty($model->payment_options))
					$model->payment_options = explode(',',$model->payment_options);
					
					if(isset( $opjaoptionslists ) && count( $opjaoptionslists)){
					
					 Productvariations::model()->deleteAll("product_id='".$model->product_id."'");
					 	$model->product_have_variations ='0';
						$model->save();
					 
						foreach($opjaoptionslists as  $opjaoptionslist){
							 $productvariations = new Productvariations;
							 $productvariations->product_id = $model->product_id;
							$productvariations->product_variation_title = $opjaoptionslist['product_variation_title'];
							$productvariations->product_price = $opjaoptionslist['product_price'];
							$productvariations->product_shipping_price = $opjaoptionslist['product_shipping_price'];
							$productvariations->save();
						}
					  }
				}
				$this->redirect(array('view','id'=>$model->product_id));
			}
		  }	
		}
$productimagesalready = array();

		$this->render('create',array(
			'model'=>$model,
			'productimages'=>$productimages,
			'productimagesarr'=>$productimagesarr,
			'productimagesalready'=>$productimagesalready,
			'productvariations'=>$productvariations,
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
		$productimages = new Storeproductsimages;
        $productimagesalready = $model->productimages;
		$productvariations = new Productvariations;
		
		$model->setScenario('update');

   $productimagesarr = array();
	if(isset($_POST['Storeproducts']))
		{
			$model->attributes=$_POST['Storeproducts'];
			
			
			if(isset($_POST['Storeproducts']['product_have_variations']) && $_POST['Storeproducts']['product_have_variations'] == '1')
		   {
		   $opjaoptionslists = $_POST['Productvariations'];
		   $model->setScenario('have_options');
		   }

		   $this->performAjaxValidation($model);
			
			if($model->validate())
			{
			$rnd = time();  
			
			$model->updated_on = date('Y-m-d H:i:s');
			$variationvalid = true;

		
			if(isset($model->payment_options) && count($model->payment_options) && is_array($model->payment_options))
			 $model->payment_options = implode(',',$model->payment_options);
			
			if($model->validate() && $variationvalid){
			

			if($model->save()){
			
			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'product_image');
		
            $fileName = "{$rnd}-{$uploadedFile}";  
			 
			 
			  if(!empty($uploadedFile))
			  {
			  $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->resize(220, 170);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/main_image/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->resize(480, 300);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/details_page/'.$fileName);
			   
			   
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->adaptiveResize(100, 100);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/listpage/'.$fileName);
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/store/'.$fileName);
			   $thumb->resize(95, 60);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/store/recent_products/'.$fileName);

			   $model->product_image = $fileName;  
			  }
			   
				if(isset( $opjaoptionslists ) && count($opjaoptionslists))
				{
				$model->product_price = '';
				$model->product_shipping_price = ''; 			
				}
					
			   $model->save();
			   		   	
				
						Productvariations::model()->deleteAll('product_id = ?' , array($model->product_id));
				    if(isset( $opjaoptionslists ) && count( $opjaoptionslists)){
						foreach($opjaoptionslists as  $opjaoptionslist){
							 $productvariations = new Productvariations;
							 $productvariations->product_id = $model->product_id;
							$productvariations->product_variation_title = $opjaoptionslist['product_variation_title'];
							$productvariations->product_price = $opjaoptionslist['product_price'];
							$productvariations->product_shipping_price = $opjaoptionslist['product_shipping_price'];
							$productvariations->save();
						}
					  }	
				}
				$this->redirect(array('view','id'=>$model->product_id));
			}
		  }
		}
	 if(isset($model->payment_options) && !empty($model->payment_options))
       $model->payment_options = explode(',',$model->payment_options);
		$this->render('update',array(
				'model'=>$model,
			'productimages'=>$productimages,
			'productimagesarr'=>$productimagesarr,
			'productimagesalready'=>$productimagesalready,
			'productvariations'=>$productvariations,
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
		$model=new Storeproducts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Storeproducts']))
			$model->attributes=$_GET['Storeproducts'];

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
		$model=Storeproducts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='storeproducts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	

	
	public function actionPimageupload()
	{
	
		if (isset($_FILES['Storeproductsimages_product_image'])) {
           $tmp_name =  $_FILES['Storeproductsimages_product_image']['tmp_name'];
		   $_FILES['Storeproductsimages_product_image']['name'] = time().'_'.str_replace(array(' ','&','?','<','>',':'),'',$_FILES['Storeproductsimages_product_image']['name']);
           $filename = $_FILES['Storeproductsimages_product_image']['name'];
           $new_url = 'uploads/store/products/'.$filename;
			// Upload file
			
			
		
		 if(isset($_FILES["Storeproductsimages_product_image"]["type"])  && in_array($_FILES["Storeproductsimages_product_image"]["type"],array('image/jpeg', 'image/gif','image/jpg','image/png','image/bmp', 'application/pdf')) && $_FILES["Storeproductsimages_product_image"]["size"] <= 1048576){	
			if(move_uploaded_file($tmp_name, $new_url)){
			$picpath = Yii::getPathOfAlias('webroot').'/'.$new_url;
			$picthumbpath =  Yii::getPathOfAlias('webroot').'/uploads/store/products/thumb/'.$filename;
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
		 $Storeproductsimages = Storeproductsimages::model()->findByPK($_POST['path']);
		  @unlink( Yii::getPathOfAlias('webroot').'/'.$Storeproductsimages->product_image );
		   $thumbpath = str_replace(basename($Storeproductsimages->product_image), 'thumb/'.basename($Storeproductsimages->product_image),$Storeproductsimages->product_image);
		  @unlink(Yii::getPathOfAlias('webroot').'/'. $thumbpath);
		  $Storeproductsimages->delete();
		 }
		 echo 'Deleted';
		 die;
	}
	

	
	
	public function actionGetsubcategories($id)
	{
	
		$subcategory = Storecategories::model()->getall_subcategory($id);
		$details = Storecategories::model()->findByPK($id);
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
	
    public function actionOption_form($key)
	{
		$model = new Storeproducts;
		$productvariations = new Productvariations;
		echo  $this->renderPartial('variations_form', array(
			'model'=>$model,
		    'productvariations'=>$productvariations,
			'key'=>$key,
		),true);		 die;
	}	
	
}
?>