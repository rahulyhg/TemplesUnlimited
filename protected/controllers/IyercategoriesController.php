<?php

class IyercategoriesController extends Controller
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
		 if(Yii::app()->session['login']=='login')
	 {
	    $model=new Iyercategories('search');
		
		if(isset($_GET['Iyercategories']))
			$model->attributes=$_GET['Iyercategories'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
		}
		else
		{
		  $this->redirect(array('site/index'));
		}
	}
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCreate()
	{
		$model=new Iyercategories;
		if(isset($_POST['Iyercategories']))
		{
			$model->attributes=$_POST['Iyercategories'];

					if($model->validate())
					{
					$model->save();
				    $this->redirect( Yii::app()->baseUrl.'/index.php/iyercategories/index',array('model'=>$model));
					}
		}
			
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
			public function actionUpdate($id)
				{
				$model=$this->loadModel($id);
				if(isset($_POST['Iyercategories']))
					{
					$model->attributes=$_POST['Iyercategories'];
					
							if($model->validate())
							{
							 $model->save();
							 $this->redirect( Yii::app()->baseUrl.'/index.php/iyercategories/index',array('model'=>$model));
							 
							}
					
					}
				$this->render('update',array(
				'model'=>$model,
				));
				}
				
		
		public function actionAdmin()
	{
	 if(Yii::app()->session['login']=='login')
	 {
	    $model=new Iyercategories('search');
		
		if(isset($_GET['Iyercategories']))
			$model->attributes=$_GET['Iyercategories'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
		}
		else
		{
		  $this->redirect(array('site/index'));
		}
	}
	
	public function actionDelete($id)
	{
		Iyerpoojas::model()->deleteAll("category_id='" .$id. "'");
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
			
	
	public function loadModel($id)
	{
		$model=Iyercategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
