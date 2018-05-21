<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoundedClub;

/**
 * FoundedClubSearch represents the model behind the search form of `app\models\FoundedClub`.
 */
class FoundedClubSearch extends FoundedClub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['club_id'], 'integer'],
            [['club_name', 'founded_club_type', 'type_id', 'formality', 'objective', 'place', 'how_the'], 'safe'],
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
    public function search($params)
    {
        $query = FoundedClub::find()
                 ->orderBy(['club_name' => SORT_ASC]);

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
            'club_id' => $this->club_id,
        ]);

        $query->andFilterWhere(['like', 'club_name', $this->club_name])
            ->andFilterWhere(['like', 'founded_club_type', $this->founded_club_type])
            ->andFilterWhere(['like', 'type_id', $this->type_id])
            ->andFilterWhere(['like', 'formality', $this->formality])
            ->andFilterWhere(['like', 'objective', $this->objective])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'how_the', $this->how_the]);

        return $dataProvider;
    }
}
