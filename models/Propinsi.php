<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "propinsi".
 *
 * @property int $id_propinsi
 * @property string $nama_propinsi
 */
class Propinsi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'propinsi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_propinsi'], 'required'],
            [['nama_propinsi'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_propinsi' => 'Id Propinsi',
            'nama_propinsi' => 'Nama Provinsi',
        ];
    }
}
