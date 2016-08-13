<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property integer $posted_by
 * @property string $news_date
 * @property string $news_title
 * @property string $news_content
 * @property string $news_image
 * @property string $news_created
 * @property string $news_updated
 */
class News extends CActiveRecord
{

     public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('posted_by, news_date, news_title, news_content, news_image, news_created, news_updated', 'required'),
			array('posted_by', 'numerical', 'integerOnly'=>true),
			array('news_title', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('news_id, posted_by, news_date, news_title, news_content, news_image, news_created, news_updated', 'safe', 'on'=>'search'),
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
			'news_id' => 'News',
			'posted_by' => 'Posted By',
			'news_date' => 'News Date',
			'news_title' => 'News Title',
			'news_content' => 'News Content',
			'news_image' => 'News Image',
			'news_created' => 'News Created',
			'news_updated' => 'News Updated',
		);
	}
	
	public  function getall(){
	  return $this->findAll();
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

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('posted_by',$this->posted_by);
		$criteria->compare('news_date',$this->news_date,true);
		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('news_content',$this->news_content,true);
		$criteria->compare('news_image',$this->news_image,true);
		$criteria->compare('news_created',$this->news_created,true);
		$criteria->compare('news_updated',$this->news_updated,true);

		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
	
	public function getinfo($id){
	   return $this->find('news_id=:id',array(':id'=>$id));
	   }
	   

	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
