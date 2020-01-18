<?php

namespace app\models;

/**
 * This is the model class for table "asset_master".
 *
 * @property int $id_asset_master
 * @property string $asset_name
 * @property int $id_asset_code
 * @property string $asset_code
 * @property int $id_type_asset1
 * @property int $id_type_asset2
 * @property int $id_type_asset3
 * @property int $id_type_asset4
 * @property int $id_type_asset5
 * @property string $attribute1
 * @property string $attribute2
 * @property string $attribute3
 * @property string $attribute4
 * @property string $attribute5
 */
class AssetMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
		$ruleslist = AppFieldConfigSearch::getRules(AssetMaster::tableName());
		
		//jika mau menambah atturan sendiri
		/*
		$ruleslist[] = [['id_type_asset2', 'id_type_asset3'], 'required'];
		$ruleslist[] = [['attribute1'], 'string', 'max' => 1];
		*/
		return $ruleslist;
		
		/*
        return [
            [['asset_name', 'asset_code'], 'required'],
            [['id_asset_code', 'id_type_asset1', 'id_type_asset2', 'id_type_asset3', 'id_type_asset4', 'id_type_asset5'], 'integer'],
            [['asset_name', 'attribute1', 'attribute2', 'attribute3', 'attribute4', 'attribute5'], 'string', 'max' => 250],
            [['asset_code'], 'string', 'max' => 150],
        ];
		*/
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
		$labelArray = AppFieldConfigSearch::getLabels(AssetMaster::tableName());
		
		//Jika Mau Menambahkan Sendiri manual
		/*
		$labelArray['id_type_asset2'] = "Label Test 2";
		$labelArray['id_type_asset3'] = "Label Test 3";
		*/
		return $labelArray;
		
		//Ini yang hardcode dimatikan
		/*
        return [
            'id_asset_master' => 'Id Asset Master',
            'asset_name' => 'Nama Barang',
            'id_asset_code' => 'Id Asset Code',
            'asset_code' => 'Kode Barang',
            'id_type_asset1' => 'Jenis Aset',
            'id_type_asset2' => 'Type Asset  2',
            'id_type_asset3' => 'Type Asset  3',
            'id_type_asset4' => 'Type Asset  4',
            'id_type_asset5' => 'Type Asset  5',
            'attribute1' => 'Attribute  1',
            'attribute2' => 'Attribute  2',
            'attribute3' => 'Attribute  3',
            'attribute4' => 'Attribute  4',
            'attribute5' => 'Attribute  5',
        ];
		*/
    }

    public function getTypeAsset1()
    {
        return $this->hasOne(TypeAsset1::className(), ['id_type_asset' => 'id_type_asset1']);
    }

    public function getTypeAsset2()
    {
        return $this->hasOne(TypeAsset2::className(), ['id_type_asset' => 'id_type_asset2']);
    }

    public function getTypeAsset3()
    {
        return $this->hasOne(TypeAsset3::className(), ['id_type_asset' => 'id_type_asset3']);
    }

    public function getTypeAsset4()
    {
        return $this->hasOne(TypeAsset4::className(), ['id_type_asset' => 'id_type_asset4']);
    }

    public function getTypeAsset5()
    {
        return $this->hasOne(TypeAsset5::className(), ['id_type_asset' => 'id_type_asset5']);
    }

    public function getAssetCode()
    {
        return $this->hasOne(AssetCode::className(), ['id_asset_code' => 'id_asset_code']);
    }
}
