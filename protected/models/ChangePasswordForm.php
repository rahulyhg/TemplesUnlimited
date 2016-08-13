<?php

class ChangePasswordForm extends CFormModel
{
  public $currentPassword;
  public $newPassword;
  public $newPassword_repeat;
  private $_user;
  
  
  public function rules()
  {
    return array(
      array(
        'currentPassword', 'compareCurrentPassword'
      ),
      array(
        'currentPassword, newPassword, newPassword_repeat', 'required',
        'message'=>'Enter {attribute}.',
      ),
      array(
        'newPassword_repeat', 'compare',
        'compareAttribute'=>'newPassword',
        'message'=>'The new password does not match.',
      ),
      
    );
  }
  
  public function compareCurrentPassword($attribute,$params)
  {
    if(User::model()->hashPassword($this->currentPassword) !== $this->_user->password )
    {
      $this->addError($attribute,'Invalid Current Password');
    }
  }
  
  
   public function init()
  {
 
    $this->_user = User::model()->findByAttributes( array( 'user_id'=>Yii::app()->user->id ) );
  }
  
  
  public function attributeLabels()
  {
    return array(
      'currentPassword'=>'Current Password',
      'newPassword'=>'New Password',
      'newPassword_repeat'=>'Repeat New Password',
    );
  }
  
  public function changePassword()
  {
    $this->_user->password =User::model()->hashPassword($this->newPassword);
    if( $this->_user->save() )
      return true;
    return false;
  }
}

?>
