<?php

namespace app\models;

use app\common\helpers\TypeFieldEnum;
use Mpdf\Tag\Th;
use Yii;

/**
 * This is the model class for table "app_field_config".
 *
 * @property int $id_app_field_config
 * @property string $classname
 * @property string $varian_group
 * @property string $fieldname
 * @property string $label
 * @property int $no_order
 * @property int $is_visible
 * @property int $is_required
 * @property int $is_unique
 * @property int $is_safe
 * @property int $type_field
 * @property int $max_field
 * @property string $default_value
 * @property string $pattern
 * @property string $image_extensions
 * @property string $image_max_size
 */
class AppFieldConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_field_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classname', 'fieldname', 'label', 'no_order', 'is_visible', 'is_required', 'max_field', 'image_extensions', 'image_max_size'], 'required'],
            [['no_order', 'is_visible', 'is_required', 'is_unique', 'is_safe', 'type_field', 'max_field'], 'integer'],
            [['classname', 'fieldname', 'label', 'default_value', 'pattern', 'image_extensions', 'image_max_size', 'varian_group'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_app_field_config' => 'Id App Field Config',
            'classname' => 'Classname',
            'fieldname' => 'Fieldname',
            'label' => 'Label',
            'no_order' => 'No Order',
            'is_visible' => 'Visible',
            'is_required' => 'Required',
            'is_unique' => 'Unique',
            'is_safe' => 'Safe',
            'type_field' => 'Type Field',
            'max_field' => 'Max Field',
            'default_value' => 'Default Value',
            'pattern' => 'Pattern',
            'image_extensions' => 'Image Extensions',
            'image_max_size' => 'Image Max Size',
        ];
    }

    public function getTypeFieldConfig(){
        $list = TypeFieldEnum::$list;
        return array_key_exists($this->type_field, $list) ? $list[$this->type_field] : 'Undefined';
    }
}
