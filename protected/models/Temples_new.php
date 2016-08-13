<?php
/**
 * This is the model class for table "temples".
 *
 * The followings are the available columns in table 'temples':
 * @property integer $id
 * @property string $temple_name
 * @property integer $city_id
 * @property integer $category_id
 * @property string $main_image
 */
class Temples extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'temples';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('temple_name, temple_deity, city_id, category_id, main_image, state_id, temple_phone_number, temple_timings, temple_description, temple_address, estimated_time, estimated_timeopt,featured_listing', 'required'),
			array('city_id, category_id', 'numerical', 'integerOnly'=>true),
			array('temple_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, temple_name, temple_deity, city_id, category_id, temple_description, temple_address, state_id, category_id, temple_phone_number, temple_timings, main_image, temple_information, temple_pooja_timings, temple_offerings, temple_events, temple_other_names, temple_map_content, is_active,featured_listing', 'safe'),
			array('main_image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
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
			'city' => array(self::BELONGS_TO, 'Cities', 'city_id'),
			'State' => array(self::BELONGS_TO, 'States', 'state_id'),
			'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
			'gallery' => array(self::HAS_MANY, 'Gallery', 'temple_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'temple_name' => 'Temple Name',
			'city_id' => 'City',
			'category_id' => 'Category',
			'main_image' => 'Image',
			'state_id' =>'State',
			'temple_description' => 'Temple Description',
			'temple_address' => 'Temple Address',
			'temple_phone_number' => 'Temple Phone Number',
			
			'temple_timings' => 'Temple Timings',
			'temple_information' => 'Temple Informations',
			'temple_pooja_timings' => 'Temple Pooja Timings',
			'temple_offerings' => 'Temple Offerings',
			'temple_events' => 'Temple Events',
			'temple_other_names'=>'Also Known as',
			'temple_deity' => 'Deity',
			'temple_map_content'=>'Map Page Content',
			'estimated_time'=>'Estimated Time Taken',
			'estimated_timeopt'=>'Estimated Time Taken option',
			'featured_listing'=>'Featured Listing',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('temple_name',$this->temple_name,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('main_image',$this->main_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Temples the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getinfo($id){
	   return $this->find('id=:id AND is_active=:is_active',array(':id'=>$id,':is_active'=>1));
	}
	
	public  function getall(){
	  return $this->findAll('is_active=:is_active',array(':is_active'=>1));
	}
	
	
	public  function getallfordropdown($ids = array()){
	 $addcond = '';
	if(count($ids))
	 $addcond .= ' AND city_id IN ('.implode(',',$ids).') ';
	
	  $temples = $this->findAll('is_active=:is_active '.$addcond,array(':is_active'=>1));
	  $templesnew = array();
	  if(count($temples) && !empty($temples)){
	     foreach($temples as $temple){
		   $templesnew[$temple->id] = $temple->temple_name.', '. $temple->city->name;
		 }
	  }
	  return $templesnew;
	}
	
	
		
	public  function getall_parent(){
	  return $this->findAll('parent_id=:parent_id',array(':parent_id'=>'0'));
	}
	
	public  function getall_subcategory($id){
	  return $this->findAll('parent_id=:parent_id',array(':parent_id'=>$id));
	}
	
	public function getall_byids($ids){
             return $this->findAllByAttributes(array('id'=>$ids,'is_active'=>'1'));
	}
}
?>
