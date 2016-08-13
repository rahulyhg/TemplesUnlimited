<?php

/**
 * This is the model class for table "guidetemple".
 *
 * The followings are the available columns in table 'guidetemple':
 * @property integer $activity_id
 * @property integer $user_id
 * @property string $activity_title
 * @property string $activity_description
 * @property string $category_id
 * @property string $activity_duration
 * @property string $duration_time_type
 * @property string $activity_language
 * @property string $discount_dates_from
 * @property string $discount
 * @property string $discount_dates_to
 * @property string $discount_percentage
 * @property integer $status
 * @property string $created
 * @property double $amount
 */
class Guidetemple extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'guidetemple';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, activity_title, activity_description, category_id, activity_duration, duration_time_type, activity_language, discount, created, amount', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('amount,activity_duration', 'numerical'),
			array('activity_title', 'length', 'max'=>500),
			array('activity_duration, duration_time_type, discount_dates_from, discount, discount_dates_to, discount_percentage', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('activity_id, user_id, activity_title, activity_description, category_id, activity_duration, duration_time_type, activity_language, discount_dates_from, discount, discount_dates_to, discount_percentage, status, created, amount', 'safe', 'on'=>'search'),
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
			'activity_id' => 'Activity',
			'user_id' => 'User',
			'activity_title' => 'Activity Title',
			'activity_description' => 'Activity Description',
			'category_id' => 'Category',
			'activity_duration' => 'Activity Duration',
			'duration_time_type' => 'Duration Time Type',
			'activity_language' => 'Activity Language',
			'discount_dates_from' => 'Discount Dates From',
			'discount' => 'Discount',
			'discount_dates_to' => 'Discount Dates To',
			'discount_percentage' => 'Discount Percentage',
			'status' => 'Status',
			'created' => 'Created',
			'amount' => 'Amount',
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
		$criteria->compare('user_id',Yii::app()->user->id);
		$criteria->compare('activity_title',$this->activity_title,true);
		$criteria->compare('activity_description',$this->activity_description,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('activity_duration',$this->activity_duration,true);
		$criteria->compare('duration_time_type',$this->duration_time_type,true);
		$criteria->compare('activity_language',$this->activity_language,true);
		$criteria->compare('discount_dates_from',$this->discount_dates_from,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('discount_dates_to',$this->discount_dates_to,true);
		$criteria->compare('discount_percentage',$this->discount_percentage,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('amount',$this->amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function searchByAttr()
	{
		$criteria=new CDbCriteria;
		
		$condition = 'status=0';
		
		$condition .= ' and user_id='.Yii::app()->user->id.' ';
		
		$criteria->condition =  $condition;


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => '10',
              ),
		));
	}
	
		public function get_all($id){
	    $guide = $this->findAll( 'user_id=:user_id AND status=0',array(':user_id'=>$id));
    	if(count($guide) && !empty($guide))
		return $guide;
		else
		return false;
	}
	
	
	public function activityname($id){
	    $guide = $this->findByPk($id);
 		return $guide->activity_title;
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Guidetemple the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
