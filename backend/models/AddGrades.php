<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_grades".
 *
 * @property integer $id
 * @property string $grade_name
 * @property string $school_id
 * @property string $created
 * @property string $updated
 * @property string $last_updated_by
 */
class AddGrades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_grades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade_name', 'school_id', 'created', 'updated', 'last_updated_by'], 'string','max' => 500],
			[['grade_name'], 'required'],
			[['grade_name'], 'validateclass'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade_name' => 'Grade Name',
            'school_id' => 'School ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'last_updated_by' => 'Last Updated By',
        ];
    }
	
	public function validateclass($attribute, $params) { 
		$section = $this->$attribute;
	
  	  if(isset($this->id)){
			$miyd = $this->id;
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddGrades::find()->where(['grade_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['!=', 'id', $miyd])->all();
			} else {
					$section1 = AddGrades::find()->where(['grade_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['!=', 'id', $miyd])->all();
			}
			
			
		}
		else{ 
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddGrades::find()->where(['grade_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			} else {
					$section1 = AddGrades::find()->where(['grade_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
			}
		 } 
        
        if(!empty($section1))
        {
			
           $this->addError($attribute, 'Grade has already Exist.');
		   return false;
        }
		return true;
		
    }
	
}
