<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_asset_item2".
 *
 * @property int $id_type_asset_item
 * @property string $type_asset_item
 * @property string $description
 * @property int $is_active
 */
class TypeAssetItem2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_asset_item2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $ruleslist = AppFieldConfigSearch::getRules(TypeAssetItem2::tableName());

        return $ruleslist;

//        return [
//            [['type_asset_item'], 'required'],
//            [['description'], 'string'],
//            [['is_active'], 'integer'],
//            [['type_asset_item'], 'string', 'max' => 250],
//        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $labelArray = AppFieldConfigSearch::getLabels(TypeAssetItem2::tableName());


        return $labelArray;

//        return [
//            'id_type_asset_item' => 'Id Type Asset Item',
//            'type_asset_item' => 'Type Asset Item',
//            'description' => 'Description',
//            'is_active' => 'Is Active',
//        ];
    }
}
