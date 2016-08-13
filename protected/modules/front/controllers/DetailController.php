<?php

class DetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '/layouts/main';	  
public $pageimage ='';
public $title ='';
public $desc ='';
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
		  
		   $userid =Yii::app()->user->id;
		  
		   $user_deatils = User::model()->getinfo($userid); 

		  
	   	   $model = Temples::model()->getinfo($id); 
		   
		   $this->pageTitle = $model->temple_name.' | Temples List | Temples Unlimited';
		   
			$this->render('temple', array(
				'model' => $model,
				'user'=>$user_deatils,
			));
	   
	}
	
	
	
	function actionProduct($id){
			   $id = helpers::simple_decrypt($id);
			   
			   $model = Storeproducts::model()->getinfo($id);   
				$this->render('product', array(
					'model' => $model,
				));
    }
	
	function actionBlogdetails($id)
	{
	  $id = helpers::simple_decrypt($id);
	  
	   $model = Blogs::model()->getinfo($id); 
	   
	   $this->render('blog', array(
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
	
	
	function actionPoojaold($id)
	{
	    $id = helpers::simple_decrypt($id);
	   	$model = Pooja::model()->getinfo($id); 


  $this->pageTitle = $model->pooja_name.' - Pooja Details - Temples Unlimited';
  $this->pageimage = $model->pooja_image;
  $this->title = $model->pooja_name;
  $this->desc = $model->pooja_overview;

  		   
		  $this->render('epooja_old', array(
				'model' => $model,
			)); 
	}
	
	
	function actionStoreold($id)
	{
	
	    $id1 =Yii::app()->user->id;
		$criteria1 = new CDbCriteria();
		$condition1 ='';
		$condition1 .= ' `user_id` ="'.$id1.'" ' ;
		$criteria1->condition =  $condition1;
		$count1 = MyCart::model()->count($criteria1);
		$pages = new CPagination($count1);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria1);
		$dataProvider1 = MyCart::model()->findAll($criteria1);

		$sub_total = array();
		$delivery_amount =array();
		
		for($i=0;$i<count($dataProvider1);$i++)
		{
		  $products = Storeproducts::model()->findByPK($dataProvider1[$i]->product_id); 
		  array_push($sub_total,$products->product_price);
		  array_push($delivery_amount,$products->product_shipping_price);
		}
		 
		Yii::app()->session['item_count'] = count($dataProvider1);
		Yii::app()->session['sub_total'] = array_sum($sub_total);
		Yii::app()->session['delivery_amount'] = array_sum($delivery_amount);
		
		/*echo json_encode(array('count'=>Yii::app()->session['item_count'],'sub_total'=>Yii::app()->session['sub_total'] ,'delivery_amount'=> Yii::app()->session['delivery_amount']));*/
		
		
	$id = helpers::simple_decrypt($id);
			   $model = Storeproducts::model()->getinfo($id); 
 $this->pageTitle = $model->product_name.' - Store Details - Temples Unlimited';
  $this->pageimage = $model->product_image;
  $this->title = $model->product_name;
  $this->desc = $model->product_overview;
  
				$this->render('store_old', array(
					'model' => $model,
				));
	}
	
	function actionNews($id){
	       $id = helpers::simple_decrypt($id);
	   	   $model = News::model()->getinfo($id); 
		   
		   $this->pageTitle = $model->news_title.' - News Details - Temples Unlimited';
		   
		   Yii::app()->session['news_id'] = $id;
		   
		     
			$this->render('news_details', array(
				'model' => $model,
			));
	}
	
	
	function actionIyer($id){
		 $id = helpers::simple_decrypt($id);
		
		$model = User::model()->findByPK($id);
		$model->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$id));
		 $this->render('iyer', array(
					'model' => $model,
		));
	}
	
		function actionGuide($id){
		$id = helpers::simple_decrypt($id);
		$model = User::model()->findByPK($id );
		$model->guidemoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$id));
		$model->guideactivities = Guidetemple::model()->findAll('user_id=:user_id',array(':user_id'=>$id ));
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

                     Yii::app()->session['event_id'] = $id;
	   	    $model = Events::model()->getinfo($id); 
			
		    $this->pageTitle = $model->event_name.' - News & Events - Temples Unlimited';
			
		    $ip = $_SERVER['REMOTE_ADDR'];
			
			$ip_address =explode(',',$model->ip_address);
			
		  if(!in_array($ip,$ip_address))
		  {
		     array_push($ip_address,$ip);
			 
			  $ip_add ='';
		  
				for($i=0;$i<count($ip_address);$i++)
				{
				    if($ip_address[$i]!='')
				    $ip_add .= $ip_address[$i].',';
				}
			$views_count  =  $model->views + 1;	
			 Yii::app()->session['views_count'] = $views_count;
			$command = Yii::app()->db->createCommand();
			$sql=' update events set ip_address="'.$ip_add.'",views ="'.$views_count.'" where event_id=:event_id';
			$params = array("event_id" =>$id,);
			$command->setText($sql)->execute($params);
		  }
		
			$this->render('event_details', array(
				'model' => $model,
			));
	}
	
	
	function  actionAddcart()
	{
	   $poojaid = $_POST['pooja_id'];
	   $this->renderPartial('add_cart',array('pooja_id'=>$poojaid)); 
	}
	
	function actionQueries()
	{
	$id = $_POST['id'];

	
	   if($_POST['type']=='temple')
	   {
	      $topic = "Queries about Temple";
		  $toname = $_POST['temple_name'];
		  
		  $redirect = "<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#339999; margin-top:-20px;'><strong><a target='_blank' href=".Yii::app()->params['SITE_BASE_URL'].'/front/detail/temple/id/'.helpers::simple_encrypt($_POST['id']).">".Yii::app()->params['SITE_BASE_URL'].'/front/detail/temple/id/'.helpers::simple_encrypt($_POST['id'])."</a></strong></td>";
	   }
	   else if($_POST['type']=='iyer')
	   {
	        $topic = "Queries about Iyer";
		     $redirect = "<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#339999; margin-top:-20px;'><strong><a target='_blank' href=".Yii::app()->params['SITE_BASE_URL'].'/front/detail/iyer/id/'.helpers::simple_encrypt($_POST['id']).">".Yii::app()->params['SITE_BASE_URL'].'/front/detail/iyer/id/'.helpers::simple_encrypt($_POST['id'])."</a></strong></td>";
		   $toname = $_POST['iyer_name'];
	   }
	    else if($_POST['type']=='guide')
	   {
	         $topic = "Queries about Guide";
		     $redirect = "<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#339999; margin-top:-20px;'><strong><a target='_blank' href=".Yii::app()->params['SITE_BASE_URL'].'/front/detail/guide/id/'.helpers::simple_encrypt($_POST['id']).">".Yii::app()->params['SITE_BASE_URL'].'/front/detail/guide/id/'.helpers::simple_encrypt($_POST['id'])."</a></strong></td>";
		     $toname = $_POST['guide_name'];
	   }
	        
			$name = $_POST['Contact_name'];
			$email = $_POST['Contact_email'];
			$phone = ($_POST['Contact_phone']!='')?$_POST['Contact_phone']: 'Nil';
			$message = $_POST['Contact_message'];
			
			

			$message1 =  "<html>
			<head>
			<title>'".$topic."'</title>
			</head>
			<body>
			<table cellpadding='0' cellspacing='0' width='800px'>
			<tr>
			<td width='800px' colspan='3' align='left' class='texthead' style='font-size:14px; color:#000; margin-top:-20px;'><strong>Queries about ".$toname."<strong></td>
			</tr>
			<br>
			<br>         
			<tr>
			".$redirect." 
			</tr>
			<br>
			<br>  
			<p style='font-weight: bold;'>&nbsp;&nbsp;Name    :&nbsp;&nbsp;".$name."</p>
            <p style='font-weight: bold;'>&nbsp;&nbsp;Email   :&nbsp;&nbsp;".$email."</p>
			<p style='font-weight: bold;'>&nbsp;&nbsp;Phone No :&nbsp;&nbsp;".$phone."</p>
			<p style='font-weight: bold;'>&nbsp;&nbsp;Message :&nbsp;&nbsp;".$message."</p>
			<p>&nbsp;</p>
			
			</table>
			</body>
			</html>
			";

				
			$subject = $topic;
			
			$to = helpers::configs()->company_email;
			
			User::model()->mailsend($to,$email,$subject,$message1);
			
			Yii::app()->user->setFlash('queries','Thank you for your Queries. We will respond to you as soon as possible.');
			
            $model=new Queries;
            
			if($_POST['type']=='iyer')
			{
			 $model->type = "Iyer";
			 $model->to_id = $id;
             $model->name = $name; 
             $model->email = $email; 
             $model->ph_no = $phone; 
             $model->question = $message; 
             $model->username = $name;
              if($model->save())
            $this->redirect($this->createUrl('detail/iyer/id/'.helpers::simple_encrypt($_POST['id'])));	
			}
			else if($_POST['type']=='temple')
			{
			 $model->type = "Temple";
             $model->name = $name; 
			 $model->to_id = $id;
             $model->email = $email; 
             $model->ph_no = $phone; 
             $model->question = $message; 
             $model->username = $name;
             if($model->save())
			 $this->redirect($this->createUrl('detail/temple/id/'.helpers::simple_encrypt($_POST['id'])));	
			}
			else
			{
			 $model->type = "Guide";
             $model->name = $name; 
			 $model->to_id = $id;
             $model->email = $email; 
             $model->ph_no = $phone; 
             $model->question = $message; 
             $model->username = $name;
             if($model->save())
			 $this->redirect($this->createUrl('detail/guide/id/'.helpers::simple_encrypt($_POST['id'])));
			}
	}
	
	
	
      function actionAvailability_status()
	  {
	     $date = $_POST['date'];
		 
		 $user_id = $_POST['dates1'];
		 
		 $type = $_POST['type'];

		 
		 echo  $this->renderPartial('availability',array('date'=>$date,'user_id'=>$user_id,'type'=>$type));
	  }
	  
	  function actionPoojadetails()
	  {
	    $pooja_id = $_POST['pooja_id'];
		
		$ivalues = $_POST['ivalues'];

         Yii::app()->session['pooja_id'] = $pooja_id;

         Yii::app()->session['ivalues'] = $ivalues;
		
		 if($_POST['type']=='guide')
		 $guidetemple = Guidetemple::model()->findByPK($pooja_id);
		 else
		 $poojas = Iyerpoojas::model()->findByPK($pooja_id);
		
		 if($_POST['type']=='guide')
		 echo  $this->renderPartial('guidechoose',array('guidetemple'=>$guidetemple,'ivalues'=>$ivalues));
		 else
		 echo  $this->renderPartial('poojaschoose',array('poojas'=>$poojas,'ivalues'=>$ivalues));
	  }
	  
	  function actionBooked_details()
	  {
	    $model=new BookedTable;
	   
	    $activity_id = $_POST['activity_id'];
		$date = $_POST['booked_date'];
		$user_id = $_POST['user_id'];
		
		
		if(isset($_POST['type']))
		{
		  $pooja_option = 'Nil';
		  $type = $_POST['type'];
		}
		else
		{
		  $pooja_option = $_POST['pooja_option'];
		  $type = 'iyer';
		}
		
		
		unset(Yii::app()->session['choose_date']);
		
		$model->user_id = $user_id;
		$model->activity_id = $activity_id;
		$model->book_date = $date;
		$model->option = $pooja_option;
		$model->type = $type;
		$model->created = date('Y-m-d');
		$model->from_user = Yii::app()->user->id;
		$model->save(false);
		
		
		
		if(isset($_POST['type']))
		{
		Yii::app()->user->setFlash('booked','Your request has been sent successfully, Please wait for request approval by Guide.');
		$this->redirect(array("detail/guide/id/".helpers::simple_encrypt($user_id)));
		}
		else
		{
		 Yii::app()->user->setFlash('booked','Your request has been sent successfully, Please wait for request approval by Iyer.');
		$this->redirect(array("detail/iyer/id/".helpers::simple_encrypt($user_id)));
		
		}
	  }
	  
	  function actionDeletequeries()
	  {
	    $id =$_POST['id'];
	    $post=Queries::model()->findByPk($id);
	    Yii::app()->user->setFlash('success','Queries has been successfully deleted.');
            $post->delete();
	  }
	 
	
	
	
}
?>
