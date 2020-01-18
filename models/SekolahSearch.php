<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sekolah;

/**
 * SekolahSearch represents the model behind the search form of `app\models\Sekolah`.
 */
class SekolahSearch extends Sekolah
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sekolah', 'id_jenis_sekolah', 'id_status_milik', 'id_kabupaten', 'id_propinsi'], 'integer'],
            [['nama_sekolah', 'nama_sekolah_singkat', 'alias1', 'alias2', 'alias3', 'alamat1', 'alamat2', 'alamat3', 'website', 'medsos1', 'medsos2', 'medsos3', 'medsos4', 'medsos5', 'description1', 'description2', 'description3', 'description4', 'description5'], 'safe'],
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
        $query = Sekolah::find();

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
            'id_sekolah' => $this->id_sekolah,
            'id_jenis_sekolah' => $this->id_jenis_sekolah,
            'id_status_milik' => $this->id_status_milik,
            'id_kabupaten' => $this->id_kabupaten,
            'id_propinsi' => $this->id_propinsi,
        ]);

        $query->andFilterWhere(['like', 'nama_sekolah', $this->nama_sekolah])
            ->andFilterWhere(['like', 'nama_sekolah_singkat', $this->nama_sekolah_singkat])
            ->andFilterWhere(['like', 'alias1', $this->alias1])
            ->andFilterWhere(['like', 'alias2', $this->alias2])
            ->andFilterWhere(['like', 'alias3', $this->alias3])
            ->andFilterWhere(['like', 'alamat1', $this->alamat1])
            ->andFilterWhere(['like', 'alamat2', $this->alamat2])
            ->andFilterWhere(['like', 'alamat3', $this->alamat3])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'medsos1', $this->medsos1])
            ->andFilterWhere(['like', 'medsos2', $this->medsos2])
            ->andFilterWhere(['like', 'medsos3', $this->medsos3])
            ->andFilterWhere(['like', 'medsos4', $this->medsos4])
            ->andFilterWhere(['like', 'medsos5', $this->medsos5])
            ->andFilterWhere(['like', 'description1', $this->description1])
            ->andFilterWhere(['like', 'description2', $this->description2])
            ->andFilterWhere(['like', 'description3', $this->description3])
            ->andFilterWhere(['like', 'description4', $this->description4])
            ->andFilterWhere(['like', 'description5', $this->description5]);

        return $dataProvider;
    }
}
