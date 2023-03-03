<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "announcements_parent".
 *
 * @property integer $id
 * @property string $class_id
 * @property string $section
 * @property string $Academic_year_id
 * @property string $school_id
 * @property string $student_id
 * @property string $anouncement_title
 * @property string $anouncement_description
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 * @property string $created_by
 * @property string $created
 * @property string $updated
 */
class AnnouncementsParent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcements_parent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'section', 'Academic_year_id', 'school_id', 'student_id', 'anouncement_title', 'status', 'created', 'updated', 'created_by'], 'string' , 'max'=>500], 
			[['anouncement_description',], 'string' , 'max'=>5000],
			[['student_id', 'Academic_year_id', 'anouncement_title', 'anouncement_description', 'status', 'start_date','end_date'], 'required'],
			['class_id','required'],
			
			[['end_date'],'validateDates'],
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
            'anouncement_title' => 'Announcement Title',
            'anouncement_description' => 'Announcement Description',
            'status' => 'Status',
            'start_date' => 'Start Date',
            'end_date' => 'End date',
            'created_by' => 'created By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
	public function validateDates($attribute,$param){
	
		if(strtotime($this->end_date) <= strtotime($this->start_date)){
			
			$this->addError('start_date','Please give correct Start and End dates');
			$this->addError('end_date','Please give correct Start and End dates');
			 return false;
		}
	}
}
