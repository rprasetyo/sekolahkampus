<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_perusahaan".
 *
 * @property int $id_user_perusahaan
 * @property int $id_user
 * @property int $id_perusahaan
 * @property string $created_date
 * @property int $created_user
 * @property string $created_ip_address
 */
class UserPerusahaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_perusahaan';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_perusahaan'], 'required'],
            [['id_user', 'id_perusahaan', 'created_user'], 'integer'],
            [['created_date'], 'safe'],
            [['created_ip_address'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user_perusahaan' => 'Id User Perusahaan',
            'id_user' => 'Id User',
            'id_perusahaan' => 'Id Perusahaan',
            'created_date' => 'Created Date',
            'created_user' => 'Created User',
            'created_ip_address' => 'Created Ip Address',
        ];
    }
}
