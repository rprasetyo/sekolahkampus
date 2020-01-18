<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item_menu".
 *
 * @property int $id_auth_item_menu
 * @property string $menu_utama
 * @property string $child_menu
 * @property string $role
 * @property string $path
 * @property int $is_enable
 */
class AuthItemMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_utama', 'child_menu', 'role', 'path'], 'required'],
            [['child_menu'], 'string'],
            [['is_enable'], 'integer'],
            [['menu_utama', 'role'], 'string', 'max' => 64],
            [['path'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_auth_item_menu' => 'Id Auth Item Menu',
            'menu_utama' => 'Menu Utama',
            'child_menu' => 'Child Menu',
            'role' => 'Role',
            'path' => 'Path',
            'is_enable' => 'Is Enable',
        ];
    }
}
