<?php

namespace app\models;

use Yii;

class Activities extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'activities';
    }

    public function rules()
    {
        return [
            [['activities_name', 'description', 'date'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['club_id'], 'integer'],
            [['activities_name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'activities_id' => 'รหัสกิจกรรม',
            'activities_name' => 'ชื่อกิจกรรม',
            'description' => 'รายละเอียดกิจกรรม',
            'date' => 'วันที่จัดกิจกรรม',
            'club_id' => 'รหัสชมรม',
        ];
    }
}
