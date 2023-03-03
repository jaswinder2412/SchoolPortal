<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_class".
 *
 * @property integer $id
 * @property string $class_name
 * @property string $school_id
 * @property string $created
 * @property string $updated
 * @property string $last_updated_by
 */
class AddClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_name', 'school_id', 'created', 'updated', 'last_updated_by'], 'string','max' => 500], 
			[['class_name'], 'required'],
			[['class_name'], 'validateclass'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_name' => 'Class Name',
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
				$section1 = AddClass::find()->where(['class_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['!=', 'id', $miyd])->all();
			} else {
					$section1 =AddClass::find()->where(['class_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['!=', 'id', $miyd])->all();
			}
			
			
		}
		else{ 
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddClass::find()->where(['class_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			} else {
					$section1 =AddClass::find()->where(['class_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
			}
		 } 
        
        if(!empty($section1))
        {
			
           $this->addError($attribute, 'Class has already Taken.');
		   return false;
        }
		return true;
		
    }
}
