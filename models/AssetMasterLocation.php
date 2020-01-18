<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asset_master_location".
 *
 * @property int $id_asset_master_location
 * @property int $id_asset_master
 * @property string $latitude
 * @property string $longitude
 * @property string $address
 * @property string $desa
 * @property string $kecamatan
 * @property string $kabupaten
 * @property string $provinsi
 * @property string $kodepos
 */
class AssetMasterLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_master_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master', 'latitude', 'longitude', 'address', 'kodepos'], 'required'],
            [['id_asset_master'], 'integer'],
            [['latitude', 'longitude'], 'string', 'max' => 60],
            [['address', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_master_location' => 'Id Asset Master Location',
            'id_asset_master' => 'Asset Master',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address',
            'desa' => 'Desa',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
            'kodepos' => 'Kodepos',
        ];
    }

    public function getAssetMaster()
    {
        return $this->hasOne(AssetMaster::className(), ['id_asset_master' => 'id_asset_master']);
    }
}
