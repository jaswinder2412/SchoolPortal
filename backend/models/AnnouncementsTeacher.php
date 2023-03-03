<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "announcements_teacher".
 *
 * @property integer $id
 * @property string $anouncement_title
 * @property string $anouncement_description
 * @property string $announcements_to
 * @property string $announcements_from
 * @property string $status
 * @property string $school_id
 * @property string $start_date
 * @property string $end_date
 * @property string $announcement_date
 * @property string $created_by
 * @property string $created_time
 * @property string $updated_time
 * @property string $seen
 */
class AnnouncementsTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcements_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anouncement_title', 'anouncement_description', 'announcements_to', 'announcements_from', 'status', 'school_id', 'created_time', 'updated_time', 'created_by','seen'], 'string'],
			[['anouncement_title', 'anouncement_description', 'announcements_to', 'status', 'start_date','end_date'],'required'],
            [['created_time', 'updated_time'], 'required'],
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
            'anouncement_title' => 'Anouncement Title',
            'anouncement_description' => 'Anouncement Description',
            'announcements_to' => 'Announcements To',
            'announcements_from' => 'Announcements From',
            'status' => 'Status',
            'school_id' => 'School ID',
            'created_by' => 'created',
            'announcement_date' => 'Date of Commencement',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'seen' => 'seen Time',
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
