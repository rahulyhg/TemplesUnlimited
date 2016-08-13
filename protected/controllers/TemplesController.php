<?php

class TemplesController extends Controller
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
		$model=new Temples;
		
       $this->performAjaxValidation($model);  
	   
	   $model->scenario='create';


		if(isset($_POST['Temples']))
		{
			$model->attributes=$_POST['Temples'];
			
			if($model->validate())
			{
			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'main_image');
			
			
            $fileName = "{$rnd}-{$uploadedFile}";  
			 
			 
			  if(!empty($uploadedFile))
			  {
			  $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
			
			  list($width, $height, $type, $attr) = getimagesize(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName); 

				if($width>=400 && $height>=600)
				{
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->resize(200, 160);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/main_image/'.$fileName);
				   $model->main_image = $fileName;
				   
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->resize(290, 220);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/slider/'.$fileName);

				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->resize(650, 450);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/detail/'.$fileName);
				   
				   
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->adaptiveResize(70, 70);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/review/'.$fileName);
				   
				   unset(Yii::app()->session['width']);
				   
				   $model->created_on = date('Y/m/d');
				   
				   if($model->save())
					$this->redirect(array('view','id'=>$model->id));
				   }
				   else
				   {
					Yii::app()->session['width'] = 'Image size must be greater then 400*600(Width*height).';
				   }
			  }		
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

	

		if(isset($_POST['Temples']))
		{
		
		$model->attributes=$_POST['Temples'];
		
		
			$rnd = rand(0,9999);  
			
			$uploadedFile=CUploadedFile::getInstance($model,'main_image');

             $fileName = "{$rnd}-{$uploadedFile}";  
			 
			 
			  if(!empty($uploadedFile))
			  {
			   $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
			
			    list($width, $height, $type, $attr) = getimagesize(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName); 

				if($width>=400 && $height>=600)
				{
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->resize(200, 160);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/main_image/'.$fileName);
				   $model->main_image = $fileName;
				   
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->resize(290, 220);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/slider/'.$fileName);
				   
				   
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->resize(650, 450);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/detail/'.$fileName);
				   
				   
				   $thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/temple_images/'.$fileName);
				   $thumb->adaptiveResize(70, 70);
				   $thumb->save(Yii::getPathOfAlias('webroot').'/temple_images/review/'.$fileName);
				   
				   unset(Yii::app()->session['width']);
 
				     $model->updated_on = date('Y/m/d');
				     $model->latitude = $_POST['Temples']['latitude'];
				     $model->logtitute = $_POST['Temples']['logtitute'];
					 $model->featured_listing = $_POST['Temples']['featured_listing'];
				    if($model->save())
					$this->redirect(array('view','id'=>$model->id));
				   }
				   else
				   {
					Yii::app()->session['width'] = 'Image size must be greater then 400*600(Width*height).';
				   }
				   }
				   else
				   {
				     $model->updated_on = date('Y/m/d');
				     $model->latitude = $_POST['Temples']['latitude'];
				     $model->logtitute = $_POST['Temples']['logtitute'];
					 $model->featured_listing = $_POST['Temples']['featured_listing'];
				   }
				   
		 if($model->save())
		  $this->redirect(array('view','id'=>$model->id));
			  	
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
		$dataProvider=new CActiveDataProvider('Temples');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Temples('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Temples']))
			$model->attributes=$_GET['Temples'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
		$model=Temples::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Temples $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='temples-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Performs Temple Gallery.
	 * @param Temples $model the model to be validated
	 */
	public function actionGallery($id)
	{
		$model = $this->loadModel($id);
		$gallery = new Gallery;
		$gallery->temple_id = $id;
		
		
		
		
		 if(isset($_POST['Gallery'])) {
		 if(count($_POST['Gallery'])){
		 if(!is_dir(Yii::getPathOfAlias('webroot').'/temple_images/gallery/'. $model->id)) {
		   mkdir(Yii::getPathOfAlias('webroot').'/temple_images/gallery/'. $model->id);
		   //chmod(Yii::getPathOfAlias('webroot').'/images/ADD YOUR PATH HERE!/'. $model->name)), 0755); 
		   // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
		}
		
		 if(!is_dir(Yii::getPathOfAlias('webroot').'/temple_images/gallery/thumb/'. $model->id)) {
		   mkdir(Yii::getPathOfAlias('webroot').'/temple_images/gallery/thumb/'. $model->id);
		   //chmod(Yii::getPathOfAlias('webroot').'/images/ADD YOUR PATH HERE!/'. $model->name)), 0755); 
		   // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
		}
 
          
			
			
			Yii::app()->setComponents(array('ThumbsGen' => array(
				'class' => 'ext.ThumbsGen.ThumbsGen',
				'scaleResize' => null, //if it is not null $thumbWidth and $thumbHeight will be ommited. for example 'scaleResize'=>0.5 generate image with half dimension
				//one of $thumbWidth or $thumbHeight is optional but not both!
				'thumbWidth' => 150, //the width of created thumbnail on pixel. if height is null the aspect ratio will be reserved
				'thumbHeight' => 150, //the height of created thumbnail on pixel. if width is null the aspect ratio will be reserved
				'baseSourceDir' =>  Yii::getPathOfAlias('webroot').'/temple_images/gallery/'. $model->id.'/', //the main direcory of source images. if set to null the destination dir is the <webroot>/images
				'baseDestDir' => Yii::getPathOfAlias('webroot').'/temple_images/gallery/thumb/'. $model->id.'/', //the main direcory of thumbnails. if set to null the destination dir is the <webroot>/images/thumbs
				'postFixThumbName' => '', //the postfix name of thumbnail for example if it set = '_thumb' then  image1.jpg become image1_thumb.jpg
				'recreate' => true, //force to create each thumbnail either exist or not, when is set to false the tumbnails created only in the first time
						  )));
 
                // go through each uploaded image
                foreach ($_POST['Gallery'] as $image => $pic) {
				  
                    //echo $pic->name.'<br />';
                    if (isset($_FILES['Gallery']['name'][$image]['image_path'])) {
					 $picname = time().str_replace(array(' ','&','?','<','>',':'),'',$_FILES['Gallery']['name'][$image]['image_path']);
					 $picpath = Yii::getPathOfAlias('webroot').'/temple_images/gallery/'. $model->id.'/'.$picname;
					   move_uploaded_file($_FILES['Gallery']['tmp_name'][$image]['image_path'], $picpath);            // add it to the main model now						
						$picthumbpath = Yii::getPathOfAlias('webroot').'/temple_images/gallery/thumb/'. $model->id.'/'.$picname;
						Yii::app()->ThumbsGen->createthumb($picpath,$picthumbpath);
                        $img_add = new Gallery;
                        $img_add->image_path =  'temple_images/gallery/'. $model->id.'/'.$picname; //it might be $img_add->name for you, filename is just what I chose to call it in my model
						$img_add->image_thumb_path = 'temple_images/gallery/thumb/'. $model->id.'/'.$picname;
						$img_add->image_caption = $pic['image_caption'];						
                        $img_add->temple_id = $model->id; // this links your picture model to the main model (like your user, or profile model)
						$img_add->created_on = date('Y-m-d H:i:s'); 
                        $img_add->save(); // DONE
                    }
                        // handle the errors here, if you want
                }
 
                // save the rest of your information from the form
                    $this->refresh();
          
		   }	
        }
		
		
		$galleryimages = Gallery::model()->findAll('temple_id=:temple_id',array(':temple_id'=>$id));
		
		
		
		
		$this->render('gallery',array(
			'model'=>$model,
			'gallery'=>$gallery,
			'galleryimages'=>$galleryimages,
		));
		
	}
	
	public function actionGalleryimage_form($key)
	{
		$gallery = new Gallery;
		echo  $this->renderPartial('gallery_form', array(
			'gallery'=>$gallery,
			'key'=>$key,
		),true);		 die;
	}	
	
	function actionRemove_galleryimage($id){
		$gallery = Gallery::model()->findByPK($id);
		unlink(Yii::getPathOfAlias('webroot').'/'.$gallery->image_path);
		unlink(Yii::getPathOfAlias('webroot').'/'.$gallery->image_thumb_path);
		$gallery->delete();
		echo 'removed'; die;
	}
	
    public function actionStatus($id,$st)
	{
		$data=$this->loadModel($id);
		if($st == '1')
	    $data->is_active = '0';
		else
		 $data->is_active = '1';
		$data->update();
		
		
		$this->redirect(array('admin'));
	}
	
}
