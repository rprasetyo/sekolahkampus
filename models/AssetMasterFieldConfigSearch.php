<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssetMasterFieldConfig;

/**
 * AssetMasterFieldConfigSearch represents the model behind the search form of `app\models\AssetMasterFieldConfig`.
 */
class AssetMasterFieldConfigSearch extends AssetMasterFieldConfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master_field_config', 'is_visible', 'is_required', 'type_field'], 'integer'],
            [['fieldname', 'label'], 'safe'],
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
        $query = AssetMasterFieldConfig::find();

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
            'id_asset_master_field_config' => $this->id_asset_master_field_config,
            'is_visible' => $this->is_visible,
            'is_required' => $this->is_required,
            'type_field' => $this->type_field,
        ]);

        $query->andFilterWhere(['like', 'fieldname', $this->fieldname])
            ->andFilterWhere(['like', 'label', $this->label]);

        return $dataProvider;
    }
}
