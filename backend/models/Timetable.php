<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property integer $id
 * @property integer $teacher_id
 * @property integer $day_id
 * @property integer $lecture_id
 * @property integer $class_id
 * @property integer $section_id
 * @property integer $subject_id
 * @property integer $academic_year
 * @property integer $created
 * @property integer $updated
 * @property integer $lecturestatus
 * @property integer $lunchbreak
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'day_id', 'lecture_id', 'class_id', 'section_id', 'subject_id', 'academic_year', 'created', 'updated', 'lecturestatus', 'lunchbreak'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher_id' => 'Teacher ID',
            'day_id' => 'Day ID',
            'lecture_id' => 'Lecture ID',
            'class_id' => 'Class ID',
            'section_id' => 'Section ID',
            'subject_id' => 'Subject ID',
            'academic_year' => 'Academic Year',
            'created' => 'Created',
            'updated' => 'Updated',
			'lecturestatus' => 'lecturestatus',
			'lunchbreak' => 'lunchbreak',
        ];
    }
}
