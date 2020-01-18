<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asset_item_location".
 *
 * @property int $id_asset_item_location
 * @property int $id_asset_master
 * @property string $latitude
 * @property string $longitude
 * @property string $address
 * @property string $desa
 * @property string $kecamatan
 * @property string $kabupaten
 * @property string $provinsi
 * @property string $kodepos
 * @property int $id_kabupaten
 * @property int $id_propinsi
 * @property int $id_kecamatan
 * @property int $id_kelurahan
 */
class AssetItemLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_item_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master', 'latitude', 'longitude', 'luas'], 'required'],
            [['id_asset_master', 'id_kabupaten', 'id_propinsi', 'id_kecamatan', 'id_kelurahan'], 'integer'],
            [['luas'], 'number'],
            [['latitude', 'longitude'], 'string', 'max' => 60],
            [['latitude', 'longitude'], 'match', 'pattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/', 'message' => 'Silakan masukkan dalam angka dan titik saja!'],
            [['address', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos'], 'string', 'max' => 250],
			[['batas_utara', 'batas_selatan', 'batas_barat', 'batas_timur', 'keterangan1'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_item_location' => 'Id Asset Item Location',
            'id_asset_master' => 'Asset Name',
            'latitude' => 'S',
            'longitude' => 'T',
            'address' => 'Lokasi',
            'desa' => 'Desa',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
            'kodepos' => 'Kodepos',
            'id_kabupaten' => 'Nama Kabupaten',
            'id_propinsi' => 'Nama Propinsi',
            'id_kecamatan' => 'Nama Kecamatan',
            'id_kelurahan' => 'Nama Kelurahan',
			'batas_utara' => 'Batas Utara',
			'batas_selatan' => 'Batas Selatan',
			'batas_barat' => 'Batas Barat',
			'batas_timur' => 'Batas Timur',
			'luas' => 'Luasan',
			'keterangan1' => 'Bukti Kepemilikan',
        ];
    }

    public function getAssetMaster()
    {
        return $this->hasOne(AssetMaster::className(), ['id_asset_master' => 'id_asset_master']);
    }

    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kelurahan' => 'id_kelurahan']);
    }

    public function getPropinsi()
    {
        return $this->hasOne(Propinsi::className(), ['id_propinsi' => 'id_propinsi']);
    }

    public function getKabupatenOne()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kabupaten' => 'id_kabupaten']);
    }

    public function getKecamatanOne()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kecamatan' => 'id_kecamatan']);
    }
}
