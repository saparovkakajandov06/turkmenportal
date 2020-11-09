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
//          $user = Ulanyjylar::model()->findByAttributes(array('username' => $this->username));
//          
//          if ($user === null)
//               $this->errorCode = self::ERROR_USERNAME_INVALID;
//          elseif ($user->parol !== md5($this->password))
//               $this->errorCode = self::ERROR_PASSWORD_INVALID;
//          else {
//               $this->_id = $user->id;
////               if(isset ($this->sklad_id) && strlen(trim($this->sklad_id))>0){
////                   $satyjySkladModel = SatyjySklad::model()->findByAttributes(array('satyjy_id'=>$user->id,'sklad_id'=>$this->sklad_id));
////                   if(isset ($satyjySkladModel)){
////                        $role = $satyjySkladModel->role;
////                        Yii::app()->user->setState('role', $role);
////                   }
////              }
              $this->errorCode = self::ERROR_NONE;
//          }
//
//          
          
          return !$this->errorCode;
	}
        
        
         public function getId() {
            return $this->_id;
        }
     
}