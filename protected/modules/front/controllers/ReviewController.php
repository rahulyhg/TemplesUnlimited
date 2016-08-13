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
	if(!Yii::app()->user->isGuest){ 
		if (Yii::app()->request->isAjaxRequest){ 
		    $model = new Reviews;
		   if(isset($_POST['Reviews'])){
		       $model->attributes = $_POST['Reviews'];
			   $model->review_by = Yii::app()->user->id;
			    if($model->validate()){
				 $model->review_date = date('Y-m-d H:i:s');
					 if( $model->save()){
					   
										if($_POST['Reviews']['review_itemtype']=='iyer')
										{
											$reviewsavg= Reviews::model()->get_average('iyer',$_POST['Reviews']['review_itemid']);
											$reviewscount = Reviews::model()->get_reviews_count('iyer',$_POST['Reviews']['review_itemid']);
											$iyer = Iyer::model()->findByAttributes(array('user_id'=>$_POST['Reviews']['review_itemid']));
											$iyer->count_review= $reviewscount['count'];
											$iyer->review_average= $reviewsavg;
											$iyer->save();
										}
										
										if($_POST['Reviews']['review_itemtype']=='guide')
										{
											$reviewsavg= Reviews::model()->get_average('guide',$_POST['Reviews']['review_itemid']);
											$reviewscount= Reviews::model()->get_reviews_count('guide',$_POST['Reviews']['review_itemid']);
											$guide = Guide::model()->findByAttributes(array('user_id'=>$_POST['Reviews']['review_itemid']));
											$guide->count_review = $reviewscount['count'];
											$guide->review_average= $reviewsavg;
											$guide->save();
										}
					           Yii::app()->user->setFlash('reviewsuccess','Your review has been submitted successfully.');
					           echo json_encode(array('review'=>'success','msg'=>'Your review has been submitted successfully.'));
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
	
	
	function actionAddreview()
	{
	  $model = new Reviews;
	  $model->review_title = $_POST['title'];
	  $model->review_content = $_POST['comment'];
	  $model->review_rate = $_POST['overall_ratings'];
	  $model->review_itemtype = 'temple';
	  $model->review_itemid  = $_POST['temple_id'];
	  $model->review_by = $_POST['review_by']; 
	  $model->review_date = date('Y-m-d H:i:s');
	  $model->architecture_review_rate = $_POST['architechture'];
	  $model->friendly_review_rate = $_POST['tourist_friendly'];
	  $model->cleanliness_review_rate = $_POST['cleanliness'];
	  $model->staffs_review_rate = $_POST['staffs'];
	  $model->darshan_review_rate = $_POST['dharshan'];
	  
		if(isset($_FILES['review_image']['name']))
		{
		$target_Path = Yii::getPathOfAlias('webroot')."/uploads/reviews/";
		$target_Path = $target_Path.basename($_FILES['review_image']['name'] );
		move_uploaded_file( $_FILES['review_image']['tmp_name'], $target_Path);
		$model->image_url =  $_FILES['review_image']['name'];
		}
		
	  if($model->save())
	  {
	        $type = 'temple';
		    $id= $_POST['temple_id'];

	           $reviews = Reviews::model()->get_average($type,$id);

			$reviewscount = Reviews::model()->get_review_all($type,$id);

		       Temples::model()->updateByPk($_POST['temple_id'], array("count_review"=>$get_average,"review_average"=>$reviews));
			
			
	  Yii::app()->user->setFlash('reviewsuccess','Your review has been submitted successfully.');
	  }
	  $this->redirect(array("review/addreviews/type/temple/id/".helpers::simple_encrypt($_POST['temple_id'])));
  
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
	  if(count($review ) && !Yii::app()->user->isGuest){
	   
		   if($review->review_itemtype != 'guide' || $review->review_itemtype != 'iyer' || (($review->review_itemtype == 'guide' || $review->review_itemtype == 'iyer' ) && $review->review_by != Yii::app()->user->id)){
		   
		   
				   if($type == 'like'){
				   
						$alreadyusersunlike = explode(',',$review->review_unlike_users);
						
						if(($key = array_search(Yii::app()->user->id, $alreadyusersunlike)) !== false){
						unset($alreadyusersunlike[$key]);
						$alreadyusersunlike1 = implode(',',$alreadyusersunlike);
						$review->review_unlike_users = $alreadyusersunlike1;
						$review->review_unlikecount =  (int)$review->review_unlikecount - 1;
						$review->update();
						}

				   
					  $review->review_likecount =  (int)$review->review_likecount+1;
					  $alreadyusers = explode(',',$review->review_like_users);
					  $alreadyusers[] = Yii::app()->user->id;
					  $alreadyusers = implode(',',$alreadyusers);
					  $review->review_like_users = $alreadyusers;		
				   }else{
				   
				    $alreadyuserslike = explode(',',$review->review_like_users);
				      if(($key = array_search(Yii::app()->user->id, $alreadyuserslike)) !== false){
						unset($alreadyuserslike[$key]);
						$alreadyuserslike1 = implode(',',$alreadyuserslike);
						$review->review_like_users = $alreadyuserslike1;
						$review->review_likecount =  (int)$review->review_likecount - 1;
						$review->update();
						}
						
						
				   
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
	
	function actionAddreviews($type,$id)
	{
	  $id = helpers::simple_decrypt($id);
	
	  $model=Temples::model()->findByPk($id);

	  
	  $this->render('addnewreviews', array('type' => $type,'id'=>$id,'model'=>$model));
	
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
