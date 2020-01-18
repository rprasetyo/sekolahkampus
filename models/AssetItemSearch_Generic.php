<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssetItem_Generic;

/**
 * AssetItemSearch_Generic represents the model behind the search form of `app\models\AssetItem`.
 */
class AssetItemSearch_Generic extends AssetItem_Generic
{
    public $id_kelurahan;
    public $id_kecamatan;
    public $id_kabupaten;
    public $bukti_kepemilikan;
    
	function __construct($config = [])
	{
		//echo count($config)."Before<br>";
		parent::__construct($config);
		//echo count($config)."After<br>";
		//echo $this->varian_group."Value After<br>";
	}
	
	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_item', 'id_asset_master', 'id_asset_received', 'id_asset_item_location',
                'id_type_asset_item1', 'id_type_asset_item2', 'id_type_asset_item3', 'id_type_asset_item4',
                'id_type_asset_item5'], 'integer'],
            [['number1', 'number2', 'number3', 'picture1', 'picture2', 'picture3', 'id_kabupaten', 'id_kecamatan', 'id_kelurahan', 'bukti_kepemilikan'], 'safe'],
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
    public function search($params, $config="")
    {
		//$mod = new AssetItem_Generic();
		//$query = $mod->find();
        $query = AssetItem_Generic::find();

        $query->joinWith('assetItemLocation');

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
            'id_asset_item' => $this->id_asset_item,
            'asset_item.id_asset_master' => $this->id_asset_master,
			'asset_item.id_asset_item_parent' => $this->id_asset_item_parent,
            'id_asset_received' => $this->id_asset_received,
            'asset_item.id_asset_item_location' => $this->id_asset_item_location,
            'id_type_asset_item1' => $this->id_type_asset_item1,
            'id_type_asset_item2' => $this->id_type_asset_item2,
            'id_type_asset_item3' => $this->id_type_asset_item3,
            'id_type_asset_item4' => $this->id_type_asset_item4,
            'id_type_asset_item5' => $this->id_type_asset_item5,
        ]);

        $query->andFilterWhere(['like', 'number1', $this->number1])
            ->andFilterWhere(['like', 'number2', $this->number2])
            ->andFilterWhere(['like', 'number3', $this->number3])
            ->andFilterWhere(['like', 'picture1', $this->picture1])
            ->andFilterWhere(['like', 'picture2', $this->picture2])
            ->andFilterWhere(['like', 'picture3', $this->picture3])
            ->andFilterWhere(['like', 'label1', $this->label1])
            ->andFilterWhere(['like', 'label2', $this->label2])
            ->andFilterWhere(['like', 'label3', $this->label3])
            ->andFilterWhere(['like', 'label4', $this->label4])
            ->andFilterWhere(['like', 'label5', $this->label5])
            ->andFilterWhere(['like', 'asset_item_location.keterangan1', $this->bukti_kepemilikan])
            ->andFilterWhere(['like', 'asset_item_location.id_kelurahan', $this->id_kelurahan])
            ->andFilterWhere(['like', 'asset_item_location.id_kelurahan', $this->id_kelurahan])
            ->andFilterWhere(['like', 'asset_item_location.id_kecamatan', $this->id_kecamatan])
            ->andFilterWhere(['like', 'asset_item_location.id_kabupaten', $this->id_kabupaten]);

        return $dataProvider;
    }
}
