<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpanel_leftmenu".
 *
 * @property int $id_leftmenu
 * @property int $id_parent_leftmenu
 * @property int $has_child
 * @property string $menu_name
 * @property string $menu_icon
 * @property string $value_indo
 * @property string $value_eng
 * @property string $url
 * @property int $is_public
 * @property string $auth
 * @property string $mobile_display
 * @property int $visible
 */
class CpanelLeftmenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cpanel_leftmenu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_leftmenu', 'id_parent_leftmenu', 'has_child', 'menu_name', 'menu_icon', 'value_indo', 'value_eng', 'url', 'auth', 'mobile_display'], 'required'],
            [['id_leftmenu', 'id_parent_leftmenu', 'has_child', 'is_public', 'visible'], 'integer'],
            [['auth', 'mobile_display'], 'string'],
            [['menu_name'], 'string', 'max' => 200],
            [['menu_icon'], 'string', 'max' => 100],
            [['value_indo', 'value_eng', 'url'], 'string', 'max' => 250],
            [['id_leftmenu'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_leftmenu' => 'Id Leftmenu',
            'id_parent_leftmenu' => 'Id Parent Leftmenu',
            'has_child' => 'Has Child',
            'menu_name' => 'Menu Name',
            'menu_icon' => 'Menu Icon',
            'value_indo' => 'Value Indo',
            'value_eng' => 'Value Eng',
            'url' => 'Url',
            'is_public' => 'Is Public',
            'auth' => 'Auth',
            'mobile_display' => 'Mobile Display',
            'visible' => 'Visible',
        ];
    }
}
