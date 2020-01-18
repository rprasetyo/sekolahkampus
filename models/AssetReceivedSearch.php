<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssetReceived;

/**
 * AssetReceivedSearch represents the model behind the search form of `app\models\AssetReceived`.
 */
class AssetReceivedSearch extends AssetReceived
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_received', 'id_asset_master', 'received_year', 'quantity', 'id_status_received'], 'integer'],
            [['number1', 'number2', 'number3', 'received_date'], 'safe'],
            [['price_received'], 'number'],
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
        $query = AssetReceived::find();

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
            'id_asset_received' => $this->id_asset_received,
            'id_asset_master' => $this->id_asset_master,
            'received_date' => $this->received_date,
            'received_year' => $this->received_year,
            'price_received' => $this->price_received,
            'quantity' => $this->quantity,
            'id_status_received' => $this->id_status_received,
        ]);

        $query->andFilterWhere(['like', 'number1', $this->number1])
            ->andFilterWhere(['like', 'number2', $this->number2])
            ->andFilterWhere(['like', 'number3', $this->number3]);

        return $dataProvider;
    }
}
