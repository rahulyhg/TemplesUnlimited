<?php
class ReviewController extends Controller
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
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'users'=>array('@'),
			),
		
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPost()
	{
	if(helpers::isnormaluser()){ 
		if (Yii::app()->request->isAjaxRequest){ 
		    $model = new Reviews;
		   if(isset($_POST['Reviews'])){
		       $model->attributes = $_POST['Reviews'];
			   $model->review_by = Yii::app()->user->id;
			    if($model->validate()){
				 $model->review_date = date('Y-m-d H:i:s');
					 if( $model->save()){
					           Yii::app()->user->setFlash('reviewsuccess','Your review submited successfully');
					           echo json_encode(array('review'=>'success','msg'=>'Your review submited successfully'));
								Yii::app()->end();
					 }else{
								echo CActiveForm::validate($model);
								Yii::app()->end();
					 }
				}else{
				     echo CActiveForm::validate($model);
					  Yii::app()->end();
				}
		   
		   }else{
							echo CActiveForm::validate($model);
							Yii::app()->end();
		  }
        }		 
	  }	 
	}
	
	
	public function actionReviewlist($type,$id)
	{
	   $reviews = Reviews::model()->get_review_all($type,$id);
	   $dataProvider = new CArrayDataProvider($reviews);
	  if(count($reviews) && !empty($reviews))
	   $this->renderPartial('reviewview',array('dataProvider'=>$dataProvider,'reviews'=>$reviews));
	   else
	   $this->renderPartial('noreviewview',array('dataProvider'=>$dataProvider,'reviews'=>$reviews));
      
			
	}  
	
	function actionMakelike($id,$type){
	
	  $review = $this->loadModel($id);
	  if(count(  $review ) && !Yii::app()->user->isGuest){
	   
		   if($review->review_itemtype != 'guide' || $review->review_itemtype != 'iyer' || (($review->review_itemtype == 'guide' || $review->review_itemtype == 'iyer' ) && $review->review_by != Yii::app()->user->id)){
				   if($type == 'like'){
					 $review->review_likecount =  (int)$review->review_likecount+1;
					 $alreadyusers = explode(',',$review->review_like_users);
					  $alreadyusers[] = Yii::app()->user->id;
					  $alreadyusers = implode(',',$alreadyusers);
					  $review->review_like_users = $alreadyusers;		
				   }else{
					 $review->review_unlikecount =  (int)$review->review_unlikecount+1;
					 $alreadyusers = explode(',',$review->review_unlike_users);
					  $alreadyusers[] = Yii::app()->user->id;
					  $alreadyusers = implode(',',$alreadyusers);
					  $review->review_unlike_users = $alreadyusers;		
				   }
				   
					$review->update();
		  }	
	     echo Reviews::model()->like_unlike_widget($review->review_id);
	  }
	}
	
	
	
	
	
		/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Temples the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Reviews::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	
	
	
	
	
}
?>