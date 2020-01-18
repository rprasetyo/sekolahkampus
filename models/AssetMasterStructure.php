<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asset_master_structure".
 *
 * @property string $id_asset_master_structure
 * @property string $id_asset_master_parent
 * @property string $id_asset_master_child
 */
class AssetMasterStructure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_master_structure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asset_master_parent', 'id_asset_master_child'], 'required'],
            [['id_asset_master_parent', 'id_asset_master_child'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_master_structure' => 'Id Asset Master Structure',
            'id_asset_master_parent' => 'Asset Master Parent',
            'id_asset_master_child' => 'Asset Master Child',
        ];
    }
	
	public function getAssetMasterParent()
    {
        return $this->hasOne(AssetMaster::className(), ['id_asset_master' => 'id_asset_master_parent']);
    }
	
	public function getAssetMasterChild()
    {
        return $this->hasOne(AssetMaster::className(), ['id_asset_master' => 'id_asset_master_child']);
    }
}
