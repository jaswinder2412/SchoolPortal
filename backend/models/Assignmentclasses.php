<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "assignmentclasses".
 *
 * @property integer $id
 * @property string $class_id
 * @property string $section
 * @property string $Academic_year_id
 * @property string $school_id
 * @property string $student_id
 * @property string $anouncement_title
 * @property string $anouncement_description
 * @property string $status
 * @property string $created_by
 * @property string $fileupload
 * @property string $created
 * @property string $updated
 */
class Assignmentclasses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assignmentclasses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'section', 'Academic_year_id', 'school_id', 'student_id', 'anouncement_title',  'status', 'created', 'updated', 'created_by'], 'string' , 'max'=>500],
			[['anouncement_description',], 'string' , 'max'=>5000],
			[['student_id', 'Academic_year_id', 'anouncement_title', 'anouncement_description', 'status', ], 'required'],
			['class_id','integer'],
			[['fileupload'], 'file','extensions' => 'png, jpg, jpeg, doc, txt, pdf, ppt, pptx', 'maxSize' => 10000000, 'tooBig' => 'Image Limit is 10MB'],
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
            'section' => 'Section',
            'Academic_year_id' => 'Academic Year ID',
            'school_id' => 'School ID',
            'student_id' => 'Student ID',
            'anouncement_title' => 'Assignment Title',
            'anouncement_description' => 'Assignment Description',
            'status' => 'Status',
            'created_by' => 'Created By',
            'fileupload' => 'Attachment',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
