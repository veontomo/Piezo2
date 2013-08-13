<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login(){
		if($this->_identity===null){
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__." identity is null"),'vardump');
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
    }else{
    	echo Yii::trace(CVarDumper::dumpAsString(__METHOD__." identity is NOT null"),'vardump');
    }
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE){
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__." error code is ".UserIdentity::ERROR_NONE),'vardump');
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": before returning TRUE"),'vardump');
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": this->_identity = ".serialize($this->_identity)),'vardump');
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": this->_identity->getId = ".serialize($this->_identity->getId())),'vardump');
      $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);

			return true;
		}
		else{
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__." error code is NOT 	".UserIdentity::ERROR_NONE),'vardump');
			echo Yii::trace(CVarDumper::dumpAsString(__METHOD__.": before returning FALSE"),'vardump');
    	return false;
    }

	}
}
