<?php
/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property string $name
 */
class Iyeractivities extends CActiveRecord
{

   public $startprice;
   public $userids;
   public $activity_durationopt;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iyeractivities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, activity_title, amount_with_items, amount_without_items, amount_without_items', 'required'), //activity_start_timings
			array('activity_title', 'length', 'max'=>450),
		    array('user_id, amount_with_items, amount_without_items', 'numerical'),			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('activity_id, user_id, activity_title, activity_description, amount_with_items, amount_without_items, created, status', 'safe'),
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
			'activity_id' => 'ID',
			'user_id' => 'Iyer ID',
			'activity_title' => 'Title',
			'activity_description' => 'Description',
			'amount_without_items' => 'Price (without Items)',
			'amount_with_items' => 'Price (with Items)',	
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
		$criteria->compare('amount_without_items',$this->category_id,true);
		$criteria->compare('amount_with_items',$this->availability_dates,true);

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
	
	
	public function getlowestprice($id){
	   $criteria=new CDbCriteria;
	   $criteria->select = 'min(amount_without_items) as startprice';
	   $criteria->condition = 'user_id="'.$id.'"';
	   $result = $this->find( $criteria);
	   if(count($result) && !empty($result) && isset($result->startprice)){
	     return $result->startprice;
	   }else{
	      return '0';
	   }
	   
	}
	
	public function getinfo($id,$activity_title){
	   return $this->find('user_id=:id,activity_title=:activity_title',array(':id'=>$id,':activity_title'=>$activity_title));
	}
	
	public function updatelowestprice($id){
	 
	    $iyer = Iyer::model()->find( 'user_id=:user_id',array(':user_id'=>$id));
    	$iyer->iyer_amount = $this->getlowestprice($id);
	    $iyer->update();
	}
	
	
	public function get_all($id){
	    $iyer = $this->findAll( 'user_id=:user_id AND status=1',array(':user_id'=>$id));
    	if(count($iyer) && !empty($iyer))
		return $iyer;
		else
		return false;
	}
}
