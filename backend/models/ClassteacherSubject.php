<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "class_subject".
 *
 * @property integer $id
 * @property string $class_id
 * @property string $subject_id
 * @property string $Assigned_teacher_id
 * @property string $created_date
 * @property string $updated_date
 */
class ClassteacherSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'subject_id', 'Assigned_teacher_id', 'created_date', 'updated_date'], 'string'],
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
            'subject_id' => 'Subject ID',
            'Assigned_teacher_id' => 'Assigned Teacher ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
