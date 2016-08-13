<?php

/**
 * This is the model class for table "userdetails".
 *
 * The followings are the available columns in table 'userdetails':
 * @property string $address
 * @property string $phone
 * @property integer $pincode
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $user_id
 * @property integer $details_id
 * @property string $delivery_address
 */
class Userdetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userdetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('pincode, user_id', 'numerical', 'integerOnly'=>true),
			array('phone', 'length', 'max'=>50),
			array('city, state, country', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('address, phone, pincode, city, state, country, user_id, details_id, delivery_address', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'usercity' => array(self::BELONGS_TO, 'Cities', 'city'),
			'userstate' => array(self::BELONGS_TO, 'States', 'state'),
			'usercountry' => array(self::BELONGS_TO, 'Country', 'country'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'address' => 'Address',
			'phone' => 'Phone',
			'pincode' => 'Pincode',
			'city' => 'City',
			'state' => 'State',
			'country' => 'Country',
			'user_id' => 'User',
			'details_id' => 'Details',
			'delivery_address' => 'Delivery Address',
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

		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('pincode',$this->pincode);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('details_id',$this->details_id);
		$criteria->compare('delivery_address',$this->delivery_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userdetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
