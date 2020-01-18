<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sensor;

/**
 * SensorSearch represents the model behind the search form of `app\models\Sensor`.
 */
class SensorSearch extends Sensor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sensor', 'id_marketplace', 'sensor_digital1', 'sensor_digital2', 'sensor_digital3', 'sensor_digital4', 'sensor_digital5', 'sensor_digital6', 'last_user_update', 'token', 'flag_new_changes', 'flag_ack_devices'], 'integer'],
            [['sensor_name', 'description', 'imei', 'cid', 'barcode1', 'last_update', 'last_update_ip_address'], 'safe'],
            [['sensor_analog1', 'sensor_analog2', 'sensor_analog3', 'sensor_analog4', 'sensor_analog5', 'sensor_analog6'], 'number'],
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
        $query = Sensor::find();

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
            'id_sensor' => $this->id_sensor,
            'id_marketplace' => $this->id_marketplace,
            'sensor_analog1' => $this->sensor_analog1,
            'sensor_analog2' => $this->sensor_analog2,
            'sensor_analog3' => $this->sensor_analog3,
            'sensor_analog4' => $this->sensor_analog4,
            'sensor_analog5' => $this->sensor_analog5,
            'sensor_analog6' => $this->sensor_analog6,
            'sensor_digital1' => $this->sensor_digital1,
            'sensor_digital2' => $this->sensor_digital2,
            'sensor_digital3' => $this->sensor_digital3,
            'sensor_digital4' => $this->sensor_digital4,
            'sensor_digital5' => $this->sensor_digital5,
            'sensor_digital6' => $this->sensor_digital6,
            'last_update' => $this->last_update,
            'last_user_update' => $this->last_user_update,
            'token' => $this->token,
            'flag_new_changes' => $this->flag_new_changes,
            'flag_ack_devices' => $this->flag_ack_devices,
        ]);

        $query->andFilterWhere(['like', 'sensor_name', $this->sensor_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'imei', $this->imei])
            ->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'barcode1', $this->barcode1])
            ->andFilterWhere(['like', 'last_update_ip_address', $this->last_update_ip_address]);

        return $dataProvider;
    }
}
