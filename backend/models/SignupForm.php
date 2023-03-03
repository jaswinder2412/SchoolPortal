<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
	public $password_repeat;
	public $role_id;
	public $last_login;
	public $status;
	public $school_id;
	public $hidden_password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			['role_id', 'required'],
            ['hidden_password', 'required'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 6],
             ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"], 
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
         
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role_id = $this->role_id;
        $user->school_id = $this->school_id;
        $user->last_login = $this->last_login;
        $user->hidden_password = $this->hidden_password;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }


	
}
