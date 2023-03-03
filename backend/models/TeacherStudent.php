<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_student".
 *
 * @property integer $id
 * @property string $user_id
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
 */
class TeacherStudent extends \yii\db\ActiveRecord
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
            [['user_id', 'first_name', 'last_name', 'dob', 'blood_group', 'gender', 'image', 'father_name', 'mother_name', 'father_ph_no', 'mother_phone_no', 'address', 'school_id', 'status', 'created', 'updated', 'admission_number'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
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
            'school_id' => 'School ID',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'admission_number' => 'Admission Number',
        ];
    }
}
