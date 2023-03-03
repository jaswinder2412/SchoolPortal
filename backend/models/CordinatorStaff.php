<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "add_staff".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property string $dob
 * @property string $gender
 * @property string $date_of_joining
 * @property string $qualification
 * @property string $image
 * @property string $co_ordinator_id
 * @property string $school_id
 * @property string $created
 * @property string $updated
 * @property string $phone_number
 * @property string $blood_group
 * @property string $address
 * @property string $emergency_contact
 * @property string $specializatin
 * @property string $status
 * @property string $last_updated_by
 */
class CordinatorStaff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['fname', 'lname', 'dob', 'gender', 'date_of_joining', 'qualification', 'image', 'co_ordinator_id', 'school_id', 'created', 'updated', 'phone_number', 'blood_group', 'address', 'emergency_contact', 'specializatin', 'status', 'last_updated_by'], 'string'],
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
            'fname' => 'Fname',
            'lname' => 'Lname',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'date_of_joining' => 'Date Of Joining',
            'qualification' => 'Qualification',
            'image' => 'Image',
            'co_ordinator_id' => 'Co Ordinator ID',
            'school_id' => 'School ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'phone_number' => 'Phone Number',
            'blood_group' => 'Blood Group',
            'address' => 'Address',
            'emergency_contact' => 'Emergency Contact',
            'specializatin' => 'Specializatin',
            'status' => 'Status',
            'last_updated_by' => 'Last Updated By',
        ];
    }
}
