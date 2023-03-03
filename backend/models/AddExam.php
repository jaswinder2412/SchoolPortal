<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_exam".
 *
 * @property integer $id
 * @property string $exam_name
 * @property string $school_id
 * @property string $created
 * @property string $updated
 * @property string $last_updated_by
 */
class AddExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_name', 'school_id', 'created', 'updated', 'last_updated_by'], 'string','max' => 500],
			[['exam_name'], 'required'],
			[['exam_name'], 'validateclass'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_name' => 'Exam Name',
            'school_id' => 'School ID',
            'created' => 'Created',
            'updated' => 'Updated',
			'last_updated_by' => 'Last_updated_by',
        ];
    }
	
	public function validateclass($attribute, $params) { 
		$section = $this->$attribute;
	
  	  if(isset($this->id)){
			$miyd = $this->id;
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddExam::find()->where(['exam_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['!=', 'id', $miyd])->all();
			} else {
					$section1 = AddExam::find()->where(['exam_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['!=', 'id', $miyd])->all();
			}
			
			
		}
		else{ 
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddExam::find()->where(['exam_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			} else {
					$section1 = AddExam::find()->where(['exam_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
			}
		 } 
        
        if(!empty($section1))
        {
			
           $this->addError($attribute, 'Exam has already Exist.');
		   return false;
        }
		return true;
		
    }
}
