<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher_manage_grade".
 *
 * @property integer $id
 * @property string $exam_id
 * @property string $class_id
 * @property string $subject_id
 * @property string $student_id
 * @property string $grade
 * @property string $marks
 */
class TeacherManageGrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_manage_grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_id', 'class_id', 'subject_id', 'student_id', 'grade', 'marks'], 'string'],
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
            'subject_id' => 'Subject ID',
            'student_id' => 'Student ID',
            'grade' => 'Grade',
            'marks' => 'Marks',
        ];
    }
}
