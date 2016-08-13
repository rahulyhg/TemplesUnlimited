<?php

class DeliveryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	  public $layout='/layouts/main';


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
				'actions'=>array('index','view','viewfront'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','viewquote'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','viewquote','deletedelivery','deletedeliveryall'),
				'users'=>array('admin'),
				//'roles'=>array('admin'),
			),
			/*array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}

   
  

   public function actionDeletedelivery($id)
	{
	   if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
		Common::model()->deletedelivery($id);
		$this->redirect(array('/admin/delivery/admin'));
	   }	
		
	}
	
	
	public function actionDeletedeliveryall()
	{
	
	  if(!Yii::app()->user->isGuest && AdminUsers::model()->is_mainadmin()){
		Common::model()->deletedeliveryall();
		$this->redirect(array('/admin/delivery/admin'));
	   }	
		
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	    $model = $this->loadModel($id);
		if( $model->deleted == '1'){
		  $this->redirect(array('/admin/default/notfound'));
		}
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewquote($id)
	{
		$this->render('viewquotes',array(
			'model'=>Quotes::model()->findByPK($id),
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Deliveries('allsearch');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Deliveries']))
			$model->attributes=$_GET['Deliveries'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Page the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Deliveries::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Page $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionFeaturestatus($id,$status)
	{
		$delivery = $this->loadModel($id);
        $delivery->upgraded = $status=='0'?'1':'0';
		$delivery->updated = date('Y-m-d H:i:s');
		$delivery->update();
		return true;
	}
}
