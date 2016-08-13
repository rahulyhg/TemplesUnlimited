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
		$criteriaguide->select=' GROUP_CONCAT(user_id) as userids';
		
		if(isset($_REQUEST['title'])){ 
		 $conditionguide .= ' AND guide_title  LIKE  "%'.$_REQUEST['title'].'%"';
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
				'pages' => $pages
			));
		} else{
			$this->render('guideview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
	    }
	
	    
	}
	
	function actionTemples(){
	
	
	   
	   //get criteria
		$criteria = new CDbCriteria();
		
		$condition  = ' 1 ';
		if(isset($_REQUEST['title'])){ 
		 $condition .= ' AND temple_name  LIKE  "%'.$_REQUEST['title'].'%"';
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
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('view', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
		} else{
			$this->render('view', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
	    }
	}
	
	
	
		
	
	
	function actionEpooja(){
	
	
	   
	   //get criteria
		$criteria = new CDbCriteria();
		
		$condition  = ' is_active=1 ';
		if(isset($_REQUEST['title'])){ 
		 $condition .= ' AND pooja_name   LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
		if(isset($_REQUEST['categories'])){ 
		 $condition .= '  AND	pooja_category_id ="'.$_REQUEST['categories'].'"';
		}
		
		
	  $criteria->condition =  $condition;
		
	    //$criteria->condition = 'country = :country';
	  	//$criteria->params = array (':country'=> $_GET['country']);
		//$criteria->order = 'ac_name asc';
		 
		//get count
		$count = Pooja::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Pooja::model()->findAll($criteria);
		$result1 = Pooja::model()->findAll('is_active=1');
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('poojaview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
		} else{
			$this->render('poojaview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
	    }
	}
	
	
	function actionIyer(){
	
	 //get criteria
		$criteria = new CDbCriteria(); 
	 	$condition  = ' role = 4 AND registration_completed=1 ';
		
	/*	if((isset($_REQUEST['fromdate'])  &&  trim($_REQUEST['fromdate']) != '')|| (isset($_REQUEST['todate'])   &&  trim($_REQUEST['todate']) != '')){
		
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
	}	*/
	
	
	
	
	
	  
	  if(isset($_REQUEST['title'])){ 
		  $condition .= ' AND	concat_ws(" ", first_name, last_name )	LIKE  "%'.$_REQUEST['title'].'%" ';
		}
	

	
	   $status = true;
		$criteriaiyer = new CDbCriteria();
		$conditioniyer  = '1';
		$criteriaiyer->select=' GROUP_CONCAT(user_id) as userids';
		
		
	  if(isset($_REQUEST['categories'])){ 
		 $conditioniyer .= '  AND	FIND_IN_SET("'.$_REQUEST['categories'].'",iyer_categories )';
		}
		
		if(isset($_REQUEST['states'])){ 
		  $conditioniyer .= ' AND	iyer_state  IN  ('.implode(',',$_REQUEST['states']).')';
		}
		
		
	 if(isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != ''){ 
		 $cid = helpers::simple_decrypt($_REQUEST['cid']);
		  $data = Iyer::model()->getinfo($cid);
	    $relatedcategory = $data->iyer_categories;
		$relatedcategories  = array_filter(explode(',', $relatedcategory ));
		  if(count( $relatedcategories)){
		  $relatedcategorycount = 0;
		  $conditioniyer .= ' AND (';
			   foreach($relatedcategories as $categoryid){$relatedcategorycount++;
				  if($relatedcategorycount>1)
				  $conditioniyer .= ' OR	 find_in_set('.$categoryid.',iyer_categories) ';
				  else
				   $conditioniyer .= '  find_in_set('.$categoryid.',iyer_categories) ';
				  
				}
				 $conditioniyer .= ') ';
			}
		}
		
		
		if(isset($_REQUEST['experience']) && count($_REQUEST['experience'])){ 
		$conditioniyer .= ' AND (';
		$experiencecount = 0;
		    foreach($_REQUEST['experience'] as $experience){ $experiencecount++;
			  $experience = explode('_',$experience);
			   if($experiencecount>1)
		      $conditioniyer .= ' OR	 (iyer_experience>='. $experience[0].'  AND iyer_experience<'. $experience[1].' ) ';
			  else
			  $conditioniyer .= ' (iyer_experience>='. $experience[0].'  AND iyer_experience<'. $experience[1].' )';
		    }
		  $conditioniyer .= ')';
		}
		
		
		if(isset($_REQUEST['whours']) && count($_REQUEST['whours'])){ 
		$conditioniyer .= ' AND (';
		$whourcount = 0;
		    foreach($_REQUEST['whours'] as $whour){ $whourcount++;
			  $whour = explode('_',$whour);
			   if($whourcount>1)
		      $conditioniyer .= ' OR	 (iyer_wh>='. $whour[0].'  AND iyer_wh<'. $whour[1].' ) ';
			  else
			  $conditioniyer .= ' (iyer_wh>='. $whour[0].'  AND iyer_wh<'. $whour[1].' )';
		    }
		  $conditioniyer .= ')';
		}
		
		
		
		
		
		
		
		
		
		if(isset($_REQUEST['amounts']) && count($_REQUEST['amounts'])){ 
		$conditioniyer .= ' AND (';
		$amountcount = 0;
		    foreach($_REQUEST['amounts'] as $amount){ $amountcount++;
			  $amount = explode('_',$amount);
			   if($amountcount>1)
		      $conditioniyer .= ' OR	 (iyer_amount>='. $amount[0].'  AND iyer_amount<'. $amount[1].' ) ';
			  else
			  $conditioniyer .= ' (iyer_amount>='. $amount[0].'  AND iyer_amount<'. $amount[1].' )';
		    }
		  $conditioniyer .= ')';
		}
		
		
		 $criteriaiyer->condition =  $conditioniyer;
		
		if((isset($_REQUEST['amounts']) && count($_REQUEST['amounts'])) ||  (isset($_REQUEST['experience']) && count($_REQUEST['experience'])) ||  (isset($_REQUEST['whours']) && count($_REQUEST['whours'])) || isset($_REQUEST['states']) ||  isset($_REQUEST['categories']) || (isset($_REQUEST['cid']) && trim($_REQUEST['cid']) != '') ){ 
		   $iyers = Iyer::model()->find($criteriaiyer);
		   
		   if($iyers->userids || trim($iyers->userids) != ''){
		       $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$iyers->userids)).')';
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
		$criteria1->params = array (':role'=> '4');
		$criteria1->order = 'user_id asc';
		$criteria1->group= 'user_id';
		
		$result1 = User::model()->findAll($criteria1);
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		 if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('iyerview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
		} else{
			$this->render('iyerview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
	    }
	    
	}
	
	
	function actionProducts(){
	
	
	   
	   //get criteria
		$criteria = new CDbCriteria();
		
		$condition  = ' is_active=1 ';
		if(isset($_REQUEST['title'])){ 
		 $condition .= ' AND product_name   LIKE  "%'.$_REQUEST['title'].'%"';
		}
		
		if(isset($_REQUEST['categories'])){ 
		 $condition .= '  AND	store_category_id="'.$_REQUEST['categories'].'"';
		}
		
		
	  $criteria->condition =  $condition;
		
	    //$criteria->condition = 'country = :country';
	  	//$criteria->params = array (':country'=> $_GET['country']);
		//$criteria->order = 'ac_name asc';
		 
		//get count
		$count = Storeproducts::model()->count($criteria);
		 
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(10);
		$pages->applyLimit($criteria);
		 
		//result to show on page
		$result = Storeproducts::model()->findAll($criteria);
		$result1 = Storeproducts::model()->findAll('is_active=1');
		$dataProvider = new CArrayDataProvider($result);
		$dataProvider1 = new CArrayDataProvider($result1);
		 
		if(Yii::app()->request->isAjaxRequest){
				$this->renderPartial('productsview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
		} else{
			$this->render('productsview', array(
				'dataProvider' => $dataProvider,
				'dataProvider1' => $dataProvider1,
				'pages' => $pages
			));
	    }
	}
	
	
	function actionNews()
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
		
		if(isset($_REQUEST['categories'])!='')
		{
				$this->renderPartial('news_ajax', array(
				'dataProvider' => $dataProvider,
				'pages' => $pages
			));
		}
		else
		{
	    $this->render('news1',array('dataProvider' => $dataProvider,'pages' => $pages));
		}
	}
	
	
	function actionevents()
	{    
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
		
		if(Yii::app()->request->isAjaxRequest)
		{
		$this->renderPartial('events_ajax', array(
				'dataProvider1'=>$dataProvider1,
				'pages' => $pages
			));
		}
		else
		{	
        $this->render('events1',array('dataProvider'=>$dataProvider1,'pages'=>$pages,'activeTab'=>'tab2',));
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
		$pages1 = new CPagination($count1);
		$pages1->setPageSize(10);
		$pages1->applyLimit($criteria1);
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
		
		 $this->render('news1',array('dataProvider' => $dataProvider,'dataProvider1'=>$dataProvider1,'pages' => $pages));
	   // $this->render('news',array('dataProvider' => $dataProvider,'dataProvider1'=>$dataProvider1,'pages' => $pages,'pages1'=>$pages1));
		}
	}
	
	
	function actionevents()
	{    
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

	    $this->render('events',array('dataProvider1'=>$dataProvider1,'pages'=>$pages));
	}*/
	
	

	
}
?>