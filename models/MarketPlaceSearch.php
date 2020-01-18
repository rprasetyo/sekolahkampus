<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MarketPlace;

/**
 * MarketPlaceSearch represents the model behind the search form of `app\models\MarketPlace`.
 */
class MarketPlaceSearch extends MarketPlace
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_marketplace'], 'integer'],
            [['marketplace_name', 'url_address', 'status'], 'safe'],
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
        $query = MarketPlace::find();

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
            'id_marketplace' => $this->id_marketplace,
        ]);

        $query->andFilterWhere(['like', 'marketplace_name', $this->marketplace_name])
            ->andFilterWhere(['like', 'url_address', $this->url_address])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
