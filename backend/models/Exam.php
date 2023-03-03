<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exams".
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
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_name', 'marks', 'school_id', 'academic_year', 'created_date', 'updated_date', 'exam_date', 'inhouse_global'], 'string' , 'max' => 500],
			[['exam_name', 'marks', 'academic_year', ], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_name' => 'Exam Name',
            'marks' => 'Marks',
            'school_id' => 'School',
            'academic_year' => 'Academic Year',
            'exam_date' => 'Exam Date',
            'inhouse_global	' => 'inhouse/global',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
