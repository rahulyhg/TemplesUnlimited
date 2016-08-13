<?php

/**
 * This is the model class for table "admin_users".
 *
 * The followings are the available columns in table 'admin_users':
 * @property string $id
 * @property string $username
 * @property string $password
 */
class AdminUsers extends CActiveRecord
{

     public $conpassword;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminUsers the static model class
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
		return 'lexgo_admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username, password, name, role, conpassword', 'required','on'=>'create'),
			array('username, password', 'length', 'max'=>100),
			array('password', 'compare', 'compareAttribute'=>'conpassword', 'on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, name, role, created, conpassword', 'safe'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'conpassword'=>'Confirm Password',
			'password'=>'Password',
			'name'=>'Name',
			'role'=>'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = 'role!="superadmin"';
		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
			'pagination'=>array(
					'pageSize'=>10,
				),
		));
	}
	
	function getrole($id){
	
	    $admindetails = $this->findByPK($id);
		if(count($admindetails)){
		  return $admindetails->role;
		}else{
		  return false;
		}
	   
	}
	
	function is_mainadmin(){
	 $role = $this->getrole(Yii::app()->user->id);
	  if($role && $role == 'superadmin')
	  return true;
	  else
	  return false;
	}
	
	function getname(){
	 $admindetails = $this->findByPK(Yii::app()->user->id);
	  if(count($admindetails))
		  return $admindetails->name;
	}
}
