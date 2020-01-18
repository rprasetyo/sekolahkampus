<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssetMaster;

/**
 * AssetMasterSearch represents the model behind the search form of `app\models\AssetMaster`.
 */
class AssetMasterSearch extends AssetMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master', 'id_asset_code', 'id_type_asset1', 'id_type_asset2', 'id_type_asset3', 'id_type_asset4', 'id_type_asset5'], 'integer'],
            [['asset_name', 'asset_code', 'attribute1', 'attribute2', 'attribute3', 'attribute4', 'attribute5'], 'safe'],
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
        $query = AssetMaster::find();

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
            'id_asset_master' => $this->id_asset_master,
            'id_asset_code' => $this->id_asset_code,
            'id_type_asset1' => $this->id_type_asset1,
            'id_type_asset2' => $this->id_type_asset2,
            'id_type_asset3' => $this->id_type_asset3,
            'id_type_asset4' => $this->id_type_asset4,
            'id_type_asset5' => $this->id_type_asset5,
        ]);

        $query->andFilterWhere(['like', 'asset_name', $this->asset_name])
            ->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'attribute1', $this->attribute1])
            ->andFilterWhere(['like', 'attribute2', $this->attribute2])
            ->andFilterWhere(['like', 'attribute3', $this->attribute3])
            ->andFilterWhere(['like', 'attribute4', $this->attribute4])
            ->andFilterWhere(['like', 'attribute5', $this->attribute5]);

        return $dataProvider;
    }
}
