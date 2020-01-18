<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SensorWarningParameter;

/**
 * SensorWarningParameterSearch represents the model behind the search form of `app\models\SensorWarningParameter`.
 */
class SensorWarningParameterSearch extends SensorWarningParameter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sensor_warning_parameter', 'parameter_number', 'need_warning'], 'integer'],
            [['label', 'color_label', 'description'], 'safe'],
            [['batas_bawah', 'batas_atas'], 'number'],
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
        $query = SensorWarningParameter::find();

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
            'id_sensor_warning_parameter' => $this->id_sensor_warning_parameter,
            'parameter_number' => $this->parameter_number,
            'batas_bawah' => $this->batas_bawah,
            'batas_atas' => $this->batas_atas,
            'need_warning' => $this->need_warning,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'color_label', $this->color_label])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
