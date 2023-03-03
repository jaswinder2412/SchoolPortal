<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exam_class".
 *
 * @property integer $id
 * @property string $class_id
 * @property string $section_id
 * @property string $subject_id
 * @property string $school_id
 * @property string $academic_year
 * @property string $created
 * @property string $updated
 */
class ExamClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'section_id', 'school_id', 'academic_year', 'created', 'updated', 'subject_id'], 'string'],
			[['class_id'], 'required'],
			/* ['class_id', 'required', 'when' => function($model) {
                                    
                  return $model->section_id != '';
            },
			'whenClient' => "function (attribute, value) { return $('#examclass-section_id').val() != ''; }"
           ],*/
		   ['section_id', 'required', 'when' => function($model) {
                                    
                  return $model->class_id != '';
            },
			'whenClient' => "function (attribute, value) { return $('#examclass-class_id').val() != ''; }"
           ], 
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [ 
            'id' => 'ID',
            'class' => 'Class',
            'section' => 'Section',
            'school_id' => 'School',
            'subject_id' => 'Subject',
            'academic_year' => 'Academic Year',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
