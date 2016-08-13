<?php

/**
 * This is the model class for table "blogs".
 *
 * The followings are the available columns in table 'blogs':
 * @property string $id
 * @property integer $category
 * @property string $blog_name
 * @property string $files
 * @property string $video_url
 * @property string $file_type
 * @property string $content
 * @property string $created
 * @property string $updated
 */
class Blogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blogs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, blog_name, file_type, content', 'required','on'=>'create'),
			array('category, blog_name, file_type, content', 'required','on'=>'update'),
			array('category, blog_name, file_type, files,content', 'required','on'=>'image_need'),
			array('category, blog_name, file_type, video_url,content', 'required','on'=>'video_need'),
			array('category', 'numerical', 'integerOnly'=>true),
			array('blog_name, video_url', 'length', 'max'=>1000),
			array('files, file_type', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category, blog_name, files, video_url, file_type, content, created, updated', 'safe', 'on'=>'search'),
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
		'State' => array(self::BELONGS_TO, 'Blogcategory', 'category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'blog_name' => 'Blog Name',
			'files' => 'Files',
			'video_url' => 'Video Url',
			'file_type' => 'File Type',
			'content' => 'Content',
			'created' => 'Created',
			'updated' => 'Updated',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('blog_name',$this->blog_name,true);
		$criteria->compare('files',$this->files,true);
		$criteria->compare('video_url',$this->video_url,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getinfo($id){
	   return $this->find('id=:id',array(':id'=>$id));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Blogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
