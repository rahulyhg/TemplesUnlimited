<?php
class Pooja extends CActiveRecord
{

  public $id;
  
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pooja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('pooja_name, pooja_category_id,pooja_code,pooja_address,pooja_country,pooja_state, phone_number, payment_options, delivery_time_1, delivery_time_2,pooja_overview,pooja_price,pooja_image', 'required','on'=>'create'),
		
				array('pooja_name, pooja_category_id,pooja_code,pooja_address,pooja_country,pooja_state, phone_number, payment_options, delivery_time_1, delivery_time_2,pooja_overview,pooja_price', 'required','on'=>'update'),


		array('pooja_name, pooja_category_id,pooja_code,pooja_address,pooja_country,pooja_state, phone_number, payment_options, delivery_time_1, delivery_time_2,pooja_overview,pooja_image','required','on'=>'have_options'),
		
/*			array('pooja_name, pooja_category_id,phone_number, payment_options, delivery_time_1, delivery_time_2, pooja_price, pooja_address,pooja_state,pooja_country,pooja_overview', 'required','on'=>'no_have_options'),*/
			array('pooja_image','checkfiletype','on'=>'create'),
			
			array('pooja_image','checkfiletype','on'=>'update'),
			
			array('pooja_image','checkfiletype','on'=>'have_options'),
	

			/*array('pooja_image', 'file','types'=>'jpg,gif,png,jpeg','allowEmpty'=>false),*/
			/*array('pooja_image', 'file','allowEmpty'=>true, 'types'=>'jpg, gif, png,jpeg','on'=>'update'),*/
			
			array('pooja_category_id, delivery_time_1, delivery_time_2, pooja_have_options, pooja_city, pooja_state, pooja_country, is_active,phone_number,pooja_price,pooja_shipping_price', 'numerical', 'integerOnly'=>true),
			

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pooja_id, pooja_category_id, pooja_name, pooja_description, phone_number, payment_options, delivery_time_1, pooja_image,delivery_time_2, pooja_price, pooja_shipping_price, pooja_overview, pooja_have_options, created_on,updated_on, delivery_time_1option, delivery_time_2option, is_active', 'safe'),
		);
	}
	
	function checkfiletype($attr,$variable)
	{
	   $extension = explode('.', $this->$attr);
	   $extend = $extension[count($extension)-1];
	   if(($extend!='jpg') && ($extend!='gif') && ($extend!='png') && ($extend!='jpeg'))
	   $this->addError($attr,'Please select valid file format');
	}
	
	

	


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'poojacity' => array(self::BELONGS_TO, 'Cities', 'pooja_city'),
			'poojastate' => array(self::BELONGS_TO, 'States', 'pooja_state'),
			'poojacountry' => array(self::BELONGS_TO, 'Country', 'pooja_country'),
			'poojaoptions' => array(self::HAS_MANY, 'Poojaoptions', 'pooja_id'),
			'category' => array(self::BELONGS_TO, 'Poojacategories', 'pooja_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pooja_id' => 'ID',
			'pooja_category_id'=>'Pooja Category',
			'pooja_name' => 'Pooja Name',
			'pooja_description' => 'Pooja Description',
			'pooja_image' => 'Pooja Image',
			'phone_number' => 'Phone Number',
			'payment_options' =>'Payment Options',
			'delivery_time_1' => 'Domestic Delivery Time',
			'delivery_time_2' => 'International Delivery Time',
			'pooja_price' => 'Pooja Price',
			'pooja_shipping_price' => 'Pooja Shipping Price',
			'pooja_overview' => 'Pooja Overview',
			'pooja_have_options' => 'Pooja has multiple options',
			'pooja_address'=>'Address',
			'pooja_city'=>'City',
			'pooja_state'=>'State',
			'pooja_country'=>'Country',
			'pooja_code'=>'Pooja Code'
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

		$criteria->compare('pooja_id',$this->pooja_id);
		$criteria->compare('pooja_name',$this->pooja_name,true);
		
		$criteria->compare('pooja_category_id',$this->pooja_category_id);
		$criteria->compare('pooja_shipping_price',$this->pooja_shipping_price,true);
		$criteria->compare('pooja_have_options',$this->pooja_have_options,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function searchByAttr()
	{
		$criteria=new CDbCriteria;
		
		$condition = 'is_active=1';
		
		if(isset($_REQUEST['epooja_category']))
		{
		 if($_REQUEST['epooja_category']!='all')
		   $criteria->addSearchCondition('pooja_category_id',$_REQUEST['epooja_category']);
		}
		
		if(isset($_REQUEST['title']) && ($_REQUEST['title']!='Search Keyword...'))
		{
		   $criteria->addSearchCondition('pooja_name',$_REQUEST['title']);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => '12',
              ),
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
	
	public  function getall()
	{
		return $this->findAll();
	}
	
	public  function getall_parent(){
	  return $this->findAll('parent_id=:parent_id',array(':parent_id'=>'0'));
	}
	
	public  function getall_subcategory($id){
	  return $this->findAll('parent_id=:parent_id',array(':parent_id'=>$id));
	}
	
	public  function getall_byids($ids)
	{
		return $this->findAll('pooja_id in ('.implode(',',$ids).')');
	}
	
	public function getinfo($id){
	   return $this->find('pooja_id=:id AND is_active=:is_active',array(':id'=>$id,':is_active'=>1));
	}
	
	 public function getrelatedproducts($id){
	  $data = $this->getinfo($id);
	
	  $category = $data->pooja_category_id;
	  $results = $this->findAll('pooja_category_id=:pooja_category_id AND pooja_id !=:pooja_id ORDER  BY pooja_id DESC',array(':pooja_category_id'=>$category,':pooja_id'=>$id));
	  return $results;
	}
	
	
}
?>
