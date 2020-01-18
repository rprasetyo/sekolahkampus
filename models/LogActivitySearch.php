<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LogActivity;

/**
 * LogActivitySearch represents the model behind the search form of `app\models\LogActivity`.
 */
class LogActivitySearch extends LogActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_log_activity', 'related_id', 'id_mst_log_activity', 'userid'], 'integer'],
            [['log_date', 'log_datetime', 'tablename', 'ip_address_user', 'additional_info1', 'additional_info2', 'additional_info3'], 'safe'],
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
        $query = LogActivity::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['log_datetime' => SORT_DESC]]

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_log_activity' => $this->id_log_activity,
            'log_date' => $this->log_date,
            'log_datetime' => $this->log_datetime,
            'related_id' => $this->related_id,
            'id_mst_log_activity' => $this->id_mst_log_activity,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'tablename', $this->tablename])
            ->andFilterWhere(['like', 'ip_address_user', $this->ip_address_user])
            ->andFilterWhere(['like', 'additional_info1', $this->additional_info1])
            ->andFilterWhere(['like', 'additional_info2', $this->additional_info2])
            ->andFilterWhere(['like', 'additional_info3', $this->additional_info3]);

        return $dataProvider;
    }
}
