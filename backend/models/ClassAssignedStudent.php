<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "class_assigned_student".
 *
 * @property integer $id
 * @property string $class_id
 * @property string $section_id
 * @property string $class_merge_id
 * @property string $student_userid
 * @property string $school_id
 * @property string $academic_year
 */
class ClassAssignedStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_assigned_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'section_id', 'class_merge_id', 'student_userid', 'school_id', 'academic_year'], 'string'],
			['section_id', 'required', 'when' => function($model) {
                                    
                  return $model->class_id != '';
            },
			'whenClient' => "function (attribute, value) { return $('#classassignedstudent-class_id').val() != ''; }"
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
            'section_id' => 'Section',
            'class_merge_id' => 'Class Merge ID',
            'student_userid' => 'Student Userid',
            'school_id' => 'School ID',
            'academic_year' => 'Academic Year',
        ];
    }
}
