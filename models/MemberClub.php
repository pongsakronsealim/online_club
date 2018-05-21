<?php

namespace app\models;

use Yii;

class MemberClub extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'member_club';
    }

    public function rules()
    {
        return [
            /*[['std_id', 'position', 'club_id', 'status_club'], 'required'],
            [['std_id'], 'string', 'max' => 12],
            [['position', 'status_club'], 'string', 'max' => 1],
            [['club_id'], 'string', 'max' => 4],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'std_id' => 'รหัสนักศึกษา',
            'position' => 'ตำแหน่ง',
            'club_id' => 'รหัสชมรม',
            'status_club' => 'สถานะ',
        ];
    }
}
