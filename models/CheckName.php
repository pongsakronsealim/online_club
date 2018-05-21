<?php

namespace app\models;

use Yii;

class CheckName extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'check_name';
    }

    public function rules()
    {
        return [
            [['activities_id'], 'required'],
            [['activities_id', 'member_id', 'status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'check_id' => 'รหัส',
            'activities_id' => 'ชื่อกิจกรรม',
            'member_id' => 'รหัสสมาชิกชมรม',
            'status' => 'สถานะ',
        ];
    }
}
