<?php

class BlogsController extends Controller
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
		$model=new Blogs;
		
		 $model->setScenario('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Blogs']))
		{
			$model->attributes=$_POST['Blogs'];
			
			
			$uploadedFile=CUploadedFile::getInstance($model,'files');
			
			$fileName = "{$uploadedFile}";  
			
			$model->files = $fileName; 
			
					
		   if(isset($_POST['Blogs']['file_type']) && $_POST['Blogs']['file_type'] == '1')
		   {
		   $model->setScenario('image_need');
		   }
		   else if(isset($_POST['Blogs']['file_type']) && $_POST['Blogs']['file_type'] == '2')
		   {
		     $model->setScenario('video_need');
		   }
		   
            $this->performAjaxValidation($model);
			
			if(!empty($uploadedFile))
			  {
			   $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/blogs/'.$fileName);
			   

					$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/blogs/'.$fileName);
					$thumb->adaptiveResize(310, 190);
					$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/blogs/listpage/'.$fileName);
				   
				   
			  }

			$model->created=date('Y-m-d');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		
		$old = $model->attributes;

		 $model->setScenario('update');


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Blogs']))
		{
			$model->attributes=$_POST['Blogs'];

		   if(isset($_POST['Blogs']['file_type']) && $_POST['Blogs']['file_type'] == '1')
		   {
		   $model->setScenario('image_need');
		   }
		   else if(isset($_POST['Blogs']['file_type']) && $_POST['Blogs']['file_type'] == '2')
		   {
		     $model->setScenario('video_need');
		   }
		   
		   
            $this->performAjaxValidation($model);
			
			
			if($model->validate())
				{
				$uploadedFile=CUploadedFile::getInstance($model,'files');
				$fileName = "{$uploadedFile}"; 
				 
				if($fileName!='')
					$model->files = $fileName; 
				else
					$model->files = $old['files'];
				
				if(!empty($uploadedFile))
				{
				$uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/blogs/'.$fileName);
				$model->video_url='';

				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/blogs/'.$fileName);
				   $thumb->adaptiveResize(310, 190);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/blogs/listpage/'.$fileName);
				   
				}
			}

			$model->updated=date('Y-m-d');
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
		$dataProvider=new CActiveDataProvider('Blogs');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Blogs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Blogs']))
			$model->attributes=$_GET['Blogs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Blogs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Blogs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Blogs $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blogs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
