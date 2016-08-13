<?php

class NewsController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
		$model=new News;
		
		$model->scenario='create';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	if(isset($_POST['News']))
		{
			 $model->attributes=$_POST['News'];
			 			
			 $uploadedFile=CUploadedFile::getInstance($model,'news_image');
			
			 $fileName = "{$uploadedFile}"; 
			 	
			   $model->news_created = date('Y-m-d H:i:s');
			   $model->posted_by = Yii::app()->user->id;
			   
			   
			    if($model->validate())
				{	
			       if(!empty($uploadedFile)) 
					{ 
					$uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					$size =  getimagesize(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					list($width, $height) = $size;
					
					$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					$thumb->resize(200, 160);
					$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/news/thumb150/'.$fileName);
					$model->news_image = '/uploads/news/thumb150/'.$fileName;
					
					$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					$thumb->resize(650,390);
					$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/news/thumb650/'.$fileName);
					$model->image_name = '/uploads/news/thumb650/'.$fileName;
					}
			
			    $model->save();	
				
	
					
			    $newsletter=Newsletter::model()->findAllByAttributes(array('status'=>'1')); 

			    $subject =  " TemplesUnlimted News";		
					
				$from = helpers::configs()->company_email;
				
				
				$mail =  array();
				
				for($j=0; $j<count($newsletter); $j++)
				{		
				 
			
				$message =  "<html>
							<head>
							<title>TemplesUnlimted News</title>
							</head>
							<body>
							<table cellpadding='0' cellspacing='0' width='800px'>
							<tr>
							<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000000;'><strong>TemplesUnlimted News <strong></td>
							</tr>
							
							<br/>
							<br/>
							
							We have updated latest news in the temples site.<br/><br/>To view the latest news  <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/detail/news/id/".helpers::simple_encrypt($model->news_id).">Click here</a>.
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

		    $this->redirect(array('view','id'=>$model->news_id));
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

		if(isset($_POST['News']))
		{
			 $model->attributes=$_POST['News'];
			 			
			 $uploadedFile=CUploadedFile::getInstance($model,'news_image');
			
			 $fileName = "{$uploadedFile}"; 

			   $model->news_created = date('Y-m-d H:i:s');
			   $model->posted_by = Yii::app()->user->id;
			   
			   
			    if($model->validate())
				{	
			       if(!empty($uploadedFile)) 
					{ 
					$uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					$size =  getimagesize(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					list($width, $height) = $size;
					
					$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					$thumb->resize(200, 160);
					$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/news/thumb150/'.$fileName);
					$model->news_image = '/uploads/news/thumb150/'.$fileName;
					
					$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/uploads/news/'.$fileName);
					$thumb->resize(650,390);
					$thumb->save(Yii::getPathOfAlias('webroot').'/uploads/news/thumb650/'.$fileName);
					$model->image_name = '/uploads/news/thumb650/'.$fileName;
					}

			    if($model->save())
				{
				 $newsletter=Newsletter::model()->findAllByAttributes(array('status'=>'1')); 
     		    $subject =  " TemplesUnlimted News";		
				$from = helpers::configs()->company_email;
				$mail =  array();
				for($j=0; $j<count($newsletter); $j++)
				{		
				$message =  "<html>
							<head>
							<title>TemplesUnlimted News</title>
							</head>
							<body>
							<table cellpadding='0' cellspacing='0' width='800px'>
							<tr>
							<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000000;'><strong>TemplesUnlimted News <strong></td>
							</tr>
							<br/>
							<br/>
							We have updated latest news in the temples site.<br/><br/>To view the latest news  <a target='_blank' href=".Yii::app()->params['SITE_BASE_URL']."/front/detail/news/id/".helpers::simple_encrypt($model->news_id).">&nbsp;Click here</a>.
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
			
				$this->redirect(array('view','id'=>$model->news_id));
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
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

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
		$model=News::model()->findByPk($id);
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
