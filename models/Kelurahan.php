<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelurahan".
 *
 * @property int $id_kelurahan
 * @property int $id_kecamatan
 * @property string $nama_kelurahan
 * @property int $kodepos
 */
class Kelurahan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelurahan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $ruleslist = AppFieldConfigSearch::getRules(Kelurahan::tableName());

        return $ruleslist;
//        return [
//            [['id_kecamatan', 'nama_kelurahan'], 'required'],
//            [['id_kecamatan', 'kodepos'], 'integer'],
//            [['nama_kelurahan'], 'string', 'max' => 250],
//        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $labelArray = AppFieldConfigSearch::getLabels(Kelurahan::tableName());


        return $labelArray;
//        return [
//            'id_kelurahan' => 'Id Kelurahan',
//            'id_kecamatan' => 'Nama Kecamatan',
//            'nama_kelurahan' => 'Nama Kelurahan',
//            'kodepos' => 'Kode Pos',
//        ];
    }

    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kecamatan' => 'id_kecamatan']);
    }
}
