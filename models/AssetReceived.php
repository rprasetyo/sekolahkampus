<?php

namespace app\models;

/**
 * This is the model class for table "asset_received".
 *
 * @property int $id_asset_received
 * @property int $id_asset_master
 * @property string $number1
 * @property string $number2
 * @property string $number3
 * @property string $received_date
 * @property int $received_year
 * @property double $price_received
 * @property int $quantity
 * @property int $id_status_received
 */
class AssetReceived extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_received';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master', 'received_year', 'price_received', 'id_status_received'], 'required'],
            [['id_asset_master', 'received_year', 'quantity', 'id_status_received'], 'integer'],
            [['received_date'], 'safe'],
            [['price_received'], 'number'],
            [['number1', 'number2', 'number3'], 'string', 'max' => 150],
			[['notes1', 'notes2', 'notes3'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_received' => 'Id Asset Received',
            'id_asset_master' => 'Asset Master',
            'number1' => 'Number 1',
            'number2' => 'Number 2',
            'number3' => 'Number 3',
            'received_date' => 'Received Date',
            'received_year' => 'Tahun Perolehan',
            'price_received' => 'Harga Perolehan',
            'quantity' => 'Quantity',
            'id_status_received' => 'Kondisi Barang',
			'notes1' => 'Penggunaan',
        ];
    }

    public function getAssetMaster()
    {
        return $this->hasOne(AssetMaster::className(), ['id_asset_master' => 'id_asset_master']);
    }

    public function getStatusReceived()
    {
        return $this->hasOne(MstStatusReceived::className(), ['id_status_received' => 'id_status_received']);
    }
}
