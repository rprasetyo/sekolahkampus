<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_sekolah".
 *
 * @property int $id_jenis_sekolah
 * @property string $jenis_sekolah
 * @property string $keterangan
 */
class JenisSekolah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_sekolah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_sekolah'], 'required'],
            [['jenis_sekolah', 'keterangan'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jenis_sekolah' => Yii::t('app', 'Id Jenis Sekolah'),
            'jenis_sekolah' => Yii::t('app', 'Jenis Sekolah'),
            'keterangan' => Yii::t('app', 'Keterangan'),
        ];
    }
}
