<?php

namespace app\models;

use Yii;

class Teacher extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'teacher';
    }

    public function rules()
    {
        return [
            [['teacher_id', 'title_id', 'fname', 'lname', 'faculty_id', 'major_id', 'phone'], 'required'],
            [['teacher_id'], 'string', 'max' => 13],
            [['title_id'], 'string', 'max' => 2],
            [['fname', 'lname'], 'string', 'max' => 20],
            [['faculty_id', 'major_id'], 'string', 'max' => 1],
            [['phone'], 'string', 'max' => 10],
            [['teacher_id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Teacher ID',
            'title_id' => 'Title ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'faculty_id' => 'Faculty ID',
            'major_id' => 'Major ID',
            'phone' => 'Phone',
        ];
    }
}
