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
class Storeproducts extends CActiveRecord
{

    public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'store_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, product_code, product_price, product_overview, store_category_id, phone_number, payment_options, delivery_time_1, delivery_time_2,location,product_image', 'required','on'=>'create'), //
			
			array('product_name, product_code, product_price, product_overview, store_category_id, phone_number, payment_options, delivery_time_1, delivery_time_2,location', 'required','on'=>'update'), //
			
			array('product_name, product_code, product_overview, store_category_id, phone_number, payment_options, delivery_time_1, delivery_time_2,product_image', 'required','on'=>'have_options'),
			
			array('product_name', 'length', 'max'=>250),
			
			array('product_price, product_shipping_price', 'numerical', 'allowEmpty'=>true),
			
			array('phone_number', 'numerical', 'integerOnly'=>true,'on'=>'create'),
			
			
			array('phone_number', 'numerical', 'integerOnly'=>true,'on'=>'update'),
			
			
	        array('product_image','checkfiletype','on'=>'create'),
			
			array('product_image','checkfiletype','on'=>'update'),
			
			array('product_image','checkfiletype','on'=>'have_options'),

			array('product_id,  product_name, product_code, product_price, product_shipping_price, product_overview, is_active, created_on, updated_on, product_have_variations, phone_number, payment_options, delivery_time_1, delivery_time_2, delivery_time_1option, delivery_time_2option', 'safe'),
		);
	}
	
	
	function checkfiletype($attr,$variable)
	{
	   $extension = explode('.', $this->$attr);
	   $extend = $extension[count($extension)-1];
if(($extend!='jpg') && ($extend!='gif') && ($extend!='png') && ($extend!='PNG') && ($extend!='jpeg') &&  ($extend!='JPG') && ($extend!='TIF')  && ($extend!='GIF') && ($extend!='JPEG'))
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
			'productimages' => array(self::HAS_MANY, 'Storeproductsimages', 'product_id'),
			'category' => array(self::BELONGS_TO, 'Storecategories', 'store_category_id'),		
			'variations' => array(self::HAS_MANY, 'Productvariations', 'product_id'),		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'ID',
			'product_name' => 'Product Name',
			'product_code' => 'Product Code',
			'product_price' => 'Product Price',
			'product_shipping_price' => 'Product Shipping Price',
			'product_overview' =>'Product Overview',
			'store_category_id'=>'Store Category',
			'is_active'=>' Product status',
			'product_have_variations' => 'Pooja has multiple options',
			'phone_number' => 'Phone Number',
			'payment_options' =>'Payment Options',
			'delivery_time_1' => 'Domestic Delivery Time',
			'delivery_time_2' => 'International Delivery Time',
			'product_image'=>'Product Image',
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

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_code',$this->product_code);
		$criteria->compare('store_category_id',$this->store_category_id,true);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		function searchByAttr()
	{
		$criteria=new CDbCriteria;
		
		$condition = 'is_active=1';
		
		if(isset($_REQUEST['categories']))
		{
 	       $criteria->addSearchCondition('store_category_id',$_REQUEST['categories']);
		}
		
		if(isset($_REQUEST['title']) && ($_REQUEST['title']!='Search Keyword...'))
		{
		   $criteria->addSearchCondition('product_name',trim($_REQUEST['title']));
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
	
	public function get_image($id){
	
	$images = Storeproductsimages::model()->find('product_id=:product_id',array(':product_id'=>$id));
	if(count($images) && isset($images->product_image) && trim($images->product_image) != '')
	return $images->product_image;
	else
	return  'images/index.jpeg';
	
	}
	
		public function getinfo($id){
		   return $this->find('product_id=:id AND is_active=:is_active',array(':id'=>$id,':is_active'=>1));
		}
		
	    public function getinfo_byids($ids){
		   return $this->findAll('product_id IN ('.implode(',',$ids).') AND is_active=:is_active',array(':is_active'=>1));
		}
	
	
      public function getrelatedproducts($id){
		  $data = $this->getinfo($id);
		  $category = $data->store_category_id;
		  $results = $this->findAll('store_category_id=:store_category_id AND product_id !=:product_id ORDER  BY product_id DESC',array(':store_category_id'=>$category,':product_id'=>$id));
		  return $results;
	 }
	
}
?>
