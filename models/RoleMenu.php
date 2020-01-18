<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_menu".
 *
 * @property int $id_role_menu
 * @property string $menu
 * @property int $is_active
 */
class RoleMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu'], 'required'],
            [['is_active'], 'integer'],
            [['menu'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_role_menu' => 'Id Role Menu',
            'menu' => 'Menu',
            'is_active' => 'Status',
        ];
    }
}
