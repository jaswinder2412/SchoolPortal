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
class newStaffdata extends \yii\db\ActiveRecord
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
            [['dob', 'gender', 'date_of_joining', 'qualification', 'image', 'co_ordinator_id', 'school_id', 'created', 'updated', 'blood_group', 'address', 'emergency_contact', 'specializatin', 'status', 'last_updated_by'], 'string','max' => 500],
			[['fname', 'lname', 'status'],'required'],
			[['fname', 'lname', 'status'],'string','max' => 50],
			[['phone_number','emergency_contact',],'match', 'pattern'=>'/^[0-9]+([- +()0-9]+)+$/','message'=>"Phone Number should be numbers."],
			
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
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'dob' => 'Date of Birth',
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
			'status' => 'status',
			'last_updated_by' => 'Last Updated By',
        ];
    }
}
