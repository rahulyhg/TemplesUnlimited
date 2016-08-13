<?php

/**
 * This is the model class for table "booked_table".
 *
 * The followings are the available columns in table 'booked_table':
 * @property string $id
 * @property string $user_id
 * @property string $activity_id
 * @property string $book_date
 * @property string $option
 * @property string $created
 * @property string $iyer_status
 * @property string $type
 * @property integer $from_user
 * @property string $status
 * @property integer $user_status
 */
class BookedTable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booked_table';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, activity_id, book_date, option, created, iyer_status, type, from_user, status, user_status', 'required'),
			array('from_user, user_status', 'numerical', 'integerOnly'=>true),
			array('user_id, activity_id, option, iyer_status, type, status', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, activity_id, book_date, option, created, iyer_status, type, from_user, status, user_status', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'activity_id' => 'Activity',
			'book_date' => 'Book Date',
			'option' => 'Option',
			'created' => 'Created',
			'iyer_status' => 'Iyer Status',
			'type' => 'Type',
			'from_user' => 'From User',
			'status' => 'Status',
			'user_status' => 'User Status',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('activity_id',$this->activity_id,true);
		$criteria->compare('book_date',$this->book_date,true);
		$criteria->compare('option',$this->option,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('iyer_status',$this->iyer_status,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('from_user',$this->from_user);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_status',$this->user_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'criteria'=>array(
            'order'=>'id DESC',
        ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookedTable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
