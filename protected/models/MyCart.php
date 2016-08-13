<?php

/**
 * This is the model class for table "my_cart".
 *
 * The followings are the available columns in table 'my_cart':
 * @property string $cart_id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $type
 * @property integer $quantity
 * @property double $amount
 * @property double $shipping_amount
 * @property double $temp_total_amount
 * @property integer $order_id
 * @property string $address
 * @property integer $user_type
 * @property string $created
 */
class MyCart extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'my_cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, product_id, type, quantity, amount, shipping_amount, temp_total_amount, order_id, address, user_type, created', 'required'),
			array('user_id, product_id, quantity, order_id, user_type', 'numerical', 'integerOnly'=>true),
			array('amount, shipping_amount, temp_total_amount', 'numerical'),
			array('type', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cart_id, user_id, product_id, type, quantity, amount, shipping_amount, temp_total_amount, order_id, address, user_type, created', 'safe', 'on'=>'search'),
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
			'cart_id' => 'Cart',
			'user_id' => 'User',
			'product_id' => 'Product',
			'type' => 'Type',
			'quantity' => 'Quantity',
			'amount' => 'Amount',
			'shipping_amount' => 'Shipping Amount',
			'temp_total_amount' => 'Temp Total Amount',
			'order_id' => 'Order',
			'address' => 'Address',
			'user_type' => 'User Type',
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

		$criteria->compare('cart_id',$this->cart_id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('shipping_amount',$this->shipping_amount);
		$criteria->compare('temp_total_amount',$this->temp_total_amount);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function get_cart_all_user($id){
	   $carts = $this->findAll('user_id=:user_id',array(':user_id'=>$id));
	   if(isset($carts) && count($carts) && isset($carts[0]) && count($carts[0]) ){
	      return $carts;
	   }else{
	      return false;
	   }
	}
	
	public  function getall(){
	  return $this->findAll();
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MyCart the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
