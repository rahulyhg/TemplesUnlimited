<?php

class PoojacategoriesController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
		$model=new Poojacategories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Poojacategories']))
		{
			$model->attributes=$_POST['Poojacategories'];
					$uploadedFile=CUploadedFile::getInstance($model,'category_image');
			if(!empty($uploadedFile))  // check if uploaded file is set or not
            {
					$uploadedFilename = str_replace(array(' ','&','?','<','>',':'),'',$uploadedFile->name);
					$fileName = time().$uploadedFilename;  
					$uploadedFile->saveAs( Yii::getPathOfAlias('webroot').'/uploads/store/category/'.$fileName);  
					$model->category_image = 'uploads/store/category/'.$fileName;
			}
			$model->created_at = date('Y-m-d H:i:s');
			
			Yii::app()->user->setFlash('success', 'Pooja category has been Created Successfully.');
			
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Poojacategories']))
		{
		   $_POST['Poojacategories']['category_image'] = $model->category_image;
			$model->attributes=$_POST['Poojacategories'];
						$uploadedFile=CUploadedFile::getInstance($model,'category_image');
			if(!empty($uploadedFile))  // check if uploaded file is set or not
            {
					$uploadedFilename = str_replace(array(' ','&','?','<','>',':'),'',$uploadedFile->name);
					$fileName = time().$uploadedFilename;  
					$uploadedFile->saveAs( Yii::getPathOfAlias('webroot').'/uploads/store/category/'.$fileName);  
					$model->category_image = 'uploads/store/category/'.$fileName;
			}
		
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete1($id)
	{
	
	
		$this->loadModel($id)->delete();
		
		 Pooja::model()->deleteAll("pooja_category_id='" .$id. "'");

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Poojacategories');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Poojacategories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Poojacategories']))
			$model->attributes=$_GET['Poojacategories'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Poojacategories the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Poojacategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Poojacategories $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='categories-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
