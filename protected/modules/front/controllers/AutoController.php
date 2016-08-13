<?php
class AutoController extends Controller
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
	
	/*function actionTemplesmain()
	{
	    $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT `temple_deity` FROM temples WHERE `temple_name` LIKE "%' .$q. '%" or `temple_deity` LIKE "%' .$q. '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();

		$data =array();
		
        for($i=0;$i<count($rows);$i++)
		{
		array_push($data, $rows[$i]['temple_deity']);	
		}
		
			$data = array_filter($data);
					
		echo json_encode($data);
	}
	*/
	
	function actionCityauto()
	{
	  $q = $_GET['name_startsWith'];
	  
	  $rows = array();
	  
	    $sql = 'SELECT `name` FROM cities WHERE `name` LIKE "%' .$q. '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
		 for($i=0;$i<count($rows);$i++)
		{
		if(!in_array($rows[$i]['name'],$data))
		array_push($data,$rows[$i]['name']);
		}
		
		$data = array_filter($data);
			
		echo json_encode($data);
	}
	
	function actionStateauto()
	{
	  $q = $_GET['name_startsWith'];
	  
	  $rows = array();
	  
	    $sql = 'SELECT `state_name` FROM states WHERE `state_name` LIKE "%' .$q. '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
		 for($i=0;$i<count($rows);$i++)
		{
		if(!in_array($rows[$i]['state_name'],$data))
		array_push($data,$rows[$i]['state_name']);
		}
		
		$data = array_filter($data);
			
		echo json_encode($data);	

	}
	
	
	function actionCountryauto()
	{
	  $q = $_GET['name_startsWith'];
	  
	  $rows = array();
	  
	    $sql = 'SELECT `country` FROM country WHERE `country` LIKE "%' .$q. '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
		 for($i=0;$i<count($rows);$i++)
		{
		if(!in_array($rows[$i]['country'],$data))
		array_push($data,$rows[$i]['country']);
		}
		
		$data = array_filter($data);
			
		echo json_encode($data);	

	}
	
	function actionTemplesgod()
	{
	    $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT `temple_name` FROM temples WHERE `temple_name` LIKE "%' .$q. '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		
		$sql1 = 'SELECT `temple_deity` FROM temples WHERE `temple_deity` LIKE "%' .$q. '%"';
        $rows1 = Yii::app()->db->createCommand($sql1)->queryAll();

		$data =array();
		
		
		 for($i=0;$i<count($rows1);$i++)
		{
		if(!in_array($rows1[$i]['temple_deity'],$data))
		array_push($data, $rows1[$i]['temple_deity']);
		}	
		
        for($i=0;$i<count($rows);$i++)
		{
		if(!in_array($rows[$i]['temple_name'],$data))
		array_push($data, $rows[$i]['temple_name']);
		}
			$data = array_filter($data);
			
		echo json_encode($data);
	}
	
	function actionIyermain()
	{
	    $q = $_GET['name_startsWith'];

        $rows = array();
			
		$sql = 'SELECT t.`first_name`,t.`last_name` FROM user t join iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id   WHERE t.role = 4 AND t.registration_completed=1 and ug.iyer_overview IS NOT NULL and ug.iyer_wh<>"0.0" and ug.iyer_experience<>"0.0" and 	ug.iyer_experience_type IS NOT NULL and ug.iyer_amount_option IS NOT NULL  and  iyer_amount<>"0.00" and t.status = 1  and(t.`first_name` LIKE "%' .$q. '%" OR t.`last_name`  LIKE "%' .$q. '%" )  GROUP BY t.user_id; ';
		
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		
		$sql1 = 'SELECT `pooja_name` FROM iyerpoojas WHERE `pooja_name` LIKE "%' .$q. '%" and status="1" ';
        $rows1 = Yii::app()->db->createCommand($sql1)->queryAll();
		
		 $data =array();
		
			for($i=0;$i<count($rows);$i++)
			{
			if(!in_array($rows[$i]['first_name'].' '.$rows[$i]['last_name'],$data))
			array_push($data, $rows[$i]['first_name'].' '.$rows[$i]['last_name']);	
			}	
			
			for($j=0;$j<count($rows1);$j++)
			{
			if(!in_array($rows1[$i]['pooja_name'],$data))
			array_push($data,$rows1[$i]['pooja_name']);	
			}
			
			
			$data = array_filter($data);
		
		

        /*$sql = 'SELECT  `first_name`,`pooja_name` FROM user as u inner join iyerpoojas as iv on u.user_id = iv.user_id WHERE `first_name` LIKE "%' . $q . '%" or `pooja_name` LIKE "%' . $q . '%"  and `role`=4';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();*/
		
		
      	
		echo json_encode($data);
	}
	
	
	function actionGuidemain()
	{
	    $q = $_GET['name_startsWith'];
		
        $rows = array();
		
		
		
			$sql = 'SELECT t.`first_name`,t.`last_name` FROM user t join guide ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN guidetemple as ip ON ip.user_id=ug.user_id   WHERE t.role = 3 AND t.registration_completed=1 and ug.guide_overview IS NOT NULL and ug.guide_wh<>"0.0" and ug.guide_experience<>"0.0" and ug.guide_experiencetype IS NOT NULL and ug.guide_amount_option IS NOT NULL  and  guide_amount<>"0.00" and t.status = 1  and(t.`first_name` LIKE "%' .$q. '%" OR t.`last_name`  LIKE "%' .$q. '%" )  GROUP BY t.user_id; ';
		
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		
		$sql1 = 'SELECT `activity_title` FROM guidetemple WHERE `activity_title` LIKE "%' .$q. '%"';
        $rows1 = Yii::app()->db->createCommand($sql1)->queryAll();
		
		

		$data =array();
		
		for($i=0;$i<count($rows);$i++)
			{
			if(!in_array($rows[$i]['first_name'].' '.$rows[$i]['last_name'],$data))
			array_push($data, $rows[$i]['first_name'].' '.$rows[$i]['last_name']);	
			}	
			
			for($j=0;$j<count($rows1);$j++)
			{
			if(!in_array($rows1[$i]['activity_title'],$data))
			array_push($data,$rows1[$i]['activity_title']);	
			}

		echo json_encode($data);
	}
	
	function actionCalenderredirect()
	{
	    $id = $_POST['id'];
		
		
		Yii::app()->session['calender_values'] = 'calender_values';
	   
	   echo helpers::simple_encrypt($id);
	}
	
	function actionCheckmailexist()
	{
	   $mail = $_POST['emailpopup'];
           $user_details = User::model()->findByAttributes(array('email'=>$mail));
	    echo count($user_details);
          
	}
	
	
	function actionshowmap()
	{
	    $latitude = $_POST['latitude'];
	  
	    $logtitute = $_POST['logtitute']; 
	  
	    $temple_name = $_POST['temple_name']; 

	   $this->renderPartial('map_details', array('latitude'=>$latitude,'logtitute'=>$logtitute,'temple_name'=>$temple_name));  
	}
	
	


	
	function actionEvents()
	{
	   Yii::app()->session['calender_values'] = 'calender_values';
	   
	     $criteria1 = new CDbCriteria();

	     $criteria1->condition =' `event_end_date` > "'.date('Y-m-d').'" ';
		 $criteria1->order = 'event_start_date ASC';
		
		 $events = Events::model()->findAll($criteria1);
		 
		 

		 
		 
		 $events111 = array();

		 
		 
		for($i=0;$i<count($events);$i++)
		{

				$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
				$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];	
		        $content = substr_replace(strip_tags($events[$i]->event_content),'...',80); 

				$start_date =  $events[$i]->event_start_date;
				$end_date =  date('Y-m-d',strtotime('+1 days',strtotime($events[$i]->event_end_date)));
				$eventArray['title'] =stripslashes($events[$i]->event_name);
				$eventArray['start'] = $start_date;
				$eventArray['end'] =  $end_date;
				$eventArray['textColor'] =  '#ffffff';
				$eventArray['backgroundColor'] =  $color;	
				
				
				$eventArray['description'] ='<span style="font-size:12px;text-decoration:none;display:block;">'.$content.'</span><hr><span style="float: right;font-weight:bold; color:#ff0000; cursor:pointer; margin-bottom:10px;font-size:12px !important;"><a href="'.CHtml::normalizeUrl(array("detail/events/id/".helpers::simple_encrypt($events[$i]->event_id))).'">More Details...</a></span>';  
				$events111[] = $eventArray;
       }
echo json_encode($events111);

}

function actionSessionforproduct()
{
  Yii::app()->session['product_categories'] = $_POST['categories'];
}



function actionIyernew()
{

  $this->pageTitle =' Temples Unlimited - Iyer List ';

         $model=new User;
	   //get criteria
		 $criteria = new CDbCriteria();
		
		  $criteria->select = "t.*,ug.iyer_phone,ug.iyer_city,ug.iyer_state,ug.iyer_country,ug.iyer_description,ug.iyer_sec_languages,rv.*";
		
		  $criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id";
		
	      $condition  = ' t.role = 4 AND t.registration_completed=1 and t.email_validated=1 and ug.iyer_overview IS NOT NULL and ug.iyer_wh<>"0.0" and ug.iyer_experience<>"0.0" and ug.iyer_experience_type IS NOT NULL and ug.iyer_amount_option IS NOT NULL  and  iyer_amount<>"0.00" and t.status = 1 ';

	      $criteria->group = 't.user_id';		

	      $criteria->condition =  $condition;

	    $count = User::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		 
		//result to show on page
		$result = User::model()->findAll($criteria);
		
		//$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id ";
		$dataProvider = new CArrayDataProvider($result);

		$dataall= new CArrayDataProvider($result);

		
		$this->render('iyer', array(
						  'dataProvider' => $dataProvider,
						  'dataProall'=>$dataall,
						  
			));
}

public function actionBlog()
	{
	   $this->pageTitle =' Temples Unlimited - Blog ';
	    
	    $model = new Blogs;
	   //get criteria
		 $criteria = new CDbCriteria();
		 
		 if(isset($_REQUEST['cat']))
		 {
		 $condition = 'category='.$_REQUEST['cat'].'';
		 
		 $criteria->condition =  $condition;
		 }
		 
		 
		  if(isset($_REQUEST['month']))
		 {
				$dates  = explode('-',$_REQUEST['month']);
				$condition = 'YEAR(created)='.$dates[1].'';
				$condition .= ' and MONTH(created)='.$dates[0].'';
				$criteria->condition =  $condition;
		 }

		$count = Blogs::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		
		$criteria->order = 'id desc';
		 
		//result to show on page
		$result = Blogs::model()->findAll($criteria);
		
		$criteria1 = new CDbCriteria();
		 
	 
		$result1 = Blogs::model()->findAll($criteria1);
		
				$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);

			$this->render('blog', array(
				'dataProvider' => $dataProvider,

				'model'=>$model,
			));
	   }
           
           
           function  actionList_country()
	{
	     $id =  $_POST['country_id'];		 
		 $Criteria = new CDbCriteria();
         $Criteria->condition = "country_id = $id";
         $model = States::model()->findAll($Criteria);
		 
		  $option ='<option value="">Select State</option>';
		 
		  for($i=0;$i<count($model);$i++)
		 {
		     $option .='<option value="'.$model[$i]->id.'">'.$model[$i]->state_name.'</option>';
		 }
		  echo $option;
	}//
	
	
	function  actionList_cities()
	{
	     $id =  $_POST['state_id'];		 
		 $Criteria = new CDbCriteria();
         $Criteria->condition = "state_id = $id";
         $model = Cities::model()->findAll($Criteria);
		 
		  $option ='<option value="">Select City</option>';
		 
		  for($i=0;$i<count($model);$i++)
		 {
		     $option .='<option value="'.$model[$i]->id.'">'.$model[$i]->name.'</option>';
		 }
		  echo $option;
	}//

           
           
           public function actionUserinitial()
           {
                $detailsmodel = Userdetails::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));

                 if(count($detailsmodel)==0){
			$detailsmodel = new  Userdetails;
	         }

                  $detailsmodel->attributes = $_POST['Userdetails'];
		   $detailsmodel->user_id = Yii::app()->user->id;
                
                if (isset($_POST['address']))
                $detailsmodel->address = $_POST['address'];

                 if(isset($_POST['country']))	
                 $detailsmodel->country = $_POST['country'];
                 
                if(isset($_POST['state']))	
                $detailsmodel->state = $_POST['state'];
                  
                if(isset($_POST['city']))	
                $detailsmodel->city = $_POST['city'];
                   
                if(isset($_POST['pincode']))	
                $detailsmodel->pincode = $_POST['pincode'];
                
                $detailsmodel->save(false);

                $this->redirect(array('profile/user'));
           }
 
}
?>
