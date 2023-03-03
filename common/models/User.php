<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use backend\models\newStaffdata;
use backend\models\SchoolList;
use backend\models\AddStudent;
use backend\models\AcedemicYear;
use backend\models\ClassStudent;
use backend\models\ClassInfo;
use backend\models\Section;
use backend\models\AddClass;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $role_id
 * @property integer $last_login
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	const STATUS_INACTIVE = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
		
        return static::findOne(['username' => $username]);
    }
	
 	public function validatestatus($user)
    {		
		$user_obj = User::find(['username' => $user, 'status' => self::STATUS_ACTIVE])->one();
		return $user_obj;  
		//return static::findOne(['username' => $user, 'status' => self::STATUS_ACTIVE]); 
    } 

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
	
	
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	
	public function getUsername($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = 'Admin';
	   }
	   else if($role == '1'){
		   $school = SchoolList::find()
						->where(['school_user_id'=> Yii::$app->user->getId()])
						->one(); 
						
		   $datta = ucfirst($school['first_name'])." ".ucfirst($school['last_name']);
	   }
	   else if($role == '6') {
		   $student = AddStudent::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
		   $datta = ucfirst($student['first_name'])." ".ucfirst($student['last_name']);
	   }
	   
	   else {
		   $staff = newStaffdata::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
		   $datta = ucfirst($staff['fname'])." ".ucfirst($staff['lname']);
	   }
	   
	   return $datta;
    }
	
	public function getUserimage($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = 'dummy.jpg';
	   }
	   else if($role == '1'){
		   
		   $school = SchoolList::find()
						->where(['school_user_id'=> Yii::$app->user->getId()])
						->one(); 
						
		   
		   if(!empty($school['image'])){
				$datta = $school['image'];
			}
			else{
				$datta = 'dummy.jpg';
			}
	   }
	   else if($role == '6') {
		   $student = AddStudent::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
			if(!empty($student['image'])){
				$datta = $student['image'];
			}
			else{
				$datta = 'dummy.jpg';
			}
	   }
	   
	   else {
		   $staff = newStaffdata::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
			if(!empty($staff['image'])){
				  $datta = $staff['image'];
			}
			else{
				$datta = 'dummy.jpg';
			}
	   }
	   
	   return $datta;
    }
	
	public function getUserschoolimage($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = 'dummy.jpg';
	   }
	   else if($role == '1'){
		   
		   $school = SchoolList::find()
						->where(['school_user_id'=> Yii::$app->user->getId()])
						->one(); 
						
		   
		   if(!empty($school['school_logo'])){
				$datta = $school['school_logo'];
			}
			else{
				$datta = 'dummy.jpg';
			}
	   }
	   else if($role == '6') {
		   $student = AddStudent::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
			$spods = SchoolList::find()
						->where(['school_user_id'=> $student['school_id']])
						->one();
			if(!empty($spods['school_logo'])){
				$datta = $spods['school_logo'];
			}
			else{
				$datta = 'dummy.jpg';
			}
	   }
	   
	   else {
		   $staff = newStaffdata::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
			$spods = SchoolList::find()
						->where(['school_user_id'=> $staff['school_id']])
						->one();
			if(!empty($spods['school_logo'])){
				  $datta = $spods['school_logo'];
			}
			else{
				$datta = 'dummy.jpg';
			}
	   }
	   
	   return $datta;
    }
	
	public function getSchoolname($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = 'Administrator';
	   }
	   else if($role == '1'){
		   
		   $school = SchoolList::find()
						->where(['school_user_id'=> Yii::$app->user->getId()])
						->one(); 
						
		   $datta = $school['school_name'];
	   }
	elseif($role == '6'){
		
		$staff = AddStudent::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
			$gtschool = SchoolList::find()
						->where(['school_user_id'=> $staff['school_id']])
						->one();
		   $datta = $gtschool['school_name'];
		
	} else{
		   $staff = newStaffdata::find()
						->where(['user_id'=> Yii::$app->user->getId()])
						->one();
			$gtschool = SchoolList::find()
						->where(['school_user_id'=> $staff['school_id']])
						->one();
		   $datta = $gtschool['school_name'];
	   }
	   
	   return $datta;
    }
	
	public function getacademicyear($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = '';
	   }
	   else if($role == '1'){
		   $acadyearing = AcedemicYear::find()->where(['school_id' => Yii::$app->user->getId()])->andwhere(['status' => 1])->one();
		   if(!empty($acadyearing)){
			   $datta = /* $acadyearing['academic_name'].": ". */$acadyearing['from']." - ".$acadyearing['to'];
		   }
		   
	   } else{
		   $acadyearing = AcedemicYear::find()->where(['school_id' => Yii::$app->user->identity->school_id])->andwhere(['status' => 1])->one();
		  
		    if(!empty($acadyearing)){
			   $datta = /* $acadyearing['academic_name'].": ". */$acadyearing['from']." - ".$acadyearing['to'];
		   }
	   }
	   return $datta;
    }
	
	public function getonlyacademicyear($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = '';
	   }
	   else if($role == '1'){
		   $acadyearing = AcedemicYear::find()->where(['school_id' => Yii::$app->user->getId()])->andwhere(['status' => 1])->one();
		   if(!empty($acadyearing)){
			   $datta = $acadyearing['from']." - ".$acadyearing['to'];
		   }
		   
	   } else{
		   $acadyearing = AcedemicYear::find()->where(['school_id' => Yii::$app->user->identity->school_id])->andwhere(['status' => 1])->one();
		  
		    if(!empty($acadyearing)){
			   $datta = $acadyearing['from']." - ".$acadyearing['to'];
		   }
	   }
	   return $datta;
    }
	
	public function getDesignation($role)
    {
	
       $datta = '';
	   if($role == '0'){
		   
		   $datta = 'Administrator';
	   }
	   else if($role == '1'){
		   
		   $datta = 'Principal';
	   }
	   else if($role == '2'){
			$datta = 'Vice Principal';
	   }
	   else if($role == '3'){
			$datta = 'Co-Ordinator';
	   }
	   else if($role == '4'){
			$datta = 'Office Staff';
	   }
	   else if($role == '5'){
			$datta = 'Teacher';
	   }
	   else if($role == '6'){
			$datta = 'Student';
	   }
	   
	   return $datta;
    }
	
	public function getCurrentclass()
    {
	
       if(Yii::$app->user->identity->role_id == 1){
				    $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				   }else{
					   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
				   }
				   $getclass = ClassStudent::find()->where(['student_id'=>Yii::$app->user->getId()])->andwhere(['Academic_year_id'=>$academine['id']])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   if(!empty($getclassname['class_name'])){
					  $nockout  = $getclassname['class_name'];
					   $myclassfind = AddClass::find()->where(['id'=>$nockout])->one();
					   $getclks = $myclassfind['class_name'];
				   }else {
					   $getclks = 'NA';
				   }
				   
				    if(Yii::$app->user->identity->role_id == 1){
				    $academinesection = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				   }else{
					   $academinesection = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
						
				   }

					$getclasssection = ClassStudent::find()->where(['student_id'=>Yii::$app->user->getId()])->andwhere(['Academic_year_id'=>$academinesection['id']])->one();
				   $getclassnamesection = ClassInfo::find()->where(['id'=>$getclasssection['class_id']])->one();
					$getsubject = Section::find()->where(['id'=>$getclassnamesection['class_section']])->one();
					 if(!empty($getsubject['section_name'])){
					   $getsubjicts = $getsubject['section_name'];
				   }else {
					   $getsubjicts = 'NA';
				   }
					
				   $golkut = $getclks. " " .$getsubjicts;
					return $golkut;
    }
	
	
}
