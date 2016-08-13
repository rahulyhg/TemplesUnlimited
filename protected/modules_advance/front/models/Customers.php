<?php
class Customers extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 */
	 
		public $conpassword;
		public $col_country;
		public $col_state;
		public $col_city;
		public $col_postcode;
		public $del_country;
		public $del_state;
		public $del_city;
		public $del_postcode;
		public $login_username;
		public $login_password;
		public $login_method;
		
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, conpassword', 'required', 'on'=>'Register'),
			array('login_username, login_password', 'required', 'on'=>'Login'),
			array('username', 'required', 'on'=>'forgot'),  
			array('password, conpassword', 'required', 'on'=>'reset'),
			array('password, conpassword','length','min'=>6, 'on'=>'Register'),
			array('password','length','min'=>6, 'on'=>'Login'),
			array('email', 'required', 'on'=>'Accountupdate'),
			array('password, oldpassword, conpassword', 'required','on'=>'passwordupdate'),
			array('username', 'unique', 'on'=>'Register'),  
			array('username, password, email', 'length', 'max'=>128),
			array('email', 'email'),
			array('password', 'compare', 'compareAttribute'=>'conpassword', 'on'=>'Register'),
			array('password', 'compare', 'compareAttribute'=>'conpassword', 'on'=>'reset'),
			array('profile, login_method, id, status, is_active,created_time,role', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userdetails' => array(self::BELONGS_TO, 'Userprofile', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'profile' => 'Profile',
			'col_country' => 'Country',
			'col_state' => 'State',
			'col_city' => 'City',
			'col_postcode' => 'Postcode',
			'del_country' => 'Country',
			'del_state' => 'State',
			'del_city' => 'City',
			'del_postcode' => 'Postcode',
			'oldpassword' => 'Existing Password',
			'conpassword' => 'Confirm Password',
		);
	}

	
	
	
	/**
	 * Retrieves the list of posts based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the needed posts.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'fully_registered="1" AND deleted = "0" ';
        $criteria->compare('username',$this->username,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('role',$this->role);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('DATE(created_time)',$this->created_time);
		
		$criteria->addCondition('role ="2"');
		
		
		
		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
			'pagination'=>array(
					'pageSize'=>10,
				),
		));
	}
	
	
	
	
	
	
}