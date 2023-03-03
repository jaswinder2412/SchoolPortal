<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_student".
 *
 * @property integer $id
 * @property integer $used_id
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property string $blood_group
 * @property string $gender
 * @property string $image
 * @property string $father_name
 * @property string $mother_name
 * @property string $father_ph_no
 * @property string $mother_phone_no
 * @property string $address
 * @property string $school_id
 * @property string $status
 * @property string $created
 * @property string $updated
 * @property string $admission_number
 * @property string $last_updated_by
 */
class AddStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name','last_name','status'], 'required'], 
			[['first_name', 'last_name', 'father_name', 'mother_name',], 'string', 'max' => 50],
			[['admission_number','address','status','last_updated_by'], 'string', 'max' => 500],
			[['dob', 'blood_group','gender','created', 'updated','school_id'], 'string'],
			
			[['father_ph_no', 'mother_phone_no'], 'match', 'pattern'=>'/^[0-9]+([- +()0-9]+)+$/','message'=>"Phone Number should be numbers."],
			//[['image'], 'file','extensions' => 'png, jpg,jpeg', 'maxSize' => 10000000, 'tooBig' => 'Image Limit is 10MB'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Login ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'dob' => 'Dob',
            'blood_group' => 'Blood Group',
            'gender' => 'Gender',
            'image' => 'Image',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'father_ph_no' => 'Father Ph No',
            'mother_phone_no' => 'Mother Phone No',
            'address' => 'Address',
			'school_id' => 'school_id',
			'created' => 'Created',
			'updated' => 'Updated',
			'admission_number' => 'Admission Number',
			'last_updated_by' => 'Last Updated By',
        ];
    }
}
