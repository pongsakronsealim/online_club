<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MemberClub;

class MemberClubSearch extends MemberClub
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['std_id', 'position', 'club_id', 'status_club'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $club_id)
    {
        $query = MemberClub::find()
                ->where(['club_id' => $club_id ]);;

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'std_id', $this->std_id])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'club_id', $this->club_id])
            ->andFilterWhere(['like', 'status_club', $this->status_club]);

        return $dataProvider;
    }
}
