<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\User;
use yii\validators\EmailValidator;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role_id
 * @property string $last_login
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $hidden_password
 */
class UserCustom extends \yii\db\ActiveRecord
{
	  public $password;
	public $password_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
			[['username'], 'validateemail'],
            /* ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255], */
			[['password_hash','status'], 'string'], 
			[['hidden_password'], 'string'], 
			['role_id', 'required'],
            ['email', 'trim'],
            ['email', 'required'],
			[['email'], 'validateemail'],
           /*  ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'], */
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role_id' => 'Designation',
            'last_login' => 'Last Login',
            'status' => 'Status',
            'created_at' => 'Created At',
            'hidden_password' => 'hidden_password',
            'updated_at' => 'Updated At',
        ];
    }
	
	  public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
	
	public function validateEmail($attribute, $params, $validator) { 
        $email = trim($this->$attribute, ' ');
        $validator = new EmailValidator();
        if (!($validator->validate($email, $error)))  {
            $this->addError($attribute, 'Email address is not a valid email address.');
        }
		
	  if(isset($this->id)){
			$miyd = $this->id;
			
			$email1 = User::find()->where(['email' => $email])->andWhere(['!=', 'id', $miyd])->all();
			
		}
		else{ 
			$email1 = User::find()->where(['email' => $email])->all();
		 } 
        
        if(!empty($email1))
        {
			
           $this->addError($attribute, 'Email address has already Taken.');
		   return false;
        }
		return true;
		
    }
	
	
}
