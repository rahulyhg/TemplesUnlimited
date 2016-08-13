<?php


/**
 * This is the model class for table "temples".
 *
 * The followings are the available columns in table 'temples':
 * @property integer $id
 * @property string $temple_name
 * @property string $temple_description
 * @property string $temple_address
 * @property integer $city_id
 * @property string $state_id
 * @property integer $category_id
 * @property string $temple_phone_number
 * @property string $temple_timings
 * @property string $temple_other_names
 * @property string $temple_deity
 * @property string $main_image
 * @property string $temple_information
 * @property string $temple_pooja_timings
 * @property string $temple_offerings
 * @property string $temple_events
 * @property string $temple_map_content
 * @property integer $estimated_time
 * @property string $estimated_timeopt
 * @property integer $is_active
 * @property string $featured_listing
 * @property string $created_on
 * @property string $updated_on
 * @property string $latitude
 * @property string $logtitute
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
			array('temple_name, temple_description, temple_address, state_id,country_id,category_id, temple_phone_number, temple_timings, temple_other_names, temple_deity, temple_information, temple_pooja_timings, temple_offerings, temple_events, temple_map_content, estimated_time, estimated_timeopt, featured_listing, latitude, logtitute', 'required'),
			array('city_id, category_id, estimated_time, is_active', 'numerical', 'integerOnly'=>true),
			
			array('logtitute,latitude', 'type', 'type'=>'float'),

			array('main_image', 'file','types'=>'jpg, gif, png,jpeg','on'=>'create'),
			array('main_image', 'file','allowEmpty'=>true, 'types'=>'jpg, gif, png,jpeg','on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, temple_name, temple_description, temple_address, city_id, state_id, category_id, temple_phone_number, temple_timings, temple_other_names, temple_deity,temple_information, temple_pooja_timings, temple_offerings, temple_events, temple_map_content, estimated_time, estimated_timeopt, is_active, featured_listing, created_on, updated_on, latitude, logtitute,main_image', 'safe'),
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
			'Country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
			'temple_name' => array(self::BELONGS_TO, 'Reviews', 'review_itemid'),
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
			'temple_description' => 'Temple Overview',
			'temple_address' => 'Temple Address',
			'city_id' => 'City',
			'state_id' => 'State',
			'category_id' => 'Category',
			'temple_phone_number' => 'Temple Phone Number',
			'temple_timings' => 'Temple Timings',
			'temple_other_names' => 'Temple Other Names',
			'temple_deity' => 'Temple Deity',
			'main_image' => 'Temple Image',
			'temple_information' => 'Temple Information',
			'temple_pooja_timings' => 'Temple Pooja Timings',
			'temple_offerings' => 'Temple Offerings',
			'temple_events' => 'Temple Events',
			'temple_map_content' => 'Temple Map Content',
			'estimated_time' => 'Estimated Time',
			'estimated_timeopt' => 'Estimated Timeopt',
			'is_active' => 'Is Active',
			'featured_listing' => 'Featured Listing',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'latitude' => 'Latitude',
			'logtitute' => 'Longitude',
			'country_id'=>'Country'
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
		$criteria->compare('temple_description',$this->temple_description,true);
		$criteria->compare('temple_address',$this->temple_address,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('state_id',$this->state_id,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('temple_phone_number',$this->temple_phone_number,true);
		$criteria->compare('temple_timings',$this->temple_timings,true);
		$criteria->compare('temple_other_names',$this->temple_other_names,true);
		$criteria->compare('temple_deity',$this->temple_deity,true);
		$criteria->compare('main_image',$this->main_image,true);
		$criteria->compare('temple_information',$this->temple_information,true);
		$criteria->compare('temple_pooja_timings',$this->temple_pooja_timings,true);
		$criteria->compare('temple_offerings',$this->temple_offerings,true);
		$criteria->compare('temple_events',$this->temple_events,true);
		$criteria->compare('temple_map_content',$this->temple_map_content,true);
		$criteria->compare('estimated_time',$this->estimated_time);
		$criteria->compare('estimated_timeopt',$this->estimated_timeopt,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('featured_listing',$this->featured_listing,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('logtitute',$this->logtitute,true);

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
