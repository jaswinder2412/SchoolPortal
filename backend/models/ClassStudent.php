<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "class_student".
 *
 * @property integer $id
 * @property string $class_id
 * @property string $student_id
 * @property string $Academic_year_id
 * @property string $school_id
 * @property string $created_date
 * @property string $updated_date
 */
class ClassStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'student_id', 'Academic_year_id', 'school_id', 'created_date', 'updated_date'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
            'student_id' => 'Student ID',
            'Academic_year_id' => 'Academic Year ID',
            'school_id' => 'School ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
