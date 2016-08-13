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
class Iyer extends CActiveRecord
{

    public $iyer_image;
	public $iyer_experiencetype;
	public $userids;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iyer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'), // iyer_amount, iyer_amount_with_items,
			array('iyer_phone, iyer_experience','numerical'),
			array('iyer_phone','length','min'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iyer_id,  user_id,  iyer_description, iyer_address, iyer_phone, iyer_city, iyer_state, iyer_sec_languages, iyer_categories, iyer_experience, iyer_overview, iyer_created, iyer_image, iyer_updated, iyer_experiencetype, iyer_wh, iyer_wh1, iyer_wh2, iyer_description, availability_dates, iyer_amount', 'safe'),
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
		    'iyercity' => array(self::BELONGS_TO, 'Cities', 'iyer_city'),
			'iyerstate' => array(self::BELONGS_TO, 'States', 'iyer_state'),
			'iyercountry' => array(self::BELONGS_TO, 'Country', 'iyer_country'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iyer_id,' => 'ID',
			'user_id' => 'User ID',
			'iyer_description' => 'About Me',
			'iyer_city' => 'City',
			'iyer_state' =>'State',
			'iyer_phone' => 'Phone Number',
			'iyer_address' => 'Address',
			'iyer_sec_languages' => 'Secondary Languages',
			'iyer_categories' => 'Pooja\'s',
			'iyer_amount' => 'Starting Price',			
			'iyer_experience' => 'Total experience',
			'iyer_overview' => 'Overview Content',	
			'iyer_image'=>'Image',
			'iyer_wh'=>'Working Hours',
			'iyer_wh1'=>'Working Hours',
			'iyer_wh2'=>'Working Hours',
		/*	'iyer_amount_with_items'=>'Price (with Items)',
			'iyer_amount'=>'Price (without Items)',*/
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

		$criteria->compare('iyer_id',$this->guide_id);
		$criteria->compare('user_id',$this->guide_gender);
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
	 	$condition  = ' role = 4 AND registration_completed=1 ';
  
	    $data = $this->getinfo($id);
	    $category = $data->iyer_categories;
		$categories  = array_filter(explode(',', $category ));
	    $criteriaiyer = new CDbCriteria();
		$conditioniyer  = '1';
		$criteriaiyer->select=' GROUP_CONCAT(user_id) as userids';
		   
		  $categorycount = 0;
		    $conditioniyer = ' 1 ';
		  if(count( $categories)){
		  $conditioniyer .= ' AND (';
			   foreach($categories as $categoryid){$categorycount++;
				  if($categorycount>1)
				  $conditioniyer .= ' OR	 find_in_set('.$categoryid.',iyer_categories) ';
				  else
				   $conditioniyer .= '  find_in_set('.$categoryid.',iyer_categories) ';
				  
				}
				 $conditioniyer .= ') ';
			}
			
		$criteriaiyer->condition =  $conditioniyer;
		if($categorycount>0 ){ 
			   $iyers = Iyer::model()->find($criteriaiyer);
			   if($iyers->userids || trim($iyers->userids) != ''){
				   $condition .= ' AND	user_id	 IN  ('.implode(',',explode(',',$iyers->userids)).') AND user_id!="'.$id.'"';
				   $criteria->condition =  $condition;
					$criteria->order = 'user_id asc';
					$criteria->group= 'user_id';	
					if($limit != ''){
					  $criteria->limit= $limit;	
					}
					$result = User::model()->findAll($criteria);
				}   
	    }	
			
		  $results = $result;
		  return $results;
	}
	
	function iyerexists($id){
	
	   $details = $this->find('user_id=:user_id',array(':user_id'=>$id));
	   if(count($details) && !empty($details))
	    return true;
	   else
	    return false;
	}
	
	
	function searchByIyer()
	{
		$criteria=new CDbCriteria;
		
		
		$criteria->select = "t.*,ug.iyer_phone,ug.iyer_city,ug.iyer_state,ug.iyer_country,ug.iyer_description,ug.iyer_sec_languages,rv.*";
		
		$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id";
		
	    $condition  = ' t.role = 4 AND t.registration_completed=1 and ug.iyer_city<>"0" and ug.iyer_state<>"0" and ug.iyer_country<>"0"  ';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => '10',
              ),
		));
	}
	
	
}
?>
