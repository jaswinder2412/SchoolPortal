<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_test".
 *
 * @property integer $id
 * @property string $test_name
 * @property string $school_id
 * @property string $created_by
 * @property string $created
 * @property string $updated
 */
class AddTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_name', 'school_id', 'created_by', 'created', 'updated'], 'string','max' => 500],
			[['test_name'], 'required'],
			[['test_name'], 'validateclass'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_name' => 'Test Name',
            'school_id' => 'School ID',
            'created_by' => 'Created By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
	
	public function validateclass($attribute, $params) { 
		$section = $this->$attribute;
	
  	  if(isset($this->id)){
			$miyd = $this->id;
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddTest::find()->where(['test_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['!=', 'id', $miyd])->all();
			} else {
					$section1 = AddTest::find()->where(['test_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['!=', 'id', $miyd])->andwhere(['=','created_by',Yii::$app->user->getId()])->all();
			}
			
			
		}
		else{ 
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = AddTest::find()->where(['test_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			} else {
					$section1 = AddTest::find()->where(['test_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','created_by',Yii::$app->user->getId()])->all();
			}
		 } 
        
        if(!empty($section1))
        {
			
           $this->addError($attribute, 'Test Name has already Exist.');
		   return false;
        }
		return true;
		
    }
}
