<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConsultantsClub;

/**
 * ConsultantsClubSearch represents the model behind the search form of `app\models\ConsultantsClub`.
 */
class ConsultantsClubSearch extends ConsultantsClub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consultants_id'], 'integer'],
            [['teacher_id', 'club_id'], 'safe'],
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
    public function search($params, $club_id)
    {
        $query = ConsultantsClub::find()
                ->where(['club_id' => $club_id ]);

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
            'consultants_id' => $this->consultants_id,
        ]);

        $query->andFilterWhere(['like', 'teacher_id', $this->teacher_id]);
      //      ->andFilterWhere(['like', 'club_id', $this->club_id]);

        return $dataProvider;
    }
}
