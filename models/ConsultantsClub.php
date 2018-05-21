<?php

namespace app\models;

use Yii;

class ConsultantsClub extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'consultants_club';
    }

    public function rules()
    {
        return [
            [['teacher_id'], 'string', 'max' => 13],
            [['club_id'], 'string', 'max' => 8],
        ];
    }

    public function attributeLabels()
    {
        return [
            'consultants_id' => 'รหัส',
            'teacher_id' => 'ชื่ออาจารย์',
            'club_id' => 'รหัสชมรม',
        ];
    }
}
