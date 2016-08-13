<?php
/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property string $name
 */
class Profile extends CActiveRecord
{


    public $conpassword;
	public $registertype;
	public $id;
	public $newpassword;
	public $connewpassword;
	public $currentpassword;
	
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
			array('first_name, last_name, role, gender, language', 'required','on'=>'common'),
			array('first_name,  role, language, last_name, gender', 'required','on'=>'normal'),
			//array('password', 'required'),
			 array('password', 'length', 'min' => 6, 'max'=>16,'on'=>'reset'),
			 
			 
			 array('password', 'match', 'pattern'=>'/^((?=.*\\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]))/', 'message'=>'Password must be 6 to 16 characters long and contain all of the following: upper case letters, lower case letters, digits and special characters.','on'=>'reset'),
	
			
			
			array('social_provider, social_identifier, first_name, role, language', 'required','on'=>'social'),
			
			array('newpassword, connewpassword, currentpassword', 'required','on'=>'passwordchange'),
			array('currentpassword', 'checkcurrentpassword',  'on'=>'passwordchange'),
				
			array('newpassword', 'match', 'pattern'=>'/^((?=.*\\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]))/', 'message'=>'Password must be 6 to 16 characters long and contain all of the following: upper case letters, lower case letters, digits and special characters.','on'=>'passwordchange'),
			
			array('email', 'email'),
/*            array('email', 'unique','except' =>'forgot'),
			array('email', 'unique','except' =>'reset'),*/
			array('email', 'required','on'=>'forgot'),
			array('password', 'required','on'=>'reset'),			
			array('email', 'checkforemailexits','on'=>'reset'),
			array('email', 'checkforemailexits','on'=>'forgot'),
			
			//array('conpassword ', 'compare', 'compareAttribute'=>'password', 'on'=>'normal'),
			//array('conpassword', 'compare', 'compareAttribute'=>'password', 'on'=>'reset'),
			array('conpassword', 'password_check','on'=>'reset'),
			array('conpassword', 'password_check','on'=>'normal'),
			array('connewpassword', 'password_check_profile','on'=>'passwordchange'),
			array('email', 'unique', 'on'=>'normal'),  
			array('email', 'unique', 'on'=>'social'),  
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, gender, first_name, last_name, email, password, conpassword, role, social_provider, social_identifier, user_image, status, language, created_on, updated_on, registration_completed, email_validated, registertype, gender1, dob, password_reset_id, favourite_products', 'safe'),
		);
	}
	
	public function password_check_profile($attribute,$params)
	{
	if($this->$attribute=='')
	{
	$this->addError($attribute,' Confirm password cannot be blank.');
	}
	else if($this->$attribute!=$this->newpassword)
	{
	$this->addError($attribute,' Confirm Password must be repeated exactly.');
	}
	
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
	
	public function checkcurrentpassword($attribute,$params){
	

	     $details = $this->findByPk(Yii::app()->user->id);
		 $currentpassword = helpers::encrypt_password($this->$attribute);
		 
	
		if($details->password !=  $currentpassword )
		$this->addError($attribute,'Please enter correct password');

	
	}
	
	public function checkforemailexits($attribute,$params){
	if(filter_var($this->$attribute, FILTER_VALIDATE_EMAIL)) {
 
		if(trim($this->$attribute) != ''){
	     $details = $this->find('email=:email',array(':email'=>$this->$attribute));
		
		if( !count( $details) || $details->email !=  $this->$attribute )
		$this->addError($attribute,' Specified email not exits.');
		}
	}	
	
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
			'newpassword'=>'New Password',
			'connewpassword'=>'Confirm New Password',
			'currentpassword'=>'Current Password',
			
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
        $mail->SetFrom($from, 'Lexgo');
        $mail->Subject    = $subject;
		$mailpage = Page::model()->getpage('1');
		$a = $mailpage->pdescription;
		$a = str_replace('{{{{{{CONTENT}}}}}}',$message,$a);
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
	
	function favourite_widget($id){
	    $product = Storeproducts::model()->findByPk($id);
		$widget = '';
		if(count( $product) && !empty($product) ){ 
		      if(!Yii::app()->user->isGuest){  
			      $user = $this->findByPk(Yii::app()->user->id);
				  $favourite_products = explode(',',$user->favourite_products);
				  
				  if(in_array($id, $favourite_products)){ 
				        $widget =  '<a href="javascript:void(0)" class="productfavourite'.$id.'" onclick="removefavourite(\''.$id.'\')" ><img src="'.Yii::app()->request->baseUrl.'/images/fav.png" title="Added to Favorite" style="margin-top:-10px;"  /></a>';
				  }else{
				         if($user->role == '2')
				         $widget =  '<a href="javascript:void(0);" class="productfavourite'.$id.'" onclick="makefavourite(\''.$id.'\')"><img src="'.Yii::app()->request->baseUrl.'/images/unfav.png" style="margin-top:-12px;"   title="Add to Favourite" /></a>';
				  }
			  }else{
			        $widget =  '<a href='.Yii::app()->createUrl('/login?fav=fav').'  class="productfavourite'.$id.'"  data-type="favourite" data-id="'.$id.'"><img  style="margin-top:-12px;" src="'.Yii::app()->request->baseUrl.'/images/unfav.png" title="Add to Favourite"  /></a>';
			  }

		    return $widget;		  
		}
	}
	
	public function username($id)
	{
		 $username = $this->findByPk($id); 
		 return   $username->first_name.' '.$username->last_name;
		 
   }
	
	
	

	
	
}
?>
