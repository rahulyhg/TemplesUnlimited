<?php
/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property string $name
 */
class User extends CActiveRecord
{


    public $conpassword;
	public $registertype;
	public $id;
	public $guideactivities;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email,password', 'required'),
			 array('password', 'length', 'min' => 6, 'max'=>16,'tooLong'=>Yii::t("translation", "Your password can't be longer than 16 characters.")),
			
			array('password', 'match', 'pattern'=>'/^((?=.*\\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]))/', 'message'=>'Password must be 6 to 16 characters long and contain at least three of the following: upper case letters, lower case letters, digits and special characters.'),

			array('first_name, last_name, role, gender, language,email', 'required','on'=>'common'),
			array('first_name,  role, language, last_name, gender', 'required','on'=>'normal'),
			array('social_provider, social_identifier, first_name, role, language, last_name, gender', 'required','on'=>'social'),
			array('email', 'email'),
			//array('conpassword', 'compare', 'compareAttribute'=>'password', 'on'=>'normal'),
			//array('conpassword', 'compare', 'compareAttribute'=>'password', 'on'=>'common'),
			array('conpassword', 'password_check','on'=>'common'),
			array('conpassword', 'password_check','on'=>'normal'),
			array('email', 'unique', 'on'=>'common'), 
			array('email', 'unique', 'on'=>'normal'),  
			array('email', 'unique', 'on'=>'social'), 
			array('first_name,last_name','match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/','message' => 'Invalid characters in name.',),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, gender, first_name, last_name, email, password, conpassword, role, social_provider, social_identifier, user_image, status, language, created_on, updated_on, registration_completed, email_validated, registertype, gender1, dob, password_reset_id, favourite_products,verified', 'safe'),
		);
	}
	
	public function password_check($attribute,$params)
	{
	if($this->$attribute=='')
	{
	$this->addError($attribute,' Confirm password cannot be blank.');
	}
	else if($this->$attribute!=$this->password)
	{
	$this->addError($attribute,' Confirm Password must be repeated exactly.');
	}
	}

	/**
	 * @return array relational rules.
	 */
	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'guidemoredetails' => array(self::BELONGS_TO, 'Guide',  'user_id'),
			'iyermoredetails' => array(self::BELONGS_TO, 'Iyer', 'user_id'),
			'languagename' => array(self::BELONGS_TO, 'Languages', 'language'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'password' => 'Password',
			'conpassword' => 'Confirm Password',		
			'role' => 'Role',
			'social_provider' => 'Social Provider Name',	
			'social_identifier' => 'Social Provider Identifier',		
			'user_image' => 'Image',		
			'status' => 'status',		
			'gender'=>'Title',		
			'registertype'=>'Registration with',
			'registration_completed'=>'Registration Completed',
			'gender1'=>'Gender',
			'dob'=>'Date of birth',
			'verified'=>'verified',
		);
	}
	
	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name,true);
	    $criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
	    $criteria->compare('role',$this->role,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('registration_completed',$this->registration_completed,true);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function mailsend($to,$from,$subject,$message){
	    $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'TemplesUnlimited');
        $mail->Subject    = $subject;
		$mailpage = Page::model()->getpage('1');
		$a = $mailpage->pdescription;
		$a = str_replace('{{{{{{CONTENT}}}}}}',$message,$a);
        $mail->MsgHTML($a);
		$mail->ClearAddresses();
		if(is_array($to) && count($to)){
		  foreach($to as $tos){
          $mail->AddAddress($tos, "");
		  }
		}else
		 $mail->AddAddress($to, "");
		 
        if(!$mail->Send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            //echo "Message sent!";
			$mail->ClearAddresses();
        }
	}	
	
	
		/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5($password);
	}
	
	
	public function mailsend_without_template($to,$from,$subject,$message){
	    $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, $from);
        $mail->Subject    = $subject;
		$a = $message;
        $mail->MsgHTML($a);
		if(is_array($to) && count($to)){
		  foreach($to as $tos){
          $mail->AddAddress($tos, "");
		  }
		}else
		 $mail->AddAddress($to, "");
		 
        if(!$mail->Send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            //echo "Message sent!";
        }
	}	
	
	
		function simple_encrypt($string){
	  return base64_encode($string);
	}
	
	function simple_decrypt($string){
	  return base64_decode($string);
	}
	
	function getrole($role){
	
	    return Yii::app()->params['userrolearr'][$role];
	}
	
	function getDatesFromRange($start, $end){
    $dates = array($start);
    while(end($dates) < $end){
        $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
		}
		return $dates;
	}
	
	public function getinfo($id){
	   return $this->find('user_id=:user_id',array(':user_id'=>$id));
	}
	
	
	
	
	function createthumnail($picpath,$picthumbpath,$width='84',$height='84'){
		Yii::app()->setComponents(array('ThumbsGen' => array(
				'class' => 'ext.ThumbsGen.ThumbsGen',
				'scaleResize' => null, //if it is not null $thumbWidth and $thumbHeight will be ommited. for example 'scaleResize'=>0.5 generate image with half dimension
				//one of $thumbWidth or $thumbHeight is optional but not both!
				'thumbWidth' => $width, //the width of created thumbnail on pixel. if height is null the aspect ratio will be reserved
				'thumbHeight' => $height, //the height of created thumbnail on pixel. if width is null the aspect ratio will be reserved
				'postFixThumbName' => '', //the postfix name of thumbnail for example if it set = '_thumb' then  image1.jpg become image1_thumb.jpg
				'recreate' => true, //force to create each thumbnail either exist or not, when is set to false the tumbnails created only in the first time
						  )));
				  
				Yii::app()->ThumbsGen->createthumb($picpath,$picthumbpath);
		}	
		
		
		function searchByIyer()
	    {
		$criteria=new CDbCriteria;

		$criteria->select = "t.*,ug.iyer_phone,ug.iyer_city,ug.iyer_state,ug.iyer_country,ug.iyer_description,ug.iyer_sec_languages,rv.*";
		
		$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id";
	
	    $condition  = ' t.role = 4 AND t.registration_completed=1 and t.email_validated=1 and ug.iyer_overview IS NOT NULL and ug.iyer_wh<>"0.0" and ug.iyer_experience<>"0.0" and 	ug.iyer_experience_type IS NOT NULL and ug.iyer_amount_option IS NOT NULL  and  iyer_amount<>"0.00" and t.status = 1  ';

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
					if(count($dates)=='1')
					{
					  $condition1 .= 'AND  ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
					}
					else
					{
						if($i==0)
						{
						$condition1 .= 'AND (ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
						}
						else
						{
						$condition1 .= 'OR ug.availability_dates  LIKE "%'.$dates[$i].'%" ';
						}  
					}
					}
					if(count($dates)>'1')
					$condition1 .= ')';
					
					$condition .= $condition1;
					}
					
					
					if(isset($_REQUEST['language'])){	 
					$condition .= '  AND  t.language IN  ('.implode(',',$_REQUEST['language']).')'; 
					}

					if(isset($_REQUEST['ratings'])){
					$condition .= ' AND	review_average  IN  ('.implode(',',$_REQUEST['ratings']).')';
					}
					
					
					if(isset($_REQUEST['title']) && ($_REQUEST['title']!='')){
					$names = explode(' ',$_REQUEST['title']);
					
					
					$names = array_filter($names);
					if(count($names)>1)
					$condition .= ' AND (first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[1].'%" or ip.pooja_name LIKE  "%'.$_REQUEST['title'].'%")  ' ;
					else
					$condition .= ' AND (first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[0].'%" or ip.pooja_name LIKE  "%'.$_REQUEST['title'].'%") ';
					}
					
					if(isset($_REQUEST['categories']))
					{
                    $count = count($_REQUEST['categories'])-1;

					for($i=0;$i<count($_REQUEST['categories']);$i++)
					{
							if(count($_REQUEST['categories'])=='1')
							{
							$condition .= ' and  (ug.iyer_categories   LIKE  "%'.$_REQUEST['categories'][$i].'%") '; 
							}
							else
							{
							if($i==0)
							$condition .= ' and  (ug.iyer_categories   LIKE  "%'.$_REQUEST['categories'][$i].'%"  '; 
							else 
							$condition .= ' or ug.iyer_categories   LIKE  "%'.$_REQUEST['categories'][$i].'%" '; 

							if($count==$i)
							 {
							   $condition .=')';
							 }
							}
					}
					}
					
					if(isset($_REQUEST['experience'])){
					
					foreach($_REQUEST['experience'] as  $cate){
					$t=explode('_',$cate);
					$ty[]=$t[0];
					$ty[]=$t[1];
					}
					$condition .= ' AND ( ( iyer_experience  >=  "'.min($ty).'" AND  iyer_experience  < "'.max($ty).'"  and monthsinyears=\'\' ) or  ( monthsinyears >= "'.min($ty).'" AND  monthsinyears< "'.max($ty).'" ))';
					
					
					}
					
					
					if(isset($_REQUEST['working_hours']))
					{	
	    		     foreach($_REQUEST['working_hours'] as  $working_hours){
					$explode1 = explode('-',$working_hours);
					$explode2 =  explode(' ',$explode1[1]);
					$explode3[] = $explode1[0];	
					$explode3[] = $explode2[0];	
					}		 
					$condition .= '  AND ( iyer_wh  >=  "'.min($explode3).'" and iyer_wh  < "' .max($explode3).'" )'; 

					
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => '9',
              ),
		));
	}
	
	
	function searchByGuide()
	{
	  
		$criteria=new CDbCriteria;

		$criteria->select = "t.*,ug.guide_phone,ug.guide_city,ug.guide_state,ug.guide_country,ug.guide_description,ug.guide_sec_languages,rv.*";
		
		$criteria->join = " JOIN guide ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN guidetemple as ip ON ip.user_id=ug.user_id";
	
	    $condition  = ' t.role = 3 AND t.registration_completed=1 and t.email_validated=1 and ug.guide_overview IS NOT NULL and ug.guide_wh<>"0.0" and ug.guide_experience<>"0.0" and ug.guide_experiencetype IS NOT NULL and ug.guide_amount_option IS NOT NULL  and  guide_amount<>"0.00" and t.status = 1 ';

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
					if(count($dates)=='1')
					{
					  $condition1 .= 'AND  ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
					}
					else
					{
						if($i==0)
						{
						$condition1 .= 'AND (ug.availability_dates  LIKE "%'.$dates[$i].'%"  ';
						}
						else
						{
						$condition1 .= 'OR ug.availability_dates  LIKE "%'.$dates[$i].'%" ';
						}  
					}
					}
					 if(count($dates)>'1')
					$condition1 .= ')';
					$condition .= $condition1;
					}
					
					
					if(isset($_REQUEST['languages'])){	 
					$condition .= '  AND  t.language IN  ('.implode(',',$_REQUEST['languages']).')'; 
					}

					if(isset($_REQUEST['ratings'])){
					 $condition .= ' AND	review_average  IN  ('.implode(',',$_REQUEST['ratings']).')';
					}
					
					
					if(isset($_REQUEST['title']) && ($_REQUEST['title']!=''))
					{
					$names = explode(' ',$_REQUEST['title']);
					$names = array_filter($names);
					if(count($names)>1)
					$condition .= ' AND (first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[1].'%" or ip.activity_title LIKE  "%'.$_REQUEST['title'].'%")  ' ;
					else
					$condition .= ' AND (first_name  LIKE  "%'.$names[0].'%"  or  last_name  LIKE  "%'.$names[0].'%" or ip.activity_title LIKE  "%'.$_REQUEST['title'].'%")';
					}
					
					
					if(isset($_REQUEST['categories']))
					{
                    $count = count($_REQUEST['categories'])-1;
					for($i=0;$i<count($_REQUEST['categories']);$i++)
					{
							if(count($_REQUEST['categories'])=='1')
							{
							$condition .= ' and  (ug.guide_categories   LIKE  "%'.$_REQUEST['categories'][$i].'%") '; 
							}
							else
							{
							if($i==0)
							$condition .= ' and  (ug.guide_categories   LIKE  "%'.$_REQUEST['categories'][$i].'%"  '; 
							else 
							$condition .= ' or ug.guide_categories   LIKE  "%'.$_REQUEST['categories'][$i].'%" '; 

							if($count==$i)
							 {
							   $condition .=')';
							 }
							}
					}
					}
					
					
					if(isset($_REQUEST['services']))
					{
                    $count = count($_REQUEST['services'])-1;
					for($i=0;$i<count($_REQUEST['services']);$i++)
					{
							if(count($_REQUEST['services'])=='1')
							{
							$condition .= ' and  (ug.guide_services   LIKE  "%'.$_REQUEST['services'][$i].'%") '; 
							}
							else
							{
							if($i==0)
							$condition .= ' and  (ug.guide_services   LIKE  "%'.$_REQUEST['services'][$i].'%"  '; 
							else 
							$condition .= ' or ug.guide_services   LIKE  "%'.$_REQUEST['services'][$i].'%" '; 

							if($count==$i)
							 {
							   $condition .=')';
							 }
							}
					}
					}
	
					if(isset($_REQUEST['experience'])){
					
					foreach($_REQUEST['experience'] as  $cate){
					$t=explode('_',$cate);
					$ty[]=$t[0];
					$ty[]=$t[1];
					}
					$condition .= ' AND ( ( guide_experience  >=  "'.min($ty).'" AND  guide_experience  <= "'.max($ty).'"  and monthsinyears=\'\' ) or  ( monthsinyears >=  "'.min($ty).'" AND  monthsinyears  < "'.max($ty).'" ))';
					}
					
					
					if(isset($_REQUEST['working_hours']))
					{	
	    		     foreach($_REQUEST['working_hours'] as  $working_hours){
					$explode1 = explode('-',$working_hours);
					$explode2 =  explode(' ',$explode1[1]);
					$explode3[] = $explode1[0];	
					$explode3[] = $explode2[0];	
					}		 
					$condition .= '  AND ( guide_wh  >=  "'.min($explode3).'" and guide_wh  < "' .max($explode3).'" )'; 
					}
					
					
					if(isset($_REQUEST['amounts']))
					{
					foreach($_REQUEST['amounts'] as  $amts){
					$amt=explode('_',$amts);
					$at[]=$amt[0];
					$at[]=$amt[1];
					}
					$condition .= ' AND ( guide_amount  >=  "'.min($at).'" AND  guide_amount  < "'.max($at).'" )';
					}
					
					if(isset($_REQUEST['states'])){
					$condition .= ' AND ug.guide_state 	 IN  ('.implode(',',$_REQUEST['states']).')';
					}
					 
					 $criteria->group = 't.user_id';	
		
		             $criteria->condition =  $condition;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => '9',
              ),
		));
	
	}	
	

	
	
}
?>
