<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asset_master_field_config".
 *
 * @property int $id_asset_master_field_config
 * @property string $fieldname
 * @property string $label
 * @property int $is_visible
 * @property int $is_required
 * @property int $type_field
 */
class AssetMasterFieldConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_master_field_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fieldname', 'label', 'is_visible', 'is_required'], 'required'],
            [['is_visible', 'is_required', 'type_field'], 'integer'],
            [['fieldname', 'label'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asset_master_field_config' => 'Id Asset Master Field Config',
            'fieldname' => 'Fieldname',
            'label' => 'Label',
            'is_visible' => 'Visible',
            'is_required' => 'Required',
            'type_field' => 'Type Field',
        ];
    }
}
