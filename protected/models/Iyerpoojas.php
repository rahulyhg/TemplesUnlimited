<?php

/**
 * This is the model class for table "iyerpoojas".
 *
 * The followings are the available columns in table 'iyerpoojas':
 * @property string $id
 * @property string $user_id
 * @property string $category_id
 * @property string $pooja_name
 * @property string $description
 * @property string $mantra_language
 * @property string $mantra_language_text
 * @property string $duration
 * @property string $duration_time_type
 * @property double $amount_with_items
 * @property double $amount_without_items
 * @property string $discount
 * @property string $discount_percentage
 * @property string $discount_dates_from
 * @property string $discount_dates_to
 * @property integer $status
 * @property string $created
 */
class Iyerpoojas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iyerpoojas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, category_id, pooja_name, description, mantra_language,  duration, duration_time_type, amount_with_items, amount_without_items, discount', 'required'),
			array('status,duration', 'numerical', 'integerOnly'=>true),
			array('amount_with_items, amount_without_items', 'numerical'),
			array('user_id, category_id, pooja_name, duration, duration_time_type, discount, discount_percentage, discount_dates_from, discount_dates_to', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, category_id, pooja_name, description, mantra_language, mantra_language_text, duration, duration_time_type, amount_with_items, amount_without_items, discount, discount_percentage, discount_dates_from, discount_dates_to, status, created', 'safe', 'on'=>'search'),
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
			'category_id' => 'Category',
			'pooja_name' => 'Pooja Name',
			'description' => 'Description',
			'mantra_language' => 'Mantra Language',
			'mantra_language_text' => 'Mantra Language Text',
			'duration' => 'Duration',
			'duration_time_type' => 'Duration Time Type',
			'amount_with_items' => 'Amount With Pooja Items',
			'amount_without_items' => 'Amount Without Pooja Items',
			'discount' => 'Discount',
			'discount_percentage' => 'Discount Percentage',
			'discount_dates_from' => 'Discount Dates From',
			'discount_dates_to' => 'Discount Dates To',
			'status' => 'Status',
			'created' => 'Created',
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
		$criteria->compare('user_id',Yii::app()->user->id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('pooja_name',$this->pooja_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('mantra_language',$this->mantra_language,true);
		$criteria->compare('mantra_language_text',$this->mantra_language_text,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('duration_time_type',$this->duration_time_type,true);
		$criteria->compare('amount_with_items',$this->amount_with_items);
		$criteria->compare('amount_without_items',$this->amount_without_items);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('discount_percentage',$this->discount_percentage,true);
		$criteria->compare('discount_dates_from',$this->discount_dates_from,true);
		$criteria->compare('discount_dates_to',$this->discount_dates_to,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function get_all($id){
	    $iyer = $this->findAll( 'user_id=:user_id AND status=0',array(':user_id'=>$id));
    	if(count($iyer) && !empty($iyer))
		return $iyer;
		else
		return false;
	}
	
	public function activityname($id){
	    $iyer = $this->findByPk($id);
 		return $iyer->pooja_name;
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Iyerpoojas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
