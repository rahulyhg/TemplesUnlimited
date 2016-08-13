<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $event_id
 * @property string $event_name
 * @property string $event_content
 * @property string $event_date
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
			array('event_name, event_content, event_date, event_address, event_image, event_created, event_updated, posted_by', 'required'),
			array('posted_by', 'numerical', 'integerOnly'=>true),
			array('event_name, event_address', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('event_id, event_name, event_content, event_date, event_address, event_image, event_created, event_updated, posted_by', 'safe', 'on'=>'search'),
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
			'event_date' => 'Event Date',
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
		$criteria->compare('event_date',$this->event_date,true);
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
