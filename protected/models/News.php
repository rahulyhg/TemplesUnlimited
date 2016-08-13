<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property string $name
 */
class News extends CActiveRecord
{
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
			array('posted_by, news_date, news_title, news_content', 'required'),
			array('news_title', 'length', 'max'=>450),
			array('news_image', 'file', 'types'=>'jpg, gif, png,jpeg','on'=>'create'),
			array('news_image', 'file','allowEmpty'=>true, 'types'=>'jpg, gif, png,jpeg','on'=>'update'),
			array('news_id, posted_by, news_date, news_title, news_content,  news_created, news_updated', 'safe'),
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
			'newsowner' => array(self::BELONGS_TO, 'User', 'posted_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'news_id' => 'ID',
			'posted_by' => 'Owner',
			'news_date' => 'News Date',
			'news_title' => 'News Title',
			'news_content' => 'News Content',
			'news_image' => 'News Image',		
			
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

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('news_date',$this->news_date,true);
		$criteria->compare('posted_by',$this->posted_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'news_date DESC', 
    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
}
