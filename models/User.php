<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'status'], 'required'],
            [['status'], 'integer'],
            [['username'], 'string', 'max' => 13],
            [['password'], 'string', 'max' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'status' => 'Status',
        ];
    }
}
