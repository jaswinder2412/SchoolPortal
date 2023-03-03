<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "school_list".
 *
 * @property integer $id
 * @property integer $school_user_id
 * @property string $school_name
 * @property string $school_location
 * @property string $school_logo
 * @property string $description
 * @property string $number_of_student
 * @property string $first_name
 * @property string $phone_number
 * @property string $last_name
 * @property string $image
 * @property string $status
 * @property string $created_by
 * @property string $created_time
 * @property string $updated
 */
class SchoolList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['school_user_id'], 'integer'],
            [['phone_number', 'number_of_student'], 'integer'],
            [['school_name' , 'status','first_name', 'last_name', 'school_location'], 'required'],
            [['school_name', 'school_location', 'school_logo', 'description', 'first_name',  'last_name', 'status', 'created_by', 'created_time', 'updated'], 'string'],
			[['school_logo'], 'file','extensions' => 'png, jpg,jpeg', 'maxSize' => 10000000, 'tooBig' => 'Image Limit is 10MB'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_user_id' => 'school user id',
            'school_name' => 'School Name',
            'school_location' => 'School Location',
            'school_logo' => 'School Logo',
            'description' => 'Description',
            'number_of_student' => 'Number Of Student',
            'first_name' => 'First Name',
            'phone_number' => 'Phone Number',
            'last_name' => 'Last Name',
            'image' => 'Image',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_time' => 'Created Time',
            'updated' => 'Updated',
        ];
    }
}
