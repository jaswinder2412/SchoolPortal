<?php

namespace backend\models;

use Yii;
/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property string $section_name
 * @property string $school_id
 * @property string $created
 * @property string $updated
 * @property string $last_updated_by
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_name', 'school_id', 'created', 'updated', 'last_updated_by'], 'string','max'=>500],
			
			[['section_name'], 'required'],
			[['section_name'], 'validatesection'],
        ];
    }
 
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_name' => 'Section Name',
            'school_id' => 'School ID',
            'created' => 'Created',
            'updated' => 'Last Update',
			'last_updated_by' => 'Last Update By',
        ];
    }
	
	public function validatesection($attribute, $params) { 
		$section = $this->$attribute;
	
  	  if(isset($this->id)){
			$miyd = $this->id;
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = Section::find()->where(['section_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['!=', 'id', $miyd])->all();
			} else {
					$section1 =Section::find()->where(['section_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['!=', 'id', $miyd])->all();
			}
			
			
		}
		else{ 
			if (Yii::$app->user->identity->role_id == 1) {
				$section1 = Section::find()->where(['section_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			} else {
					$section1 =Section::find()->where(['section_name' => $section])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
			}
		 } 
        
        if(!empty($section1))
        {
			
           $this->addError($attribute, 'Section has already Taken.');
		   return false;
        }
		return true;
		
    }
	
	
}
