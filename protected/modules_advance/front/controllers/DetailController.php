<?php

class DetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '/layouts/main';	  

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('*'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
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

	
	
	
	
	function actionTemple($id){
	      $id = helpers::simple_decrypt($id);
	   	   $model = Temples::model()->getinfo($id);   
	 
			$this->render('temple', array(
				'model' => $model,
			));
	   
	}
	
	
	
	function actionProduct($id){
			   $id = helpers::simple_decrypt($id);
			   $model = Storeproducts::model()->getinfo($id);   
				$this->render('product', array(
					'model' => $model,
				));
    }
	
	
	function actionPooja($id){
	       $id = helpers::simple_decrypt($id);
	   	   $model = Pooja::model()->getinfo($id);   
			$this->render('epooja', array(
				'model' => $model,
			));
	}
	
	
	function actionNews($id){
	       $id = helpers::simple_decrypt($id);
	   	   $model = News::model()->getinfo($id); 
		   
		   Yii::app()->session['news_id'] = $id;
		   
		     
			$this->render('news_details', array(
				'model' => $model,
			));
	}
	
	
	function actionIyer($id){
		$id = helpers::simple_decrypt($id);
		$model = User::model()->findByPK($id );
		$model->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$id ));
		 $this->render('iyer', array(
					'model' => $model,
		));
	}
	
		function actionGuide($id){
		$id = helpers::simple_decrypt($id);
		$model = User::model()->findByPK($id );
		$model->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$id ));
		$model->guideactivities = Guideactivities::model()->findAll('user_id=:user_id',array(':user_id'=>$id ));
		 $this->render('guide', array(
					'model' => $model,
		));
	}
	
	public function actionPhotolist($type,$id)
	{
	   $photos = Images::model()->get_image_all($type,$id);
	   $dataProvider = new CArrayDataProvider($photos);
	  if(count($photos) && !empty($photos))
	   $this->renderPartial('photoview',array('dataProvider'=>$dataProvider,'reviews'=>$photos));
	  else
	   $this->renderPartial('nophotoview',array('dataProvider'=>$dataProvider,'reviews'=>$photos)); 
			
	} 
	
	function actionEvents($id)
	{
	        $id = helpers::simple_decrypt($id);
	   	    $model = Events::model()->getinfo($id); 
		    Yii::app()->session['event_id'] = $id;
			$views_count  =  $model->views + 1;
			$command = Yii::app()->db->createCommand();
			$sql=' update events set views="'.$views_count.'" where event_id=:event_id';
			$params = array("event_id" =>$id,);
			$command->setText($sql)->execute($params);
			$this->render('event_details', array(
				'model' => $model,
			));
	}
	
	
	
}
?>