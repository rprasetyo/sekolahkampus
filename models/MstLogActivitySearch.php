<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MstLogActivity;

/**
 * MstLogActivitySearch represents the model behind the search form of `app\models\MstLogActivity`.
 */
class MstLogActivitySearch extends MstLogActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mst_log_activity'], 'integer'],
            [['activity', 'notes'], 'safe'],
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
        $query = MstLogActivity::find();

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
            'id_mst_log_activity' => $this->id_mst_log_activity,
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
