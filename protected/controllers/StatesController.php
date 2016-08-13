<?php

class StatesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';



public function filters()
	{
		return array(
		'accessControl', // perform access control for CRUD operations
		//	'postOnly + delete', // we only allow deletion via POST request
		);
	}


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
	 * @return array action filters
	 */
	
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
		$model=new States;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['States']))
		{
			$model->attributes=$_POST['States'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['States']))
		{
			$model->attributes=$_POST['States'];
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
		$dataProvider=new CActiveDataProvider('States');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	function  actionList_country()
	{
	     $id =  $_POST['country_id'];		 
		 $Criteria = new CDbCriteria();
         $Criteria->condition = "country_id = $id";
         $model = States::model()->findAll($Criteria);
		 
		  $option ='<option value="">Select State</option>';
		 
		  for($i=0;$i<count($model);$i++)
		 {
		     $option .='<option value="'.$model[$i]->id.'">'.$model[$i]->state_name.'</option>';
		 }
		  echo $option;
	}//
	
	
	function  actionList_cities()
	{
	     $id =  $_POST['state_id'];		 
		 $Criteria = new CDbCriteria();
         $Criteria->condition = "state_id = $id";
         $model = Cities::model()->findAll($Criteria);
		 
		  $option ='<option value="">Select City</option>';
		 
		  for($i=0;$i<count($model);$i++)
		 {
		     $option .='<option value="'.$model[$i]->id.'">'.$model[$i]->name.'</option>';
		 }
		  echo $option;
	}//

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new States('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['States']))
			$model->attributes=$_GET['States'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return States the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=States::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param States $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='states-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
