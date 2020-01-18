<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssetMasterStructure;

/**
 * AssetMasterStructureSearch represents the model behind the search form of `app\models\AssetMasterStructure`.
 */
class AssetMasterStructureSearch extends AssetMasterStructure
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master_structure', 'id_asset_master_parent', 'id_asset_master_child'], 'integer'],
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
//        $query = AssetMasterStructure::find()->groupBy('id_asset_master_parent');
         $query = AssetMasterStructure::find();

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
            'id_asset_master_structure' => $this->id_asset_master_structure,
            'id_asset_master_parent' => $this->id_asset_master_parent,
            'id_asset_master_child' => $this->id_asset_master_child,
        ]);

        return $dataProvider;
    }

    public function searchByAssetMAsterParent($params, $idAssetMasterParent)
    {
        $query = AssetMasterStructure::find()->where(['id_asset_master_parent' => $idAssetMasterParent]);

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
            'id_asset_master_structure' => $this->id_asset_master_structure,
            'id_asset_master_parent' => $this->id_asset_master_parent,
            'id_asset_master_child' => $this->id_asset_master_child,
        ]);

        return $dataProvider;
    }
}
