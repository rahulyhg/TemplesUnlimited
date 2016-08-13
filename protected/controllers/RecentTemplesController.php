<?php

class RecentTemplesController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
		$model=new RecentTemples;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RecentTemples']))
		{ 
		
		$model->attributes=$_POST['RecentTemples'];
		
		     $rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'temple_image');
			
			
            $fileName = "{$rnd}-{$uploadedFile}";  
		
		
		if(!empty($uploadedFile))
			   {
			   $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/recent/'.$fileName);
			
			     list($width, $height, $type, $attr) = getimagesize(Yii::getPathOfAlias('webroot').'/uploads/recent/'.$fileName); 

				if($width>=290 && $height>=220)
				{
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/recent/'.$fileName);
				  $thumb->resize(290, 220);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/recent/thumb/'.$fileName);
				   $model->temple_image = $fileName;

				   unset(Yii::app()->session['width']);
				   
				   if($model->save())
					$this->redirect(array('view','id'=>$model->id));
				   }
				   else
				   {
					Yii::app()->session['width'] = 'Image size must be greater then 290*220(Width*height).';
				   }
			  }		
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

		if(isset($_POST['RecentTemples']))
		{ 
		
		$model->attributes=$_POST['RecentTemples'];
		
		     $rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'temple_image');
			
			
            $fileName = "{$rnd}-{$uploadedFile}";  
		
		
		if(!empty($uploadedFile))
			   {
			   $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/recent/'.$fileName);
			
			     list($width, $height, $type, $attr) = getimagesize(Yii::getPathOfAlias('webroot').'/uploads/recent/'.$fileName); 

				if($width>=290 && $height>=220)
				{
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/recent/'.$fileName);
				   $thumb->resize(290,300);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/recent/thumb/'.$fileName);
				   $model->temple_image = $fileName;

				   unset(Yii::app()->session['width']);
				   
				   
				   }
				   else
				   {
					Yii::app()->session['width'] = 'Image size must be greater then 290*220(Width*height).';
				   }
			  }	
			  
			  if($model->save())
					$this->redirect(array('view','id'=>$model->id));	
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
		$dataProvider=new CActiveDataProvider('RecentTemples');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RecentTemples('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RecentTemples']))
			$model->attributes=$_GET['RecentTemples'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RecentTemples the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RecentTemples::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RecentTemples $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='recent-temples-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
