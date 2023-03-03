<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "class_subject".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $subject_id
 * @property integer $Assigned_teacher_id
 * @property integer $academic_year
 * @property integer $school_id
 * @property string $created_date
 * @property string $updated_date
 */
class ClassSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'subject_id', 'Assigned_teacher_id','created_date', 'updated_date','school_id', 'academic_year'], 'string'],
			['subject_id', 'required', 'when' => function($model) {
                                    
                  return $model->Assigned_teacher_id != '';
            },
			'whenClient' => "function (attribute, value) { return $('#classsubject-assigned_teacher_id').val() != ''; }"
           ],
		   ['Assigned_teacher_id', 'required', 'when' => function($model) {
                                    
                  return $model->subject_id != '';
            },
			'whenClient' => "function (attribute, value) { return $('#classsubject-subject_id').val() != ''; }"
           ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    { 
        return [
            'id' => 'ID',
            'class_id' => 'Class',
            'subject_id' => 'Subject',
            'Assigned_teacher_id' => 'Assign Teacher',
            'academic_year' => 'Assign academic_year',
            'school_id' => 'school_id Teacher',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
