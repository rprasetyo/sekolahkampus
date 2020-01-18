<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sekolah".
 *
 * @property int $id_sekolah
 * @property string $nama_sekolah
 * @property string $nama_sekolah_singkat
 * @property string $alias1
 * @property string $alias2
 * @property string $alias3
 * @property int $id_jenis_sekolah
 * @property int $id_status_milik
 * @property string $alamat1
 * @property string $alamat2
 * @property string $alamat3
 * @property string $latitude
 * @property string $longitude
 * @property int $id_kabupaten
 * @property int $id_propinsi
 * @property string $website
 * @property string $medsos1
 * @property string $medsos2
 * @property string $medsos3
 * @property string $medsos4
 * @property string $medsos5
 * @property string $description1
 * @property string $description2
 * @property string $description3
 * @property string $description4
 * @property string $description5
 */
class Sekolah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sekolah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_sekolah', 'id_jenis_sekolah', 'id_status_milik', 'alamat1', 'id_kabupaten', 'id_propinsi', 'latitude', 'longitude'], 'required'],
            [['id_jenis_sekolah', 'id_status_milik', 'id_kabupaten', 'id_propinsi'], 'integer'],
            [['description1', 'description2', 'description3', 'description4', 'description5', 'latitude', 'longitude'], 'string'],
            [['nama_sekolah', 'alamat1', 'alamat2', 'alamat3', 'website', 'medsos1', 'medsos2', 'medsos3', 'medsos4', 'medsos5'], 'string', 'max' => 250],
            [['nama_sekolah_singkat'], 'string', 'max' => 80],
            [['alias1', 'alias2', 'alias3'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sekolah' => Yii::t('app', 'Id Sekolah'),
            'nama_sekolah' => Yii::t('app', 'Nama Sekolah'),
            'nama_sekolah_singkat' => Yii::t('app', 'Nama Sekolah Singkat'),
            'alias1' => Yii::t('app', 'Alias1'),
            'alias2' => Yii::t('app', 'Alias2'),
            'alias3' => Yii::t('app', 'Alias3'),
            'id_jenis_sekolah' => Yii::t('app', 'Jenis Sekolah'),
            'id_status_milik' => Yii::t('app', 'Status Milik'),
            'alamat1' => Yii::t('app', 'Alamat1'),
            'alamat2' => Yii::t('app', 'Alamat2'),
            'alamat3' => Yii::t('app', 'Alamat3'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'id_propinsi' => Yii::t('app', 'Propinsi'),
            'id_kabupaten' => Yii::t('app', 'Kabupaten'),
            'website' => Yii::t('app', 'Website'),
            'medsos1' => Yii::t('app', 'Medsos1'),
            'medsos2' => Yii::t('app', 'Medsos2'),
            'medsos3' => Yii::t('app', 'Medsos3'),
            'medsos4' => Yii::t('app', 'Medsos4'),
            'medsos5' => Yii::t('app', 'Medsos5'),
            'description1' => Yii::t('app', 'Description1'),
            'description2' => Yii::t('app', 'Description2'),
            'description3' => Yii::t('app', 'Description3'),
            'description4' => Yii::t('app', 'Description4'),
            'description5' => Yii::t('app', 'Description5'),
        ];
    }

    public function getJenisSekolah()
    {
        return $this->hasOne(JenisSekolah::className(), ['id_jenis_sekolah' => 'id_jenis_sekolah']);
    }

    public function getStatusMilik()
    {
        return $this->hasOne(StatusMilik::className(), ['id_status_milik' => 'id_status_milik']);
    }

    public function getPropinsi()
    {
        return $this->hasOne(Propinsi::className(), ['id_propinsi' => 'id_propinsi']);
    }

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kabupaten' => 'id_kabupaten']);
    }
}
