<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kecamatan".
 *
 * @property int $id_kecamatan
 * @property int $id_kabupaten
 * @property string $nama_kecamatan
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kabupaten', 'nama_kecamatan'], 'required'],
            [['id_kabupaten'], 'integer'],
            [['nama_kecamatan'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kecamatan' => 'Id Kecamatan',
            'id_kabupaten' => 'Nama Kabupaten',
            'nama_kecamatan' => 'Nama Kecamatan',
        ];
    }

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kabupaten' => 'id_kabupaten']);
    }
}
