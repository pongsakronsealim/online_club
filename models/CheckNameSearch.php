<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CheckName;

class CheckNameSearch extends CheckName
{
    public function rules()
    {
        return [
            [['check_id', 'activities_id', 'member_id', 'status'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CheckName::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'check_id' => $this->check_id,
            'activities_id' => $this->activities_id,
            'member_id' => $this->member_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
