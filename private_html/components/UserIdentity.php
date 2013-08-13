<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    private $_id;

    public function authenticate(){
        $users=array(
            // username => password
            'demo'=>'demo',
            'admin'=>'admin',
        );
        echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": ".$this->username),'vardump');
        $username = $this->username;
        $user=Users::model()->find('login=?', array($username));
        if($user === null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else{
            if($user->pswd !== md5($this->password)) {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else{
                $this->errorCode=self::ERROR_NONE; 
                $this->_id = $user->id;
            }
        }



        echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": from db: ".serialize($user)),'vardump');

        // if(!isset($users[$this->username])){
        //     $this->errorCode=self::ERROR_USERNAME_INVALID;
        //     echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.'Not set $users[$this->username]'),'vardump');
        // }
        // else{
        //     echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.':  Array $users has key '.$this->username),'vardump');
        //     echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": ".$users[$this->username].' vs '.$this->password),'vardump');
        //     if($users[$this->username]!==$this->password){
        //         echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": wrong password"),'vardump');
        //         $this->errorCode=self::ERROR_PASSWORD_INVALID;
        //     }
        //     else{
        //         echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": correct password"),'vardump');
        //         $this->errorCode=self::ERROR_NONE;
        //     }
        // }

        return !$this->errorCode;
    }

//	public function authenticate()
//	{
//		$users=array(
//			// username => password
//			'Andrew'=>'test',
//		);
//        $username = $this->username;
//        $user=Users::model()->find('login=?',array($username));
//        if($user===null)
//        {
//            $this->errorCode=self::ERROR_USERNAME_INVALID;
//        }
//        elseif(md5($this->password)!==$user->pswd)
//        {
//            $this->errorCode=self::ERROR_PASSWORD_INVALID;
//        }
//        else{
//            $this->_id = $user->id;
//            $this->username = $user->login;
//            $this->errorCode=self::ERROR_NONE;
//        }
//        $this->errorCode=self::ERROR_NONE;
//        return !$this->errorCode;
//	}

    public function getId(){
//        return $this->_id;
        return 1;
    }
}