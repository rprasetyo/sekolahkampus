<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SensorAlert;

/**
 * SensorAlertSearch represents the model behind the search form of `app\models\SensorAlert`.
 */
class SensorAlertSearch extends SensorAlert
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sensor_alert', 'id_sensor', 'channel_number', 'is_case_open'], 'integer'],
            [['channel', 'first_appereance_time', 'last_appreance_time', 'alert_message'], 'safe'],
            [['first_appereance_value', 'last_appreance_value'], 'number'],
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
        $query = SensorAlert::find();

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
            'id_sensor_alert' => $this->id_sensor_alert,
            'id_sensor' => $this->id_sensor,
            'channel_number' => $this->channel_number,
            'first_appereance_time' => $this->first_appereance_time,
            'first_appereance_value' => $this->first_appereance_value,
            'last_appreance_time' => $this->last_appreance_time,
            'last_appreance_value' => $this->last_appreance_value,
            'is_case_open' => $this->is_case_open,
        ]);

        $query->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'alert_message', $this->alert_message]);

        return $dataProvider;
    }
}
