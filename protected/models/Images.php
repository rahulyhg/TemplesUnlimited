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
class Images extends CActiveRecord
{

    public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_type, item_id, image_path', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image_id,  item_type, item_id,  image_path, created_at, image_caption', 'safe'),
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
		    'image_id' => 'ID',
			'item_id' => 'Product ID',
			'image_path' => 'Image',
			'image_caption'=>'Caption',
			
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

		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('item_id',$this->item_id,true);
	

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
	
	function get_image($type,$id){
	   $images = $this->findAll('item_type=:item_type AND item_id=:item_id',array(':item_type'=>$type, ':item_id'=>$id));
	   if(isset($images) && count($images) && isset($images[0]) && count($images[0]) ){
	      return $images[0];
	   }else{
	      return false;
	   }

	}
	
	function get_image_all($type,$id){
	   $images = $this->findAll('item_type=:item_type AND item_id=:item_id',array(':item_type'=>$type, ':item_id'=>$id));
	   if(isset($images) && count($images) && isset($images[0]) && count($images[0]) ){
	      return $images;
	   }else{
	      return false;
	   }

	}
}
?>
