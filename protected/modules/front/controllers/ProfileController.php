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

	
	
		/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPassword()
	{
	        $id =Yii::app()->user->id;
		    $model = $this->loadModel($id);
			$model->setScenario('passwordchange');
			$this->performAjaxValidation($model);	
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
			if(isset(Yii::app()->session['securepaymentwithiyer']))
			{
			   $this->redirect(array('profile/securepaymentwithiyer'));  
			}
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
		   
		   
		   
		   if(isset($_POST['Userdetails']['country']))
		   {
		    $detailsmodel->state = '';
			$detailsmodel->city = '';
		   }

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
		 
		   $detailsmodel->user_id=  $id;
		   
		   if(isset($_POST['Guide']['guide_wh'])){
				$detailsmodel->guide_wh = $_POST['Guide']['guide_wh'];
			}
			
		if(is_array($detailsmodel->guide_services))	
		$detailsmodel->guide_services = implode(',',$detailsmodel->guide_services);
		if(is_array($detailsmodel->guide_sec_languages))	
		$detailsmodel->guide_sec_languages = implode(',',$detailsmodel->guide_sec_languages);
		if(is_array($detailsmodel->secondary_locations)){	
			$secondary_locations = implode(',',$detailsmodel->secondary_locations);
			$detailsmodel->secondary_locations =$secondary_locations;
		}
		
		if(isset($_POST['Guide']['guide_country'])){	
		$detailsmodel->guide_country =$_POST['Guide']['guide_country'];
		$detailsmodel->guide_state ='';
		$detailsmodel->guide_city ='';
		}
		
		  if(isset($_POST['Guide']['guide_experience']) ){
			if($_POST['Guide']['guide_experiencetype']== '1'){
				  $detailsmodel->guide_experience = $_POST['Guide']['guide_experience'];
				  $detailsmodel->guide_experiencetype = $_POST['Guide']['guide_experiencetype'];
				}
				else
				{
				 $detailsmodel->guide_experience = $_POST['Guide']['guide_experience'];
				 $detailsmodel->guide_experiencetype = $_POST['Guide']['guide_experiencetype'];
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
		    if(isset($_POST['Iyer']['iyer_wh'])){
			
			  $timestamp = explode(':',$_POST['Iyer']['iyer_wh']);
			  
			    $detailsmodel->iyer_wh = $timestamp[0].'.'.$timestamp[1];
			}
			
		  if(isset($_POST['Iyer']['iyer_experience']) ){  	
			if($_POST['Iyer']['iyer_experience_type'] == '1'){
			 $detailsmodel->iyer_experience =$_POST['Iyer']['iyer_experience'];
			  $detailsmodel->iyer_experience_type =$_POST['Iyer']['iyer_experience_type'];
		   }
		   else
		   {
		     $detailsmodel->iyer_experience = $_POST['Iyer']['iyer_experience'];
			 $detailsmodel->iyer_experience_type =$_POST['Iyer']['iyer_experience_type'];
		   }
		}
		
		
		if(isset($_POST['Iyer']['iyer_amount']) ){	
			$detailsmodel->iyer_amount =$_POST['Iyer']['iyer_amount'];
		}
		
		
		if(isset($_POST['Iyer']['iyer_amount_option']) ){	
			$detailsmodel->iyer_amount_option =$_POST['Iyer']['iyer_amount_option'];
		}
		
		
		

		if(isset($_POST['Iyer']['iyer_country'])){	
		$detailsmodel->iyer_country =$_POST['Iyer']['iyer_country'];
		$detailsmodel->iyer_state ='';
		$detailsmodel->iyer_city ='';	
		}
		
		
		
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
	
	
			 function actionGuidetemple()
			{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->render('guideactivity',array(
			'model'=> $model,
			));
			}
			
		public function actionTemplecreate()
		{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$guideactivities = new Guidetemple;
			$this->performAjaxValidation($guideactivities);		
			$guide_details = Guide::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
			$guide_categories = explode(',',$guide_details->guide_categories);
			$guide_categories = array_filter($guide_categories);

	     	if(isset($_POST['Guidetemple']))
			{
			$guideactivities->attributes=$_POST['Guidetemple'];
			if(is_array($_POST['Guidetemple']['activity_language']))
			$guideactivities->activity_language = implode(',',$guideactivities->activity_language);

			$guideactivities->discount_percentage = $_POST['Guidetemple']['discount_percentage']; 
			$guideactivities->user_id = Yii::app()->user->id;
			$guideactivities->discount_dates_from = $_POST['Guidetemple']['discount_dates_from']; 
			$guideactivities->discount_dates_to = $_POST['Guidetemple']['discount_dates_to']; 
			$guideactivities->status = '0';
			$guideactivities->created = date('d-m-y');
			$categories = '';
			if(!in_array($_POST['Guidetemple']['category_id'],$guide_categories))
			{
			array_push($guide_categories,$_POST['Guidetemple']['category_id']);
			for($j=0;$j<count($guide_categories);$j++)
			{
			$categories .=$guide_categories[$j].',';
			}
			}
			else
			$categories .= $guide_details->guide_categories; 
			
			$connection = yii::app()->db;
			$sql = "UPDATE guide SET guide_categories = '".$categories."' WHERE user_id='".Yii::app()->user->id."' ";
			$command=$connection->createCommand($sql);
			$command->execute();
			if($guideactivities->save())
			$this->redirect(array('templeview','id'=>$guideactivities->activity_id));
			}

		$this->render('guidetemple/create',array(
			'guideactivities'=>$guideactivities,
			'model'=>$model,

		));
		}
		
		public function actionTempleview($id)
		{
			$user_id =Yii::app()->user->id; 
			$model = $this->loadModel($user_id);
			$guideactivities = Guidetemple::model()->findByPk($id);
  		   $this->render('guidetemple/view',array(
			'guideactivities'=>$guideactivities,
			'model'=>$model,
			));
		}
		
		
		public function  actionTempleguideupdate($id)
		{
		$user_id =Yii::app()->user->id; 
		$model = $this->loadModel($user_id);
		$guideactivities = Guidetemple::model()->findByPk($id);
		$this->performAjaxValidation($guideactivities);
		$guide_details = Guide::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
		$guide_categories = explode(',',$guide_details->guide_categories);
		$guide_categories = array_filter($guide_categories);
		
		 if(isset($_POST['Guidetemple']))
			{
			$guideactivities->attributes=$_POST['Guidetemple'];
			if(is_array($_POST['Guidetemple']['activity_language']))
			$guideactivities->activity_language = implode(',',$guideactivities->activity_language);

			$guideactivities->discount_percentage = $_POST['Guidetemple']['discount_percentage']; 
			$guideactivities->user_id = Yii::app()->user->id;
			$guideactivities->discount_dates_from = $_POST['Guidetemple']['discount_dates_from']; 
			$guideactivities->discount_dates_to = $_POST['Guidetemple']['discount_dates_to']; 
			$guideactivities->status = '0';
			$guideactivities->created = date('d-m-y');
			$categories = '';
			if(!in_array($_POST['Guidetemple']['category_id'],$guide_categories))
			{
			array_push($guide_categories,$_POST['Guidetemple']['category_id']);
			for($j=0;$j<count($guide_categories);$j++)
			{
			$categories .=$guide_categories[$j].',';
			}
			}
			else
			$categories .= $guide_details->guide_categories; 
			
			$connection = yii::app()->db;
			$sql = "UPDATE guide SET guide_categories = '".$categories."' WHERE user_id='".Yii::app()->user->id."' ";
			$command=$connection->createCommand($sql);
			$command->execute();
			if($guideactivities->save())
			$this->redirect(array('templeview','id'=>$guideactivities->activity_id));
			}

		$this->render('guidetemple/update',array(
			'guideactivities'=>$guideactivities,
			'model'=>$model,
		
		));
		}
		
		public function actionTempleguidedelete($id)
		{
		$post=Guidetemple::model()->findByPk($id);
        $post->delete();
		if(!isset($_GET['ajax']))
		 $this->redirect(array('guidetemple'));
		}


		public function actionFilesubmit()
		{
		 $detailsmodel =  Guide::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
	
		 if(isset($_POST['Guide']['guide_have_certificate']))
		 {
		 $uploadedFile=CUploadedFile::getInstance($detailsmodel,'guide_have_certificate');
	     $fileName = "{$uploadedFile}";
		
		  if(!empty($uploadedFile)) 
		  { 
		   $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/license/'.$fileName); 

		  $detailsmodel->guide_have_certificate ='Yes';
		  
		   $detailsmodel->guide_license = $fileName;
		  }
		  else
		  {
		   $detailsmodel->guide_have_certificate ='Yes';
		  
		    $detailsmodel->guide_license = $fileName;
		  }
		 }
		  $detailsmodel->update();
		 
		 $this->redirect(array('/user'));
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
		
		
		public function actionIyerdatails()
		{
		     $id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->renderPartial('iyerdatails', array('model'=>$model));		
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


Yii::app()->setComponents(array('ThumbsGen' => array(
																		'class' => 'ext.ThumbsGen.ThumbsGen',
																		'scaleResize' => null, //if it is not null $thumbWidth and $thumbHeight will be ommited. for example 'scaleResize'=>0.5 generate image with half dimension
																		//one of $thumbWidth or $thumbHeight is optional but not both!
																		'thumbWidth' => 600, //the width of created thumbnail on pixel. if height is null the aspect ratio will be reserved
																		'thumbHeight' => 450, //the height of created thumbnail on pixel. if width is null the aspect ratio will be reserved
																		'postFixThumbName' => '', //the postfix name of thumbnail for example if it set = '_thumb' then  image1.jpg become image1_thumb.jpg
																		'recreate' => true, //force to create each thumbnail either exist or not, when is set to false the tumbnails created only in the first time
																				  )));
																		  
																		$picpath = Yii::getPathOfAlias('webroot').'/'.$dir.$fileName;
																		$picthumbpath =  Yii::getPathOfAlias('webroot').'/'.$dir.'resize/'.$fileName;
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
		
  
	  public  function actionRemovephoto($id)
	  {
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
			$criteria1 = new CDbCriteria();
			$condition1 = ' `user_id` ="'.$id.'" ' ;
			$criteria1->condition =  $condition1;
			$count1 = Order::model()->count($criteria1);
			$dataProvider = Order::model()->findAll($criteria1);

			$this->render('orders',array(
			 'model'=> $model,
			 'dataProvider'=>$dataProvider,
			));
	}
        
        public function actionOrderig()
	{	
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$criteria1 = new CDbCriteria();
			$condition1 = ' `user_id` ="'.$id.'" and iyer_status="yes"  ' ;
			$criteria1->condition =  $condition1;
			$count1 = BookedTable::model()->count($criteria1);
                        $dataProvider = BookedTable::model()->findAll($criteria1);	


			$this->render('orderig',array(
			 'model'=> $model,
			 'dataProvider'=>$dataProvider,
			));
	}
	
	
	public function actionOrderdetails($id)
	{	
			 $model = $this->loadModel(Yii::app()->user->id);
			 $id = helpers::simple_decrypt($id);
			// $mycart = MyCart::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id,'order_id' =>$id));
			
			 $order = Order::model()->findByPK($id);
  
			$this->render('order_detail',array(
			'model'=> $model,
			'order'=>$order,
			));
	}
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionCart()
	{
	if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
	{
			$id = Yii::app()->user->id;
			$model = $this->loadModel($id);
			$this->render('cart',array('model'=>$model,));
	}
	else
	{
	 $this->render('cart');
	}
	}
	
	
	
	
	
	function actionAddcart()
	{

     	if(isset(Yii::app()->session['cart']))
		{
		if(!array_key_exists($_POST['variations'], Yii::app()->session['cart'])) 
		{
		$cart = Yii::app()->session['cart'];
		$cart[ $_POST['variations']]['product_id']  =  $_POST['product_id'];
		$cart[ $_POST['variations']]['amount']  =  $_POST['amount'];
		$cart[ $_POST['variations']]['shipping_amount']  =  $_POST['shipping_amount'];
		$cart[ $_POST['variations']]['variations']  =  $_POST['variations'];
		Yii::app()->session['cart']=$cart;		
		echo "1".'##'.count(Yii::app()->session['cart']);
		}
		else
		{
		echo "0".'##'.count(Yii::app()->session['cart']);
		}
		}
		else
		{
		$cart = Yii::app()->session['cart'];
		$cart[ $_POST['variations']]['product_id']  =  $_POST['product_id'];
		$cart[ $_POST['variations']]['amount']  =  $_POST['amount'];
		$cart[ $_POST['variations']]['shipping_amount']  =  $_POST['shipping_amount'];
		$cart[ $_POST['variations']]['variations']  =  $_POST['variations'];
		Yii::app()->session['cart']=$cart;
		
		echo "1".'##'.count(Yii::app()->session['cart']);
		}
	  }
	  
	  
	  function actionAddbooknow()
	   {
		$cart2 = Yii::app()->session['cart2'];
		$cart2['booknow'][$_POST['variations']]['product_id']  =  $_POST['product_id'];
		$cart2['booknow'][$_POST['variations']]['amount']  =  $_POST['amount'];
		$cart2['booknow'][$_POST['variations']]['shipping_amount']  =  $_POST['shipping_amount'];
		$cart2['booknow'][$_POST['variations']]['cart_type']  =  "buy_now";
		$cart2['booknow'][$_POST['variations']]['variations']  = $_POST['variations'];
		$cart2['booknow'][$_POST['variations']]['type']  =   $_POST['type'];
		Yii::app()->session['cart2']=$cart2;
	   }
	   
	   function actionBooknow()
	   {

	     if(isset(Yii::app()->session['cart2']))
		 {
				if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
				{
				$id = Yii::app()->user->id;
				$model = $this->loadModel($id);
				$this->render('book_now',array('model'=>$model,));
				}
				else
				{
				$this->render('book_now');
				}
	       }
		   else
		   {
		      $this->redirect(array('profile/cart'));
		   }
	   }

  	    /*$carts = MyCart::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'product_id'=>$_POST['product_id']),array('condition' => 'order_id = 0'  ));
	
		if(count($carts)==0)
		{
		$no = rand(5, 50);
		$mycart = new MyCart;
		$mycart->user_id =  Yii::app()->user->id;
		$mycart->product_id =  $_POST['product_id'];
		$mycart->type =  "product";
		$mycart->quantity =  '1';
		$mycart->amount =   $_POST['amount'];
		$mycart->shipping_amount =  $_POST['shipping_amount'];
		$mycart->created =  date('Y-m-d');
		$mycart->save(false);
	      echo "1".'##'.count(Yii::app()->session['cart']);
	 	}
		else
		{
		 echo "0".'##'.count(Yii::app()->session['cart']);;
		}*/
	/* }
	 else
	 {
	            if(isset(Yii::app()->session['cart']))
				{
				if(!array_key_exists($_POST['product_id'], Yii::app()->session['cart'])) 
				{
				$cart = Yii::app()->session['cart'];
				$cart[ $_POST['product_id']]['product_id']  =  $_POST['product_id'];
				$cart[ $_POST['product_id']]['amount']  =  $_POST['amount'];
				$cart[ $_POST['product_id']]['shipping_amount']  =  $_POST['shipping_amount'];
				Yii::app()->session['cart']=$cart;
				
				   echo "1".'##'.count(Yii::app()->session['cart']);
				}
				else
				{
				 echo "0".'##'.count(Yii::app()->session['cart']);
				}
				}
				else
				{
				 $cart = Yii::app()->session['cart'];
				 $cart[ $_POST['product_id']]['product_id']  =  $_POST['product_id'];
				 $cart[ $_POST['product_id']]['amount']  =  $_POST['amount'];
				 $cart[ $_POST['product_id']]['shipping_amount']  =  $_POST['shipping_amount'];
				 Yii::app()->session['cart']=$cart;
				 
				    echo "1".'##'.count(Yii::app()->session['cart']);
				}*/

	 
	 
	 function actionDetailscheckoutbox()
	 {
	 
	   if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
	   {
			    $sub_total = array();
		        $delivery_amount =array();
				
							if(isset(Yii::app()->session['cart']))
							{
							if(count(Yii::app()->session['cart'])>0)
							{
							foreach(Yii::app()->session['cart'] as $key=>$cart)
							{
							array_push($sub_total,$cart['amount']);
							array_push($delivery_amount,$cart['shipping_amount']);
							}
							}
							}
							$sub_total1 =array_sum($sub_total);
				$delivery_amount1 =  array_sum($delivery_amount);
				
				$total = $sub_total1 + $delivery_amount1;
				
	 echo json_encode(array('count'=>count(Yii::app()->session['cart']),'sub_total'=>helpers::to_currency($sub_total1),'delivery_amount'=>helpers::to_currency($delivery_amount1),'total'=>helpers::to_currency($total)));	 

		  }
		  else
		  {
			    $sub_total = array();
		        $delivery_amount =array();
				
							if(isset(Yii::app()->session['cart']))
							{
							if(count(Yii::app()->session['cart'])>0)
							{
							foreach(Yii::app()->session['cart'] as $key=>$cart)
							{
							array_push($sub_total,$cart['amount']);
							array_push($delivery_amount,$cart['shipping_amount']);
							}
							}
							}
							$sub_total1 =array_sum($sub_total);
				$delivery_amount1 =  array_sum($delivery_amount);
				
				$total = $sub_total1 + $delivery_amount1;
				
	 echo json_encode(array('count'=>count(Yii::app()->session['cart']),'sub_total'=>helpers::to_currency($sub_total1),'delivery_amount'=>helpers::to_currency($delivery_amount1),'total'=>helpers::to_currency($total)));	 
		   
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

        function actionRemovefavouritestore($id)
	{
		$model=Profile::model()->findByPk(Yii::app()->user->id);
		$test1 = str_replace($id,"",$model->favourite_products);
		$favourite_products = str_replace(",,",",",$test1);
		$connection = yii::app()->db;
		$sql = "UPDATE user SET favourite_products = '".$favourite_products."' WHERE user_id='".Yii::app()->user->id."' ";
		$command=$connection->createCommand($sql);
		$command->execute();
		echo Profile::model()->favourite_widget($id);
	}
	


	
	function actionDetailsmakefavourite()
	{
			$id =$_POST['product_id'];
			$user = $this->loadModel(Yii::app()->user->id);
			$favourite_products = explode(',',$user->favourite_products);
			$favourite_products[] = $id;
			$favourite_products  = implode(',',$favourite_products);
			$user->favourite_products =    $favourite_products;
			$user->update();
		    echo '<a href="#" class="sc-button light" id="addtofavouritedisable" style="background-color: #444444; color: #fff;  font-style:bold; font-size:15px; margin-left:5px; border-radius:8px; padding: 2px 18px 2px; poacity:0.50">Add to Favorite<img src="'.Yii::app()->request->baseUrl.'/image/heart-red.png"  style="float:right; margin-left:5px;"  ></a><br><br>';				  
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
	
	
	function actionRemovesession($id)
	{
	  $id = helpers::simple_decrypt($id);
	  
	   
	   if ($key = array_key_exists($id,Yii::app()->session['cart'])) {
         unset($_SESSION['cart'][$id]);
       }
	   
	   if(isset(Yii::app()->session['cart1']))
	   {
	    if ($key = array_key_exists($id,Yii::app()->session['cart1']['products'])) {
         unset($_SESSION['cart1']['products'][$id]);
       }
	   }

     Yii::app()->user->setFlash("itemdelete", "Your Item has been deleted successfully.");
	  
	  $this->redirect(array('profile/cart'));
	   
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
	
	
	function actionAddressupdate()
	{
				$address = $_POST['address'].'<br>'.$_POST['city'].'-'.$_POST['pincode'].'<br>'.$_POST['state'].',<br>'.$_POST['country'];
				
				$connection = yii::app()->db;
				$sql = "update userdetails  set  delivery_address ='".$address."' WHERE user_id='".Yii::app()->user->id."' ";
				$command=$connection->createCommand($sql);
				$command->execute();
				echo $address;
	 
	}
	
	public function actionPlaceorder()
			{
				if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
				{
					$id =Yii::app()->user->id;
					$model = $this->loadModel($id);
				}
				
				if(isset($_POST['ids_for_count']))
				{
						$count = explode(',',$_POST['ids_for_count']);
						
						$total_array_count = array_filter($count);
						
						
						$cart1 = Yii::app()->session['cart1'];
						
						for($i=0;$i<count($total_array_count);$i++)
						{
							$cart1['products'][$total_array_count[$i]]['product_id'] =  $total_array_count[$i];
							$cart1['products'][$total_array_count[$i]]['quantity'] =  $_POST['quantity_'.$total_array_count[$i]];
							$cart1['products'][$total_array_count[$i]]['amount']  =  $_POST['amount_values_'.$total_array_count[$i]];
							$cart1['products'][$total_array_count[$i]]['shipping_amount']  =  $_POST['amount_shipping_values_'.$total_array_count[$i]];
							$cart1['products'][$total_array_count[$i]]['total'] = $_POST['total_amount_cart'];
							if(isset($_POST['type']))
							$cart1['products'][$total_array_count[$i]]['type'] = $_POST['type'];
							else
							$cart1['products'][$total_array_count[$i]]['type'] = 'normal';
						Yii::app()->session['cart1']=$cart1;
						}
					//Yii::app()->session['cart1']=$cart1;
				}
				
				if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
				{
					$id =Yii::app()->user->id;
					$model = $this->loadModel($id);
					$this->render('placeorderlast',array('model'=>$model));
				}
				else
				{
				     $this->render('placeorderlast'); 
				}
			}
			
			
	   
	   function actionPlaceorderlast()
	   {
				if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
				{
					 $id =Yii::app()->user->id;
					 $model = $this->loadModel($id);
					 
					 if(isset(Yii::app()->session['cart']) && isset(Yii::app()->session['cart1'])) 
						{
					
							foreach(Yii::app()->session['cart1']['products'] as $key=>$cart1)
							{
							$total = $cart1['total'];
							}

						    $order = new Order;
							$order->user_id =  Yii::app()->user->id;
							$order->total_amount = $total;
							$order->user_type =  '0';
							$order->user_name = $model->first_name.' '.$model->last_name;
							$order->created = date('Y-m-d');
							$order->status = "Accepted";
							$order->save(false); 

						
							if(isset(Yii::app()->session['cart1']))
							{
								foreach(Yii::app()->session['cart1']['products'] as $key=>$cart)
								{
								$mycart1 = new MyCart;
								$mycart1->user_id = Yii::app()->user->id;
								$mycart1->product_id = $cart['product_id'];
								$mycart1->type =  "product";
								$mycart1->quantity =  $cart['quantity'];
								$mycart1->amount =  $cart['amount'];
								$mycart1->shipping_amount =  $cart['shipping_amount'];
								$mycart1->temp_total_amount =  $cart['total'];
								$mycart1->order_id = '454354'.$order->id;
								$mycart1->user_type =  0;
								$mycart1->created =  date('Y-m-d');
								$mycart1->save(false);
								}
						}

							$FromName = helpers::configs()->company_email;	
							$to  =  $model->email;
							$message = $this->renderPartial('emailpage', array('model'=>$model),true);
							$subject = "Order Confirmation - Your order has been successfully placed!"; 
				            User::model()->mailsend($to,$FromName,$subject,$message);
                                                           $subject2 = "New Order"; 
							$message1 = $this->renderPartial('emailpageadmin', array('model'=>$model),true);
				            User::model()->mailsend($FromName,$FromName,$subject2,$message1);
				
					  $this->render('securepayment',array('model'=>$model));
					}
					else if(isset(Yii::app()->session['cart2']))
					{
					
					if(isset($_POST['product_id']))
					{
					$cart2 = Yii::app()->session['cart2'];
					$cart2['booknow'][$_POST['variations']][$_POST['product_id']]  =  $_POST['product_id'];
					$cart2['booknow'][$_POST['variations']]['amount']  =  $_POST['amount_values_'.$_POST['product_id']];
					$cart2['booknow'][$_POST['variations']]['total']  =  $_POST['amount_values_'.$_POST['product_id']] + $_POST['amount_shipping_values_'.$_POST['product_id']] ;
					$cart2['booknow'][$_POST['variations']]['shipping_amount']  = $_POST['amount_shipping_values_'.$_POST['product_id']];
					$cart2['booknow'][$_POST['variations']]['cart_type']  =  "buy_now";
					$cart2['booknow'][$_POST['variations']]['quantity']  =  $_POST['quantity_'.$_POST['product_id']];
					$cart2['booknow'][$_POST['variations']]['variations']  = $_POST['variations'];
					$cart2['booknow'][$_POST['variations']]['type']  =   $_POST['type'];
					Yii::app()->session['cart2']=$cart2;
					}
					 
							foreach(Yii::app()->session['cart2']['booknow'] as $key=>$cart1)
							{
							$total = $cart1['total'];
							}

						    $order = new Order;
							$order->user_id =  Yii::app()->user->id;
							$order->total_amount = $total;
							$order->user_type =  '0';
							$order->user_name = $model->first_name.' '.$model->last_name;
							$order->created = date('Y-m-d');
							$order->status = "Accepted";
							$order->save(false); 

						
							if(isset(Yii::app()->session['cart2']))
							{
								foreach(Yii::app()->session['cart2']['booknow'] as $key=>$cart)
								{
								$mycart1 = new MyCart;
								$mycart1->user_id = Yii::app()->user->id;
								$mycart1->product_id = $cart['product_id'];
								$mycart1->type =  "product";
								$mycart1->quantity =  $cart['quantity'];
								$mycart1->amount =  $cart['amount'];
								$mycart1->shipping_amount =  $cart['shipping_amount'];
								$mycart1->temp_total_amount =  $cart['total'];
								$mycart1->order_id = '454354'.$order->id;
								$mycart1->user_type =  0;
								$mycart1->created =  date('Y-m-d');
								$mycart1->save(false);
								}
						}

							$FromName = helpers::configs()->company_email;	
							$to  =  $model->email;
							$message = $this->renderPartial('emailpage', array('model'=>$model),true);
							$subject = "Order Confirmation - Your order has been successfully placed!"; 
				            User::model()->mailsend($to,$FromName,$subject,$message);
							$message1 = $this->renderPartial('emailpageadmin', array('model'=>$model),true);
                                                   $subject2 = "New Order";
				            User::model()->mailsend($FromName,$FromName,$subject2,$message1);
				
					  $this->render('securepayment',array('model'=>$model));
					
					}
					else
						{
							Yii::app()->user->setFlash('success',' Thank you for your purchase from Temples Unlimited.');
							
							$this->redirect(array('profile/cart'));
						}
				}
				else
				{
						$model = new Nonsiteuser;
						
						
						if(isset($_POST['product_id']))
						{
						$cart2 = Yii::app()->session['cart2'];
						$cart2['booknow'][$_POST['variations']][$_POST['product_id']]  =  $_POST['product_id'];
						$cart2['booknow'][$_POST['variations']]['amount']  =  $_POST['amount_values_'.$_POST['product_id']];
						$cart2['booknow'][$_POST['variations']]['total']  =  $_POST['amount_values_'.$_POST['product_id']] + $_POST['amount_shipping_values_'.$_POST['product_id']] ;
						$cart2['booknow'][$_POST['variations']]['shipping_amount']  = $_POST['amount_shipping_values_'.$_POST['product_id']];
						$cart2['booknow'][$_POST['variations']]['cart_type']  =  "buy_now";
						$cart2['booknow'][$_POST['variations']]['quantity']  =  $_POST['quantity_'.$_POST['product_id']];
						$cart2['booknow'][$_POST['variations']]['variations']  = $_POST['variations'];
						$cart2['booknow'][$_POST['variations']]['type']  =   $_POST['type'];
						Yii::app()->session['cart2']=$cart2;
						}
						if(isset($_POST['Nonsiteuser']))
						{
						$model->attributes=$_POST['Nonsiteuser'];
						
						$this->performAjaxValidation($model);  
						// validate user input and redirect to the previous page if valid
						if($model->validate())
						{
						$nonsite = Yii::app()->session['nonsite'];
						
						$nonsite['name'] = $_POST['Nonsiteuser']['name']; 
						$nonsite['email'] = $_POST['Nonsiteuser']['email']; 
						$nonsite['address'] = $_POST['Nonsiteuser']['address']; 
						$nonsite['city'] = $_POST['Nonsiteuser']['city']; 
						$nonsite['state'] = $_POST['Nonsiteuser']['state']; 
						$nonsite['country'] = $_POST['Nonsiteuser']['country']; 
						$nonsite['postal_code'] = $_POST['Nonsiteuser']['postal_code']; 
						Yii::app()->session['nonsite']=$nonsite;
						$this->redirect(array('profile/securepayment'));
						}
						}
						$this->render('placeorder_new',array('model'=>$model)); 
				}
	   }
	   
	   
	   
	   function actionSecurepaymentwithiyer()
		{
				if(isset(Yii::app()->user->id) && Yii::app()->user->id!='')
				{
				
				 if(isset($_REQUEST['id']))
				 Yii::app()->session['securepaymentwithiyer'] = $_REQUEST['id'];
				 
				$this->render('securepaymentwithiyer');
				}
				else
				{
				 Yii::app()->session['securepaymentwithiyer'] = $_REQUEST['id'];
				$this->redirect(array('/login'));
				}
		}
	   
	   


	 
	 function actionSecurepayment()
	 {
	 	
			if(isset(Yii::app()->session['cart']) && isset(Yii::app()->session['cart1']))
				{
				$model = new Nonsiteuser;
				$nonsite = Yii::app()->session['nonsite'];
				$model->name = $nonsite['name'];
				$model->email = $nonsite['email']; 
				$model->address = $nonsite['address']; 
				$model->city = $nonsite['city']; 
				$model->state = $nonsite['state']; 
				$model->country = $nonsite['country']; 
				$model->postal_code = $nonsite['postal_code'];
				$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);  
				$model->ip_address = $ip;
				$model->created = date('Y-m-d');
				$model->save();
				
				if(isset(Yii::app()->session['cart1']))
				{
						foreach(Yii::app()->session['cart1']['products'] as $key=>$cart)
						{
							$mycart1 = new MyCart;
							$mycart1->user_id = $model->id;
							$mycart1->product_id = $cart['product_id'];
							$mycart1->type =  "product";
							$mycart1->quantity =  $cart['quantity'];
							$mycart1->amount =  $cart['amount'];
							$mycart1->shipping_amount =  $cart['shipping_amount'];
							$mycart1->temp_total_amount =  $cart['total'];
							$mycart1->address =  $model->address;
							$mycart1->order_id =  $model->id;
							$mycart1->user_type =  1;
							$mycart1->created =  date('Y-m-d');
							$mycart1->save(false);
						}
				}
				
				$FromName = helpers::configs()->company_email;
				$to  =  Yii::app()->session['nonsite']['email'];
				$message = $this->renderPartial('emailpage', array('model'=>$model),true);
				$subject = "Order Confirmation - Your order has been successfully placed!"; 
				User::model()->mailsend($to,$FromName,$subject,$message);
				$message1 = $this->renderPartial('emailpageadmin', array('model'=>$model),true);
				User::model()->mailsend($FromName,$FromName,$subject2,$message1);
				$this->render('securepayment');				
				}
			else
				{
				
						if(isset(Yii::app()->session['cart2']))
							{
							$model = new Nonsiteuser;
							$nonsite = Yii::app()->session['nonsite'];
							$model->name = $nonsite['name'];
							$model->email = $nonsite['email']; 
							$model->address = $nonsite['address']; 
							$model->city = $nonsite['city']; 
							$model->state = $nonsite['state']; 
							$model->country = $nonsite['country']; 
							$model->postal_code = $nonsite['postal_code'];
							$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);  
							$model->ip_address = $ip;
							$model->created = date('Y-m-d');
							$model->save();
							
							if(isset(Yii::app()->session['cart2']))
							{
							foreach(Yii::app()->session['cart2']['booknow'] as $key=>$cart)
							{
							$mycart1 = new MyCart;
							$mycart1->user_id = $model->id;
							$mycart1->product_id = $cart['product_id'];
							$mycart1->type =  $cart['type'];
							$mycart1->quantity =  $cart['quantity'];
							$mycart1->amount =  $cart['amount'];
							$mycart1->shipping_amount =  $cart['shipping_amount'];
							$mycart1->temp_total_amount =  $cart['total'];
							$mycart1->address =  $model->address;
							$mycart1->order_id =  $model->id;

							$mycart1->user_type =  1;
							$mycart1->created =  date('Y-m-d');
							$mycart1->save(false);
							}
							}
							$FromName = helpers::configs()->company_email;
							$to  =  Yii::app()->session['nonsite']['email'];
							$message = $this->renderPartial('emailpage', array('model'=>$model),true);
							$subject = "Order Confirmation - Your order has been successfully placed!"; 
							User::model()->mailsend($to,$FromName,$subject,$message);
							$message1 = $this->renderPartial('emailpageadmin', array('model'=>$model),true);
$subject2 = "New Order";
							User::model()->mailsend($FromName,$FromName,$subject2,$message1);
							$this->render('securepayment');				
							}
							else
							{
								Yii::app()->user->setFlash('success',' Thank you for your purchase from Temples Unlimited.');
								
								unset(Yii::app()->session['nonsite']);
								
								$this->redirect(array('profile/cart'));
							}
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
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	   public  function actionMakeusprimaryphoto($id)
	   {
                        $connection = yii::app()->db;
						$sql = "UPDATE images SET make_as_primary = '0' WHERE 	item_id='".Yii::app()->user->id."' ";
						$command=$connection->createCommand($sql);
						$command->execute();
						$model = Images::model()->findByPk($id);
						$model->make_as_primary ='1';
						$model->save();
						
					    $useriamgesupdate = User::model()->findByPk(Yii::app()->user->id);
						$useriamgesupdate->primary_image = $model->image_path;
						$useriamgesupdate->update();
						
						echo 'primary'; die;
	  }	
	  
	  
	  public function actionIyeractivity()
	  {
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$iyerpoojas=new Iyerpoojas('search');
			$this->render('iyeractivity',array(
			'model'=> $model,
			'iyerpoojas'=>$iyerpoojas,
			));
	  }
	  
	  
	 public function actionView($id)
	{
		$user_id =Yii::app()->user->id; 
		$model = $this->loadModel($user_id);
		$iyerpoojas = Iyerpoojas::model()->findByPk($id);
		$this->render('iyerpoojas/view',array(
		'iyerpoojas'=>$iyerpoojas,
		'model'=>$model,
		));
	}
	
	public function actionCreate()
	{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id);
			$iyerpoojas=new Iyerpoojas;
			$this->performAjaxValidation($iyerpoojas);		
			$iyer_details = Iyer::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
			$iyer_categories = explode(',',$iyer_details->iyer_categories);
			$iyer_categories = array_filter($iyer_categories);

	     	if(isset($_POST['Iyerpoojas']))
			{
			$iyerpoojas->attributes=$_POST['Iyerpoojas'];
			if(is_array($_POST['Iyerpoojas']['mantra_language']))
			$iyerpoojas->mantra_language = implode(',',$iyerpoojas->mantra_language);

			$iyerpoojas->discount_percentage = $_POST['Iyerpoojas']['discount_percentage']; 
			$iyerpoojas->user_id = Yii::app()->user->id;
			$iyerpoojas->discount_dates_from = $_POST['Iyerpoojas']['discount_dates_from']; 
			$iyerpoojas->discount_dates_to = $_POST['Iyerpoojas']['discount_dates_to']; 
			$iyerpoojas->status = '0';
			$iyerpoojas->created = date('d-m-y');
			$categories = '';
			if(!in_array($_POST['Iyerpoojas']['category_id'],$iyer_categories))
			{
			array_push($iyer_categories,$_POST['Iyerpoojas']['category_id']);
			for($j=0;$j<count($iyer_categories);$j++)
			{
			$categories .=$iyer_categories[$j].',';
			}
			}
			else
			$categories .= $iyer_details->iyer_categories; 
			
			$connection = yii::app()->db;
			$sql = "UPDATE iyer SET iyer_categories = '".$categories."' WHERE user_id='".Yii::app()->user->id."' ";
			$command=$connection->createCommand($sql);
			$command->execute();
			if($iyerpoojas->save())
			$this->redirect(array('view','id'=>$iyerpoojas->id));
			}

		$this->render('iyerpoojas/create',array(
			'iyerpoojas'=>$iyerpoojas,
			'model'=>$model,

		));
	
	}
	
	  protected function performAjaxValidation($model)
		{
		if(isset($_POST['ajax']) && $_POST['ajax']==='iyerpoojas-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}	
	
	
	public function actionUpdate($id)
	{
	   $user_id =Yii::app()->user->id; 
       $model = $this->loadModel($user_id);
	   $iyerpoojas = Iyerpoojas::model()->findByPk($id);
	   $this->performAjaxValidation($iyerpoojas);
		$iyer_details = Iyer::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
		$iyer_categories = explode(',',$iyer_details->iyer_categories);
		$iyer_categories = array_filter($iyer_categories);

	     if(isset($_POST['Iyerpoojas']))
			{
			$iyerpoojas->attributes=$_POST['Iyerpoojas'];
			if(is_array($_POST['Iyerpoojas']['mantra_language']))
			$iyerpoojas->mantra_language = implode(',',$iyerpoojas->mantra_language);

			$iyerpoojas->discount_percentage = $_POST['Iyerpoojas']['discount_percentage']; 
			$iyerpoojas->user_id = Yii::app()->user->id;
			$iyerpoojas->discount_dates_from = $_POST['Iyerpoojas']['discount_dates_from']; 
			$iyerpoojas->discount_dates_to = $_POST['Iyerpoojas']['discount_dates_to']; 
			$iyerpoojas->status = '0';
			$categories = '';
			if(!in_array($_POST['Iyerpoojas']['category_id'],$iyer_categories))
			{
			array_push($iyer_categories,$_POST['Iyerpoojas']['category_id']);
			for($j=0;$j<count($iyer_categories);$j++)
			{
			$categories .=$iyer_categories[$j].',';
			}
			}
			else
			$categories .= $iyer_details->iyer_categories; 
			
			$connection = yii::app()->db;
			$sql = "UPDATE iyer SET iyer_categories = '".$categories."' WHERE user_id='".Yii::app()->user->id."' ";
			$command=$connection->createCommand($sql);
			$command->execute();
			
			if($iyerpoojas->save())
			$this->redirect(array('view','id'=>$iyerpoojas->id));
			}
	   
	   
	   $this->render('iyerpoojas/update',array(
			'iyerpoojas'=>$iyerpoojas,
			'model'=>$model,

		));
	}

    public function actionDelete($id)
	{
		$post=Iyerpoojas::model()->findByPk($id);
        $post->delete();
		if(!isset($_GET['ajax']))
		 $this->redirect(array('iyeractivity'));
	}
	
	 function actionIyernodification()
		{
		$user_id =Yii::app()->user->id; 
		$model = $this->loadModel($user_id);
		$criteria = new CDbCriteria();
		$condition  = ' user_id = '.$user_id.' ';
		$criteria->condition  =  $condition;
                $criteria->order = 'id DESC';
		$result = BookedTable::model()->findAll($criteria);	
		
		$criteria1 = new CDbCriteria();
		$condition  = ' user_id = '.$user_id.' ';
		$condition  .= ' and iyer_status =" "';
		$criteria1->condition  =  $condition;
                 $criteria1->order = 'id DESC';
		$count_notify = BookedTable::model()->findAll($criteria1);
		$iyer_notification = new CArrayDataProvider($result);

		$criteria2 = new CDbCriteria();
		$condition2  = ' to_id = '.$user_id.' ';
		$criteria2->condition  =  $condition2;
                $criteria2->order = 'id DESC';
		$queries_nodify = Queries::model()->findAll($criteria2);
		$result2 = Queries::model()->findAll($criteria2);
		$queries_notification = new CArrayDataProvider($result2);	

		
		$this->render('iyer_nodification', array(
		'model' =>$model,
		'iyernodification'=>$iyer_notification,
		'count_notify'=>$count_notify,
		'queries_notification'=>$queries_notification,
		'queries_nodify'=>$queries_nodify,
		));
		}
	  
	  function actionIyerupdates()
	  {
	     $option = $_POST['option'];
		
		 $id = $_POST['id'];
		
		 $booked_table = BookedTable::model()->findByPk($id);
		 
		 $booked_table->iyer_status = $option;

		 if($option=='yes')
		 {
			$id1 =Yii::app()->user->id;
			$model = $this->loadModel($booked_table->from_user);
                        
                        
                        $model1 = $this->loadModel($booked_table->user_id);
			
			if($booked_table->type=='iyer')
			$booked_user = 'iyer';
			else
			$booked_user = 'guide';
			
			$subject = 'Accept your request..please paid amount to '.$booked_user.'';
			
			$message = $model->first_name.' '.$model->last_name.', <br/><br/><br/><br/> The '.$booked_user.' accept your request for booking process.please paid amount for, click on the link below or copy and paste the URL into your browser:<a target="_blank" href="'.Yii::app()->params['SITE_BASE_URL'].'/front/profile/securepaymentwithiyer?id='.$id.'">Click here to paid amount</a> <br/><br/>If you are already paid,please ignore this mail.<br><br> Best regards,<br/>The TemplesUnlimited Team.';
			
			$from = helpers::configs()->company_email;
			
			User::model()->mailsend($model->email,$from,$subject,$message);
                        
                        $subject1 = " The '.$model1->first_name.' '.$model->last_name.' ('.$booked_user.') accept the request From $model->first_name.' '.$model->last_name.' ";
                        
                        $message1 = $model1->first_name.' '.$model1->last_name.' ('.$booked_user.') , <br/><br/><br/><br/> The '.$booked_user.' accept your request for booking process from '.$model->first_name.' '.$model->last_name.'.please see the admin for full details.<br/><br/>If you are already paid,please ignore this mail.<br><br> Best regards,<br/>The TemplesUnlimited Team.';
                        
                        User::model()->mailsend($from,$from,$subject1,$message1);

			$connection = yii::app()->db;
                        $sql = "update booked_table set  iyer_status='no' WHERE book_date='".$booked_table->book_date."' and type='".$booked_user."' and id!='".$_POST['id']."' ";
			$command=$connection->createCommand($sql);
			$command->execute();

		 }
	$booked_table->update(false);										  
		 
	  }

	function actionIyerinitial()
		{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id); 
			$datasaved = 0;
			$detailsmodel = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));	
			if(isset($_POST['experience']) )
			{  	
			$detailsmodel->iyer_experience =$_POST['experience'];
			$detailsmodel->iyer_experience_type =$_POST['experience_type'];
			}
			if(isset($_POST['amount']) ){	
			$detailsmodel->iyer_amount = $_POST['amount'];
			}
    		if(isset($_POST['iyer_wh']))
			{
			$detailsmodel->iyer_wh = $_POST['iyer_wh'];
			}
			if(isset($_POST['currency_type']))
			{	
			$detailsmodel->iyer_amount_option =$_POST['currency_type'];
			}
			
			if(isset($_POST['overview']))
			{	
			$detailsmodel->iyer_overview =$_POST['overview'];
			$detailsmodel->availability_dates = date('Y-m-d');
			}
			
			$detailsmodel->update();
			
			$this->redirect(array('profile/user'));
	}	
	
	
	function actionGuideinitial()
		{
			$id =Yii::app()->user->id;
			$model = $this->loadModel($id); 
			$datasaved = 0;
			$detailsmodel = Guide::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));	
			if(isset($_POST['experience']) )
			{  	
			$detailsmodel->guide_experience =$_POST['experience'];
			$detailsmodel->guide_experiencetype =$_POST['experience_type'];
			}
			if(isset($_POST['amount']) ){	
			$detailsmodel->guide_amount = $_POST['amount'];
			}
    		if(isset($_POST['guide_wh']))
			{
			$detailsmodel->guide_wh = $_POST['guide_wh'];
			}
			if(isset($_POST['currency_type']))
			{	
			$detailsmodel->guide_amount_option =$_POST['currency_type'];
			}
			
			if(isset($_POST['services']))
			{	
			$detailsmodel->guide_services =  implode(',',$_POST['services']);
			}
			
			
			if(isset($_POST['overview']))
			{	
			$detailsmodel->guide_overview =$_POST['overview'];
			$detailsmodel->availability_dates = date('Y-m-d');
			}
			
			$detailsmodel->update();
			
			$this->redirect(array('profile/user'));
	}
	
	
			function actionImagesave()	
			{	
				$img=$_POST['imgBase64'];
				$img = str_replace('data:image/png;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$file = Yii::getPathOfAlias('webroot')."/uploads/image.png";
				$success = file_put_contents($file, $data);
			}
			
			function actionUsernotify()
			{
						$user_id =Yii::app()->user->id; 
						$model = $this->loadModel($user_id);
						$criteria = new CDbCriteria();
						$condition  = ' from_user = '.$user_id.' and user_status="0" ';
						$criteria->condition  =  $condition;
						$criteria->order = 'id DESC';
						$result = BookedTable::model()->findAll($criteria);	

 					    $user_notification = new CArrayDataProvider($result);
						$this->render('usernodify', array(
						'model' =>$model,
						'result'=>$result,
						'user_notification'=>$user_notification,
						));
		
			}
                        
                        function actionDeleteusernodify()
                        {
                                 $id =$_POST['id'];
                                 $result = BookedTable::model()->findByPk($id);
                                 $result->user_status = 1;
                                 Yii::app()->user->setFlash('success','Notification has been successfully deleted.');
                                 $result->update();
                        }
                        
                 

}
?>
