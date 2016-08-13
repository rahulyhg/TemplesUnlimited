<?php
/* @var $this TemplesController */
/* @var $data Temples */
?>


  <li>
	  <img src="<?php echo Yii::app()->request->baseUrl; ?>/temple_images/<?php echo CHtml::encode($data->main_image); ?>" class="dashboard-member-activity-avatar"/>
	  <span class="blue"><?php echo CHtml::encode($data->getAttributeLabel('id')); ?> : <strong><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></strong></span><br />
	  <span class="blue"><?php echo CHtml::encode($data->getAttributeLabel('temple_name')); ?> : <strong><?php echo CHtml::encode($data->temple_name); ?></strong></span><br />
	  <span class="blue"><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?> : <strong><?php
			$criteria = new CDbCriteria;  
			$city_id = CHtml::encode($data->city_id);
			$criteria->addCondition('id' == $city_id);
			$city = Cities::model()->find($criteria);
			$state_id = $city->state_id;
			echo $city->name;
		?></strong></span><br />
	  <span class="blue">State : <strong><?php
			$criteria = new CDbCriteria;  
			$criteria->addCondition('id' == $state_id);
			$state = States::model()->find($criteria);
			echo $state->state_name;
		?></strong></span><br />
	  <span class="blue"><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?> : <strong><?php
			$criteria = new CDbCriteria;  
			$category_id = CHtml::encode($data->category_id);
			$criteria->addCondition('id' == $category_id);
			$category = Categories::model()->find($criteria);
			echo $category->category_name;
		?></strong></span><br />
  </li>
		
