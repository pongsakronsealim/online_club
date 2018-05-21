<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activities;

/**
 * ActivitiesSearch represents the model behind the search form of `app\models\Activities`.
 */
class ActivitiesSearch extends Activities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activities_id', 'club_id'], 'integer'],
            [['activities_name', 'description', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $prmClubID)
    {
        $query = Activities::find()
                  ->Where(['club_id' => $prmClubID]);

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
            'activities_id' => $this->activities_id,
            'date' => $this->date,
            'club_id' => $this->club_id,
        ]);

        $query->andFilterWhere(['like', 'activities_name', $this->activities_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
