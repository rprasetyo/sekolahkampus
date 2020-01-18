<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asset_code".
 *
 * @property int $id_asset_code
 * @property int $id_parent_asset_code
 * @property string $code
 * @property string $description
 */
class AssetCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent_asset_code', 'code'], 'required'],
            [['id_parent_asset_code'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_code' => 'Id Asset Code',
            'id_parent_asset_code' => 'Id Parent Asset Code',
            'code' => 'Code',
            'description' => 'Description',
        ];
    }
}
