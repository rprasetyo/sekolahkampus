<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kamus_petunjuk".
 *
 * @property int $id_kamus_petunjuk
 * @property string $nama
 * @property string $deskripsi
 * @property int $is_visible
 */
class KamusPetunjuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kamus_petunjuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'deskripsi'], 'required'],
            [['is_visible'], 'integer'],
            [['nama'], 'string', 'max' => 150],
            [['deskripsi'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kamus_petunjuk' => 'Id Kamus Petunjuk',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'is_visible' => 'Is Visible',
        ];
    }
}
