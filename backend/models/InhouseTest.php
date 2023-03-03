<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inhouse_test".
 *
 * @property integer $id
 * @property string $exam_id
 * @property string $class_id
 * @property string $section_id
 * @property string $subject_id
 * @property string $academic_year
 * @property string $school_id
 * @property string $teacher_created_by
 * @property string $created
 * @property string $updated
 */
class InhouseTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inhouse_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_id', 'class_id', 'section_id', 'subject_id', 'academic_year', 'school_id', 'teacher_created_by', 'created', 'updated'], 'string'],
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
            'subject_id' => 'Subject ID',
            'academic_year' => 'Academic Year',
            'school_id' => 'School ID',
            'teacher_created_by' => 'Teacher Created By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
