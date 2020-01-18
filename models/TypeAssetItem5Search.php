<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TypeAssetItem5;

/**
 * TypeAssetItem5Search represents the model behind the search form of `app\models\TypeAssetItem5`.
 */
class TypeAssetItem5Search extends TypeAssetItem5
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_type_asset_item', 'is_active'], 'integer'],
            [['type_asset_item', 'description'], 'safe'],
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
        $query = TypeAssetItem5::find();

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
            'id_type_asset_item' => $this->id_type_asset_item,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'type_asset_item', $this->type_asset_item])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
