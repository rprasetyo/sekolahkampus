<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kabupaten;

/**
 * KabupatenSearch represents the model behind the search form of `app\models\Kabupaten`.
 */
class KabupatenSearch extends Kabupaten
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kabupaten', 'id_propinsi'], 'integer'],
            [['nama_kabupaten'], 'safe'],
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
        $query = Kabupaten::find();

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
            'id_kabupaten' => $this->id_kabupaten,
            'id_propinsi' => $this->id_propinsi,
        ]);

        $query->andFilterWhere(['like', 'nama_kabupaten', $this->nama_kabupaten]);

        return $dataProvider;
    }
}
