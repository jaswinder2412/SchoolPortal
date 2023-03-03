<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher_exam_class".
 *
 * @property integer $id
 * @property string $exam_id
 * @property string $class_id
 * @property string $section_id
 * @property string $subject_id
 * @property string $school_id
 * @property string $academic_year
 * @property string $created
 * @property string $updated
 */
class TeacherExamClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_exam_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_id', 'section_id', 'subject_id', 'school_id', 'academic_year', 'created', 'updated'], 'string'],
			[['subject_id'],'required'],
			['class_id','integer'], 
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_id' => 'Exam ID',
            'class_id' => 'Class ID',
            'section_id' => 'Section ID',
            'subject_id' => 'Subject',
            'school_id' => 'School ID',
            'academic_year' => 'Academic Year',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
