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
        // echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": ".$this->username),'vardump');
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


        return !$this->errorCode;
    }

    public function getId(){
        return $this->_id;
        /* this piece of code is neccessary when making autorization against an array
            $users=array(
                // username => password
                'demo'=>'demo',
                'admin'=>'admin',
            );

        the return value should be an integer
        // return 1;
        */
    }
}