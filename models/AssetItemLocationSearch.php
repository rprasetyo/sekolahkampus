<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssetItemLocation;

/**
 * AssetItemLocationSearch represents the model behind the search form of `app\models\AssetItemLocation`.
 */
class AssetItemLocationSearch extends AssetItemLocation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_item_location', 'id_asset_master', 'id_kabupaten', 'id_propinsi', 'id_kecamatan', 'id_kelurahan'], 'integer'],
            [['latitude', 'longitude', 'address', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos'], 'safe'],
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
        $query = AssetItemLocation::find();

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
            'id_asset_item_location' => $this->id_asset_item_location,
            'id_asset_master' => $this->id_asset_master,
            'id_kabupaten' => $this->id_kabupaten,
            'id_propinsi' => $this->id_propinsi,
            'id_kecamatan' => $this->id_kecamatan,
            'id_kelurahan' => $this->id_kelurahan,
        ]);

        $query->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'desa', $this->desa])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'kabupaten', $this->kabupaten])
            ->andFilterWhere(['like', 'provinsi', $this->provinsi])
            ->andFilterWhere(['like', 'kodepos', $this->kodepos]);

        return $dataProvider;
    }
}
