<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "final_exam_grading".
 *
 * @property integer $id
 * @property string $final_exam_id
 * @property string $class_id
 * @property string $section_id
 * @property string $subject_id
 * @property string $student_id
 * @property string $grade
 * @property string $marks
 */
class FinalExamGrading extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'final_exam_grading';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['final_exam_id', 'class_id', 'section_id', 'subject_id', 'student_id', 'grade', 'marks'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'final_exam_id' => 'Final Exam ID',
            'class_id' => 'Class ID',
            'section_id' => 'Section ID',
            'subject_id' => 'Subject ID',
            'student_id' => 'Student ID',
            'grade' => 'Grade',
            'marks' => 'Marks',
        ];
    }
}
