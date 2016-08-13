<?php

class EventsController extends Controller
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
	 * @return array action filters
	 */
	

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
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
		$model= new Events;
		
		$model->scenario='create';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Events']))
		{
		
			$model->attributes=$_POST['Events'];			
			$uploadedFile=CUploadedFile::getInstance($model,'event_image');
			
			$fileName = "{$uploadedFile}"; 
			
			if($model->validate())
				{
			if(!empty($uploadedFile)) 
			 { 
			  $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
			  $size =  getimagesize(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
			  list($width, $height) = $size;

			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
			   $thumb->resize(200, 160);
  			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/events/thumb150/'.$fileName);
			   $model->event_image = '/uploads/events/thumb150/'.$fileName;
			  
			   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
			   $thumb->resize(650,390);
			   $thumb->save(Yii::getPathOfAlias('webroot').'/uploads/events/thumb650/'.$fileName);
			   $model->image_name = '/uploads/events/thumb650/'.$fileName;
			   
			  
			}

			 $model->event_created = date('Y-m-d H:i:s');
			$model->posted_by = Yii::app()->user->id;
			
			$model->save();
			
			  $newsletter=Newsletter::model()->findAllByAttributes(array('status'=>'1')); 

			    $subject =  " TemplesUnlimted Events";		
					
				$from = helpers::configs()->company_email;

				for($j=0; $j<count($newsletter); $j++)
				{		
				$message = "<html>
							<head>
							<title>TemplesUnlimted Events</title>
							</head>
							<body>
							<table cellpadding='0' cellspacing='0' width='800px'>
							<tr>
							<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000000;'><strong>TemplesUnlimted Events <strong></td>
							</tr>
							
							<br/>
							<br/>
							
							We have updated latest events in the temples site.<br/><br/>To view the latest events <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/detail/events/id/".helpers::simple_encrypt($model->event_id).">Click here</a>.
							<br />
                            <br />
							To unsubscribe from all Temples Unlimted emails,Go to <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/default/unsubscribe?email=".$newsletter[$j]->emailid.">Unsubscribe</a> <br/><br/>Best regards,<br/><br/>The TemplesUnlimited Team.
							
							<br/>
							</table>
							</body>
							</html>
							";						
							User::model()->mailsend($newsletter[$j]->emailid,$from,$subject,$message);	
			}

			 $this->redirect(array('view','id'=>$model->event_id));
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
		
		$model->setScenario('update');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Events']))
		{
	     	 $_POST['Events']['event_image']  = $model->event_image;
			 $model->attributes=$_POST['Events'];			
			$uploadedFile=CUploadedFile::getInstance($model,'event_image');
			
			$fileName = "{$uploadedFile}"; 
			
			
			
			if($model->validate())
				{	
				if(!empty($uploadedFile)) 
				{ 
				$uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
				$size =  getimagesize(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
				list($width, $height) = $size;
				
				$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
				$thumb->resize(200, 160);
				$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/events/thumb150/'.$fileName);
				$model->event_image = '/uploads/events/thumb150/'.$fileName;
				
				$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/events/'.$fileName);
				$thumb->resize(650,390);
				$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/events/thumb650/'.$fileName);
				$model->image_name = '/uploads/events/thumb650/'.$fileName;
				}
				$model->event_updated 	 = date('Y-m-d H:i:s');
				if($model->save())
				  {
				  
				   $newsletter=Newsletter::model()->findAllByAttributes(array('status'=>'1'));  

			    $subject =  " TemplesUnlimted Events";		
					
				$from = helpers::configs()->company_email;

				for($j=0; $j<count($newsletter); $j++)
				{		
				$message  = "<html>
							<head>
							<title>TemplesUnlimted Events</title>
							</head>
							<body>
							<table cellpadding='0' cellspacing='0' width='800px'>
							<tr>
							<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000000;'><strong>TemplesUnlimted Events <strong></td>
							</tr>
							
							<br/>
							<br/>
							
							We have updated latest events in the temples site.<br/><br/>To view the latest events <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/detail/events/id/".helpers::simple_encrypt($model->event_id).">&nbsp;Click here</a>.
							<br />
                            <br />
							To unsubscribe from all Temples Unlimted emails,Go to<a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/default/unsubscribe?email=".$newsletter[$j]->emailid.">Unsubscribe</a> <br/><br/>Best regards,<br/><br/>The TemplesUnlimited Team.
							<br/>
							
							</table>
							</body>
							</html>
							";						
							//User::model()->mailsend($newsletter[$j]->emailid,$from,$subject,$message);	
			}
			
				  $this->redirect(array('view','id'=>$model->event_id));
				  }
				}
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
		$dataProvider=new CActiveDataProvider('Cities');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Events('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Events']))
			$model->attributes=$_GET['Events'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cities the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Events::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cities $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cities-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
