<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_club".
 *
 * @property string $club_name ชื่อชมรม
 * @property string $founded_club_type ประเภทชมรมที่ก่อตั้งใหม่หรือชมรมที่เคยก่อตั้งแล้ว
 * @property string $type_name
 * @property string $name
 * @property string $stu_id รหัสนักศึกษา
 * @property string $major_name ชื่อสาขา
 * @property string $faculty_name ชื่อคณะ
 * @property string $phone เบอร์โทร
 * @property string $formality หลักการและเหตุผล
 * @property string $objective วัตถุประสงค์การตั้งชมรม
 * @property string $how_the วิธีดำเนินงาน
 * @property string $place สถานที่ตั้งชมรม
 */
class VClub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_club';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formality', 'objective', 'how_the'], 'string'],
            [['club_name'], 'string', 'max' => 100],
            [['founded_club_type'], 'string', 'max' => 1],
            [['type_name', 'place'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 61],
            [['stu_id'], 'string', 'max' => 12],
            [['major_name'], 'string', 'max' => 20],
            [['faculty_name'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'club_name' => 'Club Name',
            'founded_club_type' => 'Founded Club Type',
            'type_name' => 'Type Name',
            'name' => 'Name',
            'stu_id' => 'Stu ID',
            'major_name' => 'Major Name',
            'faculty_name' => 'Faculty Name',
            'phone' => 'Phone',
            'formality' => 'Formality',
            'objective' => 'Objective',
            'how_the' => 'How The',
            'place' => 'Place',
        ];
    }
}
