<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 
	 
	public function authenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
		
		$users = User::model()->find('email=:email',array(':email'=>$this->username));
		
		if(!isset($users->user_id))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users->password !=helpers::encrypt_password($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($users->role != '1')
			$this->errorCode=self::ERROR_USERNAME_INVALID;	
		else{
		    $this->_id=$users->user_id;
			if($users->role=='1')
			 $this->setState('roles','main');
			 else if($users->role=='2')
			 $this->setState('roles','normal');
			 else if($users->role=='3')
			 $this->setState('roles','guide');
			 else if($users->role=='4')
			 $this->setState('roles','iyer');

			// Yii::app()->user->email=$users->email;
			// Yii::app()->user->role=$users->role;
			$this->errorCode=self::ERROR_NONE;
			}
			
		return $this->errorCode==self::ERROR_NONE;
	}
	
	public function makeauthenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
		
		$users = User::model()->find('email=:email',array(':email'=>$this->username));
	
		if(!isset($users->user_id)){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}elseif($users->password !=$this->password){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}elseif($users->role != '1'){
			$this->errorCode=self::ERROR_USERNAME_INVALID;	
		}else{
		    $this->_id=$users->user_id;

			$this->errorCode=self::ERROR_NONE;
			}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}
?>