<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher_test_exam".
 *
 * @property integer $id
 * @property string $exam_name
 * @property string $marks
 * @property string $school_id
 * @property string $academic_year
 * @property string $exam_date
 * @property string $inhouse_global
 * @property string $created_date
 * @property string $updated_date
 * @property string $last_updated_by
 */
class TeacherTestExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_test_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_name', 'marks', 'school_id', 'academic_year', 'exam_date', 'inhouse_global', 'created_date', 'updated_date', 'last_updated_by'], 'string'],
			[['exam_name', 'marks','academic_year', 'exam_date',], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_name' => 'Test Name',
            'marks' => 'Marks',
            'school_id' => 'School ID',
            'academic_year' => 'Academic Year',
            'exam_date' => 'Test Date',
            'inhouse_global' => 'Inhouse Global',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'last_updated_by' => 'Last Updated By',
        ];
    }
}
