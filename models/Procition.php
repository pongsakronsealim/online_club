<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procition".
 *
 * @property int $procition_id รหัสตำแหน่ง
 * @property string $procition_name ชื่อตำแหน่ง
 * @property int $number จำนวนตำแหน่ง
 */
class Procition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'procition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['procition_name', 'number'], 'required'],
            [['number'], 'integer'],
            [['procition_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'procition_id' => 'Procition ID',
            'procition_name' => 'Procition Name',
            'number' => 'Number',
        ];
    }
}
