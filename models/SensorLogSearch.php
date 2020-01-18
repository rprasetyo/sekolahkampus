<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SensorLog;

/**
 * SensorLogSearch represents the model behind the search form of `app\models\SensorLog`.
 */
class SensorLogSearch extends SensorLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sensor_log', 'id_sensor'], 'integer'],
            [['log_date'], 'safe'],
            [['value1', 'value2', 'value3', 'value4', 'value5'], 'number'],
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
        $query = SensorLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['log_time'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_sensor_log' => $this->id_sensor_log,
            'id_sensor' => $this->id_sensor,
            'log_time' => $this->log_time,
            'log_date' => $this->log_date,
            'value1' => $this->value1,
            'value2' => $this->value2,
            'value3' => $this->value3,
            'value4' => $this->value4,
            'value5' => $this->value5,
        ]);

        return $dataProvider;
    }
}
