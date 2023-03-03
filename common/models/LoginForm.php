<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
	public $reCaptcha;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'
			//,'reCaptcha'
			], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
			// [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LfawEAUAAAAADZG3JCczN2IU5Z2M54vx9DxmWon', 'uncheckedMessage' => 'Please confirm that you are not a bot.']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
			
            $user = $this->getUser();
			
            if (!$user || !$user->validatePassword($this->password)) {
			
				 $this->addError($attribute, 'Incorrect username or password.');
			}
			else if($user->status=="0"){
                 $this->addError($attribute, 'Your Account is inactive . Please contact Administrator.');
           
				   
            }
			else if($user->status=="2"){
                 $this->addError($attribute, 'Your Account has been Deleted . Please contact Administrator.');
           
				   
            }
			
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
			
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
	
	protected function getstatus()
    {
		
        if ($this->_user === null) {
            $this->_user = User::validatestatus($this->username);
        }

        return $this->_user;
    }
}
