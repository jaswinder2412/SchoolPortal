<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $subject_name
 * @property string $subject_description
 * @property string $created_by
 * @property string $school_id
 * @property string $created_date
 * @property string $updated_date
 * @property string $last_updated_by
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_name', 'created_by', 'school_id', 'created_date', 'updated_date', 'last_updated_by'], 'string','max' => 500],
			[['subject_description'],'string','max' => 1000],
			[['subject_name','subject_description'], 'required'],
			[['subject_name'], 'validatesubject'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_name' => 'Subject Name',
            'subject_description' => 'Subject Description',
            'created_by' => 'Created By',
            'school_id' => 'school Id',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'last_updated_by' => 'Updated last_updated_by',
        ];
    }
	
	public function validatesubject($attribute, $params) { 
		$section = $this->$attribute;
	
  	  if(isset($this->id)){
			$miyd = $this->id;
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = Subject::find()->where(['subject_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['!=', 'id', $miyd])->all();
			} else {
					$section1 =Subject::find()->where(['subject_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['!=', 'id', $miyd])->all();
			}
			
			
		}
		else{ 
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = Subject::find()->where(['subject_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			} else {
					$section1 =Subject::find()->where(['subject_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
			}
		 } 
        
        if(!empty($section1))
        {
			
           $this->addError($attribute, 'Subject has already Taken.');
		   return false;
        }
		return true;
		
    }
	
	
	
}
