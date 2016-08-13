<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $event_id
 * @property string $event_name
 * @property string $event_content
 * @property string $event_start_date
 * @property string $event_end_date
 * @property string $event_start_time
 * @property string $event_end_time
 * @property string $phone_no
 * @property string $email_id
 * @property string $event_address
 * @property string $event_image
 * @property string $event_created
 * @property string $event_updated
 * @property integer $posted_by
 */
class Events extends CActiveRecord
{
 public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_name, event_content, event_start_date, event_start_time, phone_no, email_id, event_address, event_image, event_created, event_updated, posted_by', 'required'),
			array('posted_by', 'numerical', 'integerOnly'=>true),
			array('event_name, event_address', 'length', 'max'=>500),
			array('event_start_time, event_end_time, phone_no, email_id', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('event_id, event_name, event_content, event_start_date, event_end_date, event_start_time, event_end_time, phone_no, email_id, event_address, event_image, event_created, event_updated, posted_by', 'safe', 'on'=>'search'),
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
			'event_id' => 'Event',
			'event_name' => 'Event Name',
			'event_content' => 'Event Content',
			'event_start_date' => 'Event Start Date',
			'event_end_date' => 'Event End Date',
			'event_start_time' => 'Event Start Time',
			'event_end_time' => 'Event End Time',
			'phone_no' => 'Phone No',
			'email_id' => 'Email',
			'event_address' => 'Event Address',
			'event_image' => 'Event Image',
			'event_created' => 'Event Created',
			'event_updated' => 'Event Updated',
			'posted_by' => 'Posted By',
		);
	}
	
	
	
		public  function getall(){
	  return $this->findAll();
	}
	
		public function getinfo($id){
	   return $this->find('event_id=:id',array(':id'=>$id));
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

		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('event_name',$this->event_name,true);
		$criteria->compare('event_content',$this->event_content,true);
		$criteria->compare('event_start_date',$this->event_start_date,true);
		$criteria->compare('event_end_date',$this->event_end_date,true);
		$criteria->compare('event_start_time',$this->event_start_time,true);
		$criteria->compare('event_end_time',$this->event_end_time,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('event_address',$this->event_address,true);
		$criteria->compare('event_image',$this->event_image,true);
		$criteria->compare('event_created',$this->event_created,true);
		$criteria->compare('event_updated',$this->event_updated,true);
		$criteria->compare('posted_by',$this->posted_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Events the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
