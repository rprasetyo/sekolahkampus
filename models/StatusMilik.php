<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_milik".
 *
 * @property int $id_status_milik
 * @property string $status_milik
 * @property string $keterangan
 */
class StatusMilik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_milik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_milik'], 'required'],
            [['status_milik'], 'string', 'max' => 200],
            [['keterangan'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status_milik' => Yii::t('app', 'Id Status Milik'),
            'status_milik' => Yii::t('app', 'Status Milik'),
            'keterangan' => Yii::t('app', 'Keterangan'),
        ];
    }
}
