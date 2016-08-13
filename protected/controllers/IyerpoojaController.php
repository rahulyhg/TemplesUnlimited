<?php

class IyerpoojaController extends Controller
{

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


	public function actionIndex()
	{
	    $model=new Iyerpooja('search');
		
		if(isset($_GET['Iyerpooja']))
			$model->attributes=$_GET['Iyerpooja'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCreate()
	{
		$model=new Iyerpooja;
		if(isset($_POST['Iyerpooja']))
		{
			$model->attributes=$_POST['Iyerpooja'];

					if($model->validate())
					{
					$model->save();
				    $this->redirect( Yii::app()->baseUrl.'/index.php/iyerpooja/index',array('model'=>$model));
					}
		}
			
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
			public function actionUpdate($id)
				{
				$model=$this->loadModel($id);
				if(isset($_POST['Iyerpooja']))
					{
					$model->attributes=$_POST['Iyerpooja'];
					
							if($model->validate())
							{
							 $model->save();
							 $this->redirect( Yii::app()->baseUrl.'/index.php/iyerpooja/index',array('model'=>$model));
							 
							}
					
					}
				$this->render('update',array(
				'model'=>$model,
				));
				}
				
		
		public function actionAdmin()
	{
	    $model=new Iyerpooja('search');
		
		if(isset($_GET['Iyerpooja']))
			$model->attributes=$_GET['Iyerpooja'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
			
	
	public function loadModel($id)
	{
		$model=Iyerpooja::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
