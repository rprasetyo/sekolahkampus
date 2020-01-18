<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_user_access".
 *
 * @property int $id_role_user_access
 * @property int $id_role_menu
 * @property string $role_name
 * @property int $user_read
 * @property int $user_write
 * @property int $user_delete
 */
class RoleUserAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_user_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_role_menu', 'role_name'], 'required'],
            [['id_role_menu', 'user_read', 'user_write', 'user_delete'], 'integer'],
            [['role_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_role_user_access' => 'Id Role User Access',
            'id_role_menu' => 'Id Role Menu',
            'role_name' => 'Role Name',
            'user_read' => 'User Read',
            'user_write' => 'User Write',
            'user_delete' => 'User Delete',
        ];
    }
}
