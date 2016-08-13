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
class Productvariations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productvariations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_price, product_variation_title', 'required'),
			array('product_price', 'numerical'),
			array('product_shipping_price', 'numerical','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('variation_id, product_id, product_variation_title, product_price, product_shipping_price', 'safe'),
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
			'variation_id' => 'ID',
			'product_id' => 'Product id',
			'product_variation_title' => 'variation name',
			'product_price' => 'variation Price',
			'product_shipping_price' => 'variation Shipping Price',
			
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

		/*$criteria=new CDbCriteria;

		$criteria->compare('pooja_id',$this->pooja_id);
		$criteria->compare('pooja_name',$this->pooja_name,true);
		
		$criteria->compare('pooja_price',$this->category_id);
		$criteria->compare('pooja_shipping_price',$this->main_image,true);
		$criteria->compare('pooja_have_options',$this->main_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
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
}
?>
