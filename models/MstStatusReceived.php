<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mst_status_received".
 *
 * @property int $id_status_received
 * @property string $status_received
 * @property int $is_active
 */
class MstStatusReceived extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_status_received';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_received'], 'required'],
            [['is_active'], 'integer'],
            [['status_received'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status_received' => 'Id Status Received',
            'status_received' => 'Kondisi',
            'is_active' => 'Status',
        ];
    }
}
