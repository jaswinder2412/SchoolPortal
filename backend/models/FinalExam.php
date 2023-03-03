<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "final_exam".
 *
 * @property integer $id
 * @property string $exam_id
 * @property string $class_id
 * @property string $section_id
 * @property string $marks_in
 * @property string $subject_id
 * @property string $academic_year
 * @property string $school_id
 * @property string $created
 * @property string $updated
 */
class FinalExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'final_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_id', 'class_id', 'section_id', 'subject_id','academic_year', 'school_id', 'created', 'updated', 'marks_in'], 'string','max'=>500],
			[['exam_id', 'class_id', 'marks_in', 'section_id',], 'required'],
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_id' => 'Exam',
            'class_id' => 'Class',
            'section_id' => 'Section',
            'subject_id' => 'Subject', 
            'marks_in' => 'Marks In', 
			'academic_year' => 'Academic',
            'school_id' => 'School',
            'created' => 'created',
            'updated' => 'updated',
        ];
    }
}
