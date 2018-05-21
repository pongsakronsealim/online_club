<?php

namespace app\models;

use Yii;

class FoundedClub extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'founded_club';
    }

    public function rules()
    {
        return [
            [['club_name', 'founded_club_type', 'type_id', 
                'formality', 'objective', 'place', 'how_the','banner'], 'required'],
            [['formality', 'objective', 'how_the'], 'string'],
            [['club_name'], 'string', 'max' => 100],
            [['founded_club_type'], 'string', 'max' => 1],
            [['type_id'], 'string', 'max' => 2],
            [['place'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'club_id' => 'รหัสชมรม',
            'club_name' => 'ชื่อชมรม',
            'founded_club_type' => 'ประเภทชมรม',
            'type_id' => 'ประเภทชมรม',
            'formality' => 'หลักการและเหตุผล',
            'objective' => 'วัตถุประสงค์การตั้งชมรม',
            'place' => 'สถานที่ตั้งชมรม',
            'how_the' => 'วิธีดำเนินงาน',
            'banner' => 'แบนเนอร์ชมรม'
        ];
    }

    public function getTypeClub() {
      return $this->hasOne(
        TypeClub::className(),['type_id'=>'type_id']
      );
    }
}
