<?php
class Config extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 */
	 
	 public $set_expiry_date;
	
	
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
		return 'config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			            array('company_name,company_phone,company_address,company_email', 'required'),
            array('company_email','email'),
             array('company_phone', 'numerical'),
             array('company_phone','length', 'max'=>20),
			array('company_name, company_logo, company_phone, company_address,  company_email, individual_allowed', 'safe'),
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
			'company_name' => 'Name',
			'company_logo' => 'Logo',
			'company_phone' => 'Telephone/mobile',
			'company_address' => 'Address',
			'company_email' => 'Email',
			'individual_allowed'=>' Individual Provider is Allowed',
		);
	}

}
