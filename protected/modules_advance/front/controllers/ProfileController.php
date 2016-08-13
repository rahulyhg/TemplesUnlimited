<?php
class ProfileController extends Controller
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	
		/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPassword()
	{
	        $id =Yii::app()->user->id;
		    $model = $this->loadModel($id);
			$model->setScenario('passwordchange');
			
			  if(isset($_POST['Profile'])){
				  $model->attributes = $_POST['Profile'];
				  if($model->validate()){
					$model->updated_on = date('Y-m-d H:i:s');
					$model->password = helpers::encrypt_password($model->newpassword);
					if($model->save())
					 Yii::app()->user->setFlash('success',' Password changed successfully');
				  }
				  
			   }
			$model->newpassword = '';
			$model->connewpassword = '';
			$model->currentpassword = '';
			
			$this->render('password',array(
				'model'=> $model,
			));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionUser()
	{
	   $id =Yii::app()->user->id;
	   $model = $this->loadModel($id);
	   $model->setScenario('common');
	   if(isset($_POST['Profile'])){
	      $datasaved = 0;
	      $model->attributes = $_POST['Profile'];
		  if($model->validate()){
		    $model->updated_on = date('Y-m-d H:i:s');
			if($model->save())
			 $datasaved = 1;
		  }
		  echo  $datasaved; die;
	   }
	   
	   
	     if(isset($_POST['Userdetails'])){
	      $datasaved = 0;
		  
		   $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
			if(!count($detailsmodel )){
			$detailsmodel = new  Userdetails;
			}
		  
	      $detailsmodel->attributes = $_POST['Userdetails'];
		   $detailsmodel->user_id=  $id;
		  if($detailsmodel->validate()){
			if($detailsmodel->save())
			 $datasaved = 1;
		  }
		  echo  $datasaved; die;
	   }
	   
	   
	    if(isset($_POST['Guide'])){
	      $datasaved = 0;
		  
		 $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
		 $detailsmodel->setAttributes($_POST['Guide']);
		  $detailsmodel->guide_image =  $model->user_image;
		// $detailsmodel->setScenario('profileupdate');
		 
		   
		 //$newmodel = new Guide;
	    // $newmodel->attributes = $detailsmodel->getAttributes();
		  /*echo '<pre>CFxvb'.$detailsmodel->validate();
		  print_r($detailsmodel->getErrors());
		  die;*/
		 
		   $detailsmodel->user_id=  $id;
		   if(isset($_POST['Guide']['guide_wh1']) || isset($_POST['Guide']['guide_wh2'])){
			   $time1 = strtotime($detailsmodel->guide_wh1);
				$time2 = strtotime($detailsmodel->guide_wh2);
				$time3 = 	number_format((($time2 - $time1) / 3600), 1, '.', ' ');
				$detailsmodel->guide_wh = $time3;
			}
			
		if(is_array($detailsmodel->guide_services))	
		$detailsmodel->guide_services = implode(',',$detailsmodel->guide_services);
		if(is_array($detailsmodel->guide_sec_languages))	
		$detailsmodel->guide_sec_languages = implode(',',$detailsmodel->guide_sec_languages);
		if(is_array($detailsmodel->secondary_locations)){	
			$secondary_locations = implode(',',$detailsmodel->secondary_locations);
			$detailsmodel->secondary_locations =$secondary_locations;
		}
		
		  if(isset($_POST['Guide']['guide_experience']) ){
			if($detailsmodel->guide_experiencetype == '1'){
				  $detailsmodel->guide_experience = number_format((float)($detailsmodel->guide_experience / 12 ), 1, '.', '');
				}
		}		
		  if($detailsmodel->validate()){ 
			if($detailsmodel->save())
			 $datasaved = 1;
		  }
		  echo  $datasaved; die;
	   }
	   
	   
	   if(isset($_POST['Iyer'])){
	      $datasaved = 0;
		  
		 $detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));		
		  
		  $detailsmodel->setAttributes($_POST['Iyer']);
		  $detailsmodel->iyer_image =  $model->user_image;
		  
		   $detailsmodel->user_id=  $id; 
		    if(isset($_POST['Iyer']['iyer_wh1']) || isset($_POST['Iyer']['iyer_wh2'])){
				$time1 = strtotime($detailsmodel->iyer_wh1);
				$time2 = strtotime($detailsmodel->iyer_wh2);
				$time3 = 	number_format((($time2 - $time1) / 3600), 1, '.', ' ');
				$detailsmodel->iyer_wh = $time3;
			}
			
		  if(isset($_POST['Iyer']['iyer_experience']) ){	
			if($detailsmodel->iyer_experiencetype == '1'){
			 $detailsmodel->iyer_experience = number_format((float)($detailsmodel->iyer_experience / 12 ), 1, '.', '');
		   }
		}
		
		//echo $_POST['Iyer']['iyer_categories'];
		/*if(isset($_POST['Iyer']['iyer_categories'])){	
		$iyer->iyer_categories = implode(',',$_POST['Iyer']['iyer_experience']);
		}*/
		
		
		
		if(is_array($detailsmodel->iyer_sec_languages))
		$detailsmodel->iyer_sec_languages = implode(',',$detailsmodel->iyer_sec_languages);
			
		  if($detailsmodel->validate()){ 
			if($detailsmodel->save())
			 $datasaved = 1;
		  }
		  
		  echo  $datasaved; die;
	   }
	   
	   
	   
	   
		$this->render('user',array(
		 'model'=> $model,
		));
	}
	
		public function actionPoojas()
		{
		  $id =Yii::app()->user->id;
	      $model = $this->loadModel($id);
		  
		   $iyeractivities = Iyeractivities::model()->get_all($id);
		   $iyer= new Iyer;
		   if(isset($_POST['activity_description']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE iyeractivities SET activity_description = '".$_POST['activity_description']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		    if(isset($_POST['amount_with_items']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE iyeractivities SET amount_with_items = '".$_POST['amount_with_items']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		    if(isset($_POST['amount_without_items']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE iyeractivities SET amount_without_items = '".$_POST['amount_without_items']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		   
		if(isset($_POST['Iyer']['iyer_categories']))
		{
		     $iyer_categories = implode(',',$_POST['Iyer']['iyer_categories']);
			 $connection = yii::app()->db;
		     $sql = "UPDATE iyer SET iyer_categories = '".$iyer_categories."' WHERE user_id='".Yii::app()->user->id."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute(); 
			 $new_categories =  Iyer::model()->getinfo(Yii::app()->user->id);
			 $new_array = explode(',',$new_categories->iyer_categories);
			 $existpoojas1 =array();
			 
			 for($i=0;$i<count($new_array);$i++)
		     array_push($existpoojas1,$new_array[$i]);		 
			 $sql = "delete from iyeractivities WHERE user_id='".Yii::app()->user->id."' ";
			 $command=$connection->createCommand($sql);
			 $command->execute();
			 
			 for($i=0;$i<count($existpoojas1);$i++)
			{
			    $poojaname = Iyerpooja::model()->getinfo($existpoojas1[$i]);
				$connection = yii::app()->db;
				$sql = "insert into iyeractivities(user_id,activity_title) values('".Yii::app()->user->id."','".$poojaname->pooja_name."')";
				$command=$connection->createCommand($sql);
				$command->execute();
			}
			echo  "1";die;
		}
		
		
		/*	
	    $existpoojas =  Iyer::model()->getinfo(Yii::app()->user->id);
		$existpoojas1 =array();
		array_push($existpoojas1,$existpoojas->iyer_categories);
	    $new_categories =array();
		for($i=0;$i<=count($_POST['Iyer']['iyer_categories']);$i++)
			{
			if(isset($_POST['Iyer']['iyer_categories'][$i]))
				{
				if(in_array($_POST['Iyer']['iyer_categories'][$i],$existpoojas1))
					{
					
					}
					else
					{
					   array_push($new_categories,$_POST['Iyer']['iyer_categories'][$i]);
					}
				}
			}
			
			for($i=0;$i<count($new_categories);$i++)
			{
			    $poojaname = Pooja::model()->getinfo($new_categories[$i]);
				
				//$exist_activities = Iyeractivities::mode->getinfo();
				$connection = yii::app()->db;
				$sql = "insert into iyeractivities(user_id,activity_title) values('".Yii::app()->user->id."','".$poojaname->pooja_name."')";
				$command=$connection->createCommand($sql);
				$command->execute();
			}
		
		     $iyer_categories = implode(',',$_POST['Iyer']['iyer_categories']);
			 $connection = yii::app()->db;

		     $sql = "UPDATE iyer SET iyer_categories = '".$iyer_categories."' WHERE user_id='".Yii::app()->user->id."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		*/ 
		   
		   
	
		  $this->render('poojas',array(
		 'model'=> $model,
		 'iyer'=>$iyer,
		  'iyeractivities'=>$iyeractivities,
		));
		}
		
		
		public function actionGuideplan()
		{
		  $id =Yii::app()->user->id;
	      $model = $this->loadModel($id);
		  
		  if(isset($_POST['activity_description']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE guideactivities SET activity_description = '".$_POST['activity_description']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		   if(isset($_POST['activity_duration']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE guideactivities SET activity_duration = '".$_POST['activity_duration']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		   
		   if(isset($_POST['activity_language']))
		   {
		     $activity_language = implode(',',$_POST['activity_language']);

		     $connection = yii::app()->db;
		    $sql = "UPDATE guideactivities SET activity_language = '".$activity_language."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		    if(isset($_POST['starting_point_content']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE guideactivities SET starting_point_content = '".$_POST['starting_point_content']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		   if(isset($_POST['availability_dates']))
		   {
		     $connection = yii::app()->db;
		     $sql = "UPDATE guideactivities SET availability_dates = '".$_POST['availability_dates']."' WHERE user_id='".Yii::app()->user->id."' and  activity_id='".$_POST['activity_id']."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute();
			 echo  "1";die;
		   }
		   
		   if(isset($_POST['Guide']['guide_categories']))
		   {
		     $guide_categories = implode(',',$_POST['Guide']['guide_categories']);
			 $connection = yii::app()->db;
		     $sql = "UPDATE guide SET guide_categories = '".$guide_categories."' WHERE user_id='".Yii::app()->user->id."' ";
		     $command=$connection->createCommand($sql);
		     $command->execute(); 
			 $new_categories =  Guide::model()->getinfo(Yii::app()->user->id);
			 $existpoojas1 =array();
		     array_push($existpoojas1,$new_categories->guide_categories);		 
			 $sql = "delete from guideactivities WHERE user_id='".Yii::app()->user->id."' ";
			 $command=$connection->createCommand($sql);
			 $command->execute();
			
			

			 for($i=0;$i<count($existpoojas1);$i++)
			{
			    $templename = Temples::model()->getinfo($existpoojas1[$i]);
				$connection = yii::app()->db;
				$sql = "insert into guideactivities(user_id,activity_title) values('".Yii::app()->user->id."','".$templename->temple_name."')";
				$command=$connection->createCommand($sql);
				$command->execute();
			}
			echo  "1";die;
		   }
		 
		 
		  
		
		 $this->render('guideplan',array(
		 'model'=> $model,
		));
		
		}


   

	/**
		 * Displays a particular model.
		 * @param integer $id the ID of the model to be displayed
		 */
		public function actionMaindetails()
		{
		     $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->renderPartial('maindetails', array('model'=>$model));		
		}
		
		public function actionPooja_details()
		{
		     $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->renderPartial('pooja_details', array('model'=>$model));	
		}
		
		public function actionGuideplan_details()
		{
		     $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->renderPartial('guideplan_details', array('model'=>$model));	
		}
		
		
		/**
		 * Displays a particular model.
		 * @param integer $id the ID of the model to be displayed
		 */
		public function actionPhotos()
		{
		
		
		  $id = Yii::app()->user->id;
		 $model = $this->loadModel($id);
		 if($model->role == '3' || $model->role == '4'){
				if($model->role == '3')
				$type = 'guide';
				else if($model->role == '4')
				$type = 'iyer';
				
						if(isset($_POST['Images'])){ 
							 $imagemodel = new Images;
							 $imagemodel->attributes = $_POST['Images'];
							
							 $uploadedFile=CUploadedFile::getInstance($imagemodel,'image_path');
							 if(!empty($uploadedFile)){
								 $rnd = time();
								 $dir = 'uploads/'.$type.'/images/';
								 $fileName = "{$rnd}_{$uploadedFile}";  // random number + file name
								 $imagemodel->image_path = $dir.$fileName;
							 }
						
								   if( $imagemodel->validate()){
													   $imagemodel->created_at = date('Y-m-d H:i:s');
														if( $imagemodel->save()){
														      $uploadedFile->saveAs($dir.$fileName);
															  
															    	Yii::app()->setComponents(array('ThumbsGen' => array(
																		'class' => 'ext.ThumbsGen.ThumbsGen',
																		'scaleResize' => null, //if it is not null $thumbWidth and $thumbHeight will be ommited. for example 'scaleResize'=>0.5 generate image with half dimension
																		//one of $thumbWidth or $thumbHeight is optional but not both!
																		'thumbWidth' => 150, //the width of created thumbnail on pixel. if height is null the aspect ratio will be reserved
																		'thumbHeight' => 150, //the height of created thumbnail on pixel. if width is null the aspect ratio will be reserved
																		'postFixThumbName' => '', //the postfix name of thumbnail for example if it set = '_thumb' then  image1.jpg become image1_thumb.jpg
																		'recreate' => true, //force to create each thumbnail either exist or not, when is set to false the tumbnails created only in the first time
																				  )));
																		  
																		$picpath = Yii::getPathOfAlias('webroot').'/'.$dir.$fileName;
																		$picthumbpath =  Yii::getPathOfAlias('webroot').'/'.$dir.'thumb/'.$fileName;
																		Yii::app()->ThumbsGen->createthumb($picpath,$picthumbpath);
															  
																 Yii::app()->user->setFlash('success',' New image uploaded successfully');
														}	
									}
														
						}
						
					$images = Images::model()->get_image_all($type, $model->user_id);
					$dataProvider = new CArrayDataProvider($images);
					 if (Yii::app()->request->isAjaxRequest)
					  $this->renderPartial('photoview', array('model'=>$model,'dataProvider'=>$dataProvider,'images'=>$images,'type'=>$type,));
					  else
				      $this->render('photos', array('model'=>$model,'dataProvider'=>$dataProvider,'images'=>$images,'type'=>$type,));	
			 }	
		}	
		
  
	  public  function actionRemovephoto	($id){
	       $model = Images::model()->findByPk($id);
		   $previmage = $model->image_path;
		   $prevthumimage = str_replace(basename($previmage),'thumb/'.basename($previmage), $previmage);
		   @unlink( $previmage);
		   @unlink( $prevthumimage);
		   $model->delete();
		   echo 'deleted'; die;
	  }	
		
		
  /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionFavourites()
	{
	        $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			if($model->role == '2'){
				$productids = explode(',',$model->favourite_products);
				$productids = array_filter($productids);
				if(count($productids))
				   $products = Storeproducts::model()->getinfo_byids($productids);
				 else{
					$products = array();
				 }
				  
					$this->render('favourite',array(
					 'model'=> $model,
					 'products'=>$products,
					));
			}
	}
	
	
	
  /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionReviews()
	{
	
	    if(helpers::isiyer() || helpers::isguide()){
	        $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$reviews = Reviews::model()->get_review_all(Yii::app()->params['usertype'][$model->role],$id);
			
			if($reviews)
			$dataProvider = new CArrayDataProvider($reviews);
			else
			$dataProvider = array();
			$this->render('reviews',array(
			 'model'=> $model,
			 'reviews'=>$reviews,
			 'dataProvider'=>$dataProvider,
			));
		}	
		else
		{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$reviews = Reviews::model()->get_review_all_user($id);
			
			if($reviews)
			$dataProvider = new CArrayDataProvider($reviews);
			else
			$dataProvider = array();
			$this->render('reviews',array(
			'model'=> $model,
			'reviews'=>$reviews,
			'dataProvider'=>$dataProvider,
			));
		
		}
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionOrders()
	{
	        $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->render('orders',array(
			 'model'=> $model,
			));
	}
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionCart()
	{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$criteria1 = new CDbCriteria();
			$condition1 ='';
			$condition1 .= ' `user_id` ="'.$id.'" ' ;
			$criteria1->condition =  $condition1;
			$count1 = MyCart::model()->count($criteria1);
			$pages = new CPagination($count1);
			$pages->setPageSize(10);
			$pages->applyLimit($criteria1);
			$dataProvider1 = MyCart::model()->findAll($criteria1);
			
			
			$this->render('cart',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider1,
			'pages' => $pages
			));
	}
	
	
	function actionAddcart()
	{
  	    $carts = MyCart::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'product_id'=>$_POST['product_id']));
		if(count($carts)==0)
		{
	    $connection = yii::app()->db;
		$sql = "insert into my_cart (user_id,product_id,created_date) values(".Yii::app()->user->id.",".$_POST['product_id'].",NOW())";
		$command=$connection->createCommand($sql);
		$command->execute();
		}
	 }
	
	
	
	
	function actionMakefavourite($id){
	
		 if(!Yii::app()->user->isGuest){ 
			      $user = $this->loadModel(Yii::app()->user->id);
				  $favourite_products = explode(',',$user->favourite_products);
				  $favourite_products[] = $id;
	              $favourite_products  = implode(',',$favourite_products);
				  $user->favourite_products =    $favourite_products;
				  $user->update();
		  }	
	     echo Profile::model()->favourite_widget($id);
	 
	}
	
	
	
	function actionRemovefavourite($id)
	{
		$id = helpers::simple_decrypt($id);
		$model=Profile::model()->findByPk(Yii::app()->user->id);
		$test1 = str_replace($id,"",$model->favourite_products);
		$favourite_products = str_replace(",,",",",$test1);
		$connection = yii::app()->db;
		$sql = "UPDATE user SET favourite_products = '".$favourite_products."' WHERE user_id='".Yii::app()->user->id."' ";
		$command=$connection->createCommand($sql);
		$command->execute();
		$this->redirect(array('profile/favourites'));
	}
	
	
	function actionRemovecart($id)
	{
	     $id = helpers::simple_decrypt($id);
	   
	    $connection = yii::app()->db;
		$sql = "delete from my_cart WHERE cart_id='".$id."' ";
		$command=$connection->createCommand($sql);
		$command->execute();
		
		$this->redirect(array('profile/cart'));
	}
	
	public function actionPlaceorder()
	{
	    $total_amount_cart = $_POST['total_amount_cart'];
	   
	    $ids_for_count = explode(',',$_POST['ids_for_count']);
		
		$total_array = array_filter($ids_for_count);
		
		$quantity_array =  array();
		$amount_array =array();
		
		for($i=0;$i<count($total_array);$i++)
		{
		 array_push($quantity_array,$_POST['quantity_'.$total_array[$i]]); 
		 array_push($amount_array,$_POST['amount_values_'.$total_array[$i]]); 
		}
		   /*we are already completed index page so please continue form submit action page in the order*/
		   
		   $this->redirect(array('profile/cart'));
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
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	
	
	
	
	
}
?>