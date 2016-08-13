<?php

/**
 * This is the model class for table "queries".
 *
 * The followings are the available columns in table 'queries':
 * @property string $id
 * @property string $type
 * @property string $name
 * @property string $email
 * @property string $ph_no
 * @property string $question
 
 */
class Queries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'queries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, email, ph_no, question', 'required'),
			array('type, name, email, ph_no', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, name, email, ph_no, question', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'type' => 'Type',
			'name' => 'Name',
			'email' => 'Email',
			'ph_no' => 'Ph No',
			'question' => 'Question',
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
                
                 if(isset($_REQUEST['id']))
		$criteria->compare('id',$_REQUEST['id'],true);

                if(isset($_REQUEST['type']))
		$criteria->compare('type',$_REQUEST['type'],true);
                
                if(isset($_REQUEST['name']))
		$criteria->compare('name',$_REQUEST['name'],true);

                if(isset($_REQUEST['email']))
		$criteria->compare('email',$_REQUEST['email'],true);
                 
                if(isset($_REQUEST['ph_no']))
		$criteria->compare('ph_no',$_REQUEST['ph_no'],true);
		$criteria->compare('question',$this->question,true);
        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Queries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
