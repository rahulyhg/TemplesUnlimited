<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property string $name
 */
class Guideactivities extends CActiveRecord
{

   public $activityper;
   public $userids;
   public $activity_durationopt;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'guideactivities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, activity_title, category_id,  activity_duration, starting_point_content, activity_plans, activity_language, availability_dates', 'required'), //activity_start_timings
			array('activity_title', 'length', 'max'=>450),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('activity_id, user_id, activity_title, activity_description, category_id, service_id, activity_duration, starting_point_content, activity_plans, activity_start_timings, availability_dates, starting_point_addr, plan_per, created, status', 'safe'),
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
		'category'=>array(self::BELONGS_TO, 'Categories', 'category_id'),
		'languagerel'=>array(self::BELONGS_TO, 'Languages', 'activity_language'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activity_id' => 'ID',
			'user_id' => 'Guide ID',
			'activity_title' => 'Title',
			'activity_description' => 'Description',
			'category_id' => 'Category',
			'service_id' => 'Service type',	
			'activity_duration' => 'Duration',	
			'starting_point_content' => 'Details on meeting point, pick-up and drop-off',		
		    'activity_plans' => 'Price plans',	
			'activity_start_timings' => 'Starting times',	
			'activity_language'=>'Live Guide',
			'availability_dates'=>'Available Dates',
			'starting_point_addr'=>'Meeting Point address',
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

		$criteria->compare('activity_id',$this->activity_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('activity_title',$this->activity_title,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('availability_dates',$this->availability_dates,true);
		$criteria->compare('plan_per',$this->plan_per,true);

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
	
	
}
