<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "market_place".
 *
 * @property string $id_marketplace
 * @property string $marketplace_name
 * @property string $url_address
 * @property string $status
 */
class MarketPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'market_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marketplace_name', 'url_address', 'status'], 'required'],
            [['status'], 'string'],
            [['marketplace_name', 'url_address'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_marketplace' => 'Id Marketplace',
            'marketplace_name' => 'Marketplace Name',
            'url_address' => 'Url Address',
            'status' => 'Status',
        ];
    }
}
