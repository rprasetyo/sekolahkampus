<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KamusPetunjuk;

/**
 * KamusPetunjukSearch represents the model behind the search form of `app\models\KamusPetunjuk`.
 */
class KamusPetunjukSearch extends KamusPetunjuk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kamus_petunjuk', 'is_visible'], 'integer'],
            [['nama', 'deskripsi'], 'safe'],
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
        $query = KamusPetunjuk::find();

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
            'id_kamus_petunjuk' => $this->id_kamus_petunjuk,
            'is_visible' => $this->is_visible,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
