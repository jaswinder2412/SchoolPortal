<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inhouse_test_grading".
 *
 * @property integer $id
 * @property string $inhouse_test_id
 * @property string $class_id
 * @property string $section_id
 * @property string $subject_id
 * @property string $student_id
 * @property string $marks
 * @property string $teacher_created_by
 */
class InhouseTestGrading extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inhouse_test_grading';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inhouse_test_id', 'class_id', 'section_id', 'subject_id', 'student_id', 'marks', 'teacher_created_by'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inhouse_test_id' => 'Inhouse Test ID',
            'class_id' => 'Class ID',
            'section_id' => 'Section ID',
            'subject_id' => 'Subject ID',
            'student_id' => 'Student ID',
            'marks' => 'Marks',
            'teacher_created_by' => 'Teacher Created By',
        ];
    }
}
