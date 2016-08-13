<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property string $name
 */
class Reviews extends CActiveRecord
{

   public $id;
   public $review_count;
   public $review_sum;
   
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reviews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('review_title, review_content, review_rate, review_itemtype, review_itemid, review_by', 'required'),
			array('review_title', 'length', 'max'=>450),
			array('review_rate, review_itemid', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('review_id, review_title, review_content, review_rate, review_itemtype, review_itemid, review_by, review_date, review_likecount, review_unlikecount, review_like_users, review_unlike_users', 'safe'),
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
			'reviewowner' => array(self::BELONGS_TO, 'User', 'review_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'review_id' => 'ID',
			'review_title' => 'Title',
			'review_content' => 'Content',
			'review_itemtype' => 'Item type',
			'review_itemid' => 'Item Id',
			'review_by' => 'Review user',		
			
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

		$criteria->compare('review_id',$this->review_id);
		$criteria->compare('review_title',$this->review_title,true);
		$criteria->compare('review_itemtype',$this->review_itemtype,true);
		$criteria->compare('review_itemid',$this->review_itemid);
		$criteria->compare('review_by',$this->review_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
	
	
	function get_review_all($type,$id){
            
           $reviews = $this->findAll(array('condition'=>' review_itemtype="'.$type.'" and review_itemid="'.$id.'" ','order'=>'review_id desc'));
	  // $reviews = $this->findAll('review_itemtype=:review_itemtype AND review_itemid=:review_itemid',array(':review_itemtype'=>$type, ':review_itemid'=>$id));
	   if(isset($reviews) && count($reviews) && isset($reviews[0]) && count($reviews[0]) ){
	      return $reviews;
	   }else{
	      return false;
	   }

	}
	
	public  function getall($type){
	   $reviews = $this->findAll('review_itemtype=:review_itemtype ',array(':review_itemtype'=>$type));
	   if(isset($reviews) && count($reviews) && isset($reviews[0]) && count($reviews[0]) ){
	      return $reviews;
	   }else{
	      return false;
	   }
	}
	
	function get_average($type,$id){
	         $criteria = new CDbCriteria();
			 $criteria->select=' count(review_rate) as review_count, sum(review_rate) as review_sum';
			 $criteria->condition = 'review_itemtype="'.$type.'" AND review_itemid="'.$id.'"';
			 $reviews = $this->find( $criteria);
			 if(count( $reviews) && isset($reviews->review_count) && isset($reviews->review_sum) && $reviews->review_count != '' && $reviews->review_sum != '')
			 return round( (int)$reviews->review_sum / (int)$reviews->review_count);
			 else
			 return false;
	}
	
	function show_average_stars($type,$id){
	   $reviews = $this->get_average($type,$id);
	   if($reviews){
	       return  '<span class="star '.(($reviews>=1)?"active":"").'"></span> <span class="star '.(($reviews>=2)?"active":"").'"></span> <span class="star '.(($reviews>=3)?"active":"").'"></span> <span class="star '.(($reviews>=4)?"active":"").'"></span> <span class="star '.(($reviews>=5)?"active":"").' last"></span>';
	   }else{
	      return   '<span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star  last"></span>';
	   }
	}
	
	function get_reviews_count($type,$id){
	      $reviews = $this->get_review_all($type,$id);
		  $reviewsarr = array('count'=>0,'5stars'=>0,'4stars'=>0,'3stars'=>0,'2stars'=>0,'1stars'=>0);
		  if( $reviews){
		     foreach($reviews as $review){
			   $reviewsarr['count'] = $reviewsarr['count']+1;
			   if(isset($reviewsarr[$review->review_rate.'stars'] ))
			    $reviewsarr[$review->review_rate.'stars'] = $reviewsarr[$review->review_rate.'stars']+1;
			 }
		  
		 } 
		 
		 
		  return $reviewsarr;
	}
	
		function get_review_all_user($id){
	   $reviews = $this->findAll(array('condition'=>'review_by='.$id,'order'=>'review_id desc'));
	   if(isset($reviews) && count($reviews) && isset($reviews[0]) && count($reviews[0]) ){
	      return $reviews;
	   }else{
	      return false;
	   }

	}
	
	
	function like_unlike_widget($review_id){
	    $result = Reviews::model()->findByPk($review_id);
		$review =   $result;
		$widget = '';
		if(count( $result) && !empty( $result)){
			   if(!Yii::app()->user->isGuest){ 
				  
				   if($review->review_itemtype != 'guide' || $review->review_itemtype != 'iyer' || (($review->review_itemtype == 'guide' || $review->review_itemtype == 'iyer' ) && $review->review_by != Yii::app()->user->id)){
				   //review_likecount, review_unlikecount, review_like_users, review_unlike_users
				   $review_like_users = explode(',',$result->review_like_users);
				   $review_unlike_users = explode(',',$result->review_unlike_users);
				   $alreadyusers = array_merge( $review_like_users, $review_unlike_users);
				   if(in_array(Yii::app()->user->id, $alreadyusers)){
				   if(in_array(Yii::app()->user->id, $review_like_users))
				    $staus = 'likes';
					else
					$staus = 'unlikes';
					
					if(in_array(Yii::app()->user->id, $review_like_users) && in_array(Yii::app()->user->id, $review_unlike_users))
					 {
				     $widget .= ' '.$result->review_likecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="'.$result->review_likecount.' likes found"><img src="'.Yii::app()->request->baseUrl.'/image/'.(( $staus=='likes')?'hup':'thumb').'.png" width="20px" border="0" alt=""/></a>&nbsp; '.$result->review_unlikecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="'.$result->review_unlikecount.' unlikes found"><img  src="'.Yii::app()->request->baseUrl.'/image/'.(( $staus=='unlikes')?'hdown':'hdown').'.png" width="20px;" border="0" alt=""/></a>';
					 }
					 else if(in_array(Yii::app()->user->id, $review_like_users))
					 {
					     $widget .= ' '.$result->review_likecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="'.$result->review_likecount.' likes found"><img src="'.Yii::app()->request->baseUrl.'/image/'.(( $staus=='likes')?'hup':'thumb').'.png" width="20px" border="0" alt=""/></a>&nbsp;'.$result->review_unlikecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="Unlike this review" onclick="unlikereview(\''.$result->review_id.'\')"><img  src="'.Yii::app()->request->baseUrl.'/image/unlike.png" width="20px;" onMouseOver="this.src=\''.Yii::app()->request->baseUrl.'/image/hdown.png\'" onMouseOut="this.src=\''.Yii::app()->request->baseUrl.'/image/unlike.png\'" border="0" alt=""/></a>';
					 }
					 else if(in_array(Yii::app()->user->id, $review_unlike_users)){
					 $widget .= ' '.$result->review_likecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="Like this review" onclick="likereview(\''.$result->review_id.'\')"><img src="'.Yii::app()->request->baseUrl.'/image/thumb.png" width="20px" onMouseOver="this.src=\''.Yii::app()->request->baseUrl.'/image/hup.png\'" onMouseOut="this.src=\''.Yii::app()->request->baseUrl.'/image/thumb.png\'" border="0" alt=""/></a>&nbsp; '.$result->review_unlikecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="'.$result->review_unlikecount.' unlikes found"><img  src="'.Yii::app()->request->baseUrl.'/image/'.(( $staus=='unlikes')?'hdown':'unlike').'.png" width="20px;" border="0" alt=""/></a>';
					 }
				   }else{
				   
				 $widget .= ' '.$result->review_likecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="Like this review" onclick="likereview(\''.$result->review_id.'\')"><img src="'.Yii::app()->request->baseUrl.'/image/thumb.png" width="20px" onMouseOver="this.src=\''.Yii::app()->request->baseUrl.'/image/hup.png\'" onMouseOut="this.src=\''.Yii::app()->request->baseUrl.'/image/thumb.png\'" border="0" alt=""/></a>&nbsp;
'.$result->review_unlikecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger" title="Unlike this review" onclick="unlikereview(\''.$result->review_id.'\')"><img  src="'.Yii::app()->request->baseUrl.'/image/unlike.png" width="20px;" onMouseOver="this.src=\''.Yii::app()->request->baseUrl.'/image/hdown.png\'" onMouseOut="this.src=\''.Yii::app()->request->baseUrl.'/image/unlike.png\'" border="0" alt=""/></a>';
				    
				   }
				}
			}else{
			
			     $widget .= ' '.$result->review_likecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger triggerlogin" title="Please login to like this review" data-type="like" data-id="'.$result->review_id.'"><img src="'.Yii::app()->request->baseUrl.'/image/thumb.png" width="20px" onMouseOver="this.src=\''.Yii::app()->request->baseUrl.'/image/hup.png\'" onMouseOut="this.src=\''.Yii::app()->request->baseUrl.'/image/thumb.png\'" border="0" alt=""/></a>&nbsp; '.$result->review_unlikecount.' &nbsp;<a href="javascript:void(0);" class="tootltiptrigger triggerlogin" title="Please login to unlike this review"  data-type="unlike"><img  class="triggerlogin" src="'.Yii::app()->request->baseUrl.'/image/unlike.png" width="20px;" onMouseOver="this.src=\''.Yii::app()->request->baseUrl.'/image/hdown.png\'" onMouseOut="this.src=\''.Yii::app()->request->baseUrl.'/image/unlike.png\'" border="0" alt=""/></a>';

			}
		}	
		return $widget;
	}
}
