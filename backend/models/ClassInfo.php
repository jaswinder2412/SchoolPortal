<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "class_info".
 *
 * @property integer $id
 * @property string $class_name
 * @property string $class_section
 * @property string $class_description
 * @property string $academic_year
 * @property string $school_id
 * @property string $last_updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class ClassInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_name', 'class_section', 'academic_year', 'created_date', 'updated_date','school_id','last_updated_by'], 'string'],
			[['class_name', 'class_section', 'academic_year',], 'required'],
			[['class_description'], 'string', 'max'=>1000],
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_name' => 'Class Name',
            'class_section' => 'Class Section',
            'class_description' => 'Class Description',
            'academic_year' => 'Academic Year',
            'school_id' => 'School Id',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'last_updated_by' => 'last updated by last',
        ];
    }
}
