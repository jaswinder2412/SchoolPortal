<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "acedemic_year".
 *
 * @property integer $id
 * @property string $academic_name
 * @property string $from
 * @property string $to
 * @property string $status
 * @property string $school_id
 * @property string $created_date
 * @property string $updated_date
 */
class AcedemicYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acedemic_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_name', 'from', 'to', 'status', 'school_id', 'created_date', 'updated_date'], 'string', 'max'=>500],
            [['academic_name', 'from', 'to', 'status', 'created_date', 'updated_date'], 'required'],
			[['status'], 'validatestatus'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'academic_name' => 'Academic Name',
            'from' => 'From',
            'to' => 'To',
            'status' => 'Status',
            'school_id' => 'school_id',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
	
	public function validatestatus($attribute, $params) {

		$myid = $this->$attribute;
		$schol = Yii::$app->user->getId();
		if($myid == '1'){
		if(isset($this->id)){
			$getstatus = AcedemicYear::find()->where(['status' => '1'])->andWhere(['=', 'school_id', $schol])->andWhere(['!=', 'id', $this->id])->all();
		}
		else{
			$getstatus = AcedemicYear::find()->where(['status' => '1'])->andWhere(['=', 'school_id', $schol])->all();
		}
				
        if(!empty($getstatus))
        {
			
           $this->addError($attribute, 'Academic Year is Already Active.');
		   return false;
        }

		}
		return true;
    }
}
