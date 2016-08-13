<?php
class ListController extends Controller
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

	
        function actionIyerauto(){
	
	    $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT  `first_name` FROM user WHERE `first_name` LIKE "%' . $q . '%" and `role`=4';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
        for($i=0;$i<count($rows);$i++)
		{
		array_push($data, $rows[$i]['first_name']);	
		}		
		echo json_encode($data);
	}
        
         function actionGuideauto(){
	
	  $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT  `first_name` FROM user WHERE `first_name` LIKE "%' . $q . '%" and `role`=3';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
        for($i=0;$i<count($rows);$i++)
		{
		array_push($data, $rows[$i]['first_name']);	
		}		
		echo json_encode($data);
	}
	
	function actionProduciauto()
	{
	   $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT  `product_name` FROM store_products WHERE `product_name` LIKE "%' . $q . '%" and `is_active`=1';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
        for($i=0;$i<count($rows);$i++)
		{
		if(!in_array($rows[$i]['product_name'],$data))
		array_push($data, $rows[$i]['product_name']);	
		}		
		echo json_encode($data);
	}


	

	function actionGuides(){
	
	 //get criteria
		$criteria = new CDbCriteria();
	 
	 
	 	$condition  = ' role = 3 ';
                
               
                
		
		if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '')|| (isset($_REQUEST['todate'])   &&  trim($_REQUEST['todate']) != '')){
		
			if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '') &&  (!isset($_REQUEST['todate'])   ||  trim($_REQUEST['todate'])== '')){
			  $fromdate = $_REQUEST['fromdate'];
			  $todate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($fromdate)) . " +15 days"));
			}
			
			if((isset($_REQUEST['todate'])  &&  trim($_REQUEST['todate']) != '') &&  (!isset($_REQUEST['fromdate'])   ||  trim($_REQUEST['fromdate'])== '')){
			  $todate = $_REQUEST['todate'];
			  $fromdate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($todate)) . " -15 days"));
			}
			
			if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '') && (isset($_REQUEST['todate'])   &&  trim($_REQUEST['todate']) != '')){
			  $fromdate = $_REQUEST['fromdate'];
			  $todate = $_REQUEST['todate'];
			}
		
		   $dateranges = User::model()->getDatesFromRange($fromdate,$todate);
	
		  
		   if(count($dateranges)){
		   
		     $criteriaactivities = new CDbCriteria();
			 $criteriaactivities->select=' GROUP_CONCAT(user_id) as userids';
			 $activitiescondition = '';
			  $daterangecount = 0;
			  
			 
			 foreach($dateranges as $daterange){ $daterangecount++;
			 if($daterangecount>1)
			 $activitiescondition .= ' OR availability_dates LIKE "%'.$daterange.'%" ';
			 else
			  $activitiescondition .= '  availability_dates LIKE "%'.$daterange.'%" ';
			 }
			 
			
			 
			  $criteriaactivities->condition =  $activitiescondition;
			  $Guideactivities = Guideactivities::model()->find($criteriaactivities);
			    
			   if($Guideactivities->userids || trim($Guideactivities->userids) != ''){
		       $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$Guideactivities->userids)).')';
		       }else{
			     $condition .= ' AND	user_id	=0 ';
			   }
		}
	}	
	
	   $status = true;
		$criteriaguide = new CDbCriteria();
		$conditionguide  = '1';
                
                 $criteriaguide->join = " JOIN reviews rv ON rv.review_itemid=t.user_id";
		$criteriaguide->select=' GROUP_CONCAT(user_id) as userids';
		
		if(isset($_REQUEST['title'])){ 
		 $conditionguide .= ' AND guide_title  LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
                 //$criteria->join = " JOIN reviews rv ON rv.review_itemid=t.user_id ";
                
                if(isset($_REQUEST['ratings'])){
		 $conditionguide .= ' AND	review_rate 	 IN  ('.implode(',',$_REQUEST['ratings']).')';
		}
		/*if(isset($_REQUEST['categories'])){ 
		 $conditionguide .= '  AND	guide_categories="'.$_REQUEST['categories'].'"';
		}*/
		if(isset($_REQUEST['categories'])){ 
		 $conditionguide .= '  AND	FIND_IN_SET("'.$_REQUEST['categories'].'",guide_categories )';
		}
		
		
		
		if(isset($_REQUEST['states'])){ 
		  $conditionguide .= ' AND	guide_state 	 IN  ('.implode(',',$_REQUEST['states']).')';
		}
		
		
		 if(isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != ''){ 
		   $cid = helpers::simple_decrypt($_REQUEST['cid']);
		   $data =Guide::model()->getinfo($cid);
			$category = $data->guide_categories;
			 $conditionguide .= ' AND guide_categories='. $category ;
		}
		
		
		
		if(isset($_REQUEST['experience']) && count($_REQUEST['experience'])){ 
		$conditionguide .= ' AND (';
		$experiencecount = 0;
		    foreach($_REQUEST['experience'] as $experience){ $experiencecount++;
			  $experience = explode('_',$experience);
			   if($experiencecount>1)
		      $conditionguide .= ' OR	 (guide_experience>='. $experience[0].'  AND guide_experience<'. $experience[1].' ) ';
			  else
			  $conditionguide .= ' (guide_experience>='. $experience[0].'  AND guide_experience<'. $experience[1].' )';
		    }
		  $conditionguide .= ')';
		}
		
		if(isset($_REQUEST['services']) && count($_REQUEST['services'])){ 
		$conditionguide .= ' AND (';
		$servicecount = 0;
		    foreach($_REQUEST['services'] as $serviceid){$servicecount++;
			  if($servicecount>1)
		      $conditionguide .= ' OR	 find_in_set('.$serviceid.',guide_services) ';
			  else
			   $conditionguide .= '  find_in_set('.$serviceid.',guide_services) ';
			  
		    }
		  $conditionguide .= ')';
		}
		
		if(isset($_REQUEST['whours']) && count($_REQUEST['whours'])){ 
		$conditionguide .= ' AND (';
		$whourcount = 0;
		    foreach($_REQUEST['whours'] as $whour){ $whourcount++;
			  $whour = explode('_',$whour);
			   if($whourcount>1)
		      $conditionguide .= ' OR	 (guide_wh>='. $whour[0].'  AND guide_wh<'. $whour[1].' ) ';
			  else
			  $conditionguide .= ' (guide_wh>='. $whour[0].'  AND guide_wh<'. $whour[1].' )';
		    }
		  $conditionguide .= ')';
		}
		
		
		if(isset($_REQUEST['amounts']) && count($_REQUEST['amounts'])){ 
		$conditionguide .= ' AND (';
		$amountcount = 0;
		    foreach($_REQUEST['amounts'] as $amount){ $amountcount++;
			  $amount = explode('_',$amount);
			   if($amountcount>1)
		      $conditionguide .= ' OR	 (guide_amount>='. $amount[0].'  AND guide_amount<'. $amount[1].' ) ';
			  else
			  $conditionguide .= ' (guide_amount>='. $amount[0].'  AND guide_amount<'. $amount[1].' )';
		    }
		  $conditionguide .= ')';
		}
	
		 $criteriaguide->condition =  $conditionguide;
		
		if(isset($_REQUEST['title']) || (isset($_REQUEST['amounts']) && count($_REQUEST['amounts'])) ||  (isset($_REQUEST['whours']) && count($_REQUEST['whours'])) || (isset($_REQUEST['services']) && count($_REQUEST['services'])) || isset($_REQUEST['states']) ||  isset($_REQUEST['categories']) || (isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != '')){ 
		   $guides = Guide::model()->find($criteriaguide);
		   
		   if($guides->userids || trim($guides->userids) != ''){
		       $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$guides->userids)).')';
		   }else
		   $status = false;
		   
		  
		}
		
		
		
		
		if(isset($_REQUEST['languages'])){ 
		  $condition .= ' AND	language 	 IN  ('.implode(',',$_REQUEST['languages']).')';
		}
		
		if(!$status){
		  $condition .= ' AND	user_id	=0 ';
		}
	
		
	  $criteria->condition =  $condition;
		
	 
		$criteria->params = array (':role'=> '3');
		$criteria->order = 'user_id asc';
		$criteria->group= 'user_id';
		 
		//get count
		$count = User::model()->count($criteria);

		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = User::model()->findAll($criteria);
		$criteria1 = new CDbCriteria();
	    $criteria1->condition = 'role = :role';
		$criteria1->params = array (':role'=> '3');
		$criteria1->order = 'user_id asc';
		$criteria1->group= 'user_id';
		
		$result1 = User::model()->findAll($criteria1);
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		 if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('guideview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages,
				'items_count'=>$count,
		        'page_size'=>'10',
			));
		} else{
			$this->render('guideview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages,
				'items_count'=>$count,
		        'page_size'=>'10',
			));
	    }
	}
	
	        
        function actionGuides_list(){
	
	 //get criteria
		$criteria = new CDbCriteria();
	 
	 
	 	$condition  = ' role = 3 ';
                
               
                
		
		if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '')|| (isset($_REQUEST['todate'])   &&  trim($_REQUEST['todate']) != '')){
		
			if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '') &&  (!isset($_REQUEST['todate'])   ||  trim($_REQUEST['todate'])== '')){
			  $fromdate = $_REQUEST['fromdate'];
			  $todate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($fromdate)) . " +15 days"));
			}
			
			if((isset($_REQUEST['todate'])  &&  trim($_REQUEST['todate']) != '') &&  (!isset($_REQUEST['fromdate'])   ||  trim($_REQUEST['fromdate'])== '')){
			  $todate = $_REQUEST['todate'];
			  $fromdate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($todate)) . " -15 days"));
			}
			
			if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '') && (isset($_REQUEST['todate'])   &&  trim($_REQUEST['todate']) != '')){
			  $fromdate = $_REQUEST['fromdate'];
			  $todate = $_REQUEST['todate'];
			}
		
		   $dateranges = User::model()->getDatesFromRange($fromdate,$todate);
	
		  
		   if(count($dateranges)){
		   
		     $criteriaactivities = new CDbCriteria();
			 $criteriaactivities->select=' GROUP_CONCAT(user_id) as userids';
			 $activitiescondition = '';
			  $daterangecount = 0;
			  
			 
			 foreach($dateranges as $daterange){ $daterangecount++;
			 if($daterangecount>1)
			 $activitiescondition .= ' OR availability_dates LIKE "%'.$daterange.'%" ';
			 else
			  $activitiescondition .= '  availability_dates LIKE "%'.$daterange.'%" ';
			 }
			 
			
			 
			  $criteriaactivities->condition =  $activitiescondition;
			  $Guideactivities = Guideactivities::model()->find($criteriaactivities);
			    
			   if($Guideactivities->userids || trim($Guideactivities->userids) != ''){
		       $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$Guideactivities->userids)).')';
		       }else{
			     $condition .= ' AND	user_id	=0 ';
			   }
		}
	}	
	
	     $status = true;
		$criteriaguide = new CDbCriteria();
		$conditionguide  = '1';
                
                 $criteriaguide->join = " JOIN reviews rv ON rv.review_itemid=t.user_id";
		$criteriaguide->select=' GROUP_CONCAT(user_id) as userids';
		
		if(isset($_REQUEST['title'])){ 
		 $conditionguide .= ' AND guide_title  LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
                 //$criteria->join = " JOIN reviews rv ON rv.review_itemid=t.user_id ";
                
                if(isset($_REQUEST['ratings'])){
		 $conditionguide .= ' AND	review_rate 	 IN  ('.implode(',',$_REQUEST['ratings']).')';
		}
		/*if(isset($_REQUEST['categories'])){ 
		 $conditionguide .= '  AND	guide_categories="'.$_REQUEST['categories'].'"';
		}*/
		if(isset($_REQUEST['categories'])){ 
		 $conditionguide .= '  AND	FIND_IN_SET("'.$_REQUEST['categories'].'",guide_categories )';
		}
		
		
		
		if(isset($_REQUEST['states'])){ 
		  $conditionguide .= ' AND	guide_state 	 IN  ('.implode(',',$_REQUEST['states']).')';
		}
		
		
		 if(isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != ''){ 
		   $cid = helpers::simple_decrypt($_REQUEST['cid']);
		   $data =Guide::model()->getinfo($cid);
			$category = $data->guide_categories;
			 $conditionguide .= ' AND guide_categories='. $category ;
		}
		
		
		
		if(isset($_REQUEST['experience']) && count($_REQUEST['experience'])){ 
		$conditionguide .= ' AND (';
		$experiencecount = 0;
		    foreach($_REQUEST['experience'] as $experience){ $experiencecount++;
			  $experience = explode('_',$experience);
			   if($experiencecount>1)
		      $conditionguide .= ' OR	 (guide_experience>='. $experience[0].'  AND guide_experience<'. $experience[1].' ) ';
			  else
			  $conditionguide .= ' (guide_experience>='. $experience[0].'  AND guide_experience<'. $experience[1].' )';
		    }
		  $conditionguide .= ')';
		}
		
		if(isset($_REQUEST['services']) && count($_REQUEST['services'])){ 
		$conditionguide .= ' AND (';
		$servicecount = 0;
		    foreach($_REQUEST['services'] as $serviceid){$servicecount++;
			  if($servicecount>1)
		      $conditionguide .= ' OR	 find_in_set('.$serviceid.',guide_services) ';
			  else
			   $conditionguide .= '  find_in_set('.$serviceid.',guide_services) ';
			  
		    }
		  $conditionguide .= ')';
		}
		
		if(isset($_REQUEST['whours']) && count($_REQUEST['whours'])){ 
		$conditionguide .= ' AND (';
		$whourcount = 0;
		    foreach($_REQUEST['whours'] as $whour){ $whourcount++;
			  $whour = explode('_',$whour);
			   if($whourcount>1)
		      $conditionguide .= ' OR	 (guide_wh>='. $whour[0].'  AND guide_wh<'. $whour[1].' ) ';
			  else
			  $conditionguide .= ' (guide_wh>='. $whour[0].'  AND guide_wh<'. $whour[1].' )';
		    }
		  $conditionguide .= ')';
		}
		
		
		if(isset($_REQUEST['amounts']) && count($_REQUEST['amounts'])){ 
		$conditionguide .= ' AND (';
		$amountcount = 0;
		    foreach($_REQUEST['amounts'] as $amount){ $amountcount++;
			  $amount = explode('_',$amount);
			   if($amountcount>1)
		      $conditionguide .= ' OR	 (guide_amount>='. $amount[0].'  AND guide_amount<'. $amount[1].' ) ';
			  else
			  $conditionguide .= ' (guide_amount>='. $amount[0].'  AND guide_amount<'. $amount[1].' )';
		    }
		  $conditionguide .= ')';
		}
	
		 $criteriaguide->condition =  $conditionguide;
		
		if(isset($_REQUEST['title']) || (isset($_REQUEST['amounts']) && count($_REQUEST['amounts'])) ||  (isset($_REQUEST['whours']) && count($_REQUEST['whours'])) || (isset($_REQUEST['services']) && count($_REQUEST['services'])) || isset($_REQUEST['states']) ||  isset($_REQUEST['categories']) || (isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != '')){ 
		   $guides = Guide::model()->find($criteriaguide);
		   
		   if($guides->userids || trim($guides->userids) != ''){
		       $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$guides->userids)).')';
		   }else
		   $status = false;
		}
		
		if(isset($_REQUEST['languages'])){ 
		  $condition .= ' AND	language 	 IN  ('.implode(',',$_REQUEST['languages']).')';
		}
		
		if(!$status){
		  $condition .= ' AND	user_id	=0 ';
		}
	
		
	  $criteria->condition =  $condition;
		
	 
		$criteria->params = array (':role'=> '3');
		$criteria->order = 'user_id asc';
		$criteria->group= 'user_id';
		 
		//get count
		$count = User::model()->count($criteria);

		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = User::model()->findAll($criteria);
		$criteria1 = new CDbCriteria();
	    $criteria1->condition = 'role = :role';
		$criteria1->params = array (':role'=> '3');
		$criteria1->order = 'user_id asc';
		$criteria1->group= 'user_id';
		
		$result1 = User::model()->findAll($criteria1);
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		 if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('guideview_list', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
		} else{
			$this->render('guideview_list', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
	    }
	
	    
	}
		
	function actionTemples($id='null')
	{
	
	   $this->pageTitle =' Temples Unlimited | Temples List ';
	    
	    $model=new Temples;
	   //get criteria
		 $criteria = new CDbCriteria();
		 
		 $criteria->join = " LEFT JOIN reviews rv ON rv.review_itemid=t.id";
		
		 $condition  = '	is_active ="1" ';
		
		if(isset($_REQUEST['title']) && $_REQUEST['title']!='' &&  $_REQUEST['title']!='Search Keyword...'){ 
		
		 $condition .= ' AND temple_name  LIKE  "%'.trim($_REQUEST['title']).'%"';
		 
		 $condition .= ' OR temple_deity  LIKE  "%'.trim($_REQUEST['title']).'%"';
		}
		
		$condition_temples = array();
		
		if(isset($_REQUEST['categories'])){ 
		 $condition .= '  AND	category_id  IN  ('.implode(',',$_REQUEST['categories']).')';
		}
		
	    if(isset($_REQUEST['ratings'])){
		
		 $condition .= ' AND review_average 	 IN  ('.implode(',',$_REQUEST['ratings']).') AND rv.review_itemtype="temple" ';
		}
		
		if(isset($_REQUEST['states'])){ 
		 $condition .= ' AND	state_id  IN  ('.implode(',',$_REQUEST['states']).')';
		}
		
		if($id!='null')
		{
		$condition .= 'AND featured_listing='.$id.'';
		}

	    $criteria->condition =  $condition;

		$criteria->group= 'id';
		

		$count = Temples::model()->count($criteria);
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		//$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Temples::model()->findAll($criteria);
		
		$criteria1 = new CDbCriteria();
		 
	 
		$result1 = Temples::model()->findAll($criteria1);
		

		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_temples_view', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'mapdetails'=>$result,
				'pages' => $pages,
				'model'=>$model,
			));
		} else{
			$this->render('view', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages,
				'mapdetails'=>$result,
				'model'=>$model,
			));
	    }
	}
	
	
	function actionTemplesmap()
	{
	
	  $this->pageTitle =' Temples Unlimited | Temples Map ';
	  
		 $model=new Temples;
	   //get criteria
		$criteria = new CDbCriteria();
		
		 $criteria->join = " LEFT JOIN reviews rv ON rv.review_itemid=t.id";
		
		$condition  = '	is_active ="1"';
		
		if(isset($_REQUEST['title']) && ($_REQUEST['title'])!='' && $_REQUEST['title']!='Search Keyword...'){ 
		
		  $condition .= ' AND temple_name  LIKE  "%'.$_REQUEST['title'].'%"';
		 
		 $condition .= ' OR temple_deity  LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
		 if(isset($_REQUEST['ratings'])){
		 $condition .= ' AND review_average 	 IN  ('.implode(',',$_REQUEST['ratings']).') AND rv.review_itemtype="temple" ';
		}
		
		if(isset($_REQUEST['categories'])){ 
		 $condition .= '  AND	category_id 	 IN  ('.implode(',',$_REQUEST['categories']).')';
		}
		
		if(isset($_REQUEST['states'])){ 
		  $condition .= ' AND	state_id 	 IN  ('.implode(',',$_REQUEST['states']).')';
		}

		
	    $criteria->condition =  $condition;
		
		$criteria->group= 'id';
		
	    //$criteria->condition = 'country = :country';
	  	//$criteria->params = array (':country'=> $_GET['country']);
		//$criteria->order = 'ac_name asc';
		 
		//get count
		$count = Temples::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Temples::model()->findAll($criteria);
		

		$result1 = Temples::model()->findAll();
		

		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_temples_map', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages,
				'mapdetails'=>$result,
				'model'=>$model,
			));
		} else{
			$this->render('temples_map', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages,
				'mapdetails'=>$result1,
				'model'=>$model,
			));
	    }
	
	  
	}
	
	
	function actionTemplesmapnew()
	{
		 $model=new Temples;
	   //get criteria
		$criteria = new CDbCriteria();
		
		$condition  = '	is_active ="1"';
		
		if(isset($_REQUEST['title']) && $_REQUEST['title']!=''){ 
		
		  $condition .= ' AND temple_name  LIKE  "%'.$_REQUEST['title'].'%"';
		 
		 $condition .= ' OR temple_deity  LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
		if(isset($_REQUEST['categories'])){ 
		 $condition .= '  AND	category_id 	 IN  ('.implode(',',$_REQUEST['categories']).')';
		}
		
		if(isset($_REQUEST['states'])){ 
		  $condition .= ' AND	state_id 	 IN  ('.implode(',',$_REQUEST['states']).')';
		}

		
	    $criteria->condition =  $condition;
		
	    //$criteria->condition = 'country = :country';
	  	//$criteria->params = array (':country'=> $_GET['country']);
		//$criteria->order = 'ac_name asc';
		 
		//get count
		$count = Temples::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Temples::model()->findAll($criteria);
		$result1 = Temples::model()->findAll();
		

		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
			$this->render('_temples_map', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages,
				'mapdetails'=>$result1,
				'model'=>$model,
			));
	 } 
	
	
	
	
	function actionTemplesauto(){
	
	  $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT  `temple_name` FROM temples WHERE `temple_name` LIKE "%' . $q . '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
        for($i=0;$i<count($rows);$i++)
		{
		array_push($data, $rows[$i]['temple_name']);	
		}		
		echo json_encode($data);
	}	


	

	
	function actionTemplesAutoComplete(){
             $request=trim($_GET['term']);
	    if($request!=''){
                $match = addcslashes($request, '%_'); // escape LIKE's special characters
$q = new CDbCriteria( array(
    'condition' => "temple_name LIKE :match",         // no quotes around :match
    'params'    => array(':match' => "%$request%")  // Aha! Wildcards go here
) );
 
$model = Temples::model()->findAll( $q );  
	         //$model=Temples::model()->findAll(array("condition"=>"temple_name LIKE  '$request%'"));
                
	        $data=array();
	        foreach($model as $get){
	            $data[$get->id]=$get->temple_name;
	        }
			
		
		
	        $this->layout='empty';
	        echo json_encode($data);
	    }
        }

	
	function actionEpooja()
	{
		$this->render('poojaview_old');
	}
		
		
	function actionEpoojaAjax()
	{
	$criteria = new CDbCriteria();
	
	
	$condition  = ' is_active=1 ';
	if(isset($_REQUEST['title'])){ 
	$condition .= ' AND pooja_name   LIKE  "%'.$_REQUEST['title'].'%"';
	}
	
	
	if(isset($_REQUEST['epooja_category'])){ 
	if($_REQUEST['epooja_category']=='all')
	$condition .= '';
	else
	$condition .= '  AND	pooja_category_id ="'.$_REQUEST['epooja_category'].'"';
	}
	
	$criteria->condition =  $condition;
	
	
	$result = Pooja::model()->findAll($criteria);
    $dataProvider = new CArrayDataProvider($result);

	$this->renderPartial('_poojaview_ajax', array(
	'dataProvider' => $dataProvider));
	
	}

	
	function  actionPoojalist()
	{
		$criteria = new CDbCriteria();
		
		$condition  = ' is_active=1 ';
		if(isset($_REQUEST['title'])){ 
		 $condition .= ' AND pooja_name   LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
		
		
                if(isset($_REQUEST['epooja_category'])){ 
		  if($_REQUEST['epooja_category']=='all')
		   $condition .= '';
		  else
		  $condition .= '  AND	pooja_category_id ="'.$_REQUEST['epooja_category'].'"';
		}
		
	  $criteria->condition =  $condition;
		
	    //$criteria->condition = 'country = :country';
	  	//$criteria->params = array (':country'=> $_GET['country']);
		//$criteria->order = 'ac_name asc';
		 
		//get count
		$count = Pooja::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(12);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Pooja::model()->findAll($criteria);
		$result1 = Pooja::model()->findAll('is_active=1');
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_poojaview_list', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'page_size'=>'12',
                'items_count'=>$count,
				'pages' => $pages
			));
		} else{
			$this->render('poojaview_list', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'page_size'=>'12',
                'items_count'=>$count,
				'pages' => $pages
			));
	    }
	
	} 
	
		function actionEpoojaauto(){
	
	  $q = $_GET['name_startsWith'];

        $rows = array();

        $sql = 'SELECT  `pooja_name` FROM pooja WHERE `pooja_name` LIKE "%' . $q . '%"';
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$data =array();
		
        for($i=0;$i<count($rows);$i++)
		{
		if(!in_array($rows[$i]['pooja_name'],$data))
		array_push($data, $rows[$i]['pooja_name']);	
		}		
		echo json_encode($data);
	}	
	
	
			function getDatesFromRange($start, $end){
   
    return $dates;
}




	
	function actionIyer()
	{
         $model=new User;
	   //get criteria
		$criteria = new CDbCriteria();
		
		$criteria->select = "t.*,ug.iyer_phone,ug.iyer_city,ug.iyer_state,ug.iyer_country,ug.iyer_description,ug.iyer_sec_languages,rv.*";
		
		$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id";
		
	    $condition  = ' t.role = 4 AND t.registration_completed=1 and ug.iyer_city<>"0" and ug.iyer_state<>"0" and ug.iyer_country<>"0"  ';
		 
		 
		 
			if(isset($_REQUEST['fromdate']) && $_REQUEST['fromdate']!='' && $_REQUEST['todate']=='')
			{
			$condition .= ' AND	ug.availability_dates  LIKE   "%'.$_REQUEST['fromdate'].'%" ';
			}
			else if(isset($_REQUEST['fromdate']) && $_REQUEST['fromdate']!='' && isset($_REQUEST['todate']) && $_REQUEST['todate']!='')
			{
			$dates = array($_REQUEST['fromdate']);
			while(end($dates) < $_REQUEST['todate']){
			$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
			}
			
			$condition1 ='';
			
			for($i=0;$i<count($dates);$i++)
			{
			if($i==0)
			$condition1 .= 'AND ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
			else
			$condition1 .= 'OR ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
			}
			$condition .= $condition1;
			}
			

			 if(isset($_REQUEST['language'])){	 
			  $condition .= '  AND  t.language IN  ('.implode(',',$_REQUEST['language']).')'; 
			 }
			 
			 
			 if(isset($_REQUEST['working_hours'])){	 
			 $explode1 = explode(' ',$_REQUEST['working_hours']);
			 $explode = explode('-',$explode1[0]);			 
			  $condition .= '  AND  iyer_wh>'.$explode[0].' and iyer_wh<'.$explode[1].' '; 
			 }


      if(isset($_REQUEST['ratings'])){
		  $condition .= ' AND	review_rate  IN  ('.implode(',',$_REQUEST['ratings']).')';
		}
                
		
		if(isset($_REQUEST['title']) && ($_REQUEST['title']!='')){
		 $names = explode(' ',$_REQUEST['title']);
		 
	 
		 $names = array_filter($names);
		 if(count($names)>1)
		    $condition .= ' AND first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[1].'%" or pooja_name LIKE  "%'.$_REQUEST['title'].'%"';
			else
			$condition .= ' AND first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[0].'%" or pooja_name LIKE  "%'.$_REQUEST['title'].'%"';
		}

                if(isset($_REQUEST['categories'])){
                     $condition .= ' AND iyer_categories  LIKE  "%'.$_REQUEST['categories'].'%"';
                     
            
		}
                if(isset($_REQUEST['experience'])){
                   
                    foreach($_REQUEST['experience'] as  $cate){
                        $t=explode('_',$cate);
                        $ty[]=$t[0];
                        $ty[]=$t[1];
                       
                    }
                     $condition .= ' AND ( iyer_experience  >  "'.min($ty).'" AND  iyer_experience  < "'.max($ty).'" )';
		 
		}
                
                 if(isset($_REQUEST['amounts'])){
                   
                    foreach($_REQUEST['amounts'] as  $amts){
                        $amt=explode('_',$amts);
                        $at[]=$amt[0];
                        $at[]=$amt[1];
                      
                    }
                     $condition .= ' AND ( iyer_amount  >=  "'.min($at).'" AND  iyer_amount  < "'.max($at).'" )';
		 
		}

                 if(isset($_REQUEST['states'])){
		  $condition .= ' AND ug.iyer_state 	 IN  ('.implode(',',$_REQUEST['states']).')';
		}
		
		
			$criteria->group = 't.user_id';		

	      $criteria->condition =  $condition;

		

		//get count
	    $count = User::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		 
		//result to show on page
		$result = User::model()->findAll($criteria);
		
		//$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id ";
		$dataProvider = new CArrayDataProvider($result);
		
		
		$criteriaty = new CDbCriteria();
		$criteriaty->condition  = ' role = 4 AND registration_completed=1';
		$criteriaty->join = " JOIN iyer ug ON ug.user_id=t.user_id ";
		$resultall=User::model()->findAll($criteriaty);
		$dataall= new CArrayDataProvider($resultall);

		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_iyerview_aravind_ajax', array(
				'dataProvider' => $dataProvider,
				'dataProall'=>$dataall,
				'items_count'=>$count,
				'pages' => $pages,
				'model'=>$model,
		        'page_size'=>'10',
			));
		} else{
			$this->render('iyerview_aravind', array(
						  'dataProvider' => $dataProvider,
						  'dataProall'=>$dataall,
						  'items_count'=>$count,
						  'pages' => $pages,
						  'model'=>$model,
						  'page_size'=>'10',
			));
	    }
        }
		
		

		
		
		
			function actionIyer_list()
			{ $model=new User;
	   //get criteria
		$criteria = new CDbCriteria();
		
		$criteria->select = "t.*,ug.iyer_phone,ug.iyer_city,ug.iyer_state,ug.iyer_country,ug.iyer_description,ug.iyer_sec_languages,rv.*";
		
		$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id";
		
	 	 $condition  = ' t.role = 4 AND t.registration_completed=1 and ug.iyer_city<>"0" and ug.iyer_state<>"0" and ug.iyer_country<>"0"  ';
		 
		 
		 
			if(isset($_REQUEST['fromdate']) && $_REQUEST['fromdate']!='' && $_REQUEST['todate']=='')
			{
			$condition .= ' AND	ug.availability_dates  LIKE   "%'.$_REQUEST['fromdate'].'%" ';
			}
			else if(isset($_REQUEST['fromdate']) && $_REQUEST['fromdate']!='' && isset($_REQUEST['todate']) && $_REQUEST['todate']!='')
			{
			$dates = array($_REQUEST['fromdate']);
			while(end($dates) < $_REQUEST['todate']){
			$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
			}
			
			$condition1 ='';
			
			for($i=0;$i<count($dates);$i++)
			{
			if($i==0)
			$condition1 .= 'AND ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
			else
			$condition1 .= 'OR ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
			}
			$condition .= $condition1;
			}
			

			 if(isset($_REQUEST['language'])){	 
			  $condition .= '  AND  t.language IN  ('.implode(',',$_REQUEST['language']).')'; 
			 }
			 
			 
			 if(isset($_REQUEST['working_hours'])){	 
			 $explode1 = explode(' ',$_REQUEST['working_hours']);
			 $explode = explode('-',$explode1[0]);			 
			  $condition .= '  AND  iyer_wh>'.$explode[0].' and iyer_wh<'.$explode[1].' '; 
			 }


      if(isset($_REQUEST['ratings'])){
		  $condition .= ' AND	review_rate  IN  ('.implode(',',$_REQUEST['ratings']).')';
		}
                
		
		if(isset($_REQUEST['title']) && ($_REQUEST['title']!='')){
		 $names = explode(' ',$_REQUEST['title']);
		    $condition .= ' AND first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[1].'%" or pooja_name LIKE  "%'.$_REQUEST['title'].'%"';
		}

                if(isset($_REQUEST['categories'])){
                     $condition .= ' AND iyer_categories  LIKE  "%'.$_REQUEST['categories'].'%"';
                     
            
		}
                if(isset($_REQUEST['experience'])){
                   
                    foreach($_REQUEST['experience'] as  $cate){
                        $t=explode('_',$cate);
                        $ty[]=$t[0];
                        $ty[]=$t[1];
                       
                    }
                     $condition .= ' AND ( iyer_experience  >  "'.min($ty).'" AND  iyer_experience  < "'.max($ty).'" )';
		 
		}
                
                 if(isset($_REQUEST['amounts'])){
                   
                    foreach($_REQUEST['amounts'] as  $amts){
                        $amt=explode('_',$amts);
                        $at[]=$amt[0];
                        $at[]=$amt[1];
                      
                    }
                     $condition .= ' AND ( iyer_amount  >=  "'.min($at).'" AND  iyer_amount  < "'.max($at).'" )';
		 
		}

                 if(isset($_REQUEST['states'])){
		  $condition .= ' AND ug.iyer_state 	 IN  ('.implode(',',$_REQUEST['states']).')';
		}
		
		
			$criteria->group = 't.user_id';		

	      $criteria->condition =  $condition;

			//get count
			$count = User::model()->count($criteria);
			
			//pagination
			$pages = new CPagination($count);
			$pages->setPageSize(10);
			
			//result to show on page
			$result = User::model()->findAll($criteria);
			//$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id ";
			$dataProvider = new CArrayDataProvider($result);
			
			$criteriaty = new CDbCriteria();
			$criteriaty->condition  = ' role = 4 AND registration_completed=1';
			$criteriaty->join = " JOIN iyer ug ON ug.user_id=t.user_id ";
			$resultall=User::model()->findAll($criteriaty);
			$dataall= new CArrayDataProvider($resultall);
			
			if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_iyerview_aravind_list_ajax', array(
			'dataProvider' => $dataProvider,
			'dataProall'=>$dataall,
			'items_count'=>$count,
			'pages' => $pages,
			'model'=>$model,
			'page_size'=>'10',
			));
			} else{
			$this->render('iyerview_aravind_list', array(
			'dataProvider' => $dataProvider,
			'dataProall'=>$dataall,
			'items_count'=>$count,
			'pages' => $pages,
			'model'=>$model,
			'page_size'=>'10',
			));
			}
			}
	
	
	function actionProducts()
	{
	
	 $model=new User;
	
	 $this->render('productsview', array('model'=>$model));
	   //get criteria
		/*$criteria = new CDbCriteria();
		
		$condition  = ' is_active=1 ';
		
        if(isset($_REQUEST['title'])){ 
		 $condition .= ' AND product_name   LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
		
		if(isset(Yii::app()->session['product_categories']) && Yii::app()->session['product_categories']!='all'){ 
		 $condition .= '  AND	store_category_id="'.Yii::app()->session['product_categories'].'"';	
		}

	   $criteria->condition =  $condition;
		
	    //$criteria->condition = 'country = :country';
	  	//$criteria->params = array (':country'=> $_GET['country']);
		//$criteria->order = 'ac_name asc';
		 
		//get count
		$count = Storeproducts::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(16);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Storeproducts::model()->findAll($criteria);
		$result1 = Storeproducts::model()->findAll('is_active=1');
		$dataProvider = new CArrayDataProvider($result);
		

		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_products_view', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'page_size'=>'16',
                'items_count'=>$count,
				'pages' => $pages
			));
		} else{
			$this->render('productsview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'page_size'=>'16',
                'items_count'=>$count,
				'pages' => $pages
			));
	    }*/
	}
	
	function actionProductlist()
	{
	
	   //get criteria
		$criteria = new CDbCriteria();
		
		$condition  = ' is_active=1 ';


		if(isset(Yii::app()->session['product_categories']) && Yii::app()->session['product_categories']!='all'){ 
		 $condition .= '  AND	store_category_id="'.Yii::app()->session['product_categories'].'"';	
		}
		
	   $criteria->condition =  $condition;
		

		 
		//get count
		$count = Storeproducts::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(16);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Storeproducts::model()->findAll($criteria);
		$result1 = Storeproducts::model()->findAll('is_active=1');
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('_products_list', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'page_size'=>'16',
                'items_count'=>$count,
				'pages' => $pages
			));
		} else{
			$this->render('product_list', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'page_size'=>'16',
                'items_count'=>$count,
				'pages' => $pages
			));
	    }
   }
   
   	function actionSelectvariations()
	{
	    $get_id = explode('-',$_POST['id']);
		
	    if($get_id[1]!='0')
		{
		$criteria = new CDbCriteria;
		$criteria->condition='product_id=:product_id and variation_id=:variation_id';
		$criteria->params=array(':product_id'=>$get_id[0],':variation_id'=>$get_id[1]);
		$selectname = Productvariations::model()->findAll($criteria);	
		echo $selectname[0]->product_variation_title.'&&'.$selectname[0]->product_price.'&&'.$selectname[0]->product_shipping_price;
		}
		else
		{
		$criteria1 = new CDbCriteria;
		$criteria1->condition='product_id=:product_id';
		$criteria1->params=array(':product_id'=>$get_id[0]);
		$selectname = Storeproducts::model()->findAll($criteria1);		
		echo $selectname[0]->product_name.'&&'.$selectname[0]->product_price.'&&'.$selectname[0]->product_shipping_price;
		}
	}
	
	

	/*function actionNewsevents()
	{    
	    $criteria = new CDbCriteria();
		
		$condition ='';
		
		if(isset($_REQUEST['categories']))
		{ 
		Yii::app()->session['categories'] = $_REQUEST['categories'];
		}
		
	
		
		if(Yii::app()->session['categories']!='')
		{
		  if(Yii::app()->session['categories']=='today')
			{
			 $condition .= ' `news_date` ="'.date('Y-m-d').'"';
			}
			else if(Yii::app()->session['categories']=='yester')
			{
			$yester = date('Y-m-d',strtotime("-1 days"));
			$condition .= ' `news_date` ="'.$yester.'"';
			}
			else if(Yii::app()->session['categories']=='week')
			{
			$dt = strtotime(date('Y-m-d'));
			$start = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last sunday', $dt));
			$end= date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next saturday', $dt));
			$condition .= ' `news_date` >="'.$start.'"  and news_date <= "'.$end.'" ';
			}
			else if(Yii::app()->session['categories']=='month')
			{
			$dt = strtotime(date('Y-m-d'));
			$start = date('Y-m-d', strtotime('first day of this month', $dt));
			$end = date('Y-m-d', strtotime('last day of this month', $dt));
			$condition .= ' `news_date` >="'.$start.'"  and news_date <= "'.$end.'" ';
			}
			else if(Yii::app()->session['categories']=='all')
			{
			  $condition ='';
			}
			else
			{
			$monday = date('Y-m-d', strtotime('monday last week'));
			$start= date('Y-m-d', strtotime('-1 day', strtotime($monday)));
			$end = date('Y-m-d', strtotime('saturday last week')); 
			
			$condition .= ' `news_date` >="'.$start.'"  and news_date <= "'.$end.'" '; 
			}
		    }
			else
			{
			//$condition .= ' news_date ="'.date('Y-m-d').'"';
			//Yii::app()->session['categories'] = 'today';
			 $condition ='';
			}

		$criteria->condition =  $condition;
	    $criteria->order = 'news_date DESC';
			
		
		
		$count = News::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		$result = News::model()->findAll($criteria);
		$dataProvider = new CArrayDataProvider($result);
		
		
		$criteria1 = new CDbCriteria();
		
		$condition1 ='';
		
		if(isset($_REQUEST['events_date']))
		{
           $condition1 .= ' `event_start_date` = "'.$_REQUEST['events_date'].'" or `event_end_date` = "'.$_REQUEST['events_date'].'"  ';
		}
		else if(isset($_REQUEST['events_value']))
		{
		if(isset($_REQUEST['events_value'])){ 
		 Yii::app()->session['events_value'] = $_REQUEST['events_value'];
		}
		 if(Yii::app()->session['events_value']!='')
		 {
		 if(Yii::app()->session['events_value']=='today')
		 $condition1 .= ' `event_start_date` <= "'.date('Y-m-d').'"  and  "'.date('Y-m-d').'" <= `event_end_date` ';
		 else if(Yii::app()->session['events_value']=='tomorrow')
		 {
		  $tomorrow = date("Y-m-d", time()+86400); 
		  $condition1 .= ' `event_start_date` <= "'.$tomorrow.'"  AND "'.$tomorrow.'" <= `event_end_date` ';
		 }
		else if(Yii::app()->session['events_value']=='week')
		{
				$dt =  strtotime(date('Y-m-d'));
				$start = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last sunday', $dt));
				$end= date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next saturday', $dt));
			   	$condition1 .= ' `event_start_date` >="'.$start.'"  and  `event_end_date`  <= "'.$end.'"';
		}
		else if(Yii::app()->session['events_value']=='weekend')
		{
				$dt =  strtotime(date('Y-m-d'));
				$start = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next saturday', $dt));
				$end= date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
			 	$condition1 .= ' `event_start_date` >="'.$start.'"  AND `event_end_date`  <= "'.$end.'"';
		}
		else if(Yii::app()->session['events_value']=='month')
		{
		    $dt = strtotime(date('Y-m-d'));
			$start = date('Y-m-d', strtotime('first day of this month', $dt));
			$end = date('Y-m-d', strtotime('last day of this month', $dt));
			$condition1 .= ' `event_start_date` >="'.$start.'"  and  `event_end_date`  <= "'.$end.'"';
		}
		else if(Yii::app()->session['events_value']=='all')
		{
		  $condition1 ='';
		}
		} 
		}
		else
		{
		  $condition1 ='';
		 // $condition1 .= ' `event_start_date` <= "'.date('Y-m-d').'" ';
		 // Yii::app()->session['events_value']='today';
		}
		
		 

		
		$criteria1->condition =  $condition1;
		$criteria1->order = 'event_start_date ASC';
		
		$count1 = Events::model()->count($criteria1);
		$pages = new CPagination($count1);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria1);
		$result1 = Events::model()->findAll($criteria1);
		$dataProvider1 = new CArrayDataProvider($result1);
		
       
		 
		if(Yii::app()->request->isAjaxRequest){
		
		if(isset($_REQUEST['categories'])!='')
		{
				$this->renderPartial('news_ajax', array(
				'dataProvider' => $dataProvider,
				'pages' => $pages
			));
		}
		else
		{
		$this->renderPartial('events_ajax', array(
				'dataProvider' => $dataProvider,
				'dataProvider1'=>$dataProvider1,
				'pages' => $pages
			));
		}
		}
		else
		{
	    $this->render('news',array('dataProvider' => $dataProvider,'dataProvider1'=>$dataProvider1,'pages' => $pages));
		}
	}*/
	
	function actionNews()
	{
	
	$this->pageTitle =' Temples Unlimited | News & Events';
	
	$criteria = new CDbCriteria();
	   $condition ='';
	   	if(isset($_REQUEST['categories']))
		{ 
		Yii::app()->session['categories'] = $_REQUEST['categories'];
		}
		
	
		
		if(Yii::app()->session['categories']!='')
		{
		  if(Yii::app()->session['categories']=='today')
			{
			 $condition .= ' `news_date` ="'.date('Y-m-d').'"';
			}
			else if(Yii::app()->session['categories']=='yester')
			{
			$yester = date('Y-m-d',strtotime("-1 days"));
			$condition .= ' `news_date` ="'.$yester.'"';
			}
			else if(Yii::app()->session['categories']=='week')
			{
			$dt = strtotime(date('Y-m-d'));
			$start = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last sunday', $dt));
			$end= date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next saturday', $dt));
			$condition .= ' `news_date` >="'.$start.'"  and news_date <= "'.$end.'" ';
			}
			else if(Yii::app()->session['categories']=='month')
			{
			$dt = strtotime(date('Y-m-d'));
			$start = date('Y-m-d', strtotime('first day of this month', $dt));
			$end = date('Y-m-d', strtotime('last day of this month', $dt));
			$condition .= ' `news_date` >="'.$start.'"  and news_date <= "'.$end.'" ';
			}
			else if(Yii::app()->session['categories']=='all')
			{
			  $condition ='';
			}
			else
			{
			$monday = date('Y-m-d', strtotime('monday last week'));
			$start= date('Y-m-d', strtotime('-1 day', strtotime($monday)));
			$end = date('Y-m-d', strtotime('saturday last week')); 
			
			$condition .= ' `news_date` >="'.$start.'"  and news_date <= "'.$end.'" '; 
			}
		    }
			else
			{
			//$condition .= ' news_date ="'.date('Y-m-d').'"';
			//Yii::app()->session['categories'] = 'today';
			 $condition ='';
			}
		$criteria->condition =  $condition;
	    $criteria->order = 'news_date DESC';
			
		
		
		$count = News::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		$result = News::model()->findAll($criteria);
		$dataProvider = new CArrayDataProvider($result);
		
		
		
		if(isset($_REQUEST['categories'])!='')
		{
				$this->renderPartial('news_ajax', array(
				'dataProvider' => $dataProvider,
				'pages' => $pages,
				'items_count'=>$count,
				'page_size'=>'10'
			));
		}
		else
		{
	    $this->render('news1',array('dataProvider' => $dataProvider,'pages' => $pages, 'items_count'=>$count,'page_size'=>'10',));
		}
	}
	
	
		function getAllDatesBetweenTwoDates($strDateFrom,$strDateTo)
		{
		$aryRange=array();
		
		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
		
		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
		}
		
	
	function actionevents()
	{   
	if(Yii::app()->session['calender_values'])
	unset(Yii::app()->session['calender_values']); 
	
	$this->pageTitle =' Temples Unlimited | News & Events';

	$criteria1 = new CDbCriteria();
	
	$condition1 ='';

	$condition1 .= ' `event_end_date` >= "'.date('Y-m-d').'" ';

	if(isset($_REQUEST['events_value']))
	{
	if(isset($_REQUEST['events_value'])){ 
	Yii::app()->session['events_value'] = $_REQUEST['events_value'];
	}
	if(Yii::app()->session['events_value']!='')
	{
	if(Yii::app()->session['events_value']=='today')
	{
	$condition1 .= ' and `event_start_date` <= "'.date('Y-m-d').'" and  `event_end_date` >= "'.date('Y-m-d').'" ';
	}
	else if(Yii::app()->session['events_value']=='tomorrow')
	{
	$tomorrow = date("Y-m-d", time()+86400); 
	$condition1 .= ' and `event_start_date` <= "'.$tomorrow.'"  AND   `event_end_date` >= "'.$tomorrow.'" ';
	}
	else if(Yii::app()->session['events_value']=='week')
	{
	$dt =  strtotime(date('Y-m-d'));
	
	$day1 = date('l', strtotime(date('Y-m-d')));
	
	if($day1=='Saturday')
	{
	$start = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last sunday', $dt));
	$end= date('Y-m-d');
	}
	else
	{				
	$start = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last sunday', $dt));
	$end= date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next saturday', $dt));
	}
	$condition1 .= ' and `event_start_date` <= "'.$end.'"  ';
	}
	else if(Yii::app()->session['events_value']=='weekend')
	{
	$dt =  strtotime(date('Y-m-d'));
	
	$start = date('Y-m-d', strtotime('this saturday', $dt));
	$end  = date('Y-m-d', strtotime('this sunday', $dt));

	$condition1 .= ' and (`event_start_date` <= "'.$start.'"  AND   `event_end_date` >= "'.$start.'")  or  (`event_start_date` <= "'.$end.'"  AND  `event_end_date` >= "'.$end.'")';

	}
	else if(Yii::app()->session['events_value']=='month')
	{
	$dt = strtotime(date('Y-m-d'));
	$start = date('Y-m-d', strtotime('first day of this month', $dt));
	$end = date('Y-m-d', strtotime('last day of this month', $dt));
	 $condition1 .= '  and `event_start_date` <= "'.$end.'"  ';
	}
	else if(Yii::app()->session['events_value']=='all')
	{
	$condition1 .='';
	}
	} 
	}
	else
	{
	Yii::app()->session['events_value'] = 'all';
	}

	Yii::app()->session['condition']  = $condition1;
	
	$criteria1->condition =  $condition1;
	$criteria1->order = 'event_start_date DESC';
	
	$count1 = Events::model()->count($criteria1);
	$pages = new CPagination($count1);
	$pages->setPageSize(10);
	$pages->applyLimit($criteria1);
	$result1 = Events::model()->findAll($criteria1);
	$dataProvider1 = new CArrayDataProvider($result1);

	if(Yii::app()->request->isAjaxRequest)
	{
	$this->renderPartial('events_ajax', array(
	'dataProvider1'=>$dataProvider1,
	'pages' => $pages,
	'condition'=>$condition1,
	'items_count'=>$count1,
	'page_size'=>'10'
	));
	}
	else
	{	
	$this->render('events1',array('dataProvider'=>$dataProvider1,'pages'=>$pages,'condition'=>$condition1,'items_count'=>$count1,'page_size'=>'10'));
	}
	}
	
	
	function actionCalender()
	{ 
	$this->pageTitle =' Temples Unlimited | News & Events';
	
	Yii::app()->session['calender_values'] = 'calender_values';
	
        $this->render('calender',array('condition'=>Yii::app()->session['condition']));
	}
	
	
	function actionPoojaoptions()
	{
	    $id = $_POST['id'];
	    /*$op = $_POST['op'];
            if($op==0){
                $model = Pooja::model()->getinfo($id);   		   
		  echo $model->pooja_price;
			
            }
            else{*/
     	$criteria = new CDbCriteria;
		$criteria->condition='pooja_option_id=:pooja_option_id';
		$criteria->params=array(':pooja_option_id'=>$id);
		$selectname = Poojaoptions::model()->findAll($criteria);	
		echo $selectname[0]->option_price.'###'.$selectname[0]->option_shipping_price.'###'.$selectname[0]->pooja_option_id;
         /*   }*/        
	}
	
	public function actionGuide() 
	{
	    $model=new User;
	   //get criteria
		 $criteria = new CDbCriteria();
		
		$criteria->select = "t.*,ug.guide_phone,ug.guide_city,ug.guide_state,ug.guide_country,ug.guide_description,ug.guide_sec_languages,rv.*";
		
		$criteria->join = " JOIN guide ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN guidetemple as ip ON ip.user_id=ug.user_id";
	
	    $condition  = ' t.role = 3 AND t.registration_completed=1 and t.email_validated=1 and ug.guide_overview IS NOT NULL and ug.guide_wh<>"0.0" and ug.guide_experience<>"0.0" and ug.guide_experiencetype IS NOT NULL and ug.guide_amount_option IS NOT NULL  and  guide_amount<>"0.00" and t.status = 1 ';

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

		$resultall=User::model()->findAll($criteria);
		$dataall= new CArrayDataProvider($result);
		
			
		$this->render('guide', array(
						  'dataProvider' => $dataProvider,
						  'dataProall'=>$dataall,
						  
			));

	}
	

	
	

	
}
?>
