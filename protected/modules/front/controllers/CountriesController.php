<?php
class CountriesController extends Controller
{
	public $layout='/layouts/main';
	

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

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
			
			array('allow', // allow authenticated users to access all actions
				'users'=>array('admin'),
			),
			/*array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{    
		$Countries=$this->loadModel();
		$this->render('view',array(
			'model'=>$Countries,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Countries;
		if(isset($_Countries['Countries']))
		{
			$model->attributes=$_Countries['Countries'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionStatecreate($id)
	{
		$model=new State;
		if(isset($_POST['State']))
		{
			$model->attributes=$_POST['State'];
		    $valid= $model->validate(); 
			if($valid){
			if($model->save())
				$this->redirect(array('view','id'=>$model->idCountry));
			}	
		}

		$this->render('statecreate',array(
			'model'=>$model,
			'country'=>$id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Countries']))
		{
		   
			$model->attributes=$_POST['Countries'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idCountry));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionStateupdate($id)
	{
	
		$model=State::model()->findByPk($id);
		if(isset($_POST['State']))
		{
		   $model->attributes=$_POST['State'];
		
		    $valid= $model->validate(); 
			if($valid){
			if($model->save())
				$this->redirect(array('view','id'=>$model->idCountry));
			}	
		}

		$this->render('stateupdate',array(
			'model'=>$model,
		));
	}
	
	
	public function actionStatedelete($id)
	{
	
		$model=State::model()->findByPk($id);
		$model->delete();
		return true;
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isCountriesRequest)
		{
			// we only allow deletion via Countries request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria(array(
			'order'=>'idCountry DESC',
		));
		

		$dataProvider=new CActiveDataProvider('Countries', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['CountriessPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionStateindex()
	{
		$criteria=new CDbCriteria(array(
			'order'=>'idCountry DESC',
		));
		
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);

		$dataProvider=new CActiveDataProvider('Countries', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['CountriessPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Countries('search');
		if(isset($_GET['Countries']))
			$model->attributes=$_GET['Countries'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Countries::STATUS_PUBLISHED.' OR status='.Countries::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Countries::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Countries the Countries that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($Countries)
	{
		$comment=new Comment;
		if(isset($_Countries['ajax']) && $_Countries['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_Countries['Comment']))
		{
			$comment->attributes=$_Countries['Comment'];
			if($Countries->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be Countriesed once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}
	
	
	
}
