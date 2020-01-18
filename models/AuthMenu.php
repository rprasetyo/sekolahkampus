<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_menu".
 *
 * @property int $id_auth_menu
 * @property string $menu_utama
 * @property string $child_menu
 * @property string $path
 */
class AuthMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_utama', 'child_menu', 'path'], 'required'],
            [['child_menu'], 'string'],
            [['menu_utama'], 'string', 'max' => 64],
            [['path'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_auth_menu' => 'Id Auth Menu',
            'menu_utama' => 'Menu Utama',
            'child_menu' => 'Child Menu',
            'path' => 'Path',
        ];
    }
}
