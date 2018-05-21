<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property string $stu_id รหัสนักศึกษา
 * @property string $title_id รหัสคำนำหน้าชื่อ
 * @property string $fname ชื่อ
 * @property string $lname สกุล
 * @property string $nickname ชื่อเล่น
 * @property string $faculty_id รหัสคณะ
 * @property string $major_id รหัสสาขา
 * @property string $phone เบอร์โทร
 * @property string $birthdate ว/ด/ป เกิด
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stu_id', 'title_id', 'fname', 'lname', 'nickname', 'faculty_id', 'major_id', 'phone', 'birthdate'], 'required'],
            [['birthdate'], 'safe'],
            [['stu_id'], 'string', 'max' => 12],
            [['title_id'], 'string', 'max' => 2],
            [['fname', 'lname'], 'string', 'max' => 20],
            [['nickname', 'phone'], 'string', 'max' => 10],
            [['faculty_id', 'major_id'], 'string', 'max' => 1],
            [['stu_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stu_id' => 'Stu ID',
            'title_id' => 'Title ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'nickname' => 'Nickname',
            'faculty_id' => 'Faculty ID',
            'major_id' => 'Major ID',
            'phone' => 'Phone',
            'birthdate' => 'Birthdate',
        ];
    }
}
