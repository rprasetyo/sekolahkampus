<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_asset3".
 *
 * @property int $id_type_asset
 * @property string $type_asset
 * @property string $description
 * @property int $is_active
 */
class TypeAsset3 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_asset3';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $ruleslist = AppFieldConfigSearch::getRules(TypeAsset3::tableName());


        return $ruleslist;
//        return [
//            [['type_asset'], 'required'],
//            [['description'], 'string'],
//            [['is_active'], 'integer'],
//            [['type_asset'], 'string', 'max' => 250],
//        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $labelArray = AppFieldConfigSearch::getLabels(TypeAsset3::tableName());


        return $labelArray;
//        return [
//            'id_type_asset' => 'Id Type Asset',
//            'type_asset' => 'Type Asset',
//            'description' => 'Description',
//            'is_active' => 'Status',
//        ];
    }
}
