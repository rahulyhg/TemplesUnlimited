<?php

class GuideController extends Controller
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
		$model=new Guide;
		$guideoptions = new Guideoptions;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Guide']))
		{
			$model->attributes=$_POST['Guide'];
			$rnd = time();  
			$uploadedFile=CUploadedFile::getInstance($model,'pooja_image');
			$uploadedFilename = str_replace(array(' ','&','?','<','>',':'),'',$uploadedFile->name);
            $fileName = time().$uploadedFilename;  
			$uploadedFile->saveAs( Yii::getPathOfAlias('webroot').'/uploads/pooja/'.$fileName);  
            $model->pooja_image = 'uploads/pooja/'.$fileName;
			$model->created_on = date('Y-m-d H:i:s');
		    $model->payment_options = serialize(	$model->payment_options);
			
			if(isset($_POST['Guide']['pooja_have_options']) && $_POST['Guide']['pooja_have_options'] != '0' && isset($_POST['Poojaoptions']) && count( $_POST['Poojaoptions'])){
			   $opjaoptionslists = $_POST['Poojaoptions'];
				
				$model->setScenario('have_options');
			}else{
			    $model->setScenario('no_have_options');
			}
			
			if($model->validate()){
			if($model->save()){
				
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

		$this->render('create',array(
			'model'=>$model,
			'guideoptions'=>$guideoptions,
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
	
	
}
?>
