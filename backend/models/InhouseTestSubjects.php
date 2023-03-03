<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inhouse_test_subjects".
 *
 * @property integer $id
 * @property string $inhouse_test_id
 * @property string $subject_id
 * @property string $Assigned_teacher_id
 * @property string $exam_date
 * @property string $school_id
 * @property string $academic_year
 * @property string $created
 * @property string $updated
 * @property string $last_updated_by
 */
class InhouseTestSubjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inhouse_test_subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inhouse_test_id', 'subject_id', 'Assigned_teacher_id', 'exam_date', 'school_id', 'academic_year', 'created', 'updated', 'last_updated_by'], 'string'],
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
            'subject_id' => 'Subject ID',
            'Assigned_teacher_id' => 'Assigned Teacher ID',
            'exam_date' => 'Exam Date',
            'school_id' => 'School ID',
            'academic_year' => 'Academic Year',
            'created' => 'Created',
            'updated' => 'Updated',
            'last_updated_by' => 'Last Updated By',
        ];
    }
}
