<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StatusMilik;

/**
 * StatusMilikSearch represents the model behind the search form of `app\models\StatusMilik`.
 */
class StatusMilikSearch extends StatusMilik
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_status_milik'], 'integer'],
            [['status_milik', 'keterangan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = StatusMilik::find();

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
            'id_status_milik' => $this->id_status_milik,
        ]);

        $query->andFilterWhere(['like', 'status_milik', $this->status_milik])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
