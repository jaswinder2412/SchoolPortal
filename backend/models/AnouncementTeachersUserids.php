<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "anouncement_teachers_userids".
 *
 * @property integer $id
 * @property string $announcement_id
 * @property string $teacher_id
 * @property string $seen
 * @property string $school_id
 * @property string $academic_year
 */
class AnouncementTeachersUserids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anouncement_teachers_userids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['announcement_id', 'teacher_id', 'seen', 'school_id', 'academic_year'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'announcement_id' => 'Announcement ID',
            'teacher_id' => 'Teacher ID',
            'seen' => 'Seen',
            'school_id' => 'School ID',
            'academic_year' => 'Academic Year',
        ];
    }
}
