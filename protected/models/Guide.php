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
class Guide extends CActiveRecord
{

   public $guide_experiencetype;
   public $userids;
   public  $guide_image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'guide';
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
			array('guide_city, guide_state,  guide_phone, guide_address', 'required','on'=>'profileupdate'),
			array('guide_title', 'length', 'max'=>450),
			array('guide_license','required','on'=>'license'),
			array('guide_amount','numerical'),
			array('guide_phone','length', 'max'=>20, 'min'=>10),
			array('guide_phone', 'numerical'),
			//array('guide_video', 'file', 'allowEmpty'=>true, 'types'=>'swf, flv, avi, mp4, 3gp'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('guide_id,  user_id,  guide_title, guide_description, guide_city, guide_state, secondary_locations, guide_phone, guide_address, guide_sec_languages, guide_have_certificate, , guide_categories,  	guide_amount, guide_amount_option, guide_experience, highlights, guide_overview, guide_services, guide_video, guide_license, guide_experiencetype, guide_wh, guide_description, availability_dates,guide_image', 'safe'),
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
			'guideoptions' => array(self::BELONGS_TO, 'Guideoptions', 'guide_id'),
			'guidecity' => array(self::BELONGS_TO, 'Cities', 'guide_city'),
			'guidestate' => array(self::BELONGS_TO, 'States', 'guide_state'),
			'guidecountry' => array(self::BELONGS_TO, 'Country', 'guide_country'),
			'guideimages' => array(self::HAS_MANY, 'Images', '', 'on' => 'guideimages.item_type = "guide"'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'guide_id,' => 'ID',
			'user_id' => 'User ID',
			'guide_title'=>'Title',
			'guide_description' => 'About Me',
			'guide_city' => 'City',
			'guide_state' =>'State',
			'secondary_locations' => 'Guidable Locations',
			'guide_phone' => 'Phone Number',
			'guide_address' => 'Address',
			'guide_wh' => 'Working Hours',
			'guide_language' => 'Primary Language',
			'guide_sec_languages' => 'Secondary Languages',
			//'guide_gender' => 'Gender',
			'guide_have_certificate' => 'Has Licence/Certificate',
			'guide_license' => 'Licence/Certificate',
			'guide_categories' => 'Temples',
			//'guide_have_multiple_options' => 'Has multiple price options',
			'guide_amount' => 'Starting Price',
			'guide_services' => 'Services',
			
			'guide_experience' => 'Total experience',
			'highlights' => 'Highlights',
			'guide_overview' => 'Overview Content',
			'guide_video'=>'Guide Video',
			'guide_wh'=> 'Working Hours',
			'guide_image' =>'Guide Image',
			
	
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

		$criteria->compare('guide_id',$this->guide_id);
		$criteria->compare('guide_title',$this->guide_gender);
		$criteria->compare('guide_city',$this->guide_city,true);
		$criteria->compare('guide_state',$this->guide_state,true);

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
	   return $this->find('user_id=:id',array(':id'=>$id));
	}
	
	
	
  public function getrelatedproducts($id,$limit=''){
  
        //get criteria
	    $result = array();
		$criteria = new CDbCriteria(); 
	 	$condition  = ' role = 3 AND registration_completed=1 ';
  
	    $data = $this->getinfo($id);
	    $category = $data->guide_categories;
	    $criteriaguide = new CDbCriteria();
		$conditionguide  = '1';
		$criteriaguide->select=' GROUP_CONCAT(user_id) as userids';
		   
		 $conditionguide = ' 1 ';
		 $conditionguide .= ' AND guide_categories IN ('. implode(',',explode(',',$category)).')' ;
			
	   $criteriaguide->condition =  $conditionguide;
	   $guides = $this->find($criteriaguide);
	   if($guides->userids || trim($guides->userids) != ''){
		   $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$guides->userids)).') AND user_id!="'.$id.'"';
		   $criteria->condition =  $condition;
			$criteria->order = 'user_id asc';
			$criteria->group= 'user_id';	
			if($limit != ''){
			  $criteria->limit= $limit;	
			}
			$result = User::model()->findAll($criteria);
		}   
	 
			
		  $results = $result;
		  return $results;
	}
	
	public function exists_guide($id){
	
	   $details = $this->find('user_id=:user_id',array(':user_id'=>$id));
	   if(count($details) && !empty($details))
	    return true;
	   else
	    return false;
	}
	
}
?>
